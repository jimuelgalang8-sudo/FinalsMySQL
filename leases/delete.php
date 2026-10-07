<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $lease_id = (int) $_GET["id"];

    try {

        // Start transaction
        $conn->begin_transaction();

        // Get lease information
        $sql = "SELECT * FROM leases
                WHERE lease_id = $lease_id";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {

            echo "Lease not found.";
            exit();

        }

        $lease = $result->fetch_assoc();

        // Prepare lease details
        $details = "Lease ID: " . $lease["lease_id"] .
                   " | Tenant ID: " . $lease["tenant_id"] .
                   " | Unit ID: " . $lease["unit_id"] .
                   " | Start Date: " . $lease["start_date"] .
                   " | End Date: " . $lease["end_date"] .
                   " | Status: " . $lease["lease_status"];

        // Protect the details before inserting
        $details = $conn->real_escape_string($details);

        // Save lease to archive
        $archive_sql = "INSERT INTO archive
                        (record_type, record_id, record_details)
                        VALUES
                        ('Lease', $lease_id, '$details')";

        $conn->query($archive_sql);

        // Remove lease from active leases table
        $delete_sql = "DELETE FROM leases
                       WHERE lease_id = $lease_id";

        $conn->query($delete_sql);

        // Save changes
        $conn->commit();

        // Return to Leases page
        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        // Undo changes if something goes wrong
        $conn->rollback();

        if ($e->getCode() == 1451) {

            echo "<script>";

            echo "alert('This lease cannot be archived because it has related payments or utility bills.');";

            echo "window.location.href='index.php';";

            echo "</script>";

            exit();

        } else {

            echo "Error archiving lease: " . $e->getMessage();

        }

    }

}

?>