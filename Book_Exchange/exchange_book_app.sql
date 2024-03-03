-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 02:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exchange_book_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_Id` int(11) NOT NULL COMMENT 'It stores unique Admin Id',
  `Name` varchar(100) NOT NULL COMMENT 'It stores names of the admin. ',
  `Email` varchar(200) NOT NULL COMMENT 'It stores unique Email of the admins.',
  `Passwords` varchar(100) NOT NULL COMMENT 'It stores passwords of the Admin.',
  `Phone` varchar(20) NOT NULL COMMENT 'It stores phone Number of the admins.',
  `Address` varchar(200) NOT NULL COMMENT 'It stores Address details of the users.',
  `Image` varchar(255) DEFAULT NULL COMMENT 'It stores the image name of the admins.',
  `Status` varchar(255) NOT NULL COMMENT 'Account State of the Users.',
  `Created_At` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'It stores the date and time of the Id created of the admin.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_Id`, `Name`, `Email`, `Passwords`, `Phone`, `Address`, `Image`, `Status`, `Created_At`) VALUES
(2, 'Ashish Karki', 'Ashishcarkey89@gmail.com', '$2y$10$0oWhqrsDVHtjcCvbe9Zmve.Tah.4VGpity.BYxMWdKnFceQ2XoAy2', '9849511645', 'Kathmandu', 'admin.jpg', 'Active now', '2023-04-01 14:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `book_details`
--

CREATE TABLE `book_details` (
  `Post_Id` int(11) NOT NULL COMMENT 'stores Unique Id of book posts. ',
  `Owner_Id` int(255) NOT NULL COMMENT 'references to the user id from a users table.',
  `Owned_Book_Title` varchar(100) NOT NULL COMMENT 'Stores Book title.',
  `Author` varchar(100) NOT NULL COMMENT 'Stores Book Author name.',
  `Book_ISBN` varchar(800) DEFAULT NULL COMMENT 'Stores Book ISBN.',
  `Book_Category` varchar(150) DEFAULT NULL COMMENT 'Stores book category.',
  `Book_Description` varchar(800) NOT NULL COMMENT 'Stores book condition as well as other book details. ',
  `Wishlist_First` varchar(200) DEFAULT NULL COMMENT 'stores book name that user wan to receive from exchange.',
  `Wishlist_Second` varchar(200) DEFAULT NULL COMMENT 'stores second book name that user wan to receive from exchange.',
  `Book_Image` varchar(500) DEFAULT NULL COMMENT 'Stores book image name.',
  `Created_At` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Stores date and time of created book post. '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_details`
--

INSERT INTO `book_details` (`Post_Id`, `Owner_Id`, `Owned_Book_Title`, `Author`, `Book_ISBN`, `Book_Category`, `Book_Description`, `Wishlist_First`, `Wishlist_Second`, `Book_Image`, `Created_At`) VALUES
(1, 1, 'Muna madan', 'Laxmi Prasad Devkota', '978-9937942003', 'Novel', 'Muna-Madan, the most popular work in Nepali literature, is a short epic narrating the tragic story of Muna and Madan. Muna-Madan is written by Laxmi Prasad Devkota, and is based on an 18th-century Newari ballad entitled Ji Waya La Lachhi Maduni. The book condition is very nice.', 'Naughreko Jun', 'Summer Love', '1681000811Muna_Madan_-_book_cover.jpg', '2023-04-07 12:57:25'),
(3, 2, 'Naughreko Jun', 'Janu Kambang Limbu', '9789937932578', 'Novel', 'Naughreko June is written by Janu Kambang Limbu .\r\nReviewing the collection of stories, Thing said that she found all the stories of \'Naughreko June\' to be realistic, written on social grounds. Dr. Rai mentioned that Janu\'s songs were awful. Chairperson of the Nepali Literary Council Shashi Limbu, Secretary Tika Chamling and General Secretary of the Lyricists Association Shubh Mukharung also spoke on the occasion. The book Condition is very nice', 'Muna Madan', 'Sophie\'s World', '1680852434+Naughreko Jun.png', '2023-04-07 13:12:14'),
(14, 10, 'Fulani', 'Khagendra Lamichhane', '9780823919826', 'Novel', 'कथा सबैका रोचक हुन्छन् तर कथा भन्ने शैली सबैका रोचक हुँदैनन् । आफ्ना कथालाई आफ्नै बान्कीमा भन्ने कथाकार हुन्खगेन्द्र लामिछाने | जीवन भोगाइ र आफ्ना पेरिफेरिका मसिना विषयलाई पात्रको मनोदशाअनुसार स्थानीय लवजमा भनिएका सातवटा कथाहरूको सङ्गालो हो- फूलानी ।\r\nजीवनका सात अवस्थाहरू बालक, किशोर, यौवन, युवा, परिपक्व, सेवा निवृत्त र प्रौढ उमेरलाई इन्द्रेणीका सात रङले पोतेर उनले फूलानी-कथामाला बनाएका छन् । सरल भाषाशैलीमा लेखिएका यी कथाले पाठकलाई. book condition is very good.\r\n\r\n', 'Rich dad poor dad', 'The alchemist', '1681645208Falani2.jpg', '2023-04-16 17:25:08'),
(15, 10, 'To Kill a Mockingbird', 'Harper Lee', '9780060888695', 'Novel', 'Lee’s To Kill a Mockingbird was published in 1960 and became an immediate classic of literature. The novel examines racism in the American South through the innocent wide eyes of a clever young girl named Jean Louise (“Scout”) Finch. Its iconic characters, most notably the sympathetic and just lawyer and father Atticus Finch, served as role models and changed perspectives in the United States at a time when tensions regarding race were high. The book condition is very nice.', 'Summer Love', 'The Great Gatsby', '1681645704harper lee.jpg', '2023-04-16 17:33:24'),
(16, 14, 'Pagal Basti', 'Saru Bhakta', '978-1986711364', 'Novel', 'Pagal Basti is one of the most popular novels written by Sarubhakta. The story starts with the mention of the narrator being on his journey to Ghandruk, a beautiful place near Pokhara. The book is set in the place, which has now become one of the most popular tourist destinations in Nepal. A lot of people have visited the place after reading this novel. The book condition is very nice. It contains no any damage.', 'Saaya', 'Sophie\'s world', '1681661409paagal basti.jpg', '2023-04-16 21:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL COMMENT 'Stores Unique message Id.',
  `incoming_msg_id` int(255) NOT NULL COMMENT 'Stores Message Receivers Id.	',
  `outgoing_msg_id` int(255) NOT NULL COMMENT 'Stores Message Senders Id.',
  `msg` varchar(1000) NOT NULL COMMENT 'Stores messages.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_files`
--

CREATE TABLE `pdf_files` (
  `Id` int(6) UNSIGNED NOT NULL COMMENT 'Stores Separate Id for the Pdf.',
  `Name` varchar(255) NOT NULL COMMENT 'Stores name of the Book pdf.',
  `Author` varchar(255) NOT NULL COMMENT 'Stores Author name of book pdf.	',
  `Path` varchar(255) NOT NULL COMMENT 'Stores path of the PDF.',
  `Uploaded_on` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Stores date of the pdf added.',
  `Added_By` int(100) NOT NULL COMMENT 'Stores Admin Id '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdf_files`
--

INSERT INTO `pdf_files` (`Id`, `Name`, `Author`, `Path`, `Uploaded_on`, `Added_By`) VALUES
(7, 'Living in the Light_ A guide to personal transformation', 'Shakti Gawain', 'Living in the Light_ A guide to personal transformation ( PDFDrive ).pdf', '2023-04-16 09:09:36', 2);

-- --------------------------------------------------------

--
-- Table structure for table `request_details`
--

CREATE TABLE `request_details` (
  `Request_Id` int(11) NOT NULL COMMENT 'stores unique request Id.',
  `User_Id` int(255) NOT NULL COMMENT 'References User id from user table.',
  `Post_Id` int(255) NOT NULL COMMENT 'References Post Id from book details table.	',
  `Post_Owner_Id` int(255) NOT NULL COMMENT 'References Owner Id from book_details table.	',
  `Requested_At` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Stores date and time of Request made.',
  `Request_Status` varchar(8) NOT NULL COMMENT 'Stores Request Status.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_details`
--

INSERT INTO `request_details` (`Request_Id`, `User_Id`, `Post_Id`, `Post_Owner_Id`, `Requested_At`, `Request_Status`) VALUES
(5, 2, 16, 14, '2023-04-16 21:59:44', ''),
(7, 2, 15, 10, '2023-04-16 22:01:02', ''),
(8, 14, 1, 1, '2023-04-16 22:25:18', 'Rejected'),
(9, 14, 14, 10, '2023-04-16 22:25:32', ''),
(10, 14, 15, 10, '2023-04-16 22:25:39', 'Rejected'),
(11, 1, 16, 14, '2023-04-16 22:27:10', ''),
(12, 10, 16, 14, '2023-04-16 22:28:16', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_Id` int(11) NOT NULL COMMENT 'Primary key of Users',
  `Name` varchar(100) NOT NULL COMMENT 'User Names',
  `Email` varchar(200) NOT NULL COMMENT 'Unique Email Id of the users.',
  `Passwords` varchar(200) NOT NULL COMMENT 'Encrypted Password of Users.',
  `Phone` varchar(20) NOT NULL COMMENT 'Unique Phone Number of Users.',
  `Address` varchar(200) NOT NULL COMMENT 'Stores Address details of the users.',
  `Status` varchar(255) NOT NULL COMMENT 'online or offline status of the users',
  `Image` varchar(255) DEFAULT NULL COMMENT 'Image Name of the users.',
  `Created_At` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Date and Time of Id created.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_Id`, `Name`, `Email`, `Passwords`, `Phone`, `Address`, `Status`, `Image`, `Created_At`) VALUES
(1, 'Ashish Karki', 'Ashish@gmail.com', '$2y$10$Cg5VvifMqNLyN7X.3UtZiOyFAIY2VUYOAHGxzw8N8hQPHfOJOJpgS', '9849511645', 'Swoyambhu', 'Active now', '1680849845peakpx1.jpg', '2023-04-07 12:29:05'),
(2, 'Kabina Joshi', 'kabina@gmail.com', '$2y$10$1i20GBQZTTgHFAVEsdmMpeQoP1zai2PvuaEhlVu400hTCjTa3.PBS', '9849193736', 'Lalitpur', 'Active now', '1680852147wp7974446-4k-one-piece-laptop-wallpapers.jpg', '2023-04-07 13:07:27'),
(7, 'sudarsan karki', 'Sudarsan@gmail.com', '$2y$10$PjfqdfErjP1p291RE2S4VeNlvRSA4mMVcdpEf2pGHegs09hfI6alm', '98321993219', 'ktm', 'Active now', '1681628181men dummy pic.png', '2023-04-16 12:31:41'),
(8, 'Sujal Tamang', 'Sujal@gmail.com', '$2y$10$In3L6Jsjnx5M.uskLXKyH.v2QYC05Q7eGf5WU9.pvGxgHNN/22S9q', '983129123219', 'Swoyambhu', 'Active now', '1681629533man.jpg', '2023-04-16 13:03:53'),
(10, 'Kushal Shrestha', 'Kushal@gmail.com', '$2y$10$lXPRKS8wJiEVVuGKMQmbCONrGSuJ23wp65xuymPhuL5UqOmC2oOm.', '983123123232', 'Satdobato', 'Active now', '1681629963dummy man.png', '2023-04-16 13:11:03'),
(11, 'Aayush Baral', 'Aayush@gmail.com', '$2y$10$K4TVa7q3h8M8Mcw6LWXSSuGylEUok5cGEh/LRRBJpme/jVdp0zQK6', '98312312321', 'Kalanki', 'Active now', '1681630036men dummy pic.png', '2023-04-16 13:12:16'),
(14, 'Alisha Karki', 'Alisha@gmail.com', '$2y$10$6t9cKhyunX8BrpO7C1ksD.iVf83NvX34xws9A8ay7wPnwwafIzwES', '98312312312', 'Kalanki', 'Active now', '1681630254women.png', '2023-04-16 13:15:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- Indexes for table `book_details`
--
ALTER TABLE `book_details`
  ADD PRIMARY KEY (`Post_Id`),
  ADD KEY `Owner_Id` (`Owner_Id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `pdf_files`
--
ALTER TABLE `pdf_files`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_Added_By` (`Added_By`);

--
-- Indexes for table `request_details`
--
ALTER TABLE `request_details`
  ADD PRIMARY KEY (`Request_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Post_Id` (`Post_Id`),
  ADD KEY `request_details_ibfk_3` (`Post_Owner_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'It stores unique Admin Id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_details`
--
ALTER TABLE `book_details`
  MODIFY `Post_Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'stores Unique Id of book posts. ', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Stores Unique message Id.', AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pdf_files`
--
ALTER TABLE `pdf_files`
  MODIFY `Id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Stores Separate Id for the Pdf.', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request_details`
--
ALTER TABLE `request_details`
  MODIFY `Request_Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'stores unique request Id.', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of Users', AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_details`
--
ALTER TABLE `book_details`
  ADD CONSTRAINT `book_details_ibfk_1` FOREIGN KEY (`Owner_Id`) REFERENCES `users` (`User_Id`);

--
-- Constraints for table `pdf_files`
--
ALTER TABLE `pdf_files`
  ADD CONSTRAINT `fk_Added_By` FOREIGN KEY (`Added_By`) REFERENCES `admin` (`Admin_Id`);

--
-- Constraints for table `request_details`
--
ALTER TABLE `request_details`
  ADD CONSTRAINT `request_details_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`),
  ADD CONSTRAINT `request_details_ibfk_2` FOREIGN KEY (`Post_Id`) REFERENCES `book_details` (`Post_Id`),
  ADD CONSTRAINT `request_details_ibfk_3` FOREIGN KEY (`Post_Owner_Id`) REFERENCES `book_details` (`Owner_Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
