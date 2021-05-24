-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 08:43 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Saadat Hasan Manto'),
(2, 'George Orwell'),
(3, 'Franz Kafka'),
(4, 'William Golding'),
(5, 'hamza ahmed');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `publishedon` varchar(32) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(1024) NOT NULL,
  `weight` float NOT NULL,
  `pdf` varchar(1024) NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `description`, `price`, `author`, `publisher`, `publishedon`, `stock`, `category_id`, `image`, `weight`, `pdf`, `subcategory_id`) VALUES
(2, '1984', 'Nineteen Eighty-Four: A Novel, often referred to as 1984, is a dystopian social science fiction novel by English novelist George Orwell. It was published on 8 June 1949 by Secker & Warburg as Orwell\'s ninth and final book completed in his lifetime. Thematically, Nineteen Eighty-Four centres on the consequences of totalitarianism, mass surveillance, and repressive regimentation of persons and behaviours within society.[2][3] Orwell, himself a democratic socialist, modelled the authoritarian government in the novel after Stalinist Russia.[2][3][4] More broadly, the novel examines the role of truth and facts within politics and the ways in which they are manipulated.\r\n\r\nThe story takes place in an imagined future, the year 1984, when much of the world has fallen victim to perpetual war, omnipresent government surveillance, historical negationism, and propaganda. Great Britain, known as Airstrip One, has become a province of a totalitarian superstate named Oceania that is ruled by the Party who employ the Thought Police to persecute individuality and independent thinking.[5] Big Brother, the leader of the Party, enjoys an intense cult of personality despite the fact that he may not even exist. The protagonist, Winston Smith, is a diligent and skillful rank-and-file worker and Outer Party member who secretly hates the Party and dreams of rebellion. He enters into a forbidden relationship with a colleague, Julia, and starts to remember what life was like before the Party came to power.\r\n\r\nNineteen Eighty-Four has become a classic literary example of political and dystopian fiction. It also popularised the term \"Orwellian\" as an adjective, with many terms used in the novel entering common usage, including \"Big Brother\", \"doublethink\", \"Thought Police\", \"thoughtcrime\", \"Newspeak\", \"memory hole\", \"2 + 2 = 5\", \"proles\", \"Two Minutes Hate\", \"telescreen\", and \"Room 101\". Time included it on its 100 best English-language novels from 1923 to 2005.[6] It was placed on the Modern Library\'s 100 Best Novels, reaching No. 13 on the editors\' list and No. 6 on the readers\' list.[7] In 2003, the novel was listed at No. 8 on The Big Read survey by the BBC.[8] Parallels have been drawn between the novel\'s subject matter and real life instances of totalitarianism, mass surveillance, and violations of freedom of expression among other themes.', 4.99, 'George Orwell', 'Harvill Secker', '1949-06-8', 6, 1, '1984.jpg', 0, '1984.pdf', 1),
(5, 'Metamorphosis', 'The Metamorphosis (German: Die Verwandlung) is a novella written by Franz Kafka which was first published in 1915. One of Kafka\'s best-known works, The Metamorphosis tells the story of salesman Gregor Samsa who wakes one morning to find himself inexplicably transformed into a huge insect (German ungeheures Ungeziefer, literally \"monstrous vermin\"), subsequently struggling to adjust to this new condition. The novella has been widely discussed among literary critics, with differing interpretations being offered.', 3.99, 'Franz Kafka', 'Unknown', '1999-11-11', 0, 1, 'metamorphosis.jpg', 0, '', 1),
(6, 'Sarkandon Ke Peche', 'A story that can only be written by Manto.', 5.99, 'Saadat Hasan Manto', 'Unknown', '1955-01-01', 0, 1, 'small_sarkandon-ke-peeche-saadat-hasan-manto-ebooks.jpg', 0.12, '1984.pdf', 1),
(9, 'Lord of the Flies', 'Lord of the Flies is a 1954 novel by Nobel Prize-winning British author William Golding. The book focuses on a group of British boys stranded on an uninhabited island and their disastrous attempt to govern themselves. Themes include the tension between groupthink and individuality, between rational and emotional reactions, and between morality and immorality. The novel has been generally well received. It was named in the Modern Library 100 Best Novels, reaching number 41 on the editor\'s list, and 25 on the reader\'s list. In 2003 it was listed at number 70 on the BBC\'s The Big Read poll, and in 2005 Time magazine named it as one of the 100 best English-language novels from 1923 to 2005. Time also included the novel in its list of the 100 Best Young-Adult Books of All Time. Popular reading in schools, especially in the English-speaking world, a 2016 UK poll saw Lord of the Flies ranked third in the nation\'s favourite books from school.', 3.99, 'William Golding', 'Faber and Faber', '1999-11-11', 8, 1, 'lotf.jpg', 0.25, 'lord-of-the-flies.pdf', 1),
(15, 'My name is Lakhan', 'A heart-touching master piece.', 4.99, 'hamza ahmed', 'Unknown', '2021-04-28', 10, 4, '162459936_1460939657582013_6114879856411555923_o.jpg', 0.5, 'E-Books Report(final final).pdf', 0),
(16, 'My sons name is also Lakhan', 'A sequel to the critically acclaimed biography \'My name is Lakhan\', \'My son\'s name is also Lakhan\' has taken the world by storm.', 3.99, 'hamza ahmed', 'Unknown', '2021-04-27', 20, 4, '154971854_4478708305491008_2587024156965405088_n.jpg', 0.5, 'E-Books Report(final final).pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `books_authors`
--

CREATE TABLE `books_authors` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_authors`
--

INSERT INTO `books_authors` (`id`, `book_id`, `author_id`) VALUES
(1, 2, 2),
(2, 9, 4),
(3, 5, 3),
(4, 6, 1),
(11, 16, 5),
(12, 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `book_order`
--

CREATE TABLE `book_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `version` varchar(16) NOT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_order`
--

INSERT INTO `book_order` (`id`, `order_id`, `book_id`, `quantity`, `version`, `status`) VALUES
(3, 16, 5, 1, 'phy', 'pending'),
(4, 17, 9, 1, 'pdf', 'completed'),
(5, 18, 6, 2, 'phy', 'pending'),
(6, 18, 2, 1, 'pdf', 'completed'),
(7, 19, 9, 1, 'pdf', 'completed'),
(8, 20, 6, 1, 'phy', 'pending'),
(9, 21, 5, 1, 'pdf', 'completed'),
(10, 22, 5, 2, 'phy', 'pending'),
(11, 23, 2, 1, 'phy', 'pending'),
(12, 24, 5, 1, 'pdf', 'completed'),
(13, 24, 9, 1, 'phy', 'pending'),
(14, 25, 5, 1, 'pdf', 'completed'),
(15, 26, 9, 1, 'phy', 'pending'),
(16, 27, 9, 2, 'phy', 'pending'),
(17, 28, 9, 1, 'phy', 'pending'),
(18, 29, 5, 1, 'phy', 'pending'),
(19, 30, 9, 1, 'phy', 'pending'),
(20, 31, 9, 1, 'phy', 'pending'),
(21, 32, 9, 1, 'phy', 'pending'),
(22, 33, 6, 1, 'phy', 'pending'),
(23, 34, 9, 1, 'phy', 'pending'),
(24, 35, 6, 1, 'phy', 'pending'),
(25, 36, 6, 1, 'phy', 'pending'),
(26, 37, 6, 1, 'phy', 'pending'),
(27, 38, 6, 1, 'phy', 'pending'),
(28, 39, 9, 1, 'phy', 'pending'),
(29, 40, 9, 1, 'phy', 'pending'),
(30, 41, 9, 1, 'phy', 'pending'),
(31, 42, 9, 1, 'phy', 'pending'),
(32, 43, 9, 1, 'phy', 'pending'),
(33, 44, 9, 2, 'phy', 'pending'),
(34, 45, 9, 1, 'phy', 'pending'),
(35, 46, 2, 1, 'phy', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Novels'),
(3, 'Comics'),
(4, 'General Knowledge');

-- --------------------------------------------------------

--
-- Table structure for table `competition`
--

CREATE TABLE `competition` (
  `id` int(11) NOT NULL,
  `topic` varchar(512) NOT NULL,
  `prize` double NOT NULL,
  `start_time` varchar(32) NOT NULL,
  `end_time` varchar(32) NOT NULL,
  `winner` varchar(255) NOT NULL,
  `research` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `competition`
--

INSERT INTO `competition` (`id`, `topic`, `prize`, `start_time`, `end_time`, `winner`, `research`) VALUES
(3, 'Essay: Pakistan', 10000, '2021-04-06', '2021-04-08', '', 'E-Books.docx'),
(4, 'Essay: Poverty in  Pakistan', 10000, '2021-04-14', '2021-04-16', '', 'E-Books.docx');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `message` varchar(4096) NOT NULL,
  `resolved` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `subject`, `email`, `message`, `resolved`) VALUES
(1, 17, 'sdada', 'ali@gmail.com', 'asdasdasd', 1),
(2, 17, 'sdada', 'ali@gmail.com', 'asdasdasd', 0),
(3, 17, 'sdada', 'ali@gmail.com', 'hvjhvjhvjh', 0),
(4, 17, 'sdada', 'ali@gmail.com', 'hvjhvjhvjh', 0),
(5, 17, 'sdada', 'ali@gmail.com', 'hvjhvjhvjh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment` varchar(32) NOT NULL,
  `zip` varchar(16) NOT NULL,
  `status` varchar(32) NOT NULL,
  `order_number` varchar(12) NOT NULL,
  `cost` float NOT NULL,
  `orderedon` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `payment`, `zip`, `status`, `order_number`, `cost`, `orderedon`) VALUES
