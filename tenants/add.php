<?php

include "../config/database.php";

if (isset($_POST["submit"])) {

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $contact_number = $_POST["contact_number"];
    $province = $_POST["province"];
    $city = $_POST["city"];
    $barangay = $_POST["barangay"];
    $email = $_POST["email"];

    $sql = "INSERT INTO tenants
            (first_name, last_name, contact_number, province, city, barangay, email)
            VALUES
            ('$first_name', '$last_name', '$contact_number', '$province', '$city', '$barangay', '$email')";

    if ($conn->query($sql) === TRUE) {

        header("Location: index.php");
        exit();

    } else {

        echo "Error: " . $conn->error;

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Tenant</title>

    <style>

        body {
            font-family: Arial;
            background-color: #f2f2f2;
            margin: 0;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 20px;
        }

        .container {
            width: 500px;
            margin: 30px auto;
            background-color: white;
            padding: 25px;
            box-shadow: 0 2px 5px gray;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        /* CONTACT NUMBER */

        .contact-input {
            display: flex;
            align-items: center;

            border: 1px solid #cccccc;
            border-radius: 5px;

            margin-top: 5px;
            margin-bottom: 15px;

            overflow: hidden;
        }

        .contact-input span {
            padding: 10px;

            color: #999;

            background-color: #f5f5f5;
        }

        .contact-input input {
            border: none;
            outline: none;

            margin: 0;

            flex: 1;
        }

        button {
            background-color: #333;
            color: white;

            padding: 10px 20px;

            border: none;

            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        a {
            margin-left: 10px;
        }

    </style>

</head>

<body>

<div class="header">

    <h1>Add Tenant</h1>

</div>

<div class="container">

    <form method="POST">

        <label>First Name:</label>

        <input
            type="text"
            name="first_name"
            required
        >


        <label>Last Name:</label>

        <input
            type="text"
            name="last_name"
            required
        >


        <label>Contact Number:</label>

        <div class="contact-input">

            <span>+63</span>

            <input
                type="text"
                name="contact_number"
                maxlength="10"
                inputmode="numeric"
                pattern="[0-9]{10}"
                placeholder="9123456789"
                required
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            >

        </div>


        <label>Province:</label>

        <input
            type="text"
            name="province"
            required
        >


        <label>City:</label>

        <input
            type="text"
            name="city"
        >


        <label>Barangay:</label>

        <input
            type="text"
            name="barangay"
        >


        <label>Email:</label>

        <input
            type="email"
            name="email"
        >


        <button type="submit" name="submit">
            Add Tenant
        </button>

        <a href="index.php">
            Cancel
        </a>

    </form>

</div>

</body>

</html>