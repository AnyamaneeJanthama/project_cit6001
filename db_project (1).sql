-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 10:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin1', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` varchar(4) NOT NULL,
  `cus_firstname` varchar(20) NOT NULL,
  `cus_lastname` varchar(20) NOT NULL,
  `cus_address` varchar(50) NOT NULL,
  `cus_subdis` varchar(30) NOT NULL,
  `cus_district` varchar(30) NOT NULL,
  `cus_province` varchar(30) NOT NULL,
  `cus_postcode` varchar(5) NOT NULL,
  `cus_phone` varchar(10) NOT NULL,
  `cus_email` varchar(50) NOT NULL,
  `void` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_firstname`, `cus_lastname`, `cus_address`, `cus_subdis`, `cus_district`, `cus_province`, `cus_postcode`, `cus_phone`, `cus_email`, `void`) VALUES
('0001', 'จันทิรา', 'กิตติมานพ', '36/9', 'สถาน', 'เชียงของ', 'เชียงราย', '57140', '0698521473', 'juntira@gmail.com', 0),
('0002', 'Stephen', 'Dyer', 'Soluta consequuntur ', 'Consectetur sint eni', 'Harum molestias obca', 'Officia consectetur', '5555', '+1 (536) 7', 'pupa@mailinator.com', 0),
('0003', 'Idola', 'Kelly', 'Est eiusmod velit a', 'Modi exercitation ci', 'Deleniti nostrud ex ', 'Dolorem et in volupt', 'Excep', '+1 (469) 2', 'weca@mailinator.com', 0),
('0004', 'Valentine', 'Duke', 'Quia ducimus vero e', 'Architecto veniam c', 'Laudantium ut conse', 'Sapiente a aut culpa', 'Nesci', '+1 (548) 1', 'luvavipuk@mailinator.com', 1),
('0005', 'Ivory', 'Caldwell', 'Ex sunt non eum qui', 'Ea quibusdam lorem o', 'Proident quia disti', 'Enim recusandae Iur', 'Conse', '+1 (494) 6', 'fevenyrati@mailinator.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` varchar(4) NOT NULL,
  `emp_firstname` varchar(20) NOT NULL,
  `emp_lastname` varchar(20) NOT NULL,
  `emp_address` varchar(50) NOT NULL,
  `emp_subdis` varchar(20) NOT NULL,
  `emp_district` varchar(30) NOT NULL,
  `emp_province` varchar(30) NOT NULL,
  `emp_postcode` varchar(5) NOT NULL,
  `emp_phone` varchar(10) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_startworking` date NOT NULL,
  `emp_password` varchar(20) NOT NULL,
  `emp_department` varchar(30) NOT NULL,
  `void` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_firstname`, `emp_lastname`, `emp_address`, `emp_subdis`, `emp_district`, `emp_province`, `emp_postcode`, `emp_phone`, `emp_email`, `emp_startworking`, `emp_password`, `emp_department`, `void`) VALUES
