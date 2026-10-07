<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $bill_id = (int) $_GET["id"];

    try {

        $conn->begin_transaction();

        $sql = "SELECT * FROM utility_bills
                WHERE bill_id = $bill_id";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            echo "Utility bill not found.";
            exit();
        }

        $bill = $result->fetch_assoc();

        $details = "Bill ID: " . $bill["bill_id"] .
                   " | Lease ID: " . $bill["lease_id"] .
                   " | Utility Type: " . $bill["utility_type"] .
                   " | Billing Month: " . $bill["billing_month"] .
                   " | Amount: " . $bill["amount"] .
                   " | Bill Status: " . $bill["bill_status"];

        $details = $conn->real_escape_string($details);

        $archive_sql = "INSERT INTO archive
                        (record_type, record_id, record_details)
                        VALUES
                        ('Utility Bill', $bill_id, '$details')";

        $conn->query($archive_sql);

        $delete_sql = "DELETE FROM utility_bills
                       WHERE bill_id = $bill_id";

        $conn->query($delete_sql);

        $conn->commit();

        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        $conn->rollback();

        if ($e->getCode() == 1451) {

            echo "<script>";
            echo "alert('This utility bill cannot be archived because it has an existing payment detail.');";
            echo "window.location.href='index.php';";
            echo "</script>";
            exit();

        } else {

            echo "Error archiving utility bill: " . $e->getMessage();

        }
    }
}

?>