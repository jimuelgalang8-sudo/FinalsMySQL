<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $payment_detail_id = (int) $_GET["id"];

    try {

        $conn->begin_transaction();

        $sql = "SELECT * FROM payment_details
                WHERE payment_detail_id = $payment_detail_id";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            echo "Payment detail not found.";
            exit();
        }

        $payment_detail = $result->fetch_assoc();

        $details = "Payment Detail ID: " . $payment_detail["payment_detail_id"] .
                   " | Payment ID: " . $payment_detail["payment_id"] .
                   " | Bill ID: " . $payment_detail["bill_id"] .
                   " | Amount Paid: " . $payment_detail["amount_paid"];

        $details = $conn->real_escape_string($details);

        $archive_sql = "INSERT INTO archive
                        (record_type, record_id, record_details)
                        VALUES
                        ('Payment Detail', $payment_detail_id, '$details')";

        $conn->query($archive_sql);

        $delete_sql = "DELETE FROM payment_details
                       WHERE payment_detail_id = $payment_detail_id";

        $conn->query($delete_sql);

        $conn->commit();

        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        $conn->rollback();

        echo "Error archiving payment detail: " . $e->getMessage();
    }
}

?>