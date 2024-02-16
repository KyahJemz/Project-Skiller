-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 12:26 AM
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
-- Database: `skillerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `Id` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Image` text DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `MiddleName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Role` varchar(25) NOT NULL DEFAULT 'Student',
  `Group` int(11) DEFAULT NULL,
  `Disabled` tinyint(1) NOT NULL DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`Id`, `Email`, `Image`, `FirstName`, `MiddleName`, `LastName`, `Role`, `Group`, `Disabled`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'stephenreganjames.layson@gmail.com', null, null, NULL, null, 'Administrator', NULL, 0, '2024-02-11 09:57:25', '2024-02-11 09:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE `tbl_activity` (
  `Id` int(11) NOT NULL,
  `Lesson_Id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Description` text DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `IsViewSummary` tinyint(1) NOT NULL DEFAULT 1,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_activity`
--

INSERT INTO `tbl_activity` (`Id`, `Lesson_Id`, `Title`, `Description`, `Notes`, `IsViewSummary`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 1, 'Activity 1 - Test', 'testset s', 'bawal pasaway', 1, '2024-01-21 19:31:17', '2024-01-28 08:55:10'),
(3, 1, 'Activity 2 - eme lang', 'tes tsefsd fsf a', 'wala na finnish na', 1, '2024-01-29 01:19:04', '2024-01-29 01:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chapter`
--

