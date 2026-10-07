<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>

    <title>Dashboard - Apartment Management System</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f6f8;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;

            width: 240px;
            height: 100vh;

            background-color: #222;

            color: white;

            padding: 25px 15px;
        }

        .logo {
            text-align: center;
            font-size: 20px;
            font-weight: bold;

            margin-bottom: 35px;
        }

        .menu a {
            display: block;

            color: #dddddd;
            text-decoration: none;

            padding: 13px 15px;

            margin-bottom: 5px;

            border-radius: 5px;
        }

        .menu a:hover {
            background-color: #444;
            color: white;
        }

        .menu .active {
            background-color: #444;
            color: white;
        }

        .logout {
            position: absolute;

            bottom: 25px;
            left: 15px;
            right: 15px;

            background-color: #333;

            text-align: center;
        }

        /* MAIN CONTENT */

        .main {
            margin-left: 240px;

            padding: 35px;
        }

        .top {
            margin-bottom: 30px;
        }

        .top h1 {
            margin: 0 0 10px 0;
        }

        .top p {
            color: #666;
            margin: 0;
        }

        /* CARDS */

        .cards {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;
        }

        .card {
            background-color: white;

            padding: 25px;

            border-radius: 8px;

            box-shadow: 0 2px 8px #dddddd;

            text-decoration: none;

            color: #222;

            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);

            box-shadow: 0 4px 12px #cccccc;
        }

        .card h2 {
            margin-top: 0;

            font-size: 18px;
        }

        .card h2 i {
    margin-right: 8px;
}

        .card p {
            color: #777;

            margin-bottom: 0;
        }

        /* MOBILE */

        @media (max-width: 800px) {

            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                padding: 25px;
            }

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .sidebar {
                position: relative;

                width: 100%;
                height: auto;
            }

            .logout {
                position: relative;

                bottom: auto;
                left: auto;
                right: auto;

                margin-top: 20px;
            }

            .main {
                margin-left: 0;
            }

            .cards {
                grid-template-columns: 1fr;
            }

        }

        .menu a i {
    margin-right: 10px;
}

    </style>

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">

        APARTMENT<br>
        MANAGEMENT

    </div>


    <div class="menu">

        <a href="dashboard.php" class="active">
             <i class="bi bi-house-door"></i>
             Dashboard
        </a>

        <a href="tenants/index.php">
            <i class="bi bi-people"></i>
             Tenants
        </a>

        <a href="units/index.php">
            <i class="bi bi-building"></i>
             Units
        </a>

        <a href="leases/index.php">
            <i class="bi bi-file-earmark-text"></i>
             Leases
        </a>

        <a href="payments/index.php">
            <i class="bi bi-cash-stack"></i>
             Payments
        </a>

        <a href="utilities/index.php">
            <i class="bi bi-lightbulb"></i>
             Utility Bills
        </a>

        <a href="payment_details/index.php">
            <i class="bi bi-link-45deg"></i>
             Payment Details
        </a>

        <a href="archive/index.php">
            <i class="bi bi-archive"></i>
         Archive
        </a>

        

        <a href="logout.php" class="logout">
            <i class="bi bi-box-arrow-right"></i>
             Logout
        </a>

    </div>

</div>


<!-- MAIN CONTENT -->

<div class="main">


    <div class="top">

        <h1>Dashboard</h1>

        <p>
            Welcome, <?php echo $_SESSION["full_name"]; ?>!
        </p>

    </div>


    <div class="cards">


        <a href="tenants/index.php" class="card">
            <h2>
            <i class="bi bi-people"></i>
            Tenants
            </h2>

            <p>
                Manage tenant information
            </p>

        </a>


        <a href="units/index.php" class="card">
            <h2>
        <i class="bi bi-building"></i>
            Units
        </h2>

            <p>
                Manage apartment units
            </p>

        </a>


        <a href="leases/index.php" class="card">
            <h2>
            <i class="bi bi-file-earmark-text"></i>
        Leases
        </h2>

            <p>
                Manage tenant leases
            </p>

        </a>


        <a href="payments/index.php" class="card">
             <h2>
            <i class="bi bi-cash-stack"></i>
                Payments
            </h2>

            <p>
                Manage rent payments
            </p>

        </a>


        <a href="utilities/index.php" class="card">
            <h2>
            <i class="bi bi-lightbulb"></i>
            Utility Bills
        </h2>

            <p>
                Manage utility bills
            </p>

        </a>


        <a href="payment_details/index.php" class="card">
            <h2>
            <i class="bi bi-link-45deg"></i>
             Payment Details
        </h2>

            <p>
                Manage payment details
            </p>

        </a>

        <a href="archive/index.php" class="card">
            <h2>
            <i class="bi bi-archive"></i>
            Archive
        </h2>

        <p>
        View archived records
        </p>

</a>


    </div>


</div>


</body>

</html>