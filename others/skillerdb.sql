-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 11:26 AM
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
  `CurrentLesson` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`Id`, `Email`, `Image`, `FirstName`, `MiddleName`, `LastName`, `Role`, `Group`, `Disabled`, `CurrentLesson`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'stephenreganjames.layson@gmail.com', NULL, NULL, NULL, NULL, 'Administrator', NULL, 0, NULL, '2024-02-11 09:57:25', '2024-02-25 08:12:31');

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
(1, 1, 'Making the World Work Assessment', 'Assessment 1', 'Assessment 1', 1, '2024-02-25 08:58:29', '2024-02-25 09:00:00'),
(2, 2, 'Mastering Function Evaluation Assessment', 'Assessment 2', NULL, 1, '2024-02-25 09:01:50', '2024-02-25 09:03:02'),
(3, 5, 'Modeling the World with Ratios Assessment', '30 Points', 'Assessment', 0, '2024-02-25 09:18:50', '2024-02-25 09:18:50'),
(4, 9, 'Undoing the Action in Real-World Scenarios Assessment', 'Assessment', '30 Points ', 1, '2024-02-25 09:22:42', '2024-02-25 09:22:42'),
(5, 13, 'Growth and Decay in the Real World Assessment', '30 points', '30 points', 1, '2024-02-25 09:26:30', '2024-02-25 09:26:30'),
(6, 17, 'Unveiling the Magic of Financial Mathematics Assessment', '30 points', '30 points', 1, '2024-02-25 09:33:19', '2024-02-25 09:33:19'),
(7, 20, 'A Logical Approach Assessment', '30 Points', NULL, 1, '2024-02-25 09:36:32', '2024-02-25 09:36:32'),
(8, 21, 'Final Assessment', '60 Points', 'Required 75% score.', 0, '2024-02-25 10:03:27', '2024-02-25 10:03:30');

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
(5, 'Financial Mathematics, Propositions, and Logic', 'M11GM-IIa-1, M11GM-IIa-2, M11GM-IIa-b-1, M11GM-IIb-2, M11GM-IIc-1, M11GM-IIc-2, M11GM-IIc-d-1, M11GM-IId-2, M11GM-IId-3, M11GM-IIe-1, M11GM-IIe-2, M11GM-IIe-3, M11GM-IIe-4, M11GM-IIe-5, M11GM-IIf-1, M11GM-IIf-2, M11GM-IIf-3, M11GM-IIg-1, M11GM-IIg-2, M11GM-IIg-3, M11GM-IIg-4, M11GM-IIh-1, M11GM-IIh-2, M11GM-IIi-1, M11GM-IIi-2, M11GM-IIi-3, M11GM-IIj-1, M11GM-IIj-2', '2024-01-21 19:29:35', '2024-01-21 19:29:35'),
(6, 'Final Examination', 'All Lessons', '2024-02-23 14:54:00', '2024-02-25 06:09:09');

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
(1, 'Real-world Applications of Functions', 1, 'The primary objective of this lesson is to enable students to recognize and formulate mathematical functions that effectively describe and predict real-world phenomena. By the end of the session, students should not only comprehend the theoretical foundations of functions but also develop the skills to apply these concepts in solving tangible problems beyond the classroom setting. This lesson serves as a foundation for appreciating the practical significance of functions and their role in addressing complex, dynamic scenarios in various fields.', 'The lesson on &#34;Real-world Applications of Functions&#34; is designed to bridge the gap between abstract mathematical concepts and their practical utility in addressing real-life scenarios. Students explore the versatile nature of functions as powerful tools for representing relationships between different quantities in a variety of contexts. Through concrete examples and case studies, the lesson provides a hands-on understanding of how functions can accurately model dynamic systems, offering valuable insights into the complexities of the real world.', '', 'https://www.youtube-nocookie.com/embed/tAoe4xjUZQk?si=5NVt0aQh78ys47NP', 'Introduction to Functions: Making the World Work\r\n\r\nImagine a world without functions. Recipes wouldn&#39;t work, music wouldn&#39;t play, and even basic tasks like calculating the cost of groceries would become incredibly complex. Functions are the hidden language that powers the world around us, and understanding them unlocks a deeper appreciation for the way things work.\r\n\r\n\r\nSo, what exactly is a function?\r\n\r\nThink of a function as a machine that takes in an input, performs an operation on it, and produces an output. This input is often called the argument or domain, while the output is known as the range. For example, a function that doubles any number would take a number as input (argument), multiply it by two (operation), and give you the answer (output).\r\n\r\n\r\nReal-world examples of functions are everywhere:\r\n\r\n- Cooking: A recipe is essentially a function. You follow the instructions (inputs) and get a delicious dish (output). The amount of each ingredient is an input, and the cooking process is the operation that transforms those inputs into the final dish.\r\n\r\n- Music: Every musical note can be represented by a function. The pitch of the note is determined by the frequency of the sound wave, which can be expressed as a mathematical function. Playing a specific note on an instrument is like feeding an input into the function, and the resulting sound is the output.\r\n\r\n- Economics: Supply and demand curves are perfect examples of functions. The price of a good or service (output) is determined by the quantity supplied and demanded (inputs). These relationships can be modeled using mathematical functions, allowing economists to predict market behavior.\r\n\r\n- GPS Navigation: When you enter a destination into your GPS, it uses a complex set of functions to calculate the route. Your starting location and desired destination are the inputs, and the navigation system applies various algorithms (functions) to determine the optimal route, providing you with turn-by-turn instructions (output).\r\nThese are just a few examples, and the list goes on! From physics and engineering to computer science and finance, functions are fundamental building blocks that help us understand, analyze, and solve problems in countless ways.\r\n\r\n\r\nBy understanding functions, you gain a powerful tool to:\r\n\r\n- Model real-world phenomena: Functions provide a framework for expressing relationships between different variables, allowing us to create simulations and make predictions.\r\n\r\n- Simplify complex tasks: Breaking down problems into smaller, well-defined functions makes them easier to solve and analyze.\r\n\r\n- Develop problem-solving skills: The ability to think in terms of functions is essential for various fields, from engineering to data science.\r\n\r\n\r\nSo, the next time you listen to music, cook a meal, or use your GPS, remember the invisible functions working behind the scenes, making the world a more predictable and manageable place.', '2024-01-21 19:30:43', '2024-02-25 08:22:29'),
(2, 'Mastering Function Evaluation', 1, 'The primary objective of this lesson is to equip students with the necessary skills to confidently evaluate a variety of functions for specific inputs. By mastering function evaluation, students will not only enhance their computational abilities but also develop a deeper understanding of the dynamic nature of functions. This skill is crucial for navigating more complex mathematical concepts and problem-solving scenarios that involve the manipulation and analysis of functions in practical applications.', 'The lesson on &#34;Mastering Function Evaluation&#34; focuses on honing students&#39; proficiency in evaluating functions, a fundamental skill in understanding mathematical relationships. Students delve into the process of substituting specific values into functions and calculating the corresponding outputs. The lesson emphasizes the importance of this skill in comprehending how functions behave and respond to different inputs. Through a series of examples and exercises, students gain confidence in manipulating functions and interpreting the results of their evaluations, laying a solid foundation for more advanced concepts in the study of functions.', '', 'https://www.youtube-nocookie.com/embed/lGfsp2CWjok?si=1KVD3uGlFDeRQI9i', 'Introduction to Functions: Mastering Function Evaluation\r\n\r\nFunction evaluation is the process of determining the output of a function for a specific input value. It&#39;s like plugging a number into a machine and getting the answer out. Here&#39;s a breakdown to help you master this essential concept:\r\n\r\n\r\nUnderstanding the Notation:\r\n\r\nFunction Notation: We use the letter f(x) to represent a function named &#34;f&#34; that takes an input &#34;x&#34;. The input is placed inside the parentheses.\r\nExample: f(x) = 2x + 3\r\n\r\n\r\nEvaluating the Function:\r\n\r\nSubstitute the input value: Replace &#34;x&#34; in the function&#39;s formula with the given input value.\r\nPerform the calculation: Apply the operations according to the order of operations (PEMDAS: Parentheses, Exponents, Multiplication and Division from left to right, Addition and Subtraction from left to right).\r\nThe result is the output: The answer you get after performing the calculation is the function&#39;s output for that specific input.\r\n\r\nExample:\r\n\r\nLet&#39;s evaluate the function f(x) = 2x + 3 for the input x = 5:\r\nSubstitute x = 5: f(5) = 2(5) + 3\r\nPerform the calculation: f(5) = 10 + 3\r\nOutput: f(5) = 13\r\nTherefore, when x = 5, the function f(x) outputs 13.\r\n\r\n\r\nPractice Makes Perfect:\r\n\r\nTry evaluating functions with different inputs to solidify your understanding. Here are some examples:\r\nf(x) = x^2 - 4, evaluate for x = 2\r\ng(t) = 3t - 1, evaluate for t = -1\r\nh(y) = y/(y-2), evaluate for y = 3\r\n\r\n\r\nRemember, function evaluation is a fundamental skill in mathematics. By mastering it, you&#39;ll be able to solve various problems and applications involving functions.', '2024-01-21 19:30:43', '2024-02-25 08:24:58'),
(3, 'Basic Operations and Function Compositions', 1, 'The primary objective of this lesson is to empower students with the skills to perform basic operations on functions and compose multiple functions. By mastering these fundamental operations, students develop a deeper understanding of how functions interact and transform, laying the groundwork for more complex mathematical concepts. The lesson aims to foster both algebraic and graphical proficiency, ensuring that students can navigate various scenarios involving the manipulation and combination of functions with confidence.', 'The lesson on \"Basic Operations and Function Compositions\" delves into the fundamental operations that can be performed on functions and the concept of composing multiple functions. Students explore how to combine, add, subtract, multiply, and divide functions, understanding the impact of these operations on the overall behavior of the composite function. Emphasis is placed on developing a systematic approach to performing these operations and interpreting the results in both algebraic and graphical terms. Through examples and interactive exercises, students gain a solid grasp of manipulating functions, setting the stage for more advanced studies in function theory and analysis.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(4, 'Problems in the Realm of Functions', 1, 'The primary objective of this lesson is to develop students problem-solving skills within the context of functions. By tackling a range of problems, students learn to apply function concepts to real-world scenarios, fostering a deeper appreciation for the practical utility of mathematical functions. The lesson aims to cultivate analytical thinking, encouraging students to approach problem-solving with a systematic and mathematically informed mindset.', 'The lesson on \"Problems in the Realm of Functions\" is geared towards applying the knowledge of functions to solve real-world problems and mathematical challenges. Students engage in problem-solving exercises that require them to leverage their understanding of functions to analyze, model, and address practical scenarios. This lesson aims to sharpen students critical thinking and analytical skills by presenting them with a variety of problems that can be effectively tackled using the concepts learned in previous sessions. Through guided problem-solving and interactive discussions, students gain confidence in their ability to apply function theory to diverse problem domains.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(5, 'Representing Scenarios with Rational Functions', 2, 'The primary objective of this lesson is to equip students with the skills to recognize and utilize rational functions as powerful tools for representing real-world scenarios. By the end of the session, students should be adept at identifying situations where rational functions are applicable and be able to formulate these functions accurately. This lesson sets the stage for further exploration into the nuances of rational functions and their applications in various fields.', 'The lesson on &#34;Representing Scenarios with Rational Functions&#34; immerses students in the practical application of rational functions to model and represent real-world scenarios. Students explore the versatile nature of rational functions, understanding how they can accurately describe relationships in various contexts. The lesson introduces scenarios where ratios, proportions, and dynamic relationships can be effectively modeled using rational functions. Through examples and hands-on activities, students gain insight into selecting and formulating rational functions that best represent specific situations, laying the groundwork for a deeper understanding of this important class of functions.', '', 'https://www.youtube-nocookie.com/embed/1fR_9ke5-n8?si=Za2sh-b2LAY6_XdS', 'Rational Functions and Equations: Modeling the World with Ratios\r\n\r\nRational functions, a powerful tool in mathematics, allow us to represent real-world scenarios involving rates, proportions, and ratios. They are expressed as the quotient of two polynomial functions, where the denominator cannot be zero.\r\n\r\n\r\nUnderstanding Rational Functions:\r\n\r\n- A rational function is written as f(x) = p(x) / q(x), where p(x) and q(x) are polynomial functions and q(x) ≠ 0.\r\n\r\n- The numerator, p(x), represents the expression being divided.\r\n\r\n- The denominator, q(x), represents the divisor and cannot contain the value that makes it zero (restrictions on the domain).\r\n\r\n\r\nRepresenting Scenarios:\r\n\r\n- Rates: Imagine a car traveling at a constant speed of 60 miles per hour. The distance traveled (d) can be related to time (t) by the rational function d(t) = 60t / 1, where 60 represents the rate (speed) and t is the input (time).\r\n\r\n- Proportions: Mixing paints of different colors is a common example. To achieve a desired shade (output), you mix specific proportions of two base colors (inputs). This scenario can be modeled by a rational function where the output is the ratio of one color quantity to the other.\r\n\r\n- Concentration: In chemistry, solutions often involve mixing a solute with a solvent. The concentration of the solute (output) can be expressed as a rational function of the amount of solute and the total volume of the solution (inputs).\r\n\r\nExamples:\r\n\r\n1. Finding the cost of renting a car: A car rental company charges a daily rate of $50 and a one-time cleaning fee of $20. The total cost (C) can be modeled by the function C(d) = 50d + 20, where d represents the number of rental days.\r\n\r\n2. Calculating the average speed: If you travel a distance of 200 miles in 4 hours, your average speed (S) can be found using the function S(d, t) = d / t, where d = 200 and t = 4.\r\n\r\n\r\nSolving Rational Equations:\r\n\r\nRational equations involve rational functions set equal to another expression. Solving them requires manipulating the equation algebraically to isolate the variable in the desired domain.\r\n\r\n\r\nRemember:\r\n\r\n- Always check for any restrictions on the domain due to the denominator being zero.\r\n\r\n- Rational functions offer a versatile tool for modeling and analyzing various real-world phenomena involving rates, proportions, and ratios.\r\n\r\n\r\nFurther Exploration:\r\n\r\n- Explore online resources and textbooks to delve deeper into solving rational equations and applying them to diverse scenarios.\r\n\r\n- Practice with various problems involving rational functions to solidify your understanding and problem-solving skills.', '2024-01-21 19:30:43', '2024-02-25 08:32:01'),
(6, 'Understanding Rational Functions, Equations, and Inequalities', 2, 'The primary objective of this lesson is to provide students with a nuanced understanding of rational functions, equations, and inequalities. By the end of the session, students should be proficient in recognizing, manipulating, and solving problems involving rational functions. The lesson aims to build a strong foundation for students to navigate the complexities of rational expressions, setting the stage for more advanced studies in the realm of mathematical functions.', 'The lesson titled \"Understanding Rational Functions, Equations, and Inequalities\" delves into the intricacies of rational functions, emphasizing the distinctions between functions, equations, and inequalities within this specific class. Students explore the structure of rational functions and how they differ from other types of mathematical expressions. The lesson introduces the concept of rational equations and inequalities, shedding light on how these mathematical constructs relate to real-world problem-solving scenarios. Through theoretical discussions and practical examples, students gain a comprehensive understanding of the role that rational functions play in both theoretical mathematics and practical applications.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(7, 'Solving Rational Equations and Inequalities', 2, 'The primary objective of this lesson is to equip students with the skills to solve both rational equations and inequalities. By the end of the session, students should be adept at employing various techniques to isolate variables and determine solution sets within the realm of rational expressions. This lesson serves as a crucial step in developing problem-solving abilities related to rational functions and lays the groundwork for more advanced studies in the domain of mathematical functions.', 'The lesson on \"Solving Rational Equations and Inequalities\" guides students through the process of effectively solving mathematical problems involving rational equations and inequalities. Students delve into strategies for isolating variables, simplifying expressions, and determining the solution sets for rational equations. The lesson also extends to understanding and interpreting solutions in the context of rational inequalities. Through a series of examples and interactive exercises, students gain proficiency in solving problems that require the manipulation and analysis of rational expressions, providing them with essential problem-solving tools.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(8, 'Visualizing and Analyzing Rational Functions', 2, 'The primary objective of this lesson is to equip students with the skills to visualize and analyze rational functions graphically. By the end of the session, students should be proficient in graphing rational functions, identifying critical points, and interpreting the graphical representation in the context of real-world scenarios. This lesson sets the stage for more advanced studies in function theory, where graphical analysis plays a crucial role in understanding the behavior of complex mathematical functions.', 'The lesson on \"Visualizing and Analyzing Rational Functions\" immerses students in the graphical representation and analysis of rational functions. Students explore how to graphically depict rational functions, identifying key features such as asymptotes, intercepts, and behavior in different regions. The lesson emphasizes the connection between the graphical representation and the algebraic structure of rational functions. Through interactive activities and visual aids, students develop a keen sense of interpreting and analyzing the graphical behavior of rational functions, providing valuable insights into their overall characteristics.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(9, 'Real-life Scenarios with One-to-One Functions', 3, 'The primary objective of this lesson is to enable students to recognize and apply one-to-one functions in real-world contexts. By the end of the session, students should be proficient in identifying situations where one-to-one functions are applicable and formulating these functions accurately to model unique relationships. This lesson lays the foundation for a deeper understanding of the practical significance of one-to-one functions and their role in various fields of study.', 'In the lesson focused on &#34;Real-life Scenarios with One-to-One Functions,&#34; students explore the practical applications of one-to-one functions in modeling and solving real-world situations. The lesson introduces scenarios where one-to-one functions play a crucial role in accurately representing relationships with a unique correspondence between inputs and outputs. Through concrete examples and case studies, students discover how one-to-one functions are employed to model diverse phenomena in fields such as economics, biology, and technology. The lesson aims to bridge theoretical concepts with practical applications, illustrating the relevance of one-to-one functions in understanding and addressing complex real-life scenarios.', '', 'https://www.youtube-nocookie.com/embed/GsIo3B46yjU?si=ldw3Ve2p1fpdGrRz', 'Inverse Functions: Undoing the Action in Real-World Scenarios\r\n\r\nImagine a world where actions cannot be undone. In mathematics, however, the concept of inverse functions allows us to &#34;reverse&#34; the effect of a function under certain conditions. This lesson explores real-life applications of inverse functions, focusing on one-to-one functions where the inverse exists.\r\n\r\n\r\nUnderstanding Inverse Functions:\r\n\r\n- A function f(x) has an inverse function, denoted by f^-1(x), only if f(x) is one-to-one. This means each output has a unique input, and vice versa.\r\n\r\n- The inverse function essentially &#34;undoes&#34; the action of the original function.\r\n\r\n- If y = f(x), then x = f^-1(y).\r\n\r\n\r\nReal-Life Scenarios:\r\n\r\n1. Temperature Conversion: Converting between Celsius (°C) and Fahrenheit (°F) is a classic example. The function f(°C) = (9/5)°C + 32 converts Celsius to Fahrenheit, while its inverse, f^-1(°F) = (5/9)(°F - 32), converts Fahrenheit to Celsius.\r\n\r\n2. Age and Year of Birth: The function f(y) = 2024 - y gives your current age (y) based on the year (2024). Its inverse, f^-1(a) = 2024 - a, determines your year of birth (a) given your current age.\r\n\r\n3. Discounts and Original Prices: A store offers a 20% discount on all items. The function f(p) = 0.8p represents the discounted price (p) based on the original price. The inverse, f^-1(dp) = dp / 0.8, calculates the original price (dp) from the discounted price.\r\n\r\n\r\nKey Points:\r\n\r\n- Not all functions have inverses. Only one-to-one functions guarantee the existence of an inverse.\r\n\r\n- The inverse function swaps the roles of the input and output variables.\r\n\r\n- Understanding inverse functions helps us model and analyze situations where we need to &#34;undo&#34; or reverse an action.\r\n\r\n\r\nExplore Further:\r\n\r\n- Investigate how inverse functions are used in cryptography, where encryption and decryption are essentially inverse operations.\r\n\r\n- Look into applications of inverse functions in physics, economics, and other disciplines to broaden your understanding of their versatility.\r\n\r\n\r\nBy delving into these real-life scenarios, you can appreciate the practical significance of inverse functions and their ability to model various situations where reversing an action or process is crucial.', '2024-01-21 19:30:43', '2024-02-25 08:35:12'),
(10, 'Determining Inverses in One-to-One Functions', 3, 'The primary objective of this lesson is to enable students to confidently determine inverses in one-to-one functions. By the end of the session, students should grasp the concept of one-to-one functions and understand the process of identifying and representing their inverses. This lesson serves as a foundational step in building students proficiency in dealing with inverse relationships and prepares them for more complex studies in function theory and analysis.', 'The lesson titled \"Determining Inverses in One-to-One Functions\" delves into the concept of one-to-one functions and the process of identifying and understanding their inverses. Students explore the unique characteristics of one-to-one functions, which guarantee a distinct correspondence between inputs and outputs. The lesson guides students through the steps of determining the inverse function for a given one-to-one function, emphasizing the symmetry and reversal of roles between the original function and its inverse. Through examples and interactive exercises, students develop a solid understanding of one-to-one functions and their inverses, paving the way for more advanced topics in function theory.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(11, 'Representing and Graphing Inverse Functions', 3, 'The primary objective of this lesson is to equip students with the skills to represent and graph inverse functions. By the end of the session, students should comprehend the graphical symmetry inherent in the relationship between a function and its inverse. This lesson serves as a crucial step in building students understanding of inverse functions and prepares them for more advanced studies in function theory and graphical analysis.', 'The lesson titled \"Representing and Graphing Inverse Functions\" guides students through the exploration of inverse functions and their graphical representation. Students delve into the unique relationship between a function and its inverse, understanding how the graph of an inverse function mirrors the original function across the line y = x. The lesson emphasizes the steps involved in graphing inverse functions, highlighting the symmetry between points on the original function and its inverse. Through practical examples and interactive exercises, students gain proficiency in representing and graphing inverse functions, fostering a deeper appreciation for the symmetrical nature of these mathematical relationships.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(12, 'Problem-solving with Inverse Functions', 3, 'The primary objective of this lesson is to enable students to proficiently solve problems using inverse functions. By the end of the session, students should be adept at applying inverse functions to reverse operations, solve equations, and address real-world challenges. This lesson serves as a crucial step in building problem-solving skills within the context of inverse functions and prepares students for more advanced studies in function theory and applications.', 'The lesson on \"Problem-solving with Inverse Functions\" immerses students in the practical application of inverse functions to solve a variety of mathematical challenges and real-world problems. Students explore how inverse functions can be utilized to reverse the effects of an original function and solve equations involving these functions. The lesson emphasizes the role of inverse functions in undoing operations and isolating variables. Through a series of problem-solving exercises and real-world scenarios, students develop critical thinking skills, honing their ability to apply inverse functions as powerful tools in mathematical analysis.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(13, 'Applications of Exponential Functions in Real Life', 4, 'The primary objective of this lesson is to equip students with the skills to recognize and apply exponential functions in real-life situations. By the end of the session, students should comprehend the significance of exponential functions in modeling growth and decay phenomena and be able to interpret and analyze these functions in practical contexts. This lesson serves as a foundation for further exploration into the nuances of exponential functions and their wide-ranging applications.', 'The lesson on &#34;Applications of Exponential Functions in Real Life&#34; immerses students in the practical and diverse applications of exponential functions. Students explore how exponential functions model phenomena characterized by rapid growth or decay, such as population growth, compound interest, and radioactive decay. The lesson emphasizes the versatility of exponential functions in capturing real-world scenarios with exponential behavior. Through concrete examples and case studies, students gain insights into the role of exponential functions in predicting future trends and understanding dynamic processes in various fields.', '', 'https://www.youtube-nocookie.com/embed/6WMZ7J0wwMI?si=ges7ISBn7pLI_pBk', 'Exponential Functions: Growth and Decay in the Real World\n\nExponential functions, characterized by their rapid growth or decay, play a crucial role in modeling various real-world phenomena. This lesson explores some captivating applications of these functions:\n\n\nUnderstanding Exponential Functions:\n\n- An exponential function is of the form f(x) = a^x, where a is any positive constant base (a ≠ 0, a ≠ 1) and x is the exponent.\n\n- The base determines the rate of growth or decay:\na > 1: Exponential growth (e.g., population increase, compound interest)\n0 < a < 1: Exponential decay (e.g., radioactive decay, drug elimination from the body)\n\n\nReal-Life Applications:\n\n1. Population Growth: Demographers use exponential functions to model population growth, considering birth rates, death rates, and migration patterns. This helps predict future population trends and inform resource allocation decisions.\n\n3. Compound Interest: Earning interest on your savings is an exciting example of exponential growth. The formula A = P(1 + r)^t calculates the future amount (A) based on the initial principal (P), interest rate (r), and time (t).\n\n3. Radioactive Decay: Radioactive isotopes decay exponentially over time. The half-life, the time it takes for an isotope to lose half its radioactivity, is a key concept. Scientists use exponential functions to predict the remaining activity of radioactive materials and ensure safe handling.\n\n4. Modeling Infectious Diseases: The spread of viruses and bacteria often follows an exponential pattern in the initial stages. Understanding this growth pattern is crucial for implementing effective control measures.\n\n\nExample:\n\nImagine a bacterial population that doubles every hour (a = 2). The initial population is 100 (P = 100). How many bacteria will be present after 3 hours (t = 3)?\n\nUsing the formula A = P(a^t), we get:\n\nA = 100 * (2^3) = 800\n\nTherefore, the population will grow to 800 bacteria after 3 hours.\n\n\nFurther Exploration:\n\n- Explore the YouTube video \"Exponential Functions and Applications: \'[invalid URL removed]\'\" by MathTheBeautiful to gain a deeper understanding of exponential functions and their applications.\n\n- Investigate how exponential functions are used in finance, computer science, and other fields to broaden your perspective on their diverse applications.\n\n\nBy understanding exponential functions, you can appreciate their power in modeling various real-world phenomena characterized by rapid growth or decay, making informed decisions in diverse fields.', '2024-01-21 19:30:43', '2024-02-25 08:41:02'),
(14, 'Understanding Exponential Equations and Inequalities', 4, 'The primary objective of this lesson is to enable students to confidently solve both exponential equations and inequalities. By the end of the session, students should be adept at employing various techniques to isolate variables and determine solution sets within the realm of exponential functions. This lesson serves as a crucial step in developing problem-solving abilities related to exponential growth and decay, preparing students for more advanced studies in the domain of mathematical functions.', 'The lesson titled \"Understanding Exponential Equations and Inequalities\" delves into the intricacies of solving mathematical problems involving exponential equations and inequalities. Students explore the unique properties of exponential functions and how these properties translate into solving equations and inequalities. The lesson guides students through techniques for isolating variables, simplifying exponential expressions, and determining solution sets. Through practical examples and interactive exercises, students gain proficiency in solving problems that involve exponential growth and decay, laying the foundation for a deeper understanding of exponential functions.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(15, 'Navigating Logarithmic Equations and Inequalities', 4, 'The primary objective of this lesson is to equip students with the skills to confidently navigate and solve logarithmic equations and inequalities. By the end of the session, students should be adept at employing various techniques to isolate variables and determine solution sets within the realm of logarithmic functions. This lesson serves as a crucial step in developing problem-solving abilities related to logarithmic functions, preparing students for more advanced studies in the domain of mathematical functions.', 'The lesson on \"Navigating Logarithmic Equations and Inequalities\" guides students through the complexities of solving mathematical problems involving logarithmic functions. Students explore the unique properties of logarithms and how these properties translate into solving equations and inequalities. The lesson covers techniques for isolating variables, simplifying logarithmic expressions, and determining solution sets. Through practical examples and interactive exercises, students gain proficiency in solving problems that involve logarithmic functions, providing a solid foundation for understanding the intricacies of these mathematical constructs.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(16, 'Charting the Course of Exponential and Logarithmic Functions', 4, 'The primary objective of this lesson is to equip students with the skills to graphically represent and analyze exponential and logarithmic functions. By the end of the session, students should be proficient in graphing these functions, identifying critical points, and interpreting the graphical representation in the context of real-world scenarios. This lesson sets the stage for more advanced studies in function theory, where graphical analysis plays a crucial role in understanding the behavior of complex mathematical functions.', 'The lesson titled \"Charting the Course of Exponential and Logarithmic Functions\" provides students with a comprehensive understanding of the graphical representation and analysis of exponential and logarithmic functions. Students explore the distinctive characteristics of these functions, including exponential growth/decay and logarithmic transformations. The lesson guides students through graphing techniques, identifying key features such as intercepts, asymptotes, and behavior in different regions. Through practical examples and interactive exercises, students gain proficiency in charting the course of exponential and logarithmic functions, enhancing their ability to interpret and analyze these functions graphically.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(17, 'Simple and Compound Tales in Financial Mathematics', 5, 'The primary objective of this lesson is to enable students to comprehend and apply the principles of simple and compound interest in financial mathematics. By the end of the session, students should be adept at calculating interest, determining future values, and making informed financial decisions based on these concepts. This lesson serves as a crucial step in developing financial literacy and prepares students for more advanced studies in financial mathematics.', 'The lesson on &#34;Simple and Compound Tales in Financial Mathematics&#34; delves into the world of financial concepts, focusing on simple and compound interest scenarios. Students explore the principles underlying simple and compound interest, understanding how these concepts influence financial decisions and investments. The lesson covers calculations of interest, maturity value, future value, and present value in both simple interest and compound interest environments. Through practical examples and hands-on activities, students gain insights into the application of financial mathematics in various contexts, laying the foundation for informed decision-making in financial scenarios.', '', 'https://www.youtube-nocookie.com/embed/Hn0eLcOSQGw?si=4z4dXmF2AaBqOY68', 'Simple and Compound Tales: Unveiling the Magic of Financial Mathematics\r\n\r\nFinancial mathematics, a captivating blend of finance and mathematics, empowers you to make informed financial decisions. This lesson delves into the contrasting worlds of simple and compound interest, unveiling their unique tales and highlighting their significance in financial planning.\r\n\r\n\r\nSimple Interest: A Straightforward Story\r\n\r\n- Imagine saving $1000 at an annual interest rate of 5%. With simple interest, you earn a fixed amount of interest each year, calculated as:\r\n\r\n\r\nInterest earned per year = Principal × Interest rate\r\n\r\n- In this case, you would earn $50 per year (1000 × 0.05).\r\n\r\n- Regardless of the investment period, the interest earned remains constant with simple interest.\r\n\r\n\r\nCompound Interest: A Story of Exponential Growth\r\n\r\n- Compound interest, often referred to as &#34;interest on interest,&#34; works like magic. It reinvests not just the initial principal but also the accumulated interest from previous periods.\r\n\r\n- This creates a snowball effect, where your money grows exponentially over time.\r\n\r\n\r\nExample:\r\n\r\n- Let&#39;s revisit the $1000 scenario, but this time with compound interest at 5%.\r\n\r\n- Year 1: Interest earned = $50 (same as simple interest)\r\n\r\n- Year 2: Interest earned = $52.50 (1050 × 0.05)\r\n\r\n- Year 3: Interest earned = $55.13 (1102.50 × 0.05)\r\n\r\nAs you can see, the interest earned keeps increasing with each year, showcasing the power of compounding.\r\n\r\n\r\nThe Tales Collide: Making informed choices\r\n\r\n- Choosing between simple and compound interest depends on your financial goals and investment horizon.\r\n\r\n- Simple interest is suitable for short-term investments where frequent withdrawals are expected.\r\n\r\n- Compound interest shines for long-term goals like retirement planning, as it allows your money to grow exponentially over extended periods.\r\n\r\n\r\nEmpowering Yourself:\r\n\r\n- Understanding these concepts empowers you to:\r\n   - Compare investment options effectively.\r\n   - Make informed decisions about saving and borrowing.\r\n   - Plan for your financial future with greater clarity.\r\n\r\n\r\nExplore Further:\r\n\r\n- Research various financial instruments like savings accounts, mutual funds, and stocks to understand how they leverage simple or compound interest.\r\n\r\nBy understanding the contrasting tales of simple and compound interest, you gain valuable knowledge to navigate the exciting realm of financial mathematics and make informed decisions that shape your financial future.', '2024-01-21 19:30:43', '2024-02-25 08:44:44'),
(18, 'Coding Real-world Statements into Logical Propositions', 5, 'The primary objective of this lesson is to equip students with the skills to code real-world statements into logical propositions. By the end of the session, students should be proficient in recognizing logical structures within statements and translating them into a symbolic language. This lesson serves as a foundational step in building students logical reasoning skills and prepares them for more advanced studies in formal logic and problem-solving.', 'The lesson titled \"Coding Real-world Statements into Logical Propositions\" introduces students to the fundamentals of symbolic logic by translating real-world statements into logical propositions. Students explore the process of representing complex statements using mathematical symbols and logical operators. The lesson emphasizes the importance of precision in logical coding, fostering an understanding of how to capture the essence of real-world scenarios in a formal logical language. Through practical examples and exercises, students gain proficiency in coding statements into logical propositions, laying the groundwork for further studies in propositional logic.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(19, 'Unraveling Truth Values and Conditional Propositions', 5, 'The primary objective of this lesson is to enable students to confidently unravel truth values and understand conditional propositions. By the end of the session, students should be adept at assessing the truth or falsity of propositions and interpreting conditional statements. This lesson serves as a foundational step in building students proficiency in symbolic logic and prepares them for more advanced studies in logical reasoning and argumentation.', 'The lesson on \"Unraveling Truth Values and Conditional Propositions\" introduces students to the fundamental concepts of truth values and conditional propositions within the realm of symbolic logic. Students explore the truth values of propositions and understand the implications of conditional statements. The lesson guides students through the logical structure of conditional propositions, emphasizing the relationship between the antecedent and the consequent. Through practical examples and interactive exercises, students gain proficiency in unraveling truth values and analyzing conditional propositions, enhancing their logical reasoning skills.', NULL, NULL, NULL, '2024-01-21 19:30:43', '2024-01-21 19:30:43'),
(20, 'Analyzing Validity, Fallacies, and Methods in Logic', 5, 'The primary objective of this lesson is to equip students with the skills to analyze the validity of logical arguments, identify fallacies, and apply various methods of logical reasoning. By the end of the session, students should be proficient in critically assessing the strength and soundness of logical propositions and arguments. This lesson serves as a crucial step in building students&#39; logical reasoning abilities and prepares them for more advanced studies in formal logic and argumentation.', 'The lesson on &#34;Analyzing Validity, Fallacies, and Methods in Logic&#34; provides students with a deep dive into the evaluation of logical arguments. Students explore the principles of validity, identifying common fallacies, and understanding different methods of logical reasoning. The lesson emphasizes the importance of sound reasoning and critical analysis in assessing the strength of logical arguments. Through practical examples and interactive discussions, students gain proficiency in identifying valid arguments, recognizing fallacies, and applying different methods of logical analysis. This lesson lays the foundation for developing strong analytical and evaluative skills in logical reasoning.', '', 'https://www.youtube-nocookie.com/embed/ohy2d1Op5nc?si=Z-QUqRQ6bm43jpM2', 'Analyzing Validity, Fallacies, and Methods in Financial Decisions: A Logical Approach\r\n\r\nFinancial decisions often involve complex information and competing viewpoints. Logic, the science of reasoning, empowers you to analyze arguments, identify fallacies, and make sound financial choices.\r\n\r\n\r\nUnderstanding Validity and Fallacies:\r\n\r\n- Valid arguments: The conclusion logically follows from the premises (statements assumed to be true).\r\n\r\n- Fallacies: Errors in reasoning that lead to unsound conclusions. Common fallacies in finance include:\r\n\r\n- Appeal to authority: Relying solely on someone&#39;s reputation without evidence.\r\n\r\n- Post hoc fallacy: Assuming because event A happened before event B, A caused B.\r\n\r\n- Slippery slope: Assuming a small step will inevitably lead to a disastrous outcome.\r\n\r\n\r\nExample:\r\n\r\nArgument: &#34;The stock market has gone up for the past 5 years. Therefore, it will definitely go up in the next year.&#34;\r\n\r\nFallacy: This argument commits the post hoc fallacy. Past performance is not a guarantee of future results.\r\n\r\n\r\nMethods of Logical Reasoning:\r\n\r\n- Deductive reasoning: Draws a specific conclusion from general principles (e.g., &#34;All stocks are risky; therefore, this specific stock is risky&#34;).\r\n\r\n- Inductive reasoning: Uses specific observations to form a general conclusion (e.g., &#34;Several tech stocks have performed well recently; therefore, the tech sector is likely to outperform other sectors&#34;).\r\n\r\n\r\nApplying Logic in Finance:\r\n\r\n- Evaluating investment recommendations: Scrutinize the reasoning behind investment advice. Are there logical fallacies present?\r\n\r\n- Assessing financial news: Critically analyze news articles and financial reports. Are the claims supported by evidence?\r\n\r\n- Making informed decisions: Use logic to weigh different options, considering potential risks and rewards based on sound reasoning.\r\n\r\n\r\nEmpowering Yourself:\r\n\r\nBy honing your logical reasoning skills, you can:\r\n\r\n- Make more objective financial decisions.\r\n\r\n- Avoid falling prey to emotional biases and cognitive errors.\r\n\r\n- Develop a critical thinking approach to navigate the complexities of the financial world.\r\n\r\n\r\nExplore Further:\r\n\r\n- Research common cognitive biases that can influence financial decisions and learn strategies to mitigate their impact.\r\n\r\n\r\nRemember, logic is a powerful tool that empowers you to make informed financial choices and navigate the ever-changing world of finance with greater confidence.', '2024-01-21 19:30:43', '2024-02-25 08:47:49'),
(21, 'Final Examination', 6, 'As a reminder, successfully passing this final examination in General Mathematics is crucial for obtaining your certificate. Your performance on this test will determine your mastery of essential mathematical concepts and your eligibility for certification. Take this opportunity to review thoroughly, ensuring your understanding of the material and your ability to apply it effectively. Your dedication and preparation are key to achieving success and reaching your academic goals. Good luck and remember that your hard work will be rewarded with the recognition and validation of your achievements.', 'As a reminder, successfully passing this final examination in General Mathematics is crucial for obtaining your certificate. Your performance on this test will determine your mastery of essential mathematical concepts and your eligibility for certification. Take this opportunity to review thoroughly, ensuring your understanding of the material and your ability to apply it effectively. Your dedication and preparation are key to achieving success and reaching your academic goals. Good luck and remember that your hard work will be rewarded with the recognition and validation of your achievements.', NULL, NULL, NULL, '2024-02-23 15:05:23', '2024-02-23 15:29:12');

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
  `IsActive` tinyint(1) NOT NULL DEFAULT 1,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_questions`
--

INSERT INTO `tbl_questions` (`Id`, `Activity_Id`, `Question`, `Points`, `Option1`, `Option2`, `Option3`, `Option4`, `Answer`, `Image`, `IsActive`, `CreatedAt`, `UpdatedAt`) VALUES
(61, 1, 'What is a function?', '1', 'A) A machine that produces inputs', 'B) A recipe for cooking', 'C) A mathematical concept that relates inputs to outputs', 'D) A musical note', 'C) A mathematical concept that relates inputs to outputs', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(62, 1, 'In cooking, what represents the input of a function?', '1', 'A) The final dish', 'B) The instructions', 'C) The amount of each ingredient', 'D) The cooking process', 'C) The amount of each ingredient', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(63, 1, 'What aspect of a musical note can be represented by a function?', '1', 'A) Its color', 'B) Its shape', 'C) Its pitch', 'D) Its texture', 'C) Its pitch', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(64, 1, 'What do supply and demand curves in economics represent?', '1', 'A) Inputs and outputs', 'B) Cost and benefit', 'C) Quantity supplied and demanded', 'D) Market equilibrium', 'C) Quantity supplied and demanded', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(65, 1, 'In GPS navigation, what are the inputs of the function?', '1', 'A) The starting location and desired destination', 'B) The turn-by-turn instructions', 'C) The road conditions', 'D) The GPS device', 'A) The starting location and desired destination', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(66, 1, 'How do functions help in modeling real-world phenomena?', '1', 'A) By simplifying complex tasks', 'B) By expressing relationships between variables', 'C) By providing turn-by-turn instructions', 'D) By calculating market equilibrium', 'B) By expressing relationships between variables', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(67, 1, 'What is the benefit of breaking down problems into smaller functions?', '1', 'A) It makes them more complex', 'B) It makes them easier to solve and analyze', 'C) It increases the number of variables', 'D) It decreases problem-solving skills', 'B) It makes them easier to solve and analyze', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(68, 1, 'Why are functions essential in fields like engineering and data science?', '1', 'A) To complicate problem-solving', 'B) To decrease problem-solving skills', 'C) To express relationships between variables', 'D) To avoid simulations and predictions', 'C) To express relationships between variables', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(69, 1, 'What invisible entities work behind the scenes in music, cooking, and GPS navigation?', '1', 'A) Functions', 'B) Ingredients', 'C) Musicians', 'D) Algorithms', 'A) Functions', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(70, 1, 'What do functions contribute to making the world?', '1', 'A) More chaotic', 'B) More predictable and manageable', 'C) More complex', 'D) More difficult to understand', 'B) More predictable and manageable', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(71, 1, 'What fundamental concept does a function relate?', '1', 'A) Inputs and outputs', 'B) Ingredients and recipes', 'C) Notes and melodies', 'D) Directions and destinations', 'A) Inputs and outputs', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(72, 1, 'In economics, what determines the price of a good or service?', '1', 'A) Market demand', 'B) Market competition', 'C) Quantity supplied and demanded', 'D) Government regulations', 'C) Quantity supplied and demanded', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(73, 1, 'What aspect of a recipe can be compared to the operation of a function?', '1', 'A) Mixing ingredients', 'B) Reading instructions', 'C) Choosing utensils', 'D) Setting the table', 'A) Mixing ingredients', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(74, 1, 'What allows economists to predict market behavior?', '1', 'A) Supply and demand curves', 'B) Government regulations', 'C) Random fluctuations', 'D) Historical data', 'A) Supply and demand curves', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(75, 1, 'How do functions help in problem-solving?', '1', 'A) By making problems more difficult', 'B) By providing step-by-step instructions', 'C) By expressing relationships between variables', 'D) By avoiding simulations and predictions', 'C) By expressing relationships between variables', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(76, 1, 'What is the role of functions in GPS navigation?', '1', 'A) To complicate routes', 'B) To increase traffic', 'C) To calculate the optimal route', 'D) To decrease problem-solving skills', 'C) To calculate the optimal route', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(77, 1, 'What is a significant benefit of understanding functions?', '1', 'A) It reduces the need for predictions', 'B) It increases problem-solving skills', 'C) It complicates problem-solving', 'D) It eliminates the need for simulations', 'B) It increases problem-solving skills', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(78, 1, 'What is a real-world example of a function?', '1', 'A) Cooking recipe', 'B) Spaghetti and meatballs', 'C) Kitchen appliances', 'D) Food packaging', 'A) Cooking recipe', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(79, 1, 'How do functions contribute to simplifying complex tasks?', '1', 'A) By adding more variables', 'B) By providing step-by-step instructions', 'C) By increasing unpredictability', 'D) By eliminating simulations', 'B) By providing step-by-step instructions', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(80, 1, 'What is the primary purpose of functions in music?', '1', 'A) To confuse listeners', 'B) To create harmony', 'C) To increase volume', 'D) To eliminate melodies', 'B) To create harmony', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(81, 1, 'What is the essential characteristic of a function?', '1', 'A) It always produces the same output for a given input', 'B) It operates without any input', 'C) It produces random outputs', 'D) It changes its operation based on the input', 'A) It always produces the same output for a given input', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(82, 1, 'How do functions contribute to understanding physics phenomena?', '1', 'A) By adding complexity to equations', 'B) By expressing relationships between physical quantities', 'C) By avoiding mathematical models', 'D) By eliminating the need for simulations', 'B) By expressing relationships between physical quantities', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(83, 1, 'In computer science, what do functions allow programmers to do?', '1', 'A) To write more code', 'B) To complicate algorithms', 'C) To break down tasks into manageable parts', 'D) To avoid solving problems', 'C) To break down tasks into manageable parts', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(84, 1, 'What do functions provide in the field of engineering?', '1', 'A) Solutions to problems', 'B) Complexity to equations', 'C) Relationships between variables', 'D) Predictions about market behavior', 'C) Relationships between variables', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(85, 1, 'How do functions contribute to data analysis in finance?', '1', 'A) By making data analysis more complicated', 'B) By providing a framework for expressing relationships between financial variables', 'C) By avoiding mathematical models', 'D) By eliminating the need for simulations', 'B) By providing a framework for expressing relationships between financial variables', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(86, 1, 'What is the role of functions in simulating real-world phenomena?', '1', 'A) To complicate simulations', 'B) To provide inaccurate results', 'C) To express relationships between variables in a simulation', 'D) To eliminate the need for simulations', 'C) To express relationships between variables in a simulation', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(87, 1, 'Why are functions considered fundamental building blocks?', '1', 'A) Because they add complexity to problems', 'B) Because they express relationships between variables', 'C) Because they avoid problem-solving', 'D) Because they eliminate the need for predictions', 'B) Because they express relationships between variables', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(88, 1, 'What do functions allow scientists to do in biology?', '1', 'A) To avoid studying living organisms', 'B) To express relationships between biological variables', 'C) To increase the number of unknowns', 'D) To eliminate the need for experimentation', 'B) To express relationships between biological variables', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(89, 1, 'How do functions contribute to understanding weather patterns?', '1', 'A) By providing inaccurate predictions', 'B) By expressing relationships between meteorological variables', 'C) By avoiding mathematical models', 'D) By eliminating the need for simulations', 'B) By expressing relationships between meteorological variables', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(90, 1, 'What is the primary function of functions in mathematics?', '1', 'A) To make calculations more complex', 'B) To express relationships between mathematical variables', 'C) To avoid solving mathematical problems', 'D) To eliminate the need for mathematical models', 'B) To express relationships between mathematical variables', NULL, 1, '2024-02-25 08:58:36', '2024-02-25 08:58:36'),
(91, 2, 'What is function evaluation?', '3', 'A) Determining the input of a function', 'B) Finding the domain of a function', 'C) Determining the output of a function for a specific input value', 'D) Finding the range of a function', 'C) Determining the output of a function for a specific input value', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(92, 2, 'Which notation is commonly used to represent a function?', '2', 'A) g(x)', 'B) h(x)', 'C) f(x)', 'D) p(x)', 'C) f(x)', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(93, 2, 'What does the notation f(x) represent?', '3', 'A) The input of the function', 'B) The output of the function', 'C) The domain of the function', 'D) The range of the function', 'B) The output of the function', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(94, 2, 'How do you evaluate a function?', '3', 'A) By finding the domain', 'B) By finding the range', 'C) By determining the output for a given input', 'D) By determining the input for a given output', 'C) By determining the output for a given input', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(95, 2, 'What is the first step in evaluating a function?', '2', 'A) Perform the calculation', 'B) Substitute the input value into the function', 'C) Determine the output value', 'D) Find the range of the function', 'B) Substitute the input value into the function', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(96, 2, 'Which of the following represents function notation?', '2', 'A) f(input)', 'B) input = f(output)', 'C) output = f(input)', 'D) f = input + output', 'A) f(input)', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(97, 2, 'In the function f(x) = 2x + 3, what does the 2x represent?', '2', 'A) The output value', 'B) The input value', 'C) The constant term', 'D) The coefficient of x', 'D) The coefficient of x', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:17:52'),
(98, 2, 'What is the next step after substituting the input value into the function?', '3', 'A) Determine the output value', 'B) Find the range of the function', 'C) Perform the calculation', 'D) Determine the domain of the function', 'C) Perform the calculation', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(99, 2, 'In the function f(x) = 2x + 3, what does the 3 represent?', '2', 'A) The output value', 'B) The input value', 'C) The coefficient of x', 'D) The constant term', 'D) The constant term', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:10:39'),
(100, 2, 'What is the output of the function f(x) = 2x + 3 for x = 5?', '3', 'A) 13', 'B) 15', 'C) 10', 'D) 17', 'A) 13', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(101, 2, 'Which of the following is an example of function evaluation?', '2', 'A) Finding the slope of a line', 'B) Finding the y-intercept of a line', 'C) Substituting a value into a function', 'D) Graphing a function', 'C) Substituting a value into a function', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(102, 2, 'What is the output of the function f(x) = x^2 - 4 for x = 2?', '2', 'A) 0', 'B) 4', 'C) 8', 'D) 12', 'B) 4', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(103, 2, 'What is the output of the function g(t) = 3t - 1 for t = -1?', '2', 'A) 0', 'B) 2', 'C) -4', 'D) -6', 'C) -4', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(104, 2, 'What is the output of the function h(y) = y/(y-2) for y = 3?', '2', 'A) -3', 'B) -1', 'C) 1', 'D) 3', 'D) 3', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(105, 2, 'What is the output of the function f(x) = 2x^2 - 5x + 1 for x = 3?', '3', 'A) 10', 'B) 11', 'C) 12', 'D) 13', 'B) 11', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(106, 2, 'What is the output of the function g(x) = sqrt(x + 4) for x = 9?', '3', 'A) 3', 'B) 4', 'C) 5', 'D) 6', 'C) 5', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(107, 2, 'What is the output of the function h(x) = (x^2 + 3x - 4)/(x + 2) for x = 2?', '3', 'A) 2', 'B) 3', 'C) 4', 'D) 5', 'C) 4', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(108, 2, 'What is the output of the function f(x) = 4x^2 - 2x + 5 for x = -1?', '3', 'A) 7', 'B) 9', 'C) 11', 'D) 13', 'B) 9', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(109, 2, 'What is the output of the function g(x) = 2/x for x = 2?', '2', 'A) 0', 'B) 1', 'C) 2', 'D) 3', 'B) 1', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(110, 2, 'What is the output of the function h(x) = x^3 - 2x^2 + x - 1 for x = 1?', '2', 'A) 0', 'B) 1', 'C) 2', 'D) 3', 'A) 0', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(111, 2, 'What is the output of the function f(x) = x^2 + 3x + 2 for x = -2?', '2', 'A) 2', 'B) 6', 'C) 10', 'D) 14', 'A) 2', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(112, 2, 'What is the output of the function g(x) = 3x^2 - 2x - 1 for x = 0?', '2', 'A) -1', 'B) 0', 'C) 1', 'D) 2', 'A) -1', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(113, 2, 'What is the output of the function h(x) = 4x^2 + 2x - 3 for x = 1?', '2', 'A) 3', 'B) 5', 'C) 7', 'D) 9', 'B) 5', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(114, 2, 'What is the output of the function f(x) = 2x^3 - x^2 + x - 1 for x = 2?', '2', 'A) 5', 'B) 7', 'C) 9', 'D) 11', 'D) 11', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(115, 2, 'What is the output of the function g(x) = x^4 - 3x^2 + 2 for x = -1?', '2', 'A) -1', 'B) 0', 'C) 1', 'D) 2', 'C) 1', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(116, 2, 'What is the output of the function h(x) = 3x^3 - 2x^2 + 5x - 1 for x = 0?', '2', 'A) -1', 'B) 0', 'C) 1', 'D) 2', 'A) -1', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(117, 2, 'What is the output of the function f(x) = 4x^3 - 3x^2 + 2x - 1 for x = 1?', '2', 'A) 2', 'B) 4', 'C) 6', 'D) 8', 'C) 6', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(118, 2, 'What is the output of the function g(x) = 2x^3 - 3x^2 + x - 2 for x = -1?', '2', 'A) 1', 'B) 2', 'C) 3', 'D) 4', 'B) 2', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(119, 2, 'What is the output of the function h(x) = 3x^4 - 2x^3 + x^2 - 1 for x = 2?', '2', 'A) 19', 'B) 23', 'C) 27', 'D) 31', 'B) 23', NULL, 1, '2024-02-25 09:02:26', '2024-02-25 09:02:26'),
(120, 3, 'What is a rational function?', '3', 'A) A function with a rational output', 'B) A function expressed as the quotient of two polynomial functions', 'C) A function with irrational solutions', 'D) A function with exponential growth', 'B) A function expressed as the quotient of two polynomial functions', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(121, 3, 'Which of the following correctly represents a rational function?', '2', 'A) f(x) = x^2 + 3x - 2', 'B) f(x) = 1 / (x + 2)', 'C) f(x) = sqrt(x)', 'D) f(x) = e^x', 'B) f(x) = 1 / (x + 2)', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(122, 3, 'What does the denominator of a rational function represent?', '2', 'A) The input of the function', 'B) The output of the function', 'C) The expression being divided', 'D) The divisor and restrictions on the domain', 'D) The divisor and restrictions on the domain', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(123, 3, 'In the rational function f(x) = 2x / (x - 3), what is the restriction on the domain?', '3', 'A) x ≠ 0', 'B) x ≠ 2', 'C) x ≠ 3', 'D) x ≠ -2', 'C) x ≠ 3', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(124, 3, 'Which real-world scenario can be best modeled by a rational function?', '3', 'A) The growth of a population over time', 'B) The height of a bouncing ball over time', 'C) The concentration of a solute in a solution', 'D) The temperature change over time', 'C) The concentration of a solute in a solution', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(125, 3, 'What is the numerator in the rational function d(t) = 60t / 1, where d represents the distance traveled and t represents time?', '2', 'A) The distance traveled', 'B) The rate of speed', 'C) The time elapsed', 'D) The constant term', 'A) The distance traveled', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(126, 3, 'What does the rational function C(d) = 50d + 20 represent in the context of renting a car?', '2', 'A) The number of rental days', 'B) The total cost of renting the car', 'C) The one-time cleaning fee', 'D) The rental company', 'B) The total cost of renting the car', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(127, 3, 'How is the average speed calculated using a rational function?', '3', 'A) By dividing the distance traveled by the rate of speed', 'B) By multiplying the rate of speed by the time elapsed', 'C) By subtracting the final distance from the initial distance', 'D) By adding the rate of speed and the time elapsed', 'A) By dividing the distance traveled by the rate of speed', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(128, 3, 'What is the output of the rational function S(d, t) = d / t, where d = 200 and t = 4?', '3', 'A) 50', 'B) 100', 'C) 200', 'D) 800', 'A) 50', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(129, 3, 'What is the main strategy for solving rational equations?', '2', 'A) Factoring quadratic expressions', 'B) Finding the intersection points of graphs', 'C) Manipulating the equation algebraically', 'D) Estimating solutions graphically', 'C) Manipulating the equation algebraically', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(130, 3, 'Why is it important to check for restrictions on the domain when solving rational equations?', '2', 'A) To complicate the problem-solving process', 'B) To ensure that the equation has a solution', 'C) To eliminate solutions that are not feasible', 'D) To increase the number of variables', 'C) To eliminate solutions that are not feasible', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(131, 3, 'What makes rational functions versatile for modeling real-world phenomena?', '3', 'A) Their ability to involve complex numbers', 'B) Their simplicity in expression', 'C) Their ability to represent rates, proportions, and ratios', 'D) Their limitation to polynomial functions', 'C) Their ability to represent rates, proportions, and ratios', NULL, 1, '2024-02-25 09:21:51', '2024-02-25 09:21:51'),
(132, 4, 'What is a key requirement for a function to have an inverse?', '1', 'A) It must be continuous', 'B) It must be differentiable', 'C) It must be one-to-one', 'D) It must be increasing', 'C) It must be one-to-one', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(133, 4, 'What role do inverse functions play in real-world scenarios?', '1', 'A) They complicate situations', 'B) They reverse or undo actions', 'C) They increase complexity', 'D) They have no practical significance', 'B) They reverse or undo actions', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(134, 4, 'What is the inverse of the function f(x) = 3x + 5?', '1', 'A) f^-1(x) = 3x - 5', 'B) f^-1(x) = (x - 5) / 3', 'C) f^-1(x) = (x + 5) / 3', 'D) f^-1(x) = (x + 5) / 2', 'B) f^-1(x) = (x - 5) / 3', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(135, 4, 'If f(x) = x^2, what is the inverse of the function?', '1', 'A) f^-1(x) = sqrt(x)', 'B) f^-1(x) = x^2', 'C) f^-1(x) = 1 / x^2', 'D) f^-1(x) = x^2 - 1', 'A) f^-1(x) = sqrt(x)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(136, 4, 'Which of the following functions has an inverse?', '1', 'A) f(x) = x^2', 'B) f(x) = e^x', 'C) f(x) = ln(x)', 'D) f(x) = 2x + 3', 'D) f(x) = 2x + 3', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(137, 4, 'What is the inverse of the function f(x) = log(x)?', '1', 'A) f^-1(x) = e^x', 'B) f^-1(x) = ln(x)', 'C) f^-1(x) = 10^x', 'D) f^-1(x) = x^2', 'A) f^-1(x) = e^x', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(138, 4, 'Which of the following statements about inverse functions is true?', '1', 'A) Inverse functions always exist for all functions', 'B) Inverse functions can only be found for linear functions', 'C) Inverse functions swap the input and output variables', 'D) Inverse functions have the same domain as the original function', 'C) Inverse functions swap the input and output variables', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(139, 4, 'What is the inverse of the function f(x) = 1 / x?', '1', 'A) f^-1(x) = x', 'B) f^-1(x) = -x', 'C) f^-1(x) = 1 - x', 'D) f^-1(x) = 1 / x', 'D) f^-1(x) = 1 / x', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(140, 4, 'If f(x) = 2x - 3, what is the inverse of the function?', '1', 'A) f^-1(x) = 3x + 2', 'B) f^-1(x) = (x - 3) / 2', 'C) f^-1(x) = (x + 3) / 2', 'D) f^-1(x) = 2x - 3', 'C) f^-1(x) = (x + 3) / 2', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(141, 4, 'What is the inverse of the function f(x) = sin(x)?', '1', 'A) f^-1(x) = cos(x)', 'B) f^-1(x) = tan(x)', 'C) f^-1(x) = arcsin(x)', 'D) f^-1(x) = csc(x)', 'C) f^-1(x) = arcsin(x)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(142, 4, 'If f(x) = x^3, what is the inverse of the function?', '1', 'A) f^-1(x) = x^(1/3)', 'B) f^-1(x) = x^2', 'C) f^-1(x) = x^4', 'D) f^-1(x) = x^(1/2)', 'A) f^-1(x) = x^(1/3)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(143, 4, 'Which of the following functions is not one-to-one?', '1', 'A) f(x) = x^2', 'B) f(x) = x + 5', 'C) f(x) = e^x', 'D) f(x) = ln(x)', 'A) f(x) = x^2', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(144, 4, 'What is the inverse of the function f(x) = 5x - 7?', '1', 'A) f^-1(x) = (x + 7) / 5', 'B) f^-1(x) = (x - 7) / 5', 'C) f^-1(x) = 5x + 7', 'D) f^-1(x) = (x - 7) / 2', 'B) f^-1(x) = (x - 7) / 5', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(145, 4, 'If f(x) = e^x, what is the inverse of the function?', '1', 'A) f^-1(x) = ln(x)', 'B) f^-1(x) = sin(x)', 'C) f^-1(x) = cos(x)', 'D) f^-1(x) = tan(x)', 'A) f^-1(x) = ln(x)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(146, 4, 'What is the inverse of the function f(x) = 3x^2?', '1', 'A) f^-1(x) = sqrt(3x)', 'B) f^-1(x) = 3sqrt(x)', 'C) f^-1(x) = x^2 / 3', 'D) f^-1(x) = sqrt(x / 3)', 'A) f^-1(x) = sqrt(3x)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(147, 4, 'If f(x) = cos(x), what is the inverse of the function?', '1', 'A) f^-1(x) = sin(x)', 'B) f^-1(x) = sec(x)', 'C) f^-1(x) = csc(x)', 'D) f^-1(x) = cos(x)', 'A) f^-1(x) = sin(x)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(148, 2, 'What is the inverse of the function f(x) = 2x^3 + 5?', '1', 'A) f^-1(x) = (x - 5) / 2', 'B) f^-1(x) = (x + 5) / 2', 'C) f^-1(x) = sqrt((x - 5) / 2)', 'D) f^-1(x) = (x^3 - 5) / 2', 'A) f^-1(x) = (x - 5) / 2', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(149, 4, 'Which of the following functions has an inverse?', '1', 'A) f(x) = x^2', 'B) f(x) = e^x', 'C) f(x) = ln(x)', 'D) f(x) = 2x + 3', 'D) f(x) = 2x + 3', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(150, 4, 'What is the inverse of the function f(x) = 1 / (x + 3)?', '1', 'A) f^-1(x) = x - 3', 'B) f^-1(x) = x + 3', 'C) f^-1(x) = 1 / x - 3', 'D) f^-1(x) = 1 / (x - 3)', 'D) f^-1(x) = 1 / (x - 3)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(151, 4, 'If f(x) = sqrt(x), what is the inverse of the function?', '1', 'A) f^-1(x) = x^2', 'B) f^-1(x) = x / 2', 'C) f^-1(x) = x^3', 'D) f^-1(x) = x^2 / 2', 'A) f^-1(x) = x^2', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(152, 4, 'What is the inverse of the function f(x) = 4x - 8?', '1', 'A) f^-1(x) = (x - 8) / 4', 'B) f^-1(x) = (x + 8) / 4', 'C) f^-1(x) = 4x + 8', 'D) f^-1(x) = (x - 8) / 2', 'A) f^-1(x) = (x - 8) / 4', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(153, 4, 'If f(x) = tan(x), what is the inverse of the function?', '1', 'A) f^-1(x) = sec(x)', 'B) f^-1(x) = csc(x)', 'C) f^-1(x) = cos(x)', 'D) f^-1(x) = tan(x)', 'A) f^-1(x) = sec(x)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(154, 4, 'What is the inverse of the function f(x) = 3 / (x - 2)?', '1', 'A) f^-1(x) = 3x - 2', 'B) f^-1(x) = 2 / (3 - x)', 'C) f^-1(x) = 3 / x - 2', 'D) f^-1(x) = (3 + x) / 2', 'A) f^-1(x) = 3x - 2', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(155, 4, 'If f(x) = ln(x), what is the inverse of the function?', '1', 'A) f^-1(x) = e^x', 'B) f^-1(x) = log(x)', 'C) f^-1(x) = 1 / x', 'D) f^-1(x) = sqrt(x)', 'A) f^-1(x) = e^x', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(156, 4, 'What is the inverse of the function f(x) = 2x + 4?', '1', 'A) f^-1(x) = (x - 4) / 2', 'B) f^-1(x) = (x + 4) / 2', 'C) f^-1(x) = 2x - 4', 'D) f^-1(x) = (x - 4) / 3', 'A) f^-1(x) = (x - 4) / 2', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(157, 4, 'If f(x) = cos(x), what is the inverse of the function?', '1', 'A) f^-1(x) = sin(x)', 'B) f^-1(x) = tan(x)', 'C) f^-1(x) = sec(x)', 'D) f^-1(x) = cos(x)', 'A) f^-1(x) = sin(x)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(158, 4, 'What is the inverse of the function f(x) = 3x^2 - 5?', '1', 'A) f^-1(x) = sqrt(3x + 5)', 'B) f^-1(x) = 3sqrt(x) + 5', 'C) f^-1(x) = x^2 / 3 - 5', 'D) f^-1(x) = sqrt(x / 3) - 5', 'A) f^-1(x) = sqrt(3x + 5)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(159, 4, 'If f(x) = e^x, what is the inverse of the function?', '1', 'A) f^-1(x) = ln(x)', 'B) f^-1(x) = sin(x)', 'C) f^-1(x) = cos(x)', 'D) f^-1(x) = tan(x)', 'A) f^-1(x) = ln(x)', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(160, 4, 'What is the inverse of the function f(x) = 4 / (x - 2)?', '1', 'A) f^-1(x) = 4x - 2', 'B) f^-1(x) = 2 / (4 - x)', 'C) f^-1(x) = 4 / x - 2', 'D) f^-1(x) = (4 + x) / 2', 'A) f^-1(x) = 4x - 2', NULL, 1, '2024-02-25 09:25:54', '2024-02-25 09:25:54'),
(161, 5, 'What is the formula for an exponential function?', '1', 'A) f(x) = x^2', 'B) f(x) = log(x)', 'C) f(x) = a^x', 'D) f(x) = e^x', 'C) f(x) = a^x', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(162, 5, 'What does (a) represent in the exponential function f(x) = a^x?', '1', 'A) The exponent', 'B) The input value', 'C) The slope', 'D) The base', 'D) The base', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:31:00'),
(163, 5, 'What happens to an exponential function when the base (a) is greater than 1?', '1', 'A) It decays', 'B) It remains constant', 'C) It grows exponentially', 'D) It becomes negative', 'C) It grows exponentially', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:31:08'),
(164, 5, 'Which of the following represents exponential growth?', '1', 'A) f(x) = (1/2)^x', 'B) f(x) = 2^x', 'C) f(x) = -3^x', 'D) f(x) = e^x', 'B) f(x) = 2^x', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(165, 5, 'What type of function describes the decay of a radioactive substance?', '1', 'A) Linear function', 'B) Quadratic function', 'C) Exponential function', 'D) Logarithmic function', 'C) Exponential function', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(166, 5, 'What does the base (a) determine in an exponential function?', '1', 'A) The slope', 'B) The exponent', 'C) The input value', 'D) The rate of growth or decay', 'D) The rate of growth or decay', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:31:13'),
(167, 5, 'Which of the following represents exponential decay?', '1', 'A) f(x) = -3^x', 'B) f(x) = e^x', 'C) f(x) = (1/2)^x', 'D) f(x) = 2^x', 'C) f(x) = (1/2)^x', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(168, 5, 'What does the half-life of a radioactive isotope represent?', '1', 'A) The time it takes for the isotope to decay completely', 'B) The time it takes for the isotope to lose half its radioactivity', 'C) The time it takes for the isotope to double its radioactivity', 'D) The time it takes for the isotope to reach equilibrium', 'B) The time it takes for the isotope to lose half its radioactivity', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(169, 5, 'Which of the following is an application of exponential functions?', '1', 'A) Modeling linear growth', 'B) Modeling quadratic growth', 'C) Modeling population growth', 'D) Modeling constant growth', 'C) Modeling population growth', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(170, 5, 'What is the future amount (A) in compound interest calculated using the formula A = P(1 + r)^t?', '1', 'A) The initial principal (P)', 'B) The interest rate (r)', 'C) The time (t)', 'D) The future value after time t', 'D) The future value after time t', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(171, 5, 'Which of the following represents a real-world scenario best modeled by an exponential function?', '1', 'A) The temperature of a cooling cup of coffee', 'B) The height of a bouncing ball', 'C) The growth of a bacterial population', 'D) The speed of a car', 'C) The growth of a bacterial population', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(172, 5, 'What is the inverse operation of exponential growth?', '1', 'A) Addition', 'B) Subtraction', 'C) Multiplication', 'D) Division', 'D) Division', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(173, 5, 'Which of the following represents an exponential function?', '1', 'A) f(x) = x + 2', 'B) f(x) = 3x^2', 'C) f(x) = e^(2x)', 'D) f(x) = log(x)', 'C) f(x) = e^(2x)', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(174, 5, 'In the function f(x) = 2^x, what does the exponent x represent?', '1', 'A) The base', 'B) The rate of growth', 'C) The input value', 'D) The exponent', 'C) The input value', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(175, 5, 'What is the base of the exponential function f(x) = 10^x?', '1', 'A) 10', 'B) x', 'C) 1', 'D) The exponent', 'A) 10', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(176, 5, 'What happens to an exponential function when the base (a) is between 0 and 1?', '1', 'A) It grows exponentially', 'B) It remains constant', 'C) It decays', 'D) It becomes negative', 'C) It decays', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:31:17'),
(177, 5, 'Which of the following represents exponential decay?', '1', 'A) f(x) = -2^x', 'B) f(x) = e^x', 'C) f(x) = 3^x', 'D) f(x) = (1/2)^x', 'D) f(x) = (1/2)^x', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(178, 5, 'What is the base of the exponential function f(x) = e^x?', '1', 'A) e', 'B) x', 'C) 1', 'D) The exponent', 'A) e', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(179, 5, 'Which of the following is true about exponential decay?', '1', 'A) The function approaches infinity as x increases', 'B) The function approaches zero as x increases', 'C) The function approaches a negative value as x increases', 'D) The function remains constant as x increases', 'B) The function approaches zero as x increases', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(180, 5, 'What is the half-life of a substance?', '1', 'A) The time it takes for the substance to decay completely', 'B) The time it takes for the substance to lose half its mass or activity', 'C) The time it takes for the substance to double its mass or activity', 'D) The time it takes for the substance to reach equilibrium', 'B) The time it takes for the substance to lose half its mass or activity', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(181, 5, 'What is the future value after time t in compound interest calculated using the formula A = P(1 + r)^t?', '1', 'A) The initial principal (P)', 'B) The interest rate (r)', 'C) The time (t)', 'D) The future amount (A)', 'D) The future amount (A)', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(182, 5, 'Which of the following is an application of exponential functions in finance?', '1', 'A) Modeling linear growth of investments', 'B) Modeling quadratic growth of investments', 'C) Modeling compound interest', 'D) Modeling constant growth of investments', 'C) Modeling compound interest', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(183, 5, 'What does the base (a) determine in an exponential function?', '1', 'A) The slope', 'B) The exponent', 'C) The input value', 'D) The rate of growth or decay', 'D) The rate of growth or decay', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:31:21'),
(184, 5, 'Which of the following is an example of exponential growth?', '1', 'A) Bacterial population decreasing by 10% every hour', 'B) Investment increasing by 5% every year', 'C) Radioactive substance decaying by 50% every day', 'D) Population doubling every 30 years', 'D) Population doubling every 30 years', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(185, 5, 'What is the future value after time t in compound interest calculated using the formula A = P(1 + r)^t?', '1', 'A) The initial principal (P)', 'B) The interest rate (r)', 'C) The time (t)', 'D) The future amount (A)', 'D) The future amount (A)', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(186, 5, 'Which of the following represents a real-world scenario best modeled by an exponential function?', '1', 'A) The temperature of a cooling cup of coffee', 'B) The height of a bouncing ball', 'C) The growth of a bacterial population', 'D) The speed of a car', 'C) The growth of a bacterial population', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(187, 5, 'What is the inverse operation of exponential decay?', '1', 'A) Addition', 'B) Subtraction', 'C) Multiplication', 'D) Division', 'D) Division', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(188, 5, 'Which of the following represents an exponential function?', '1', 'A) f(x) = x + 2', 'B) f(x) = 3x^2', 'C) f(x) = e^(2x)', 'D) f(x) = log(x)', 'C) f(x) = e^(2x)', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(189, 5, 'In the function f(x) = 2^x, what does the exponent x represent?', '1', 'A) The base', 'B) The rate of growth', 'C) The input value', 'D) The exponent', 'C) The input value', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(190, 5, 'What is the base of the exponential function f(x) = 10^x?', '1', 'A) 10', 'B) x', 'C) 1', 'D) The exponent', 'A) 10', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(191, 5, 'What happens to an exponential function when the base (a) is between 0 and 1?', '1', 'A) It grows exponentially', 'B) It remains constant', 'C) It decays', 'D) It becomes negative', 'C) It decays', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:31:28'),
(192, 5, 'Which of the following represents exponential decay?', '1', 'A) f(x) = -2^x', 'B) f(x) = e^x', 'C) f(x) = 3^x', 'D) f(x) = (1/2)^x', 'D) f(x) = (1/2)^x', NULL, 1, '2024-02-25 09:29:29', '2024-02-25 09:29:29'),
(193, 6, 'What is the formula for calculating simple interest?', '2', 'A) P × r × t', 'B) P × (1 + r × t)', 'C) P × r', 'D) P × r × (1 + t)', 'C) P × r', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(194, 6, 'In simple interest, what does (P) represent?', '1', 'A) The principal amount', 'B) The interest rate', 'C) The time period', 'D) The total amount', 'A) The principal amount', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(195, 6, 'Which of the following statements about simple interest is true?', '2', 'A) The interest earned increases exponentially over time', 'B) The interest earned remains constant over time', 'C) The interest rate changes periodically', 'D) The interest earned decreases with time', 'B) The interest earned remains constant over time', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(196, 6, 'If you deposit $1000 at an annual interest rate of 8%, how much simple interest will you earn in 2 years?', '3', 'A) $80', 'B) $160', 'C) $180', 'D) $200', 'D) $200', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(197, 6, 'What is the formula for compound interest?', '2', 'A) P × r × t', 'B) P × (1 + r × t)', 'C) P × r', 'D) P × (1 + r)^t', 'D) P × (1 + r)^t', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(198, 6, 'In compound interest, what does (r) represent?', '1', 'A) The principal amount', 'B) The interest rate', 'C) The time period', 'D) The total amount', 'B) The interest rate', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(199, 6, 'Which of the following statements about compound interest is true?', '2', 'A) The interest earned remains constant over time', 'B) The interest earned decreases with time', 'C) The interest earned increases linearly over time', 'D) The interest earned increases exponentially over time', 'D) The interest earned increases exponentially over time', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(200, 6, 'If you invest $500 at an annual interest rate of 6% compounded annually, what is the balance after 3 years?', '3', 'A) $575', 'B) $598', 'C) $615', 'D) $632', 'D) $632', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(201, 6, 'Which of the following represents a scenario best suited for simple interest?', '1', 'A) Saving for retirement', 'B) Taking out a mortgage', 'C) Investing in a mutual fund', 'D) Borrowing money for a short-term project', 'D) Borrowing money for a short-term project', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(202, 6, 'Which of the following represents a scenario best suited for compound interest?', '2', 'A) Saving for a vacation next month', 'B) Borrowing money for a short-term project', 'C) Investing in a certificate of deposit for 10 years', 'D) Taking out a payday loan', 'C) Investing in a certificate of deposit for 10 years', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(203, 6, 'What is the main difference between simple and compound interest?', '2', 'A) Simple interest is calculated annually, while compound interest is calculated quarterly', 'B) Simple interest includes interest on interest, while compound interest does not', 'C) Simple interest grows exponentially, while compound interest remains constant', 'D) Compound interest includes interest on interest, while simple interest does not', 'D) Compound interest includes interest on interest, while simple interest does not', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(204, 6, 'Which of the following statements about compound interest is true?', '1', 'A) The interest earned remains constant over time', 'B) The interest rate changes periodically', 'C) The interest earned increases with time', 'D) The interest earned decreases with time', 'C) The interest earned increases with time', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(205, 6, 'If you borrow $2000 at an annual interest rate of 10% compounded quarterly, what is the balance after 2 years?', '2', 'A) $2420', 'B) $2440', 'C) $2460', 'D) $2480', 'D) $2480', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(206, 6, 'What is the advantage of compound interest over simple interest for long-term investments?', '1', 'A) Compound interest offers higher interest rates', 'B) Compound interest does not involve interest on interest', 'C) Compound interest allows your money to grow exponentially', 'D) Compound interest is simpler to calculate', 'C) Compound interest allows your money to grow exponentially', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(207, 6, 'What is the disadvantage of compound interest compared to simple interest for short-term investments?', '1', 'A) Compound interest offers lower interest rates', 'B) Compound interest involves interest on interest', 'C) Compound interest requires a longer investment horizon', 'D) Compound interest is more volatile', 'B) Compound interest involves interest on interest', NULL, 1, '2024-02-25 09:35:07', '2024-02-25 09:35:07'),
(208, 7, 'What defines a valid argument?', '3', 'A) The conclusion follows from the premises', 'B) The conclusion is supported by evidence', 'C) The conclusion is popularly accepted', 'D) The conclusion is emotionally appealing', 'A) The conclusion follows from the premises', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(209, 7, 'Which of the following is an example of the post hoc fallacy?', '2', 'A) (Many successful investors own this stock, so it must be a good investment.)', 'B) (Every time Ive invested in gold, the stock market has gone down.)', 'C) (If we lower taxes, the economy will grow.)', 'D) (This product is endorsed by a famous celebrity.)', 'B) (Every time Ive invested in gold, the stock market has gone down.)', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(210, 7, 'What fallacy is committed in the argument: (If we ban plastic bags, soon we will ban all types of packaging, and then people won’t be able to buy groceries.)', '1', 'A) Appeal to authority', 'B) Post hoc fallacy', 'C) Slippery slope', 'D) Circular reasoning', 'C) Slippery slope', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(211, 7, 'What type of reasoning draws a specific conclusion from general principles?', '2', 'A) Inductive reasoning', 'B) Deductive reasoning', 'C) Abductive reasoning', 'D) Analogical reasoning', 'B) Deductive reasoning', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(212, 7, 'If all luxury cars are expensive, and this car is a luxury car, what can we deduce about its price?', '2', 'A) It is definitely the most expensive car on the market.', 'B) It is likely to be expensive, but we need more information to confirm.', 'C) It must be cheap because it is a luxury car.', 'D) Its price cannot be determined.', 'B) It is likely to be expensive, but we need more information to confirm.', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(213, 7, 'Which type of reasoning uses specific observations to form a general conclusion?', '1', 'A) Deductive reasoning', 'B) Inductive reasoning', 'C) Abductive reasoning', 'D) Analogical reasoning', 'B) Inductive reasoning', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(214, 7, 'When evaluating investment recommendations, what should you scrutinize?', '1', 'A) The appearance of the advisor', 'B) The reputation of the advisor', 'C) The reasoning behind the advice', 'D) The advisors age', 'C) The reasoning behind the advice', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(215, 7, 'What is the primary advantage of applying logic in finance?', '3', 'A) It guarantees profitable investments', 'B) It eliminates all risks', 'C) It enables making more objective decisions', 'D) It increases emotional biases', 'C) It enables making more objective decisions', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(216, 7, 'How does logic empower individuals in making financial decisions?', '1', 'A) By increasing emotional biases', 'B) By eliminating all risks', 'C) By reducing critical thinking skills', 'D) By providing a rational framework for decision-making', 'D) By providing a rational framework for decision-making', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(217, 7, 'What is a potential drawback of relying solely on emotional instincts in financial decisions?', '2', 'A) It increases the likelihood of making informed choices', 'B) It can lead to cognitive biases and irrational decisions', 'C) It ensures objective analysis of investment options', 'D) It minimizes the impact of logical fallacies', 'B) It can lead to cognitive biases and irrational decisions', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(218, 7, 'Which of the following strategies can help mitigate the impact of cognitive biases in financial decisions?', '2', 'A) Ignoring contradictory evidence', 'B) Being aware of common biases and actively seeking to counteract them', 'C) Making impulsive decisions based on emotions', 'D) Relying solely on intuition', 'B) Being aware of common biases and actively seeking to counteract them', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(219, 7, 'What is the role of logic in evaluating financial news?', '1', 'A) To reinforce emotional biases', 'B) To validate unsubstantiated claims', 'C) To critically analyze claims and assess their logical coherence', 'D) To accept claims at face value', 'C) To critically analyze claims and assess their logical coherence', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(220, 7, 'Which of the following statements about logical reasoning in finance is true?', '2', 'A) It encourages impulsive decision-making', 'B) It provides a systematic approach to evaluate evidence and make decisions', 'C) It limits the ability to analyze complex financial information', 'D) It increases susceptibility to cognitive biases', 'B) It provides a systematic approach to evaluate evidence and make decisions', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(221, 7, 'How can understanding logical fallacies benefit individuals in financial decision-making?', '1', 'A) By encouraging reliance on emotional instincts', 'B) By increasing the likelihood of making impulsive decisions', 'C) By enabling recognition of flawed arguments and avoiding unsound conclusions', 'D) By minimizing critical thinking skills', 'C) By enabling recognition of flawed arguments and avoiding unsound conclusions', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(222, 7, 'What is the primary purpose of logic in financial decision-making?', '2', 'A) To encourage reliance on emotional biases', 'B) To provide a rational framework for evaluating evidence and making informed choices', 'C) To eliminate all risks associated with investments', 'D) To disregard contradictory evidence', 'B) To provide a rational framework for evaluating evidence and making informed choices', NULL, 1, '2024-02-25 09:37:32', '2024-02-25 09:37:32'),
(436, 8, 'What is the solution to the equation 2x + 5 = 15?', '1', 'A) x = 10', 'B) x = 5', 'C) x = 7', 'D) x = 6', 'A) x = 10', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(437, 8, 'Solve for x: 3(x + 2) = 21', '1', 'A) x = 5', 'B) x = 7', 'C) x = 3', 'D) x = 6', 'A) x = 5', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(438, 8, 'What is the value of 5^2?', '1', 'A) 10', 'B) 25', 'C) 30', 'D) 20', 'B) 25', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(439, 8, 'If f(x) = 3x + 2, what is the value of f(4)?', '1', 'A) 10', 'B) 14', 'C) 12', 'D) 11', 'B) 14', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(440, 8, 'If g(x) = x^2 + 4x - 5, find g(3)', '1', 'A) 10', 'B) 18', 'C) 14', 'D) 15', 'D) 15', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(441, 8, 'What is the slope of the line passing through the points (2, 5) and (4, 9)?', '1', 'A) 2', 'B) 3', 'C) 4', 'D) 1', 'B) 3', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(442, 8, 'Solve for x: 2x - 3 = 9', '1', 'A) x = 3', 'B) x = 6', 'C) x = 8', 'D) x = 6', 'B) x = 6', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(443, 8, 'What is the value of log(100)?', '1', 'A) 1', 'B) 10', 'C) 100', 'D) 2', 'B) 10', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(444, 8, 'What is the solution to the equation 3x - 7 = 8?', '1', 'A) x = 5', 'B) x = 3', 'C) x = 6', 'D) x = 9', 'D) x = 9', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(445, 8, 'If h(x) = 2x^2 - 5x + 3, find h(2)', '1', 'A) 1', 'B) 0', 'C) 3', 'D) 5', 'C) 3', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(446, 8, 'What is the value of 4! (factorial)?', '1', 'A) 24', 'B) 120', 'C) 12', 'D) 6', 'B) 120', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(447, 8, 'Solve for x: x/4 = 5', '1', 'A) x = 20', 'B) x = 25', 'C) x = 10', 'D) x = 15', 'B) x = 25', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(448, 8, 'If f(x) = x^2 - 3x + 2, what is the value of f(2)?', '1', 'A) 2', 'B) 4', 'C) 6', 'D) 8', 'A) 2', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(449, 8, 'What is the value of 7^2?', '1', 'A) 14', 'B) 21', 'C) 49', 'D) 35', 'C) 49', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(450, 8, 'If g(x) = 2x - 5, find g(4)', '1', 'A) 3', 'B) 5', 'C) 6', 'D) 3', 'C) 3', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(451, 8, 'What is the slope of the line passing through the points (-1, 3) and (2, 9)?', '1', 'A) 2', 'B) 3', 'C) 4', 'D) 1', 'B) 3', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(452, 8, 'Solve for x: 3x + 2 = 14', '1', 'A) x = 3', 'B) x = 4', 'C) x = 5', 'D) x = 6', 'C) x = 4', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(453, 8, 'What is the value of log(1000)?', '1', 'A) 1', 'B) 10', 'C) 100', 'D) 2', 'B) 10', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(454, 8, 'What is the solution to the equation 4x - 9 = 15?', '1', 'A) x = 3', 'B) x = 6', 'C) x = 7', 'D) x = 9', 'C) x = 6', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35');
INSERT INTO `tbl_questions` (`Id`, `Activity_Id`, `Question`, `Points`, `Option1`, `Option2`, `Option3`, `Option4`, `Answer`, `Image`, `IsActive`, `CreatedAt`, `UpdatedAt`) VALUES
(455, 8, 'If h(x) = x^2 + 3x - 2, find h(3)', '1', 'A) 6', 'B) 12', 'C) 10', 'D) 16', 'D) 16', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(456, 8, 'What is the value of 5! (factorial)?', '1', 'A) 20', 'B) 120', 'C) 180', 'D) 720', 'D) 720', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(457, 8, 'Solve for x: 3x = 15', '1', 'A) x = 3', 'B) x = 5', 'C) x = 10', 'D) x = 15', 'B) x = 5', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(458, 8, 'If f(x) = x^2 + 3x - 2, what is the value of f(3)?', '1', 'A) 8', 'B) 12', 'C) 16', 'D) 18', 'D) 18', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(459, 8, 'What is the value of 6^2?', '1', 'A) 12', 'B) 36', 'C) 42', 'D) 48', 'B) 36', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(460, 8, 'If g(x) = x^2 + 4x - 6, find g(2)', '1', 'A) 12', 'B) 14', 'C) 16', 'D) 18', 'B) 14', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(461, 8, 'What is the slope of the line passing through the points (3, 5) and (5, 11)?', '1', 'A) 2', 'B) 3', 'C) 4', 'D) 1', 'B) 3', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(462, 8, 'Solve for x: 4x - 7 = 17', '1', 'A) x = 3', 'B) x = 6', 'C) x = 8', 'D) x = 6', 'D) x = 6', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(463, 8, 'What is the value of log(10000)?', '1', 'A) 1', 'B) 10', 'C) 100', 'D) 1000', 'B) 10', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(464, 8, 'What is the solution to the equation 3x + 5 = 20?', '1', 'A) x = 5', 'B) x = 6', 'C) x = 7', 'D) x = 8', 'C) x = 5', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(465, 8, 'If h(x) = 2x^2 + 3x - 1, find h(3)', '1', 'A) 20', 'B) 24', 'C) 26', 'D) 28', 'C) 26', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(466, 8, 'What is the value of 7! (factorial)?', '1', 'A) 42', 'B) 5040', 'C) 720', 'D) 120', 'B) 5040', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(467, 8, 'Solve for x: 5x = 25', '1', 'A) x = 3', 'B) x = 5', 'C) x = 10', 'D) x = 15', 'B) x = 5', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(468, 8, 'If f(x) = 2x^2 - x + 3, what is the value of f(2)?', '1', 'A) 9', 'B) 10', 'C) 11', 'D) 12', 'A) 9', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(469, 8, 'What is the definition of a function?', '1', 'A) A relationship between two variables', 'B) A mathematical operation', 'C) A set of ordered pairs with distinct first elements', 'D) A set of ordered pairs with distinct second elements', 'A) A relationship between two variables', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(470, 8, 'In the function f(x) = 2x + 3, what does the number 2 represent?', '1', 'A) The output value', 'B) The exponent', 'C) The constant term', 'D) The coefficient of x', 'D) The coefficient of x', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(471, 8, 'Which of the following represents a rational function?', '1', 'A) f(x) = x^2 + 1', 'B) g(x) = 1/x', 'C) h(x) = √x', 'D) k(x) = |x|', 'B) g(x) = 1/x', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(472, 8, 'What is the restriction on the domain of a rational function?', '1', 'A) The domain cannot be negative', 'B) The domain cannot be zero', 'C) The domain cannot include irrational numbers', 'D) The domain cannot make the denominator zero', 'D) The domain cannot make the denominator zero', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(473, 8, 'What is the inverse of the function f(x) = 3x + 2?', '1', 'A) f^-1(x) = (x - 2)/3', 'B) f^-1(x) = (x + 2)/3', 'C) f^-1(x) = 2x - 3', 'D) f^-1(x) = 3x - 2', 'A) f^-1(x) = (x - 2)/3', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(474, 8, 'Which of the following is an example of an exponential function?', '1', 'A) f(x) = x^2', 'B) g(x) = √x', 'C) h(x) = 2^x', 'D) k(x) = |x|', 'C) h(x) = 2^x', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(475, 8, 'What does the base of an exponential function determine?', '1', 'A) The y-intercept', 'B) The rate of growth or decay', 'C) The exponent', 'D) The coefficient of x', 'B) The rate of growth or decay', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(476, 8, 'What is the inverse function of f(x) = 10^x?', '1', 'A) f^-1(x) = log(x)', 'B) f^-1(x) = ln(x)', 'C) f^-1(x) = 10^x', 'D) f^-1(x) = log10(x)', 'D) f^-1(x) = log10(x)', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(477, 8, 'What is the definition of compound interest?', '1', 'A) Interest calculated only on the principal amount', 'B) Interest calculated on both the principal amount and the accumulated interest', 'C) Interest calculated at a fixed rate', 'D) Interest calculated annually', 'B) Interest calculated on both the principal amount and the accumulated interest', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(478, 8, 'Which fallacy occurs when one assumes that because Event A occurred before Event B, Event A caused Event B?', '1', 'A) Post hoc fallacy', 'B) Appeal to authority fallacy', 'C) Slippery slope fallacy', 'D) Circular reasoning fallacy', 'A) Post hoc fallacy', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(479, 8, 'What type of reasoning draws a specific conclusion from general principles?', '1', 'A) Inductive reasoning', 'B) Deductive reasoning', 'C) Abductive reasoning', 'D) Analogical reasoning', 'B) Deductive reasoning', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(480, 8, 'In financial decision-making, what does logic help individuals to do?', '1', 'A) Rely solely on emotional instincts', 'B) Make impulsive decisions', 'C) Make more objective choices', 'D) Ignore contradictory evidence', 'C) Make more objective choices', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(481, 8, 'What is the primary purpose of logic in financial decision-making?', '1', 'A) To encourage emotional biases', 'B) To provide a rational framework for evaluating evidence', 'C) To eliminate all risks associated with investments', 'D) To disregard contradictory evidence', 'B) To provide a rational framework for evaluating evidence', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(482, 8, 'How can understanding logical fallacies benefit individuals in financial decision-making?', '1', 'A) By encouraging reliance on emotional instincts', 'B) By enabling recognition of flawed arguments and avoiding unsound conclusions', 'C) By minimizing critical thinking skills', 'D) By promoting impulsive decisions', 'B) By enabling recognition of flawed arguments and avoiding unsound conclusions', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(483, 8, 'What is the restriction on the domain of a rational function?', '1', 'A) The domain cannot be negative', 'B) The domain cannot be zero', 'C) The domain cannot include irrational numbers', 'D) The domain cannot make the denominator zero', 'D) The domain cannot make the denominator zero', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(484, 8, 'What does the term (inverse) refer to in the context of functions?', '1', 'A) Reversing the order of operations', 'B) Reversing the input and output values of a function', 'C) Multiplying the output by the input', 'D) Taking the square root of the input', 'B) Reversing the input and output values of a function', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:52'),
(485, 8, 'What is the base of an exponential function?', '1', 'A) The y-intercept', 'B) The rate of growth or decay', 'C) The exponent', 'D) The coefficient of x', 'B) The rate of growth or decay', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(486, 8, 'What is the primary purpose of understanding logical fallacies in financial decision-making?', '1', 'A) To increase reliance on anecdotal evidence', 'B) To identify flawed arguments and avoid unsound conclusions', 'C) To minimize critical thinking skills', 'D) To encourage impulsive decisions', 'B) To identify flawed arguments and avoid unsound conclusions', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(487, 8, 'What type of reasoning draws a general conclusion from specific observations?', '1', 'A) Deductive reasoning', 'B) Inductive reasoning', 'C) Abductive reasoning', 'D) Analogical reasoning', 'B) Inductive reasoning', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(488, 8, 'What is the base of an exponential function?', '1', 'A) The y-intercept', 'B) The rate of growth or decay', 'C) The exponent', 'D) The coefficient of x', 'B) The rate of growth or decay', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(489, 8, 'What does the term (rational) mean in the context of rational functions?', '1', 'A) Logical', 'B) Fractional', 'C) Irrational', 'D) Exponential', 'B) Fractional', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:57'),
(490, 8, 'What is the restriction on the domain of a rational function?', '1', 'A) The domain cannot be negative', 'B) The domain cannot be zero', 'C) The domain cannot include irrational numbers', 'D) The domain cannot make the denominator zero', 'D) The domain cannot make the denominator zero', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(491, 8, 'What does the term (inverse) refer to in the context of functions?', '1', 'A) Reversing the order of operations', 'B) Reversing the input and output values of a function', 'C) Multiplying the output by the input', 'D) Taking the square root of the input', 'B) Reversing the input and output values of a function', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:04:04'),
(492, 8, 'What is the base of an exponential function?', '1', 'A) The y-intercept', 'B) The rate of growth or decay', 'C) The exponent', 'D) The coefficient of x', 'B) The rate of growth or decay', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(493, 8, 'What is the value of 3^3?', '1', 'A) 6', 'B) 9', 'C) 12', 'D) 27', 'D) 27', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(494, 8, 'If g(x) = 3x - 2, find g(5)', '1', 'A) 13', 'B) 14', 'C) 15', 'D) 16', 'C) 15', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35'),
(495, 8, 'What is the slope of the line passing through the points (0, 2) and (4, 10)?', '1', 'A) 2', 'B) 3', 'C) 4', 'D) 5', 'B) 3', NULL, 1, '2024-02-25 10:03:35', '2024-02-25 10:03:35');

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
-- Indexes for dumped tables
--

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_chapter`
--
ALTER TABLE `tbl_chapter`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_lessons`
--
ALTER TABLE `tbl_lessons`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;

--
-- AUTO_INCREMENT for table `tbl_results`
--
ALTER TABLE `tbl_results`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

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
