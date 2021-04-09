-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2021 at 09:46 PM
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
  `rating` int(11) NOT NULL,
  `weight` varchar(8) NOT NULL,
  `pdf` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `description`, `price`, `author`, `publisher`, `publishedon`, `stock`, `category_id`, `image`, `rating`, `weight`, `pdf`) VALUES
(2, '1984', 'Nineteen Eighty-Four: A Novel, often referred to as 1984, is a dystopian social science fiction novel by English novelist George Orwell. It was published on 8 June 1949 by Secker & Warburg as Orwell\'s ninth and final book completed in his lifetime. Thematically, Nineteen Eighty-Four centres on the consequences of totalitarianism, mass surveillance, and repressive regimentation of persons and behaviours within society.[2][3] Orwell, himself a democratic socialist, modelled the authoritarian government in the novel after Stalinist Russia.[2][3][4] More broadly, the novel examines the role of truth and facts within politics and the ways in which they are manipulated.\r\n\r\nThe story takes place in an imagined future, the year 1984, when much of the world has fallen victim to perpetual war, omnipresent government surveillance, historical negationism, and propaganda. Great Britain, known as Airstrip One, has become a province of a totalitarian superstate named Oceania that is ruled by the Party who employ the Thought Police to persecute individuality and independent thinking.[5] Big Brother, the leader of the Party, enjoys an intense cult of personality despite the fact that he may not even exist. The protagonist, Winston Smith, is a diligent and skillful rank-and-file worker and Outer Party member who secretly hates the Party and dreams of rebellion. He enters into a forbidden relationship with a colleague, Julia, and starts to remember what life was like before the Party came to power.\r\n\r\nNineteen Eighty-Four has become a classic literary example of political and dystopian fiction. It also popularised the term \"Orwellian\" as an adjective, with many terms used in the novel entering common usage, including \"Big Brother\", \"doublethink\", \"Thought Police\", \"thoughtcrime\", \"Newspeak\", \"memory hole\", \"2 + 2 = 5\", \"proles\", \"Two Minutes Hate\", \"telescreen\", and \"Room 101\". Time included it on its 100 best English-language novels from 1923 to 2005.[6] It was placed on the Modern Library\'s 100 Best Novels, reaching No. 13 on the editors\' list and No. 6 on the readers\' list.[7] In 2003, the novel was listed at No. 8 on The Big Read survey by the BBC.[8] Parallels have been drawn between the novel\'s subject matter and real life instances of totalitarianism, mass surveillance, and violations of freedom of expression among other themes.', 4.99, 'George Orwell', 'Harvill Secker', '1999-11-11', 10, 1, '1984.jpg', 0, '0', '1984.pdf'),
(5, 'Metamorphosis', 'The Metamorphosis (German: Die Verwandlung) is a novella written by Franz Kafka which was first published in 1915. One of Kafka\'s best-known works, The Metamorphosis tells the story of salesman Gregor Samsa who wakes one morning to find himself inexplicably transformed into a huge insect (German ungeheures Ungeziefer, literally \"monstrous vermin\"), subsequently struggling to adjust to this new condition. The novella has been widely discussed among literary critics, with differing interpretations being offered.', 3.99, 'Franz Kafka', '', '1999-11-11', 5, 1, 'metamorphosis.jpg', 0, '0', ''),
(6, 'Sarkandon Ke Peche', '', 0, 'Saadat Hasan Manto', '', '', 10, 1, 'small_sarkandon-ke-peeche-saadat-hasan-manto-ebooks.jpg', 0, '0', ''),
(9, 'Lord of the Flies', 'Lord of the Flies is a 1954 novel by Nobel Prize-winning British author William Golding. The book focuses on a group of British boys stranded on an uninhabited island and their disastrous attempt to govern themselves. Themes include the tension between groupthink and individuality, between rational and emotional reactions, and between morality and immorality. The novel has been generally well received. It was named in the Modern Library 100 Best Novels, reaching number 41 on the editor\'s list, and 25 on the reader\'s list. In 2003 it was listed at number 70 on the BBC\'s The Big Read poll, and in 2005 Time magazine named it as one of the 100 best English-language novels from 1923 to 2005. Time also included the novel in its list of the 100 Best Young-Adult Books of All Time. Popular reading in schools, especially in the English-speaking world, a 2016 UK poll saw Lord of the Flies ranked third in the nation\'s favourite books from school.', 3.99, 'William Golding', 'Faber and Faber', '1999-11-11', 11, 1, 'lotf.jpg', 0, '0.25', 'lord-of-the-flies.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `book_genre`
--

CREATE TABLE `book_genre` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `book_order`
--

CREATE TABLE `book_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_order`
--

INSERT INTO `book_order` (`id`, `order_id`, `book_id`, `quantity`) VALUES
(2, 9002, 9, 1),
(3, 9002, 5, 2),
(4, 9002, 2, 1);

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
(3, 'Essay: Pakistan', 10000, '2021-04-06', '2021-04-08', '', 'E-Books.docx');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `message` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Horror');

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
  `order_number` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `payment`, `zip`, `status`, `order_number`) VALUES
(9002, 17, 'cod', '1018', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `category_id`) VALUES
(1, 'Fiction', 1),
(2, 'Non-Fiction', 1),
(3, 'Marvel', 3),
(4, 'DC', 3);

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
(17, 'Muhammad Ali Khan', '123123123', 'ali@gmail.com', '2000-03-22', 'WhatsApp Image 2021-03-20 at 9.04.49 PM.jpeg', '1018000022223333', 'Male', 'Gulshan-e-Iqbal', '0330000000', 0, 0, '2021-03-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `book_genre`
--
ALTER TABLE `book_genre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `book_order`
--
ALTER TABLE `book_order`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `book_genre`
--
ALTER TABLE `book_genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_order`
--
ALTER TABLE `book_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9004;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `book_genre`
--
ALTER TABLE `book_genre`
  ADD CONSTRAINT `book_genre_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `book_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
