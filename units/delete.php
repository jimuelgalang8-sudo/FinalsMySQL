<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $unit_id = (int) $_GET["id"];

    try {

        // Start transaction
        $conn->begin_transaction();

        // Get unit information
        $sql = "SELECT * FROM units
                WHERE unit_id = $unit_id";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {

            echo "Unit not found.";
            exit();

        }

        $unit = $result->fetch_assoc();

        // Prepare unit details
        $details = "Unit ID: " . $unit["unit_id"] .
                   " | Unit Number: " . $unit["unit_number"] .
                   " | Unit Type: " . $unit["unit_type"] .
                   " | Monthly Rent: " . $unit["monthly_rent"] .
                   " | Status: " . $unit["status"];

        // Protect the details before inserting
        $details = $conn->real_escape_string($details);

        // Save unit to archive
        $archive_sql = "INSERT INTO archive
                        (record_type, record_id, record_details)
                        VALUES
                        ('Unit', $unit_id, '$details')";

        $conn->query($archive_sql);

        // Remove unit from active units table
        $delete_sql = "DELETE FROM units
                       WHERE unit_id = $unit_id";

        $conn->query($delete_sql);

        // Save changes
        $conn->commit();

        // Return to Units page
        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        // Undo changes if something goes wrong
        $conn->rollback();

        if ($e->getCode() == 1451) {

            echo "<script>";

            echo "alert('This unit cannot be archived because it has an existing lease.');";

            echo "window.location.href='index.php';";

            echo "</script>";

            exit();

        } else {

            echo "Error archiving unit: " . $e->getMessage();

        }

    }

}

?>