('0001', 'มาลา', 'จันติตา', '16', 'สถาน', 'เชียงของ', 'เชียงราย', '57140', '0825011348', 'mala@gmail.com', '2023-09-01', 'mala1234', 'ผู้จัดการฝ่ายบัญชี', 0),
('0002', 'Brandon', 'Bradford', 'Facere ad maiores ip', 'Aut corrupti error ', 'Mollitia anim fugiat', 'Tenetur repudiandae ', 'Volup', '+1 (703) 9', 'gagyme@mailinator.com', '2007-12-03', 'Et aut eius omnis cu', 'Et saepe tenetur eni', 0),
('0003', 'Shannon', 'Wong', 'Totam mollitia solut', 'Est perferendis et l', 'Rerum lorem ducimus', 'Dolor ut consequuntu', 'Moles', '+1 (314) 6', 'foxopyda@mailinator.com', '1990-03-14', 'Pariatur Ea quisqua', 'Adipisci dolores occ', 0),
('0004', 'Dorian', 'Hansen', 'Adipisci exercitatio', 'Omnis do ad impedit', 'Minima pariatur Ea ', 'Commodo voluptatem ', 'Delec', '+1 (518) 1', 'jymisa@mailinator.com', '2017-01-10', 'Ab eaque quis repell', 'Quibusdam minim veri', 0),
('0005', 'Anyamanee1', 'Janthama', '18/1', 'สถาน', 'เชียงของ', 'เชียงราย', '57140', '+666250111', 'sml19932002@gmail.com', '2023-10-11', '1254', 'ฝึกงาน', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` varchar(4) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `cus_id` varchar(4) NOT NULL,
  `project_start` date NOT NULL,
  `project_end` date NOT NULL,
  `project_valueprice` float(10,2) NOT NULL,
  `emp_id` varchar(4) NOT NULL COMMENT 'ผู้ดูแลโครงการ',
  `project_status` int(1) NOT NULL COMMENT '0 = ยกเลิก, 1 = อยู่ระหว่างดำเนินการ, 2 = ปิดโครงการ',
  `void` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `cus_id`, `project_start`, `project_end`, `project_valueprice`, `emp_id`, `project_status`, `void`) VALUES
('0001', 'Regan Hubbard', '0004', '2023-10-11', '2024-10-11', 96700.00, '0002', 1, 0),
('0002', 'Ivory Levine', '0001', '2023-10-11', '2024-10-11', 972.00, '0005', 1, 0),
('0003', 'Velma Jarvis', '0005', '2023-10-11', '2024-10-11', 208000.00, '0005', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_close`
--

CREATE TABLE `project_close` (
  `headcode` varchar(8) NOT NULL,
  `dateclose` date NOT NULL,
  `project_id` int(4) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `pay` float(10,2) NOT NULL,
  `emp_id` int(4) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `void` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_close`
--

INSERT INTO `project_close` (`headcode`, `dateclose`, `project_id`, `cost`, `pay`, `emp_id`, `comment`, `void`) VALUES
('23100001', '1978-12-04', 1, 96700.00, 3740.00, 2, '-', 0),
('23100003', '1997-04-08', 5, 208000.00, 6840.00, 2, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_desc`
--

CREATE TABLE `project_desc` (
  `headcode` varchar(8) NOT NULL,
  `s_id` varchar(4) NOT NULL,
  `qty` float(5,2) NOT NULL,
  `s_price` float(8,2) NOT NULL,
  `totalprice` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_desc`
--

INSERT INTO `project_desc` (`headcode`, `s_id`, `qty`, `s_price`, `totalprice`) VALUES
('23100001', '0003', 221.00, 510.00, 112710.00),
('23100001', '0002', 190.00, 452.00, 85880.00),
('23100001', '0003', 46.00, 916.00, 42136.00);

-- --------------------------------------------------------

--
-- Table structure for table `project_hd`
--

CREATE TABLE `project_hd` (
  `headcode` varchar(8) NOT NULL COMMENT 'headcode = no_',
  `datesave` date NOT NULL,
  `receiptcode` int(4) NOT NULL,
  `datereceipt` date NOT NULL,
  `project_id` int(11) NOT NULL,
  `totalprice` float(8,2) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=ยกเลิก, 1=ปกติ',
  `void` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_hd`
--

INSERT INTO `project_hd` (`headcode`, `datesave`, `receiptcode`, `datereceipt`, `project_id`, `totalprice`, `status`, `void`) VALUES
('23100001', '1971-03-22', 52, '1991-11-27', 3, 42136.00, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `s_id` varchar(4) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_unit` varchar(30) NOT NULL,
  `s_price` float(10,2) NOT NULL,
  `void` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`s_id`, `s_name`, `s_unit`, `s_price`, `void`) VALUES
('0001', 'คอมพิวเตอร์', 'เครื่อง', 9999.99, 0),
('0002', 'กระดาษ', 'ริม', 643.00, 0),
('0003', 'โซฟา', 'ตัว', 29999.99, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `project_hd`
--
ALTER TABLE `project_hd`
  ADD PRIMARY KEY (`headcode`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`s_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
