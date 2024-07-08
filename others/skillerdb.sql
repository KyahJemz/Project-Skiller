
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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
  `Disabled` tinyint(1) NOT NULL DEFAULT 0,
  `IsApproved` tinyint(1) NOT NULL DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Date` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`Id`, `Email`, `Image`, `FirstName`, `MiddleName`, `LastName`, `Role`, `Disabled`, `IsApproved`, `CreatedAt`, `UpdatedAt`, `Date`) VALUES
(1, 'administrator@gmail.com', NULL, NULL, NULL, NULL, 'Administrator', 0, 1, '2024-02-11 09:57:25', '2024-07-08 13:51:21', '2024-07-08 15:46:25'),
(11, 'completed.student@gmail.com', NULL, NULL, NULL, NULL, 'Student', 0, 1, '2024-05-02 15:19:56', '2024-07-08 13:51:18', '2024-07-08 15:48:21');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_certificates`
--

CREATE TABLE `tbl_certificates` (
  `Id` int(11) NOT NULL,
  `Account_Id` int(11) NOT NULL,
  `Course_Id` int(11) NOT NULL,
  `Path` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chapter`
--

CREATE TABLE `tbl_chapter` (
  `Id` int(11) NOT NULL,
  `Course_Id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Codes` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_chapter`
--

INSERT INTO `tbl_chapter` (`Id`, `Course_Id`, `Title`, `Codes`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 1, 'Introduction to Functions', 'M11GM-Ia-1, M11GM-Ia-2, M11GM-Ia-3, M11GM-Ia-4', '2024-01-21 11:29:35', '2024-03-30 06:01:20'),
(2, 1, 'Rational Functions and Equations', 'M11GM-Ib-1, M11GM-Ib-2, M11GM-Ib-3, M11GM-Ib-4, M11GM-Ib-5, M11GM-Ic-1, M11GM-Ic-2, M11GM-Ic-3', '2024-01-21 11:29:35', '2024-03-30 06:01:24'),
(3, 1, 'Inverse Functions', 'M11GM-Id-1, M11GM-Id-2, M11GM-Id-3, M11GM-Id-4, M11GM-Ie-1, M11GM-Ie-2', '2024-01-21 11:29:35', '2024-03-30 06:01:22'),
(4, 1, 'Exponential Functions and Logarithmic Functions', 'M11GM-Ie-3, M11GM-Ie-4, M11GM-Ie-5, M11GM-If-1, M11GM-If-2, M11GM-If-3, M11GM-If-4, M11GM-Ig-1, M11GM-Ig-2, M11GM-Ih-1, M11GM-Ih-2, M11GM-Ih-3, M11GM-Ih-i-1, M11GM-Ii-2, M11GM-Ii-3, M11GM-Ii-4, M11GM-Ij-1, M11GM-Ij-2', '2024-01-21 11:29:35', '2024-05-02 18:09:39'),
(5, 1, 'Financial Mathematics, Propositions, and Logic', 'M11GM-IIa-1, M11GM-IIa-2, M11GM-IIa-b-1, M11GM-IIb-2, M11GM-IIc-1, M11GM-IIc-2, M11GM-IIc-d-1, M11GM-IId-2, M11GM-IId-3, M11GM-IIe-1, M11GM-IIe-2, M11GM-IIe-3, M11GM-IIe-4, M11GM-IIe-5, M11GM-IIf-1, M11GM-IIf-2, M11GM-IIf-3, M11GM-IIg-1, M11GM-IIg-2, M11GM-IIg-3, M11GM-IIg-4, M11GM-IIh-1, M11GM-IIh-2, M11GM-IIi-1, M11GM-IIi-2, M11GM-IIi-3, M11GM-IIj-1, M11GM-IIj-2', '2024-01-21 11:29:35', '2024-03-30 06:01:27'),
(6, 1, 'Final Examination', 'All Lessons', '2024-02-23 06:54:00', '2024-03-30 06:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

CREATE TABLE `tbl_courses` (
  `Id` int(11) NOT NULL,
  `CourseName` text NOT NULL,
  `CourseDescription` text DEFAULT NULL,
  `CourseImage` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`Id`, `CourseName`, `CourseDescription`, `CourseImage`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'General Mathematics', 'General math: Unveiling the language of numbers and shapes for everyday use.', './images/uploads/OIP.jpg', '2024-05-02 15:24:11', '2024-05-02 15:28:46'),
(2, 'Course 2', '', '', '2024-05-02 15:32:57', '2024-05-02 15:32:57');

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
  `LastAttempt` timestamp NOT NULL DEFAULT current_timestamp(),
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, 'Real-world Applications of Functions', 1, 'The primary objective of this lesson is to enable students to recognize and formulate mathematical functions that effectively describe and predict real-world phenomena. By the end of the session, students should not only comprehend the theoretical foundations of functions but also develop the skills to apply these concepts in solving tangible problems beyond the classroom setting. This lesson serves as a foundation for appreciating the practical significance of functions and their role in addressing complex, dynamic scenarios in various fields.', 'The lesson on &#34;Real-world Applications of Functions&#34; is designed to bridge the gap between abstract mathematical concepts and their practical utility in addressing real-life scenarios. Students explore the versatile nature of functions as powerful tools for representing relationships between different quantities in a variety of contexts. Through concrete examples and case studies, the lesson provides a hands-on understanding of how functions can accurately model dynamic systems, offering valuable insights into the complexities of the real world.', '', 'https://www.youtube-nocookie.com/embed/tAoe4xjUZQk?si=5NVt0aQh78ys47NP', 'Introduction to Functions: Making the World Work\r\n\r\nImagine a world without functions. Recipes wouldn&#39;t work, music wouldn&#39;t play, and even basic tasks like calculating the cost of groceries would become incredibly complex. Functions are the hidden language that powers the world around us, and understanding them unlocks a deeper appreciation for the way things work.\r\n\r\n\r\nSo, what exactly is a function?\r\n\r\nThink of a function as a machine that takes in an input, performs an operation on it, and produces an output. This input is often called the argument or domain, while the output is known as the range. For example, a function that doubles any number would take a number as input (argument), multiply it by two (operation), and give you the answer (output).\r\n\r\n\r\nReal-world examples of functions are everywhere:\r\n\r\n- Cooking: A recipe is essentially a function. You follow the instructions (inputs) and get a delicious dish (output). The amount of each ingredient is an input, and the cooking process is the operation that transforms those inputs into the final dish.\r\n\r\n- Music: Every musical note can be represented by a function. The pitch of the note is determined by the frequency of the sound wave, which can be expressed as a mathematical function. Playing a specific note on an instrument is like feeding an input into the function, and the resulting sound is the output.\r\n\r\n- Economics: Supply and demand curves are perfect examples of functions. The price of a good or service (output) is determined by the quantity supplied and demanded (inputs). These relationships can be modeled using mathematical functions, allowing economists to predict market behavior.\r\n\r\n- GPS Navigation: When you enter a destination into your GPS, it uses a complex set of functions to calculate the route. Your starting location and desired destination are the inputs, and the navigation system applies various algorithms (functions) to determine the optimal route, providing you with turn-by-turn instructions (output).\r\nThese are just a few examples, and the list goes on! From physics and engineering to computer science and finance, functions are fundamental building blocks that help us understand, analyze, and solve problems in countless ways.\r\n\r\n\r\nBy understanding functions, you gain a powerful tool to:\r\n\r\n- Model real-world phenomena: Functions provide a framework for expressing relationships between different variables, allowing us to create simulations and make predictions.\r\n\r\n- Simplify complex tasks: Breaking down problems into smaller, well-defined functions makes them easier to solve and analyze.\r\n\r\n- Develop problem-solving skills: The ability to think in terms of functions is essential for various fields, from engineering to data science.\r\n\r\n\r\nSo, the next time you listen to music, cook a meal, or use your GPS, remember the invisible functions working behind the scenes, making the world a more predictable and manageable place.', '2024-01-21 11:30:43', '2024-02-25 00:22:29'),
(2, 'Mastering Function Evaluation', 1, 'The primary objective of this lesson is to equip students with the necessary skills to confidently evaluate a variety of functions for specific inputs. By mastering function evaluation, students will not only enhance their computational abilities but also develop a deeper understanding of the dynamic nature of functions. This skill is crucial for navigating more complex mathematical concepts and problem-solving scenarios that involve the manipulation and analysis of functions in practical applications.', 'The lesson on &#34;Mastering Function Evaluation&#34; focuses on honing students&#39; proficiency in evaluating functions, a fundamental skill in understanding mathematical relationships. Students delve into the process of substituting specific values into functions and calculating the corresponding outputs. The lesson emphasizes the importance of this skill in comprehending how functions behave and respond to different inputs. Through a series of examples and exercises, students gain confidence in manipulating functions and interpreting the results of their evaluations, laying a solid foundation for more advanced concepts in the study of functions.', '', 'https://www.youtube-nocookie.com/embed/lGfsp2CWjok?si=1KVD3uGlFDeRQI9i', 'Introduction to Functions: Mastering Function Evaluation\r\n\r\nFunction evaluation is the process of determining the output of a function for a specific input value. It&#39;s like plugging a number into a machine and getting the answer out. Here&#39;s a breakdown to help you master this essential concept:\r\n\r\n\r\nUnderstanding the Notation:\r\n\r\nFunction Notation: We use the letter f(x) to represent a function named &#34;f&#34; that takes an input &#34;x&#34;. The input is placed inside the parentheses.\r\nExample: f(x) = 2x + 3\r\n\r\n\r\nEvaluating the Function:\r\n\r\nSubstitute the input value: Replace &#34;x&#34; in the function&#39;s formula with the given input value.\r\nPerform the calculation: Apply the operations according to the order of operations (PEMDAS: Parentheses, Exponents, Multiplication and Division from left to right, Addition and Subtraction from left to right).\r\nThe result is the output: The answer you get after performing the calculation is the function&#39;s output for that specific input.\r\n\r\nExample:\r\n\r\nLet&#39;s evaluate the function f(x) = 2x + 3 for the input x = 5:\r\nSubstitute x = 5: f(5) = 2(5) + 3\r\nPerform the calculation: f(5) = 10 + 3\r\nOutput: f(5) = 13\r\nTherefore, when x = 5, the function f(x) outputs 13.\r\n\r\n\r\nPractice Makes Perfect:\r\n\r\nTry evaluating functions with different inputs to solidify your understanding. Here are some examples:\r\nf(x) = x^2 - 4, evaluate for x = 2\r\ng(t) = 3t - 1, evaluate for t = -1\r\nh(y) = y/(y-2), evaluate for y = 3\r\n\r\n\r\nRemember, function evaluation is a fundamental skill in mathematics. By mastering it, you&#39;ll be able to solve various problems and applications involving functions.', '2024-01-21 11:30:43', '2024-02-25 00:24:58'),
(3, 'Basic Operations and Function Compositions', 1, 'The primary objective of this lesson is to empower students with the skills to perform basic operations on functions and compose multiple functions. By mastering these fundamental operations, students develop a deeper understanding of how functions interact and transform, laying the groundwork for more complex mathematical concepts. The lesson aims to foster both algebraic and graphical proficiency, ensuring that students can navigate various scenarios involving the manipulation and combination of functions with confidence.', 'The lesson on \"Basic Operations and Function Compositions\" delves into the fundamental operations that can be performed on functions and the concept of composing multiple functions. Students explore how to combine, add, subtract, multiply, and divide functions, understanding the impact of these operations on the overall behavior of the composite function. Emphasis is placed on developing a systematic approach to performing these operations and interpreting the results in both algebraic and graphical terms. Through examples and interactive exercises, students gain a solid grasp of manipulating functions, setting the stage for more advanced studies in function theory and analysis.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(4, 'Problems in the Realm of Functions', 1, 'The primary objective of this lesson is to develop students problem-solving skills within the context of functions. By tackling a range of problems, students learn to apply function concepts to real-world scenarios, fostering a deeper appreciation for the practical utility of mathematical functions. The lesson aims to cultivate analytical thinking, encouraging students to approach problem-solving with a systematic and mathematically informed mindset.', 'The lesson on \"Problems in the Realm of Functions\" is geared towards applying the knowledge of functions to solve real-world problems and mathematical challenges. Students engage in problem-solving exercises that require them to leverage their understanding of functions to analyze, model, and address practical scenarios. This lesson aims to sharpen students critical thinking and analytical skills by presenting them with a variety of problems that can be effectively tackled using the concepts learned in previous sessions. Through guided problem-solving and interactive discussions, students gain confidence in their ability to apply function theory to diverse problem domains.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(5, 'Representing Scenarios with Rational Functions', 2, 'The primary objective of this lesson is to equip students with the skills to recognize and utilize rational functions as powerful tools for representing real-world scenarios. By the end of the session, students should be adept at identifying situations where rational functions are applicable and be able to formulate these functions accurately. This lesson sets the stage for further exploration into the nuances of rational functions and their applications in various fields.', 'The lesson on &#34;Representing Scenarios with Rational Functions&#34; immerses students in the practical application of rational functions to model and represent real-world scenarios. Students explore the versatile nature of rational functions, understanding how they can accurately describe relationships in various contexts. The lesson introduces scenarios where ratios, proportions, and dynamic relationships can be effectively modeled using rational functions. Through examples and hands-on activities, students gain insight into selecting and formulating rational functions that best represent specific situations, laying the groundwork for a deeper understanding of this important class of functions.', '', 'https://www.youtube-nocookie.com/embed/1fR_9ke5-n8?si=Za2sh-b2LAY6_XdS', 'Rational Functions and Equations: Modeling the World with Ratios\r\n\r\nRational functions, a powerful tool in mathematics, allow us to represent real-world scenarios involving rates, proportions, and ratios. They are expressed as the quotient of two polynomial functions, where the denominator cannot be zero.\r\n\r\n\r\nUnderstanding Rational Functions:\r\n\r\n- A rational function is written as f(x) = p(x) / q(x), where p(x) and q(x) are polynomial functions and q(x) ≠ 0.\r\n\r\n- The numerator, p(x), represents the expression being divided.\r\n\r\n- The denominator, q(x), represents the divisor and cannot contain the value that makes it zero (restrictions on the domain).\r\n\r\n\r\nRepresenting Scenarios:\r\n\r\n- Rates: Imagine a car traveling at a constant speed of 60 miles per hour. The distance traveled (d) can be related to time (t) by the rational function d(t) = 60t / 1, where 60 represents the rate (speed) and t is the input (time).\r\n\r\n- Proportions: Mixing paints of different colors is a common example. To achieve a desired shade (output), you mix specific proportions of two base colors (inputs). This scenario can be modeled by a rational function where the output is the ratio of one color quantity to the other.\r\n\r\n- Concentration: In chemistry, solutions often involve mixing a solute with a solvent. The concentration of the solute (output) can be expressed as a rational function of the amount of solute and the total volume of the solution (inputs).\r\n\r\nExamples:\r\n\r\n1. Finding the cost of renting a car: A car rental company charges a daily rate of $50 and a one-time cleaning fee of $20. The total cost (C) can be modeled by the function C(d) = 50d + 20, where d represents the number of rental days.\r\n\r\n2. Calculating the average speed: If you travel a distance of 200 miles in 4 hours, your average speed (S) can be found using the function S(d, t) = d / t, where d = 200 and t = 4.\r\n\r\n\r\nSolving Rational Equations:\r\n\r\nRational equations involve rational functions set equal to another expression. Solving them requires manipulating the equation algebraically to isolate the variable in the desired domain.\r\n\r\n\r\nRemember:\r\n\r\n- Always check for any restrictions on the domain due to the denominator being zero.\r\n\r\n- Rational functions offer a versatile tool for modeling and analyzing various real-world phenomena involving rates, proportions, and ratios.\r\n\r\n\r\nFurther Exploration:\r\n\r\n- Explore online resources and textbooks to delve deeper into solving rational equations and applying them to diverse scenarios.\r\n\r\n- Practice with various problems involving rational functions to solidify your understanding and problem-solving skills.', '2024-01-21 11:30:43', '2024-02-25 00:32:01'),
(6, 'Understanding Rational Functions, Equations, and Inequalities', 2, 'The primary objective of this lesson is to provide students with a nuanced understanding of rational functions, equations, and inequalities. By the end of the session, students should be proficient in recognizing, manipulating, and solving problems involving rational functions. The lesson aims to build a strong foundation for students to navigate the complexities of rational expressions, setting the stage for more advanced studies in the realm of mathematical functions.', 'The lesson titled \"Understanding Rational Functions, Equations, and Inequalities\" delves into the intricacies of rational functions, emphasizing the distinctions between functions, equations, and inequalities within this specific class. Students explore the structure of rational functions and how they differ from other types of mathematical expressions. The lesson introduces the concept of rational equations and inequalities, shedding light on how these mathematical constructs relate to real-world problem-solving scenarios. Through theoretical discussions and practical examples, students gain a comprehensive understanding of the role that rational functions play in both theoretical mathematics and practical applications.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(7, 'Solving Rational Equations and Inequalities', 2, 'The primary objective of this lesson is to equip students with the skills to solve both rational equations and inequalities. By the end of the session, students should be adept at employing various techniques to isolate variables and determine solution sets within the realm of rational expressions. This lesson serves as a crucial step in developing problem-solving abilities related to rational functions and lays the groundwork for more advanced studies in the domain of mathematical functions.', 'The lesson on \"Solving Rational Equations and Inequalities\" guides students through the process of effectively solving mathematical problems involving rational equations and inequalities. Students delve into strategies for isolating variables, simplifying expressions, and determining the solution sets for rational equations. The lesson also extends to understanding and interpreting solutions in the context of rational inequalities. Through a series of examples and interactive exercises, students gain proficiency in solving problems that require the manipulation and analysis of rational expressions, providing them with essential problem-solving tools.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(8, 'Visualizing and Analyzing Rational Functions', 2, 'The primary objective of this lesson is to equip students with the skills to visualize and analyze rational functions graphically. By the end of the session, students should be proficient in graphing rational functions, identifying critical points, and interpreting the graphical representation in the context of real-world scenarios. This lesson sets the stage for more advanced studies in function theory, where graphical analysis plays a crucial role in understanding the behavior of complex mathematical functions.', 'The lesson on \"Visualizing and Analyzing Rational Functions\" immerses students in the graphical representation and analysis of rational functions. Students explore how to graphically depict rational functions, identifying key features such as asymptotes, intercepts, and behavior in different regions. The lesson emphasizes the connection between the graphical representation and the algebraic structure of rational functions. Through interactive activities and visual aids, students develop a keen sense of interpreting and analyzing the graphical behavior of rational functions, providing valuable insights into their overall characteristics.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(9, 'Real-life Scenarios with One-to-One Functions', 3, 'The primary objective of this lesson is to enable students to recognize and apply one-to-one functions in real-world contexts. By the end of the session, students should be proficient in identifying situations where one-to-one functions are applicable and formulating these functions accurately to model unique relationships. This lesson lays the foundation for a deeper understanding of the practical significance of one-to-one functions and their role in various fields of study.', 'In the lesson focused on &#34;Real-life Scenarios with One-to-One Functions,&#34; students explore the practical applications of one-to-one functions in modeling and solving real-world situations. The lesson introduces scenarios where one-to-one functions play a crucial role in accurately representing relationships with a unique correspondence between inputs and outputs. Through concrete examples and case studies, students discover how one-to-one functions are employed to model diverse phenomena in fields such as economics, biology, and technology. The lesson aims to bridge theoretical concepts with practical applications, illustrating the relevance of one-to-one functions in understanding and addressing complex real-life scenarios.', '', 'https://www.youtube-nocookie.com/embed/GsIo3B46yjU?si=ldw3Ve2p1fpdGrRz', 'Inverse Functions: Undoing the Action in Real-World Scenarios\r\n\r\nImagine a world where actions cannot be undone. In mathematics, however, the concept of inverse functions allows us to &#34;reverse&#34; the effect of a function under certain conditions. This lesson explores real-life applications of inverse functions, focusing on one-to-one functions where the inverse exists.\r\n\r\n\r\nUnderstanding Inverse Functions:\r\n\r\n- A function f(x) has an inverse function, denoted by f^-1(x), only if f(x) is one-to-one. This means each output has a unique input, and vice versa.\r\n\r\n- The inverse function essentially &#34;undoes&#34; the action of the original function.\r\n\r\n- If y = f(x), then x = f^-1(y).\r\n\r\n\r\nReal-Life Scenarios:\r\n\r\n1. Temperature Conversion: Converting between Celsius (°C) and Fahrenheit (°F) is a classic example. The function f(°C) = (9/5)°C + 32 converts Celsius to Fahrenheit, while its inverse, f^-1(°F) = (5/9)(°F - 32), converts Fahrenheit to Celsius.\r\n\r\n2. Age and Year of Birth: The function f(y) = 2024 - y gives your current age (y) based on the year (2024). Its inverse, f^-1(a) = 2024 - a, determines your year of birth (a) given your current age.\r\n\r\n3. Discounts and Original Prices: A store offers a 20% discount on all items. The function f(p) = 0.8p represents the discounted price (p) based on the original price. The inverse, f^-1(dp) = dp / 0.8, calculates the original price (dp) from the discounted price.\r\n\r\n\r\nKey Points:\r\n\r\n- Not all functions have inverses. Only one-to-one functions guarantee the existence of an inverse.\r\n\r\n- The inverse function swaps the roles of the input and output variables.\r\n\r\n- Understanding inverse functions helps us model and analyze situations where we need to &#34;undo&#34; or reverse an action.\r\n\r\n\r\nExplore Further:\r\n\r\n- Investigate how inverse functions are used in cryptography, where encryption and decryption are essentially inverse operations.\r\n\r\n- Look into applications of inverse functions in physics, economics, and other disciplines to broaden your understanding of their versatility.\r\n\r\n\r\nBy delving into these real-life scenarios, you can appreciate the practical significance of inverse functions and their ability to model various situations where reversing an action or process is crucial.', '2024-01-21 11:30:43', '2024-02-25 00:35:12'),
(10, 'Determining Inverses in One-to-One Functions', 3, 'The primary objective of this lesson is to enable students to confidently determine inverses in one-to-one functions. By the end of the session, students should grasp the concept of one-to-one functions and understand the process of identifying and representing their inverses. This lesson serves as a foundational step in building students proficiency in dealing with inverse relationships and prepares them for more complex studies in function theory and analysis.', 'The lesson titled \"Determining Inverses in One-to-One Functions\" delves into the concept of one-to-one functions and the process of identifying and understanding their inverses. Students explore the unique characteristics of one-to-one functions, which guarantee a distinct correspondence between inputs and outputs. The lesson guides students through the steps of determining the inverse function for a given one-to-one function, emphasizing the symmetry and reversal of roles between the original function and its inverse. Through examples and interactive exercises, students develop a solid understanding of one-to-one functions and their inverses, paving the way for more advanced topics in function theory.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(11, 'Representing and Graphing Inverse Functions', 3, 'The primary objective of this lesson is to equip students with the skills to represent and graph inverse functions. By the end of the session, students should comprehend the graphical symmetry inherent in the relationship between a function and its inverse. This lesson serves as a crucial step in building students understanding of inverse functions and prepares them for more advanced studies in function theory and graphical analysis.', 'The lesson titled \"Representing and Graphing Inverse Functions\" guides students through the exploration of inverse functions and their graphical representation. Students delve into the unique relationship between a function and its inverse, understanding how the graph of an inverse function mirrors the original function across the line y = x. The lesson emphasizes the steps involved in graphing inverse functions, highlighting the symmetry between points on the original function and its inverse. Through practical examples and interactive exercises, students gain proficiency in representing and graphing inverse functions, fostering a deeper appreciation for the symmetrical nature of these mathematical relationships.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(12, 'Problem-solving with Inverse Functions', 3, 'The primary objective of this lesson is to enable students to proficiently solve problems using inverse functions. By the end of the session, students should be adept at applying inverse functions to reverse operations, solve equations, and address real-world challenges. This lesson serves as a crucial step in building problem-solving skills within the context of inverse functions and prepares students for more advanced studies in function theory and applications.', 'The lesson on \"Problem-solving with Inverse Functions\" immerses students in the practical application of inverse functions to solve a variety of mathematical challenges and real-world problems. Students explore how inverse functions can be utilized to reverse the effects of an original function and solve equations involving these functions. The lesson emphasizes the role of inverse functions in undoing operations and isolating variables. Through a series of problem-solving exercises and real-world scenarios, students develop critical thinking skills, honing their ability to apply inverse functions as powerful tools in mathematical analysis.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(13, 'Applications of Exponential Functions in Real Life', 4, 'The primary objective of this lesson is to equip students with the skills to recognize and apply exponential functions in real-life situations. By the end of the session, students should comprehend the significance of exponential functions in modeling growth and decay phenomena and be able to interpret and analyze these functions in practical contexts. This lesson serves as a foundation for further exploration into the nuances of exponential functions and their wide-ranging applications.', 'The lesson on &#34;Applications of Exponential Functions in Real Life&#34; immerses students in the practical and diverse applications of exponential functions. Students explore how exponential functions model phenomena characterized by rapid growth or decay, such as population growth, compound interest, and radioactive decay. The lesson emphasizes the versatility of exponential functions in capturing real-world scenarios with exponential behavior. Through concrete examples and case studies, students gain insights into the role of exponential functions in predicting future trends and understanding dynamic processes in various fields.', '', 'https://www.youtube-nocookie.com/embed/6WMZ7J0wwMI?si=ges7ISBn7pLI_pBk', 'Exponential Functions: Growth and Decay in the Real World\n\nExponential functions, characterized by their rapid growth or decay, play a crucial role in modeling various real-world phenomena. This lesson explores some captivating applications of these functions:\n\n\nUnderstanding Exponential Functions:\n\n- An exponential function is of the form f(x) = a^x, where a is any positive constant base (a ≠ 0, a ≠ 1) and x is the exponent.\n\n- The base determines the rate of growth or decay:\na > 1: Exponential growth (e.g., population increase, compound interest)\n0 < a < 1: Exponential decay (e.g., radioactive decay, drug elimination from the body)\n\n\nReal-Life Applications:\n\n1. Population Growth: Demographers use exponential functions to model population growth, considering birth rates, death rates, and migration patterns. This helps predict future population trends and inform resource allocation decisions.\n\n3. Compound Interest: Earning interest on your savings is an exciting example of exponential growth. The formula A = P(1 + r)^t calculates the future amount (A) based on the initial principal (P), interest rate (r), and time (t).\n\n3. Radioactive Decay: Radioactive isotopes decay exponentially over time. The half-life, the time it takes for an isotope to lose half its radioactivity, is a key concept. Scientists use exponential functions to predict the remaining activity of radioactive materials and ensure safe handling.\n\n4. Modeling Infectious Diseases: The spread of viruses and bacteria often follows an exponential pattern in the initial stages. Understanding this growth pattern is crucial for implementing effective control measures.\n\n\nExample:\n\nImagine a bacterial population that doubles every hour (a = 2). The initial population is 100 (P = 100). How many bacteria will be present after 3 hours (t = 3)?\n\nUsing the formula A = P(a^t), we get:\n\nA = 100 * (2^3) = 800\n\nTherefore, the population will grow to 800 bacteria after 3 hours.\n\n\nFurther Exploration:\n\n- Explore the YouTube video \"Exponential Functions and Applications: \'[invalid URL removed]\'\" by MathTheBeautiful to gain a deeper understanding of exponential functions and their applications.\n\n- Investigate how exponential functions are used in finance, computer science, and other fields to broaden your perspective on their diverse applications.\n\n\nBy understanding exponential functions, you can appreciate their power in modeling various real-world phenomena characterized by rapid growth or decay, making informed decisions in diverse fields.', '2024-01-21 11:30:43', '2024-02-25 00:41:02'),
(14, 'Understanding Exponential Equations and Inequalities', 4, 'The primary objective of this lesson is to enable students to confidently solve both exponential equations and inequalities. By the end of the session, students should be adept at employing various techniques to isolate variables and determine solution sets within the realm of exponential functions. This lesson serves as a crucial step in developing problem-solving abilities related to exponential growth and decay, preparing students for more advanced studies in the domain of mathematical functions.', 'The lesson titled \"Understanding Exponential Equations and Inequalities\" delves into the intricacies of solving mathematical problems involving exponential equations and inequalities. Students explore the unique properties of exponential functions and how these properties translate into solving equations and inequalities. The lesson guides students through techniques for isolating variables, simplifying exponential expressions, and determining solution sets. Through practical examples and interactive exercises, students gain proficiency in solving problems that involve exponential growth and decay, laying the foundation for a deeper understanding of exponential functions.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(15, 'Navigating Logarithmic Equations and Inequalities', 4, 'The primary objective of this lesson is to equip students with the skills to confidently navigate and solve logarithmic equations and inequalities. By the end of the session, students should be adept at employing various techniques to isolate variables and determine solution sets within the realm of logarithmic functions. This lesson serves as a crucial step in developing problem-solving abilities related to logarithmic functions, preparing students for more advanced studies in the domain of mathematical functions.', 'The lesson on \"Navigating Logarithmic Equations and Inequalities\" guides students through the complexities of solving mathematical problems involving logarithmic functions. Students explore the unique properties of logarithms and how these properties translate into solving equations and inequalities. The lesson covers techniques for isolating variables, simplifying logarithmic expressions, and determining solution sets. Through practical examples and interactive exercises, students gain proficiency in solving problems that involve logarithmic functions, providing a solid foundation for understanding the intricacies of these mathematical constructs.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(16, 'Charting the Course of Exponential and Logarithmic Functions', 4, 'The primary objective of this lesson is to equip students with the skills to graphically represent and analyze exponential and logarithmic functions. By the end of the session, students should be proficient in graphing these functions, identifying critical points, and interpreting the graphical representation in the context of real-world scenarios. This lesson sets the stage for more advanced studies in function theory, where graphical analysis plays a crucial role in understanding the behavior of complex mathematical functions.', 'The lesson titled \"Charting the Course of Exponential and Logarithmic Functions\" provides students with a comprehensive understanding of the graphical representation and analysis of exponential and logarithmic functions. Students explore the distinctive characteristics of these functions, including exponential growth/decay and logarithmic transformations. The lesson guides students through graphing techniques, identifying key features such as intercepts, asymptotes, and behavior in different regions. Through practical examples and interactive exercises, students gain proficiency in charting the course of exponential and logarithmic functions, enhancing their ability to interpret and analyze these functions graphically.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(17, 'Simple and Compound Tales in Financial Mathematics', 5, 'The primary objective of this lesson is to enable students to comprehend and apply the principles of simple and compound interest in financial mathematics. By the end of the session, students should be adept at calculating interest, determining future values, and making informed financial decisions based on these concepts. This lesson serves as a crucial step in developing financial literacy and prepares students for more advanced studies in financial mathematics.', 'The lesson on &#34;Simple and Compound Tales in Financial Mathematics&#34; delves into the world of financial concepts, focusing on simple and compound interest scenarios. Students explore the principles underlying simple and compound interest, understanding how these concepts influence financial decisions and investments. The lesson covers calculations of interest, maturity value, future value, and present value in both simple interest and compound interest environments. Through practical examples and hands-on activities, students gain insights into the application of financial mathematics in various contexts, laying the foundation for informed decision-making in financial scenarios.', '', 'https://www.youtube-nocookie.com/embed/Hn0eLcOSQGw?si=4z4dXmF2AaBqOY68', 'Simple and Compound Tales: Unveiling the Magic of Financial Mathematics\r\n\r\nFinancial mathematics, a captivating blend of finance and mathematics, empowers you to make informed financial decisions. This lesson delves into the contrasting worlds of simple and compound interest, unveiling their unique tales and highlighting their significance in financial planning.\r\n\r\n\r\nSimple Interest: A Straightforward Story\r\n\r\n- Imagine saving $1000 at an annual interest rate of 5%. With simple interest, you earn a fixed amount of interest each year, calculated as:\r\n\r\n\r\nInterest earned per year = Principal × Interest rate\r\n\r\n- In this case, you would earn $50 per year (1000 × 0.05).\r\n\r\n- Regardless of the investment period, the interest earned remains constant with simple interest.\r\n\r\n\r\nCompound Interest: A Story of Exponential Growth\r\n\r\n- Compound interest, often referred to as &#34;interest on interest,&#34; works like magic. It reinvests not just the initial principal but also the accumulated interest from previous periods.\r\n\r\n- This creates a snowball effect, where your money grows exponentially over time.\r\n\r\n\r\nExample:\r\n\r\n- Let&#39;s revisit the $1000 scenario, but this time with compound interest at 5%.\r\n\r\n- Year 1: Interest earned = $50 (same as simple interest)\r\n\r\n- Year 2: Interest earned = $52.50 (1050 × 0.05)\r\n\r\n- Year 3: Interest earned = $55.13 (1102.50 × 0.05)\r\n\r\nAs you can see, the interest earned keeps increasing with each year, showcasing the power of compounding.\r\n\r\n\r\nThe Tales Collide: Making informed choices\r\n\r\n- Choosing between simple and compound interest depends on your financial goals and investment horizon.\r\n\r\n- Simple interest is suitable for short-term investments where frequent withdrawals are expected.\r\n\r\n- Compound interest shines for long-term goals like retirement planning, as it allows your money to grow exponentially over extended periods.\r\n\r\n\r\nEmpowering Yourself:\r\n\r\n- Understanding these concepts empowers you to:\r\n   - Compare investment options effectively.\r\n   - Make informed decisions about saving and borrowing.\r\n   - Plan for your financial future with greater clarity.\r\n\r\n\r\nExplore Further:\r\n\r\n- Research various financial instruments like savings accounts, mutual funds, and stocks to understand how they leverage simple or compound interest.\r\n\r\nBy understanding the contrasting tales of simple and compound interest, you gain valuable knowledge to navigate the exciting realm of financial mathematics and make informed decisions that shape your financial future.', '2024-01-21 11:30:43', '2024-02-25 00:44:44'),
(18, 'Coding Real-world Statements into Logical Propositions', 5, 'The primary objective of this lesson is to equip students with the skills to code real-world statements into logical propositions. By the end of the session, students should be proficient in recognizing logical structures within statements and translating them into a symbolic language. This lesson serves as a foundational step in building students logical reasoning skills and prepares them for more advanced studies in formal logic and problem-solving.', 'The lesson titled \"Coding Real-world Statements into Logical Propositions\" introduces students to the fundamentals of symbolic logic by translating real-world statements into logical propositions. Students explore the process of representing complex statements using mathematical symbols and logical operators. The lesson emphasizes the importance of precision in logical coding, fostering an understanding of how to capture the essence of real-world scenarios in a formal logical language. Through practical examples and exercises, students gain proficiency in coding statements into logical propositions, laying the groundwork for further studies in propositional logic.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(19, 'Unraveling Truth Values and Conditional Propositions', 5, 'The primary objective of this lesson is to enable students to confidently unravel truth values and understand conditional propositions. By the end of the session, students should be adept at assessing the truth or falsity of propositions and interpreting conditional statements. This lesson serves as a foundational step in building students proficiency in symbolic logic and prepares them for more advanced studies in logical reasoning and argumentation.', 'The lesson on \"Unraveling Truth Values and Conditional Propositions\" introduces students to the fundamental concepts of truth values and conditional propositions within the realm of symbolic logic. Students explore the truth values of propositions and understand the implications of conditional statements. The lesson guides students through the logical structure of conditional propositions, emphasizing the relationship between the antecedent and the consequent. Through practical examples and interactive exercises, students gain proficiency in unraveling truth values and analyzing conditional propositions, enhancing their logical reasoning skills.', NULL, NULL, NULL, '2024-01-21 11:30:43', '2024-01-21 11:30:43'),
(20, 'Analyzing Validity, Fallacies, and Methods in Logic', 5, 'The primary objective of this lesson is to equip students with the skills to analyze the validity of logical arguments, identify fallacies, and apply various methods of logical reasoning. By the end of the session, students should be proficient in critically assessing the strength and soundness of logical propositions and arguments. This lesson serves as a crucial step in building students&#39; logical reasoning abilities and prepares them for more advanced studies in formal logic and argumentation.', 'The lesson on &#34;Analyzing Validity, Fallacies, and Methods in Logic&#34; provides students with a deep dive into the evaluation of logical arguments. Students explore the principles of validity, identifying common fallacies, and understanding different methods of logical reasoning. The lesson emphasizes the importance of sound reasoning and critical analysis in assessing the strength of logical arguments. Through practical examples and interactive discussions, students gain proficiency in identifying valid arguments, recognizing fallacies, and applying different methods of logical analysis. This lesson lays the foundation for developing strong analytical and evaluative skills in logical reasoning.', '', 'https://www.youtube-nocookie.com/embed/ohy2d1Op5nc?si=Z-QUqRQ6bm43jpM2', 'Analyzing Validity, Fallacies, and Methods in Financial Decisions: A Logical Approach\r\n\r\nFinancial decisions often involve complex information and competing viewpoints. Logic, the science of reasoning, empowers you to analyze arguments, identify fallacies, and make sound financial choices.\r\n\r\n\r\nUnderstanding Validity and Fallacies:\r\n\r\n- Valid arguments: The conclusion logically follows from the premises (statements assumed to be true).\r\n\r\n- Fallacies: Errors in reasoning that lead to unsound conclusions. Common fallacies in finance include:\r\n\r\n- Appeal to authority: Relying solely on someone&#39;s reputation without evidence.\r\n\r\n- Post hoc fallacy: Assuming because event A happened before event B, A caused B.\r\n\r\n- Slippery slope: Assuming a small step will inevitably lead to a disastrous outcome.\r\n\r\n\r\nExample:\r\n\r\nArgument: &#34;The stock market has gone up for the past 5 years. Therefore, it will definitely go up in the next year.&#34;\r\n\r\nFallacy: This argument commits the post hoc fallacy. Past performance is not a guarantee of future results.\r\n\r\n\r\nMethods of Logical Reasoning:\r\n\r\n- Deductive reasoning: Draws a specific conclusion from general principles (e.g., &#34;All stocks are risky; therefore, this specific stock is risky&#34;).\r\n\r\n- Inductive reasoning: Uses specific observations to form a general conclusion (e.g., &#34;Several tech stocks have performed well recently; therefore, the tech sector is likely to outperform other sectors&#34;).\r\n\r\n\r\nApplying Logic in Finance:\r\n\r\n- Evaluating investment recommendations: Scrutinize the reasoning behind investment advice. Are there logical fallacies present?\r\n\r\n- Assessing financial news: Critically analyze news articles and financial reports. Are the claims supported by evidence?\r\n\r\n- Making informed decisions: Use logic to weigh different options, considering potential risks and rewards based on sound reasoning.\r\n\r\n\r\nEmpowering Yourself:\r\n\r\nBy honing your logical reasoning skills, you can:\r\n\r\n- Make more objective financial decisions.\r\n\r\n- Avoid falling prey to emotional biases and cognitive errors.\r\n\r\n- Develop a critical thinking approach to navigate the complexities of the financial world.\r\n\r\n\r\nExplore Further:\r\n\r\n- Research common cognitive biases that can influence financial decisions and learn strategies to mitigate their impact.\r\n\r\n\r\nRemember, logic is a powerful tool that empowers you to make informed financial choices and navigate the ever-changing world of finance with greater confidence.', '2024-01-21 11:30:43', '2024-02-25 00:47:49'),
(21, 'Final Examination', 6, 'As a reminder, successfully passing this final examination in General Mathematics is crucial for obtaining your certificate. Your performance on this test will determine your mastery of essential mathematical concepts and your eligibility for certification. Take this opportunity to review thoroughly, ensuring your understanding of the material and your ability to apply it effectively. Your dedication and preparation are key to achieving success and reaching your academic goals. Good luck and remember that your hard work will be rewarded with the recognition and validation of your achievements.', 'As a reminder, successfully passing this final examination in General Mathematics is crucial for obtaining your certificate. Your performance on this test will determine your mastery of essential mathematical concepts and your eligibility for certification. Take this opportunity to review thoroughly, ensuring your understanding of the material and your ability to apply it effectively. Your dedication and preparation are key to achieving success and reaching your academic goals. Good luck and remember that your hard work will be rewarded with the recognition and validation of your achievements.', NULL, NULL, NULL, '2024-02-23 07:05:23', '2024-02-23 07:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_progress`
--

CREATE TABLE `tbl_progress` (
  `Course_Id` int(11) DEFAULT NULL,
  `Account_Id` int(11) NOT NULL,
  `Lesson_Id` int(11) DEFAULT NULL,
  `Activity_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_progress`
--

INSERT INTO `tbl_progress` (`Course_Id`, `Account_Id`, `Lesson_Id`, `Activity_Id`) VALUES
(1, 11, 1, 0),
(1, 11, 2, 0),
(1, 11, 3, 0),
(1, 11, 4, 0),
(1, 11, 5, 0),
(1, 11, 6, 0),
(1, 11, 7, 0),
(1, 11, 8, 0),
(1, 11, 9, 0),
(1, 11, 10, 0),
(1, 11, 11, 0),
(1, 11, 12, 0),
(1, 11, 13, 0),
(1, 11, 14, 0),
(1, 11, 15, 0),
(1, 11, 16, 0),
(1, 11, 17, 0),
(1, 11, 18, 0),
(1, 11, 19, 0),
(1, 11, 20, 0),
(1, 11, 21, 0);

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
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `TimeStarted` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sections`
--

CREATE TABLE `tbl_sections` (
  `Account_Id` int(11) NOT NULL,
  `Course_Id` int(11) DEFAULT NULL,
  `Progress` int(11) NOT NULL DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sections`
--

INSERT INTO `tbl_sections` (`Account_Id`, `Course_Id`, `Progress`, `CreatedAt`, `UpdatedAt`) VALUES
(11, 1, 23, '2024-05-02 15:48:59', '2024-05-02 18:10:09');

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
-- Indexes for table `tbl_certificates`
--
ALTER TABLE `tbl_certificates`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Account_Id` (`Account_Id`),
  ADD KEY `Course_Id` (`Course_Id`);

--
-- Indexes for table `tbl_chapter`
--
ALTER TABLE `tbl_chapter`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Course_Id` (`Course_Id`);

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
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
  ADD UNIQUE KEY `Account_Id` (`Account_Id`,`Lesson_Id`,`Activity_Id`,`Course_Id`) USING BTREE;

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
-- Indexes for table `tbl_sections`
--
ALTER TABLE `tbl_sections`
  ADD UNIQUE KEY `Account_Id` (`Account_Id`,`Course_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_certificates`
--
ALTER TABLE `tbl_certificates`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chapter`
--
ALTER TABLE `tbl_chapter`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_lessons`
--
ALTER TABLE `tbl_lessons`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `tbl_certificates`
--
ALTER TABLE `tbl_certificates`
  ADD CONSTRAINT `tbl_certificates_ibfk_1` FOREIGN KEY (`Account_Id`) REFERENCES `tbl_accounts` (`Id`),
  ADD CONSTRAINT `tbl_certificates_ibfk_2` FOREIGN KEY (`Course_Id`) REFERENCES `tbl_courses` (`Id`);

--
-- Constraints for table `tbl_chapter`
--
ALTER TABLE `tbl_chapter`
  ADD CONSTRAINT `tbl_chapter_ibfk_1` FOREIGN KEY (`Course_Id`) REFERENCES `tbl_courses` (`Id`);

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

--
-- Constraints for table `tbl_sections`
--
ALTER TABLE `tbl_sections`
  ADD CONSTRAINT `tbl_sections_ibfk_1` FOREIGN KEY (`Account_Id`) REFERENCES `tbl_accounts` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
