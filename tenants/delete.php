<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $tenant_id = (int) $_GET["id"];

    try {

        // Start transaction
        $conn->begin_transaction();

        // Get tenant information
        $sql = "SELECT * FROM tenants
                WHERE tenant_id = $tenant_id";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {

            echo "Tenant not found.";
            exit();

        }

        $tenant = $result->fetch_assoc();

        // Prepare the tenant details
        $details = "Tenant ID: " . $tenant["tenant_id"] .
                   " | Name: " . $tenant["first_name"] . " " . $tenant["last_name"] .
                   " | Contact: " . $tenant["contact_number"] .
                   " | Province: " . $tenant["province"] .
                   " | City: " . $tenant["city"] .
                   " | Barangay: " . $tenant["barangay"] .
                   " | Email: " . $tenant["email"];

        // Protect the details before inserting
        $details = $conn->real_escape_string($details);

        // Save tenant to archive
        $archive_sql = "INSERT INTO archive
                        (record_type, record_id, record_details)
                        VALUES
                        ('Tenant', $tenant_id, '$details')";

        $conn->query($archive_sql);

        // Remove tenant from active tenants table
        $delete_sql = "DELETE FROM tenants
                       WHERE tenant_id = $tenant_id";

        $conn->query($delete_sql);

        // Save all changes
        $conn->commit();

        // Return to tenants page
        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        // Undo changes if something goes wrong
        $conn->rollback();

        if ($e->getCode() == 1451) {

            echo "<script>";

            echo "alert('This tenant cannot be archived because they have an existing lease.');";

            echo "window.location.href='index.php';";

            echo "</script>";

            exit();

        } else {

            echo "Error archiving tenant: " . $e->getMessage();

        }

    }

}

?>