(16, 17, 'cod', '1018', 'pending', '#11614027413', 5.99, '2021-04-10'),
(17, 17, 'cod', '1018', 'completed', '#86036617177', 5.99, '2021-04-10'),
(18, 17, 'cod', '1018', 'pending', '#73154572730', 6.99, '2021-04-10'),
(19, 17, 'cod', '1111', 'completed', '#49403924482', 5.99, '2021-04-10'),
(20, 17, 'cc', '1111', 'pending', '#78538561922', 7.99, '2021-04-11'),
(21, 17, 'cod', '1018', 'completed', '#98428680074', 5.99, '2021-04-12'),
(22, 17, 'cod', '1212', 'pending', '#90839331976', 9.98, '2021-04-12'),
(23, 20, 'cod', '7777', 'pending', '#35899169713', 6.99, '2021-04-12'),
(24, 17, 'cod', '1018', 'pending', '#83941353716', 9.98, '2021-04-12'),
(25, 17, 'cod', '1018', 'completed', '#02251349744', 5.99, '2021-04-12 12:42PM'),
(26, 17, 'cod', '1018', 'cancelled', '#92128036657', 5.99, '2021-04-12 12:43PM'),
(27, 17, 'cod', '1018', 'cancelled', '43893257227', 9.98, '2021-04-14 09:24AM'),
(28, 17, 'cod', '1111', 'cancelled', '48083052011', 5.99, '2021-04-15 02:34AM'),
(29, 15, 'cod', '123123', 'pending', '#96927464856', 5.99, '2021-04-19 12:37AM'),
(30, 15, 'cod', '121', 'pending', '#93434588795', 5.99, '2021-04-19 12:48AM'),
(31, 15, 'cod', '241', 'pending', '#45299361721', 5.99, '2021-04-19 12:52AM'),
(32, 15, 'cod', '2312', 'pending', '#53033838028', 5.99, '2021-04-19 12:59AM'),
(33, 15, 'cod', '2312', 'pending', '#57276952548', 7.99, '2021-04-19 01:12AM'),
(34, 15, 'cod', '2312', 'pending', '#71973598640', 5.99, '2021-04-19 01:15AM'),
(35, 15, 'cc', '2312', 'pending', '#89073396997', 7.99, '2021-04-19 03:34AM'),
(36, 15, 'cod', '123123', 'pending', '#95775365552', 7.99, '2021-04-19 09:06AM'),
(37, 15, 'cc', '123', 'pending', '#27599551714', 7.99, '2021-04-19 09:12AM'),
(38, 15, 'cod', '121', 'pending', '#67954468811', 7.99, '2021-04-19 09:15AM'),
(39, 15, 'cc', '123', 'pending', '#73179652646', 5.99, '2021-04-19 09:18AM'),
(40, 15, 'cod', '2312', 'confirmed', '#32063394532', 5.99, '2021-04-19 09:20AM'),
(41, 15, 'cod', '123', 'pending', '#30345907743', 5.99, '2021-04-19 09:23AM'),
(42, 15, 'cod', '121', 'pending', '#37828989708', 5.99, '2021-04-21 04:56AM'),
(43, 15, 'cod', '121', 'pending', '#95389205137', 5.99, '2021-04-21 04:59AM'),
(44, 15, 'cod', '2312', 'pending', '#84791032748', 9.98, '2021-04-21 05:02AM'),
(45, 15, 'cod', '123', 'pending', '#18511879451', 5.99, '2021-04-21 12:19PM'),
(46, 15, 'cc', '123', 'pending', '#33614785127', 6.99, '2021-04-21 02:10PM');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `otp`, `order_id`) VALUES
(4, 'ZVQsWM', 16),
(5, 'W4c!Wl', 17),
(6, '68zDG3', 18),
(7, '2tHyZ1', 19),
(8, 'D7IF5W', 20),
(9, '2SIfoo', 21),
(10, 'Po#aH#', 22),
(11, 'T538N!', 23),
(12, '64gqWL', 24),
(13, 'kvntki', 25),
(14, 'PtDCDF', 26),
(15, '#r166Q', 27),
(16, 'RDsoHx', 28),
(17, 'AqvVz@', 29),
(18, 'AkUOEi', 30),
(19, '77@TLY', 31),
(20, 'tWd&eT', 32),
(21, '%OIf0x', 33),
(22, 'MH7f4z', 34),
(23, 'rp7bn9', 35),
(24, '!&$pwI', 36),
(25, 'vEwx7d', 37),
(26, 'CEMwvk', 38),
(27, 'vpr@hy', 39),
(28, 'f5k8jh', 40),
(29, '!I0Jbi', 41),
(30, '3GTO%M', 42),
(31, 'A$yPBx', 43),
(32, '4hVJKE', 44),
(33, 'XFTRiU', 45),
(34, 'lBSArJ', 46);

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`id`, `user_id`, `competition_id`) VALUES
(1, 17, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `category_id`) VALUES
(1, 'Fiction', 1),
(2, 'Non-Fiction', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `image` varchar(512) NOT NULL,
  `creditcard` varchar(16) NOT NULL,
  `gender` varchar(16) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `contactnumber` varchar(50) NOT NULL,
  `isadmin` int(11) NOT NULL,
  `isseller` int(11) NOT NULL,
  `createdon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `dob`, `image`, `creditcard`, `gender`, `address`, `contactnumber`, `isadmin`, `isseller`, `createdon`) VALUES
(10, 'Muhammad Ali Khan', 'admin1018', 'admin@iqra.com', '2000-03-22', 'WhatsApp Image 2021-03-20 at 9.04.49 PM.jpeg', '', 'Male', 'Gulshan-e-Iqbal', '03302399258', 1, 0, ''),
(15, 'faizan khan', '123', 'f@gmail.com', '2021-03-16', '161713066_883878445522848_1490982166969035585_n.jpg', '1111111111111111', 'Male', 'Gulshan-e-Iqbal 13', '0330000000', 0, 0, '2021-03-21'),
(17, 'Muhammad Ali Khan', '123123123', 'ali@gmail.com', '2000-03-22', '', '1018000022223333', 'Male', 'Gulshan-e-Iqbal', '0330000000', 0, 0, '2021-03-24'),
(21, 'Amaaz', '123123123', 'amaz@gmail.com', '', '', '1018000022223333', '', 'Gulshan-e-Iqbal', '0330000000', 0, 0, '2021-04-12'),
(22, 'Tashfeen', '123123123', 't@gmail.com', '', '', '1018000022223333', 'Male', 'Gulshan-e-Iqbal', '0330000000', 0, 0, '2021-04-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CATEGORY` (`category_id`);

--
-- Indexes for table `books_authors`
--
ALTER TABLE `books_authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `book_order`
--
ALTER TABLE `book_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `competition_id` (`competition_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `books_authors`
--
ALTER TABLE `books_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `book_order`
--
ALTER TABLE `book_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books_authors`
--
ALTER TABLE `books_authors`
  ADD CONSTRAINT `books_authors_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_authors_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
