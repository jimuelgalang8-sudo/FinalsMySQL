-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 07, 2026 at 04:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `archive_id` int(11) NOT NULL,
  `record_type` varchar(50) NOT NULL,
  `record_id` int(11) NOT NULL,
  `record_details` text NOT NULL,
  `archived_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`archive_id`, `record_type`, `record_id`, `record_details`, `archived_at`) VALUES
(2, 'Tenant', 16, 'Tenant ID: 16 | Name: Dave Llanto | Contact: 091234567891 | Email: asdasdsad@gmail.com | Address: Taga pulo', '2026-10-07 00:23:29'),
(3, 'Unit', 18, 'Unit ID: 18 | Unit Number: 6 | Unit Type: Single bedroom | Monthly Rent: 1500.00 | Status: Available', '2026-10-07 00:27:55'),
(4, 'Lease', 9, 'Lease ID: 9 | Tenant ID: 1 | Unit ID: 4 | Start Date: 2026-10-15 | End Date: 2026-10-17 | Status: Expired', '2026-10-07 00:30:59'),
(5, 'Payment', 9, 'Payment ID: 9 | Lease ID: 4 | Payment Date: 2026-10-03 | Amount: 1525.00 | Payment Method: Bank Transfer | Payment Status: Paid', '2026-10-07 00:34:33'),
(6, 'Utility Bill', 9, 'Bill ID: 9 | Lease ID: 4 | Utility Type: Electricity | Billing Month: 2026-10-03 | Amount: 1525.00 | Bill Status: Paid', '2026-10-07 00:38:02'),
(7, 'Payment Detail', 9, 'Payment Detail ID: 9 | Payment ID: 4 | Bill ID: 3 | Amount Paid: 1300.00', '2026-10-07 00:41:27'),
(8, 'Payment Detail', 10, 'Payment Detail ID: 10 | Payment ID: 2 | Bill ID: 2 | Amount Paid: 1555.00', '2026-10-07 00:43:01'),
(9, 'Tenant', 17, 'Tenant ID: 17 | Name: John Santos | Contact: 09171234567 | Province: Laguna | City: Calamba | Barangay: Niugan | Email: john@email.com', '2026-10-07 22:19:20'),
(10, 'Tenant', 18, 'Tenant ID: 18 | Name: John Santos | Contact: 09171234567 | Province: Laguna | City: Calamba | Barangay: Cabuyao | Email: john@email.com', '2026-10-07 22:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `leases`
--

CREATE TABLE `leases` (
  `lease_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `lease_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leases`
--

INSERT INTO `leases` (`lease_id`, `tenant_id`, `unit_id`, `start_date`, `end_date`, `lease_status`) VALUES
(1, 1, 1, '2026-01-01', '2026-12-31', 'Active'),
(2, 2, 2, '2026-02-01', '2027-01-31', 'Active'),
(3, 3, 3, '2026-03-01', '2027-02-28', 'Active'),
(4, 4, 4, '2026-04-01', '2027-03-31', 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `lease_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `lease_id`, `payment_date`, `amount`, `payment_method`, `payment_status`) VALUES
(1, 1, '2026-09-01', 5000.00, 'Cash', 'Pending'),
(2, 2, '2026-09-02', 5000.00, 'GCash', 'Paid'),
(3, 3, '2026-09-03', 7500.00, 'Bank Transfer', 'Paid'),
(4, 4, '2026-09-04', 5500.00, 'Cash', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_detail_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_detail_id`, `payment_id`, `bill_id`, `amount_paid`) VALUES
(1, 1, 1, 1200.00),
(2, 2, 2, 500.00),
(3, 3, 3, 1500.00);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `first_name`, `last_name`, `contact_number`, `province`, `city`, `barangay`, `email`) VALUES
(1, 'John', 'Santos', '09171234567', 'Laguna', 'Calamba', 'Majayjay', 'john@email.com'),
(2, 'Maria', 'Reyes', '09181234567', 'Laguna', 'Cabuyao', 'Marinig', 'maria@email.com'),
(3, 'Carlo', 'Garcia', '09191234567', 'Laguna', 'Calamba', 'Canlubang', 'carlo@email.com'),
(4, 'Anna', 'Cruz', '09201234567', 'Laguna', 'Sta.Rosa', 'Celestine', 'anna@email.com'),
(15, 'Jimuel', 'Galang', '0912345678', 'Laguna', 'Cabuyao', 'Sala', 'jimuelgalang4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_number` varchar(20) NOT NULL,
  `unit_type` varchar(50) NOT NULL,
  `monthly_rent` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_number`, `unit_type`, `monthly_rent`, `status`) VALUES
(1, 'A-101', 'Single Room', 5000.00, 'Occupied'),
(2, 'A-102', 'Single Room', 5000.00, 'Occupied'),
(3, 'A-103', 'Double Room', 7500.00, 'Available'),
(4, 'B-101', 'Single Room', 5500.00, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`) VALUES
(1, 'admin', 'admin123', 'Apartment Administrator'),
(2, 'staff01', 'staff123', 'Maria Santos'),
(3, 'staff02', 'staff123', 'Juan Dela Cruz'),
(4, 'staff03', 'staff123', 'Ana Reyes'),
(5, 'staff04', 'staff123', 'Mark Garcia');

-- --------------------------------------------------------

--
-- Table structure for table `utility_bills`
--

CREATE TABLE `utility_bills` (
  `bill_id` int(11) NOT NULL,
  `lease_id` int(11) NOT NULL,
  `utility_type` varchar(30) NOT NULL,
  `billing_month` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `bill_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utility_bills`
--

INSERT INTO `utility_bills` (`bill_id`, `lease_id`, `utility_type`, `billing_month`, `amount`, `bill_status`) VALUES
(1, 1, 'Water', '2026-09-25', 1200.00, 'Paid'),
(2, 2, 'Water', '2026-09-08', 500.00, 'Unpaid'),
(3, 3, 'Electricity', '2026-09-01', 1500.00, 'Unpaid'),
(4, 4, 'Water', '2026-09-01', 600.00, 'Paid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`archive_id`);

--
-- Indexes for table `leases`
--
ALTER TABLE `leases`
  ADD PRIMARY KEY (`lease_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `lease_id` (`lease_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_detail_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`),
  ADD UNIQUE KEY `unit_number` (`unit_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `utility_bills`
--
ALTER TABLE `utility_bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `lease_id` (`lease_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leases`
--
ALTER TABLE `leases`
  MODIFY `lease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utility_bills`
--
ALTER TABLE `utility_bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leases`
--
ALTER TABLE `leases`
  ADD CONSTRAINT `leases_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`tenant_id`),
  ADD CONSTRAINT `leases_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`lease_id`) REFERENCES `leases` (`lease_id`);

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`),
  ADD CONSTRAINT `payment_details_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `utility_bills` (`bill_id`);

--
-- Constraints for table `utility_bills`
--
ALTER TABLE `utility_bills`
  ADD CONSTRAINT `utility_bills_ibfk_1` FOREIGN KEY (`lease_id`) REFERENCES `leases` (`lease_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