CREATE TABLE `tbl_chapter` (
  `Id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Codes` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_chapter`
--

INSERT INTO `tbl_chapter` (`Id`, `Title`, `Codes`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'Introduction to Functions', 'M11GM-Ia-1, M11GM-Ia-2, M11GM-Ia-3, M11GM-Ia-4', '2024-01-21 19:29:35', '2024-01-21 19:29:35'),
(2, 'Rational Functions and Equations', 'M11GM-Ib-1, M11GM-Ib-2, M11GM-Ib-3, M11GM-Ib-4, M11GM-Ib-5, M11GM-Ic-1, M11GM-Ic-2, M11GM-Ic-3', '2024-01-21 19:29:35', '2024-01-21 19:29:35'),
(3, 'Inverse Functions', 'M11GM-Id-1, M11GM-Id-2, M11GM-Id-3, M11GM-Id-4, M11GM-Ie-1, M11GM-Ie-2', '2024-01-21 19:29:35', '2024-01-21 19:29:35'),
(4, 'Exponential Functions and Logarithmic Functions', 'M11GM-Ie-3, M11GM-Ie-4, M11GM-Ie-5, M11GM-If-1, M11GM-If-2, M11GM-If-3, M11GM-If-4, M11GM-Ig-1, M11GM-Ig-2, M11GM-Ih-1, M11GM-Ih-2, M11GM-Ih-3, M11GM-Ih-i-1, M11GM-Ii-2, M11GM-Ii-3, M11GM-Ii-4, M11GM-Ij-1, M11GM-Ij-2', '2024-01-21 19:29:35', '2024-01-21 19:29:35'),
(5, 'Financial Mathematics, Propositions, and Logic', 'M11GM-IIa-1, M11GM-IIa-2, M11GM-IIa-b-1, M11GM-IIb-2, M11GM-IIc-1, M11GM-IIc-2, M11GM-IIc-d-1, M11GM-IId-2, M11GM-IId-3, M11GM-IIe-1, M11GM-IIe-2, M11GM-IIe-3, M11GM-IIe-4, M11GM-IIe-5, M11GM-IIf-1, M11GM-IIf-2, M11GM-IIf-3, M11GM-IIg-1, M11GM-IIg-2, M11GM-IIg-3, M11GM-IIg-4, M11GM-IIh-1, M11GM-IIh-2, M11GM-IIi-1, M11GM-IIi-2, M11GM-IIi-3, M11GM-IIj-1, M11GM-IIj-2', '2024-01-21 19:29:35', '2024-01-21 19:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inprogress`
--

CREATE TABLE `tbl_inprogress` (
  `Account_Id` int(11) NOT NULL,
  `Lesson_Id` int(11) NOT NULL,
  `Activity_Id` int(11) NOT NULL,
  `Questions` text NOT NULL,
  `Answers` text NOT NULL,
  `LastAttempt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lessons`
--

CREATE TABLE `tbl_lessons` (
  `Id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Chapter_Id` int(11) NOT NULL,
  `Objective` text NOT NULL,
  `Description` text NOT NULL,
  `Image` text DEFAULT NULL,
  `Video` text DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lessons`
--

INSERT INTO `tbl_lessons` (`Id`, `Title`, `Chapter_Id`, `Objective`, `Description`, `Image`, `Video`, `Content`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'Real-world Applications of Functions', 1, 'The primary objective of this lesson is to enable students to recognize and formulate mathematical functions that effectively describe and predict real-world phenomena. By the end of the session, students should not only comprehend the theoretical foundations of functions but also develop the skills to apply these concepts in solving tangible problems beyond the classroom setting. This lesson serves as a foundation for appreciating the practical significance of functions and their role in addressing complex, dynamic scenarios in various fields.', 'The lesson on \"Real-world Applications of Functions\" is designed to bridge the gap between abstract mathematical concepts and their practical utility in addressing real-life scenarios. Students explore the versatile nature of functions as powerful tools for representing relationships between different quantities in a variety of contexts. Through concrete examples and case studies, the lesson provides a hands-on understanding of how functions can accurately model dynamic systems, offering valuable insights into the complexities of the real world.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(2, 'Mastering Function Evaluation', 1, 'The primary objective of this lesson is to equip students with the necessary skills to confidently evaluate a variety of functions for specific inputs. By mastering function evaluation, students will not only enhance their computational abilities but also develop a deeper understanding of the dynamic nature of functions. This skill is crucial for navigating more complex mathematical concepts and problem-solving scenarios that involve the manipulation and analysis of functions in practical applications.', 'The lesson on \"Mastering Function Evaluation\" focuses on honing students\' proficiency in evaluating functions, a fundamental skill in understanding mathematical relationships. Students delve into the process of substituting specific values into functions and calculating the corresponding outputs. The lesson emphasizes the importance of this skill in comprehending how functions behave and respond to different inputs. Through a series of examples and exercises, students gain confidence in manipulating functions and interpreting the results of their evaluations, laying a solid foundation for more advanced concepts in the study of functions.', NULL, 'https://www.youtube-nocookie.com/embed/p7YXXieghto?si=XL6ZKyQ6mZqYJJDC', 'The primary objective of this lesson is to equip students with the necessary skills to confidently evaluate a variety of functions for specific inputs. By mastering function evaluation, students will not only enhance their computational abilities but also develop a deeper understanding of the dynamic nature of functions. This skill is crucial for navigating more complex mathematical concepts and problem-solving scenarios that involve the manipulation and analysis of functions in practical applications.', '2024-01-21 19:30:43', '2024-01-21 20:33:33'),
(3, 'Basic Operations and Function Compositions', 1, 'The primary objective of this lesson is to empower students with the skills to perform basic operations on functions and compose multiple functions. By mastering these fundamental operations, students develop a deeper understanding of how functions interact and transform, laying the groundwork for more complex mathematical concepts. The lesson aims to foster both algebraic and graphical proficiency, ensuring that students can navigate various scenarios involving the manipulation and combination of functions with confidence.', 'The lesson on \"Basic Operations and Function Compositions\" delves into the fundamental operations that can be performed on functions and the concept of composing multiple functions. Students explore how to combine, add, subtract, multiply, and divide functions, understanding the impact of these operations on the overall behavior of the composite function. Emphasis is placed on developing a systematic approach to performing these operations and interpreting the results in both algebraic and graphical terms. Through examples and interactive exercises, students gain a solid grasp of manipulating functions, setting the stage for more advanced studies in function theory and analysis.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(4, 'Problems in the Realm of Functions', 1, 'The primary objective of this lesson is to develop students\' problem-solving skills within the context of functions. By tackling a range of problems, students learn to apply function concepts to real-world scenarios, fostering a deeper appreciation for the practical utility of mathematical functions. The lesson aims to cultivate analytical thinking, encouraging students to approach problem-solving with a systematic and mathematically informed mindset.', 'The lesson on \"Problems in the Realm of Functions\" is geared towards applying the knowledge of functions to solve real-world problems and mathematical challenges. Students engage in problem-solving exercises that require them to leverage their understanding of functions to analyze, model, and address practical scenarios. This lesson aims to sharpen students\' critical thinking and analytical skills by presenting them with a variety of problems that can be effectively tackled using the concepts learned in previous sessions. Through guided problem-solving and interactive discussions, students gain confidence in their ability to apply function theory to diverse problem domains.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(5, 'Representing Scenarios with Rational Functions', 2, 'The primary objective of this lesson is to equip students with the skills to recognize and utilize rational functions as powerful tools for representing real-world scenarios. By the end of the session, students should be adept at identifying situations where rational functions are applicable and be able to formulate these functions accurately. This lesson sets the stage for further exploration into the nuances of rational functions and their applications in various fields.', 'The lesson on \"Representing Scenarios with Rational Functions\" immerses students in the practical application of rational functions to model and represent real-world scenarios. Students explore the versatile nature of rational functions, understanding how they can accurately describe relationships in various contexts. The lesson introduces scenarios where ratios, proportions, and dynamic relationships can be effectively modeled using rational functions. Through examples and hands-on activities, students gain insight into selecting and formulating rational functions that best represent specific situations, laying the groundwork for a deeper understanding of this important class of functions.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(6, 'Understanding Rational Functions, Equations, and Inequalities', 2, 'The primary objective of this lesson is to provide students with a nuanced understanding of rational functions, equations, and inequalities. By the end of the session, students should be proficient in recognizing, manipulating, and solving problems involving rational functions. The lesson aims to build a strong foundation for students to navigate the complexities of rational expressions, setting the stage for more advanced studies in the realm of mathematical functions.', 'The lesson titled \"Understanding Rational Functions, Equations, and Inequalities\" delves into the intricacies of rational functions, emphasizing the distinctions between functions, equations, and inequalities within this specific class. Students explore the structure of rational functions and how they differ from other types of mathematical expressions. The lesson introduces the concept of rational equations and inequalities, shedding light on how these mathematical constructs relate to real-world problem-solving scenarios. Through theoretical discussions and practical examples, students gain a comprehensive understanding of the role that rational functions play in both theoretical mathematics and practical applications.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(7, 'Solving Rational Equations and Inequalities', 2, 'The primary objective of this lesson is to equip students with the skills to solve both rational equations and inequalities. By the end of the session, students should be adept at employing various techniques to isolate variables and determine solution sets within the realm of rational expressions. This lesson serves as a crucial step in developing problem-solving abilities related to rational functions and lays the groundwork for more advanced studies in the domain of mathematical functions.', 'The lesson on \"Solving Rational Equations and Inequalities\" guides students through the process of effectively solving mathematical problems involving rational equations and inequalities. Students delve into strategies for isolating variables, simplifying expressions, and determining the solution sets for rational equations. The lesson also extends to understanding and interpreting solutions in the context of rational inequalities. Through a series of examples and interactive exercises, students gain proficiency in solving problems that require the manipulation and analysis of rational expressions, providing them with essential problem-solving tools.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(8, 'Visualizing and Analyzing Rational Functions', 2, 'The primary objective of this lesson is to equip students with the skills to visualize and analyze rational functions graphically. By the end of the session, students should be proficient in graphing rational functions, identifying critical points, and interpreting the graphical representation in the context of real-world scenarios. This lesson sets the stage for more advanced studies in function theory, where graphical analysis plays a crucial role in understanding the behavior of complex mathematical functions.', 'The lesson on \"Visualizing and Analyzing Rational Functions\" immerses students in the graphical representation and analysis of rational functions. Students explore how to graphically depict rational functions, identifying key features such as asymptotes, intercepts, and behavior in different regions. The lesson emphasizes the connection between the graphical representation and the algebraic structure of rational functions. Through interactive activities and visual aids, students develop a keen sense of interpreting and analyzing the graphical behavior of rational functions, providing valuable insights into their overall characteristics.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(9, 'Real-life Scenarios with One-to-One Functions', 3, 'The primary objective of this lesson is to enable students to recognize and apply one-to-one functions in real-world contexts. By the end of the session, students should be proficient in identifying situations where one-to-one functions are applicable and formulating these functions accurately to model unique relationships. This lesson lays the foundation for a deeper understanding of the practical significance of one-to-one functions and their role in various fields of study.', 'In the lesson focused on \"Real-life Scenarios with One-to-One Functions,\" students explore the practical applications of one-to-one functions in modeling and solving real-world situations. The lesson introduces scenarios where one-to-one functions play a crucial role in accurately representing relationships with a unique correspondence between inputs and outputs. Through concrete examples and case studies, students discover how one-to-one functions are employed to model diverse phenomena in fields such as economics, biology, and technology. The lesson aims to bridge theoretical concepts with practical applications, illustrating the relevance of one-to-one functions in understanding and addressing complex real-life scenarios.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(10, 'Determining Inverses in One-to-One Functions', 3, 'The primary objective of this lesson is to enable students to confidently determine inverses in one-to-one functions. By the end of the session, students should grasp the concept of one-to-one functions and understand the process of identifying and representing their inverses. This lesson serves as a foundational step in building students\' proficiency in dealing with inverse relationships and prepares them for more complex studies in function theory and analysis.', 'The lesson titled \"Determining Inverses in One-to-One Functions\" delves into the concept of one-to-one functions and the process of identifying and understanding their inverses. Students explore the unique characteristics of one-to-one functions, which guarantee a distinct correspondence between inputs and outputs. The lesson guides students through the steps of determining the inverse function for a given one-to-one function, emphasizing the symmetry and reversal of roles between the original function and its inverse. Through examples and interactive exercises, students develop a solid understanding of one-to-one functions and their inverses, paving the way for more advanced topics in function theory.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(11, 'Representing and Graphing Inverse Functions', 3, 'The primary objective of this lesson is to equip students with the skills to represent and graph inverse functions. By the end of the session, students should comprehend the graphical symmetry inherent in the relationship between a function and its inverse. This lesson serves as a crucial step in building students\' understanding of inverse functions and prepares them for more advanced studies in function theory and graphical analysis.', 'The lesson titled \"Representing and Graphing Inverse Functions\" guides students through the exploration of inverse functions and their graphical representation. Students delve into the unique relationship between a function and its inverse, understanding how the graph of an inverse function mirrors the original function across the line y = x. The lesson emphasizes the steps involved in graphing inverse functions, highlighting the symmetry between points on the original function and its inverse. Through practical examples and interactive exercises, students gain proficiency in representing and graphing inverse functions, fostering a deeper appreciation for the symmetrical nature of these mathematical relationships.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(12, 'Problem-solving with Inverse Functions', 3, 'The primary objective of this lesson is to enable students to proficiently solve problems using inverse functions. By the end of the session, students should be adept at applying inverse functions to reverse operations, solve equations, and address real-world challenges. This lesson serves as a crucial step in building problem-solving skills within the context of inverse functions and prepares students for more advanced studies in function theory and applications.', 'The lesson on \"Problem-solving with Inverse Functions\" immerses students in the practical application of inverse functions to solve a variety of mathematical challenges and real-world problems. Students explore how inverse functions can be utilized to reverse the effects of an original function and solve equations involving these functions. The lesson emphasizes the role of inverse functions in undoing operations and isolating variables. Through a series of problem-solving exercises and real-world scenarios, students develop critical thinking skills, honing their ability to apply inverse functions as powerful tools in mathematical analysis.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(13, 'Applications of Exponential Functions in Real Life', 4, 'The primary objective of this lesson is to equip students with the skills to recognize and apply exponential functions in real-life situations. By the end of the session, students should comprehend the significance of exponential functions in modeling growth and decay phenomena and be able to interpret and analyze these functions in practical contexts. This lesson serves as a foundation for further exploration into the nuances of exponential functions and their wide-ranging applications.', 'The lesson on \"Applications of Exponential Functions in Real Life\" immerses students in the practical and diverse applications of exponential functions. Students explore how exponential functions model phenomena characterized by rapid growth or decay, such as population growth, compound interest, and radioactive decay. The lesson emphasizes the versatility of exponential functions in capturing real-world scenarios with exponential behavior. Through concrete examples and case studies, students gain insights into the role of exponential functions in predicting future trends and understanding dynamic processes in various fields.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(14, 'Understanding Exponential Equations and Inequalities', 4, 'The primary objective of this lesson is to enable students to confidently solve both exponential equations and inequalities. By the end of the session, students should be adept at employing various techniques to isolate variables and determine solution sets within the realm of exponential functions. This lesson serves as a crucial step in developing problem-solving abilities related to exponential growth and decay, preparing students for more advanced studies in the domain of mathematical functions.', 'The lesson titled \"Understanding Exponential Equations and Inequalities\" delves into the intricacies of solving mathematical problems involving exponential equations and inequalities. Students explore the unique properties of exponential functions and how these properties translate into solving equations and inequalities. The lesson guides students through techniques for isolating variables, simplifying exponential expressions, and determining solution sets. Through practical examples and interactive exercises, students gain proficiency in solving problems that involve exponential growth and decay, laying the foundation for a deeper understanding of exponential functions.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(15, 'Navigating Logarithmic Equations and Inequalities', 4, 'The primary objective of this lesson is to equip students with the skills to confidently navigate and solve logarithmic equations and inequalities. By the end of the session, students should be adept at employing various techniques to isolate variables and determine solution sets within the realm of logarithmic functions. This lesson serves as a crucial step in developing problem-solving abilities related to logarithmic functions, preparing students for more advanced studies in the domain of mathematical functions.', 'The lesson on \"Navigating Logarithmic Equations and Inequalities\" guides students through the complexities of solving mathematical problems involving logarithmic functions. Students explore the unique properties of logarithms and how these properties translate into solving equations and inequalities. The lesson covers techniques for isolating variables, simplifying logarithmic expressions, and determining solution sets. Through practical examples and interactive exercises, students gain proficiency in solving problems that involve logarithmic functions, providing a solid foundation for understanding the intricacies of these mathematical constructs.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(16, 'Charting the Course of Exponential and Logarithmic Functions', 4, 'The primary objective of this lesson is to equip students with the skills to graphically represent and analyze exponential and logarithmic functions. By the end of the session, students should be proficient in graphing these functions, identifying critical points, and interpreting the graphical representation in the context of real-world scenarios. This lesson sets the stage for more advanced studies in function theory, where graphical analysis plays a crucial role in understanding the behavior of complex mathematical functions.', 'The lesson titled \"Charting the Course of Exponential and Logarithmic Functions\" provides students with a comprehensive understanding of the graphical representation and analysis of exponential and logarithmic functions. Students explore the distinctive characteristics of these functions, including exponential growth/decay and logarithmic transformations. The lesson guides students through graphing techniques, identifying key features such as intercepts, asymptotes, and behavior in different regions. Through practical examples and interactive exercises, students gain proficiency in charting the course of exponential and logarithmic functions, enhancing their ability to interpret and analyze these functions graphically.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(17, 'Simple and Compound Tales in Financial Mathematics', 5, 'The primary objective of this lesson is to enable students to comprehend and apply the principles of simple and compound interest in financial mathematics. By the end of the session, students should be adept at calculating interest, determining future values, and making informed financial decisions based on these concepts. This lesson serves as a crucial step in developing financial literacy and prepares students for more advanced studies in financial mathematics.', 'The lesson on \"Simple and Compound Tales in Financial Mathematics\" delves into the world of financial concepts, focusing on simple and compound interest scenarios. Students explore the principles underlying simple and compound interest, understanding how these concepts influence financial decisions and investments. The lesson covers calculations of interest, maturity value, future value, and present value in both simple interest and compound interest environments. Through practical examples and hands-on activities, students gain insights into the application of financial mathematics in various contexts, laying the foundation for informed decision-making in financial scenarios.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(18, 'Coding Real-world Statements into Logical Propositions', 5, 'The primary objective of this lesson is to equip students with the skills to code real-world statements into logical propositions. By the end of the session, students should be proficient in recognizing logical structures within statements and translating them into a symbolic language. This lesson serves as a foundational step in building students\' logical reasoning skills and prepares them for more advanced studies in formal logic and problem-solving.', 'The lesson titled \"Coding Real-world Statements into Logical Propositions\" introduces students to the fundamentals of symbolic logic by translating real-world statements into logical propositions. Students explore the process of representing complex statements using mathematical symbols and logical operators. The lesson emphasizes the importance of precision in logical coding, fostering an understanding of how to capture the essence of real-world scenarios in a formal logical language. Through practical examples and exercises, students gain proficiency in coding statements into logical propositions, laying the groundwork for further studies in propositional logic.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(19, 'Unraveling Truth Values and Conditional Propositions', 5, 'The primary objective of this lesson is to enable students to confidently unravel truth values and understand conditional propositions. By the end of the session, students should be adept at assessing the truth or falsity of propositions and interpreting conditional statements. This lesson serves as a foundational step in building students\' proficiency in symbolic logic and prepares them for more advanced studies in logical reasoning and argumentation.', 'The lesson on \"Unraveling Truth Values and Conditional Propositions\" introduces students to the fundamental concepts of truth values and conditional propositions within the realm of symbolic logic. Students explore the truth values of propositions and understand the implications of conditional statements. The lesson guides students through the logical structure of conditional propositions, emphasizing the relationship between the antecedent and the consequent. Through practical examples and interactive exercises, students gain proficiency in unraveling truth values and analyzing conditional propositions, enhancing their logical reasoning skills.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(20, 'Analyzing Validity, Fallacies, and Methods in Logic', 5, 'The primary objective of this lesson is to equip students with the skills to analyze the validity of logical arguments, identify fallacies, and apply various methods of logical reasoning. By the end of the session, students should be proficient in critically assessing the strength and soundness of logical propositions and arguments. This lesson serves as a crucial step in building students\' logical reasoning abilities and prepares them for more advanced studies in formal logic and argumentation.', 'The lesson on \"Analyzing Validity, Fallacies, and Methods in Logic\" provides students with a deep dive into the evaluation of logical arguments. Students explore the principles of validity, identifying common fallacies, and understanding different methods of logical reasoning. The lesson emphasizes the importance of sound reasoning and critical analysis in assessing the strength of logical arguments. Through practical examples and interactive discussions, students gain proficiency in identifying valid arguments, recognizing fallacies, and applying different methods of logical analysis. This lesson lays the foundation for developing strong analytical and evaluative skills in logical reasoning.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_progress`
--

CREATE TABLE `tbl_progress` (
  `Account_Id` int(11) NOT NULL,
  `Lesson_Id` int(11) DEFAULT NULL,
  `Activity_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE `tbl_questions` (
  `Id` int(11) NOT NULL,
  `Activity_Id` int(11) NOT NULL,
  `Question` text NOT NULL,
  `Points` text NOT NULL,
  `Option1` text NOT NULL,
  `Option2` text DEFAULT NULL,
  `Option3` text DEFAULT NULL,
  `Option4` text DEFAULT NULL,
  `Answer` text NOT NULL,
  `Image` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_questions`
--

INSERT INTO `tbl_questions` (`Id`, `Activity_Id`, `Question`, `Points`, `Option1`, `Option2`, `Option3`, `Option4`, `Answer`, `Image`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 1, '123', '1', '111', '222', '333', '444', '222', NULL, '2024-01-27 01:36:42', '2024-01-27 01:37:51'),
(2, 1, '123', '1', '111', '222', '333', '444', '333', NULL, '2024-01-27 01:37:01', '2024-01-27 01:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_results`
--

CREATE TABLE `tbl_results` (
  `Id` int(11) NOT NULL,
  `Activity_Id` int(11) NOT NULL,
  `Lesson_Id` int(11) NOT NULL,
  `Account_Id` int(11) NOT NULL,
  `Score` varchar(5) NOT NULL,
  `Summary` text NOT NULL,
  `Total` varchar(5) NOT NULL,
  `IsRetake` tinyint(1) NOT NULL DEFAULT 0,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_results`
--


-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Lesson_Id` (`Lesson_Id`);

--
-- Indexes for table `tbl_chapter`
--
ALTER TABLE `tbl_chapter`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_inprogress`
--
ALTER TABLE `tbl_inprogress`
  ADD UNIQUE KEY `Account_Id_2` (`Account_Id`,`Lesson_Id`,`Activity_Id`),
  ADD KEY `Activity_Id` (`Activity_Id`),
  ADD KEY `Lesson_Id` (`Lesson_Id`);

--
-- Indexes for table `tbl_lessons`
--
ALTER TABLE `tbl_lessons`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Chapter` (`Chapter_Id`);

--
-- Indexes for table `tbl_progress`
--
ALTER TABLE `tbl_progress`
  ADD UNIQUE KEY `Account_Id` (`Account_Id`,`Lesson_Id`,`Activity_Id`);

--
-- Indexes for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tbl_questions_ibfk_1` (`Activity_Id`);

--
-- Indexes for table `tbl_results`
--
ALTER TABLE `tbl_results`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tbl_results_ibfk_1` (`Account_Id`),
  ADD KEY `tbl_results_ibfk_2` (`Activity_Id`),
  ADD KEY `tbl_results_ibfk_3` (`Lesson_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_lessons`
--
ALTER TABLE `tbl_lessons`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_results`
--
ALTER TABLE `tbl_results`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD CONSTRAINT `tbl_activity_ibfk_1` FOREIGN KEY (`Lesson_Id`) REFERENCES `tbl_lessons` (`Id`);

--
-- Constraints for table `tbl_inprogress`
--
ALTER TABLE `tbl_inprogress`
  ADD CONSTRAINT `tbl_inprogress_ibfk_1` FOREIGN KEY (`Account_Id`) REFERENCES `tbl_accounts` (`Id`),
  ADD CONSTRAINT `tbl_inprogress_ibfk_2` FOREIGN KEY (`Activity_Id`) REFERENCES `tbl_activity` (`Id`),
  ADD CONSTRAINT `tbl_inprogress_ibfk_3` FOREIGN KEY (`Lesson_Id`) REFERENCES `tbl_lessons` (`Id`);

--
-- Constraints for table `tbl_lessons`
--
ALTER TABLE `tbl_lessons`
  ADD CONSTRAINT `tbl_lessons_ibfk_1` FOREIGN KEY (`Chapter_Id`) REFERENCES `tbl_chapter` (`Id`);

--
-- Constraints for table `tbl_progress`
--
ALTER TABLE `tbl_progress`
  ADD CONSTRAINT `tbl_progress_ibfk_1` FOREIGN KEY (`Account_Id`) REFERENCES `tbl_accounts` (`Id`);

--
-- Constraints for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  ADD CONSTRAINT `tbl_questions_ibfk_1` FOREIGN KEY (`Activity_Id`) REFERENCES `tbl_activity` (`Id`);

--
-- Constraints for table `tbl_results`
--
ALTER TABLE `tbl_results`
  ADD CONSTRAINT `tbl_results_ibfk_1` FOREIGN KEY (`Account_Id`) REFERENCES `tbl_accounts` (`Id`),
  ADD CONSTRAINT `tbl_results_ibfk_2` FOREIGN KEY (`Activity_Id`) REFERENCES `tbl_activity` (`Id`),
  ADD CONSTRAINT `tbl_results_ibfk_3` FOREIGN KEY (`Lesson_Id`) REFERENCES `tbl_lessons` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
