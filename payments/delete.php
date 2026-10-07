<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $payment_id = (int) $_GET["id"];

    try {

        // Start transaction
        $conn->begin_transaction();

        // Get payment information
        $sql = "SELECT * FROM payments
                WHERE payment_id = $payment_id";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {

            echo "Payment not found.";
            exit();

        }

        $payment = $result->fetch_assoc();

        // Prepare payment details
        $details = "Payment ID: " . $payment["payment_id"] .
                   " | Lease ID: " . $payment["lease_id"] .
                   " | Payment Date: " . $payment["payment_date"] .
                   " | Amount: " . $payment["amount"] .
                   " | Payment Method: " . $payment["payment_method"] .
                   " | Payment Status: " . $payment["payment_status"];

        // Protect the details before inserting
        $details = $conn->real_escape_string($details);

        // Save payment to archive
        $archive_sql = "INSERT INTO archive
                        (record_type, record_id, record_details)
                        VALUES
                        ('Payment', $payment_id, '$details')";

        $conn->query($archive_sql);

        // Remove payment from active payments table
        $delete_sql = "DELETE FROM payments
                       WHERE payment_id = $payment_id";

        $conn->query($delete_sql);

        // Save changes
        $conn->commit();

        // Return to Payments page
        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        // Undo changes if something goes wrong
        $conn->rollback();

        if ($e->getCode() == 1451) {

            echo "<script>";

            echo "alert('This payment cannot be archived because it has an existing payment detail.');";

            echo "window.location.href='index.php';";

            echo "</script>";

            exit();

        } else {

            echo "Error archiving payment: " . $e->getMessage();

        }

    }

}

?>