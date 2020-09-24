-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 14 juil. 2019 à 09:59
-- Version du serveur :  10.1.25-MariaDB
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `distance_evaluation`
--

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `option` tinyint(1) DEFAULT NULL,
  `isCommon` tinyint(1) NOT NULL DEFAULT '0',
  `credit` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`id`, `title`, `code`, `year`, `option`, `isCommon`, `credit`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'visual programming and projects', 'csct6105', 5, 0, 0, 3, 1, '2019-06-16 21:03:07', '2019-06-16 21:03:07'),
(2, 'cryptography and applications', 'csct6104', 5, 0, 0, 3, 1, '2019-06-16 21:03:07', '2019-06-16 21:03:07'),
(3, 'advanced applied didatics', 'csct6103', 5, 0, 1, 3, 1, '2019-06-16 21:03:07', '2019-06-16 21:03:07'),
(4, 'microcontrollers interfaces', 'csct6102', 5, 0, 0, 3, 98, '2019-06-16 21:03:07', '2019-06-16 21:03:07'),
(5, 'artificial  intelligence', 'csct6101', 5, 0, 0, 2, 99, '2019-06-16 21:03:07', '2019-06-16 21:03:07'),
(6, 'object oriented programming languages', 'csct5104', 4, 0, 0, 3, 1, '2019-06-16 21:03:07', '2019-06-16 21:03:07'),
(7, 'data structures II', 'csct6123', 5, 1, 0, 3, 101, '2019-06-16 21:03:07', '2019-06-17 17:44:12'),
(8, 'advanced networking', 'csct6122', 5, 1, 0, 3, 1, '2019-06-16 21:03:07', '2019-06-17 17:43:50'),
(9, 'signal processing techniques', 'csct4101', 3, 0, 1, 2, 99, '2019-06-16 21:03:07', '2019-06-16 21:03:07'),
(10, 'pascal programming', 'csct2104', 1, 0, 0, 3, 1, '2019-06-16 21:03:07', '2019-06-16 21:03:07'),
(11, 'c programming', 'csct3103', 2, 1, 0, 2, 101, '2019-06-16 21:03:07', '2019-06-16 21:03:07'),
(12, 'image processing', 'csct5108', 4, 0, 0, 3, 100, '2019-06-16 21:03:07', '2019-06-16 21:20:48'),
(13, 'c++ programming', 'csct3108', 2, 1, 0, 2, 101, '2019-06-16 21:03:07', '2019-06-16 21:03:07');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_14_183850_create_courses_table', 1),
(4, '2019_02_14_183947_create_test_papers_table', 1),
(5, '2019_02_14_184121_create_questions_table', 1),
(6, '2019_02_14_184358_create_question_distractors_table', 1),
(7, '2019_02_14_190525_create_staff_table', 1),
(8, '2019_02_14_194728_create_news_table', 1),
(9, '2019_05_18_142537_create_written_test_papers_table', 1),
(10, '2019_05_18_142631_create_repeating_courses_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `created_at`, `updated_at`) VALUES
(1, 'latest day for registration', 'dear students, due to the fact the first semester exam will be done during the month of december, all year 3 and year 4 students should submit their registration files latest on the 21 th of november 2020.', '2019-06-16 22:05:45', '2019-06-16 22:08:38'),
(2, 'Coms club welcoming day', 'the computer science department club (coms club) invites every student to participate at its meeting which will take place on the 1st of november 2020.', '2019-06-16 22:08:28', '2019-06-16 22:08:28'),
(3, 'first semester exam complaints', 'the first semester exam has been published on the 3rd of february. so any complaint should be submitted to the department before the 08/02/2020. \nNote: one folder per subject', '2019-06-16 22:11:25', '2019-06-16 22:11:25');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `over_mark` int(11) NOT NULL,
  `test_paper_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `text`, `over_mark`, `test_paper_id`, `created_at`, `updated_at`) VALUES
(3, 'in computer science, which one is an appropriate definition of a network', 15, 1, '2019-06-17 17:17:29', '2019-06-17 17:17:29'),
(4, 'The use of technology to enhance learning process is called __________ in education', 15, 1, '2019-06-17 17:17:30', '2019-06-17 17:17:30'),
(5, 'Which of the following statements is not true ?', 15, 3, '2019-06-17 17:28:02', '2019-06-17 17:28:02'),
(6, 'The use of technology to enhance learning process is called __________ in education', 15, 3, '2019-06-17 17:28:02', '2019-06-17 17:28:02'),
(7, 'Pedagogy is the study of', 15, 3, '2019-06-17 17:28:02', '2019-06-17 17:28:02'),
(8, 'Individual learns from his own mistakes” This statement is based on which learning theory ?', 15, 3, '2019-06-17 17:28:02', '2019-06-17 17:28:02'),
(9, 'Which of the following statements is not true ?', 10, 3, '2019-06-17 17:28:02', '2019-06-17 17:28:02');

-- --------------------------------------------------------

--
-- Structure de la table `question_distractors`
--

CREATE TABLE `question_distractors` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isCorrect` tinyint(1) NOT NULL DEFAULT '0',
  `question_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question_distractors`
--

INSERT INTO `question_distractors` (`id`, `text`, `isCorrect`, `question_id`, `created_at`, `updated_at`) VALUES
(5, 'good question', 1, 3, NULL, NULL),
(6, 'bad question', 0, 3, NULL, NULL),
(7, 'bad', 0, 3, NULL, NULL),
(8, 'basd', 0, 4, NULL, NULL),
(9, 'good', 1, 4, NULL, NULL),
(10, 'bad', 0, 4, NULL, NULL),
(11, 'bad', 0, 4, NULL, NULL),
(12, 'Growth is a biological process', 0, 5, NULL, NULL),
(13, 'Development is a quantitative process (correct)', 1, 5, NULL, NULL),
(14, 'Education is a goal-oriented process', 0, 5, NULL, NULL),
(15, 'Learning is a process of behavioural changes', 0, 5, NULL, NULL),
(16, 'IT', 0, 6, NULL, NULL),
(17, 'ICT (correct)', 1, 6, NULL, NULL),
(18, 'Information technology', 0, 6, NULL, NULL),
(19, 'Communication technology', 0, 6, NULL, NULL),
(20, 'Education', 0, 7, NULL, NULL),
(21, 'Guiding Students', 0, 7, NULL, NULL),
(22, 'Learning Process', 0, 7, NULL, NULL),
(23, 'Teaching Methods (correct)', 1, 7, NULL, NULL),
(24, 'Instrumental conditioning', 0, 8, NULL, NULL),
(25, 'Insight', 0, 8, NULL, NULL),
(26, 'Trial & Error (correct)', 1, 8, NULL, NULL),
(27, 'Classical conditioning', 0, 8, NULL, NULL),
(28, 'Growth is a biological process', 0, 9, NULL, NULL),
(29, 'Development is a quantitative process (correct)', 1, 9, NULL, NULL),
(30, 'Education is a goal-oriented process', 0, 9, NULL, NULL),
(31, 'Learning is a process of behavioural changes', 0, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `repeating_courses`
--

CREATE TABLE `repeating_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `repeating_courses`
--

INSERT INTO `repeating_courses` (`id`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(2, 65, 11, '2019-06-16 21:23:23', '2019-06-16 21:23:23'),
(3, 2, 6, '2019-06-16 21:24:03', '2019-06-16 21:24:03'),
(5, 64, 11, '2019-06-16 21:27:50', '2019-06-16 21:27:50'),
(6, 64, 13, '2019-06-16 21:40:04', '2019-06-16 21:40:04');

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `staff`
--

INSERT INTO `staff` (`id`, `name`, `type`, `email`, `phone`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Lienou Jean Pierre', 'hod', 'lieunoujp@gmail.com', 673828999, 'The computer science head of department', '2019-06-16 21:42:19', '2019-06-16 21:43:39'),
(2, 'dr. njieSimon', 'hoo', 'pfubong@gmail.com', 673873388, 'the head of option of ICT', '2019-06-16 21:43:11', '2019-06-16 21:45:52'),
(3, 'Dr. kana ebenezer', 'hoo', 'ebeneser@yahoo.fr', 653338888, 'head of option of FCS', '2019-06-16 21:44:24', '2019-06-16 21:45:35'),
(4, 'mme. nimbeu jeanne', 'teacher', 'jeann@yahoo.fr', 654223333, 'teacher', '2019-06-16 21:46:50', '2019-06-16 21:46:50'),
(5, 'mr. tchahou esquivel', 'teacher', 'esquibel@yahoo.fe', 673332222, 'teacher', '2019-06-16 21:48:17', '2019-06-16 21:48:17'),
(6, 'mr. neba jonathen', 'teacher', 'nebaj@gmail.com', 667888888, 'teacher', '2019-06-16 21:49:20', '2019-06-16 21:54:01'),
(7, 'mme. djobia pamen', 'teacher', 'pamen@yahoo.fr', 673333322, 'teacher', '2019-06-16 21:51:30', '2019-06-16 21:51:30'),
(8, 'dr. innocent njie', 'teacher', 'njie@yahoo.fr', 657993322, 'teacher', '2019-06-16 21:53:45', '2019-06-16 21:53:45'),
(9, 'kouatcha merlin', 'delegate', 'kouatcha@gmail.com', 675929020, 'FCS year 5 delegate', '2019-06-16 21:55:08', '2019-06-16 21:55:08'),
(10, 'wabo pierre', 'delegate', 'wabo@gmail.com', 693663388, 'ICTyear 4 delegate', '2019-06-16 21:55:45', '2019-06-16 21:55:45');

-- --------------------------------------------------------

--
-- Structure de la table `test_papers`
--

CREATE TABLE `test_papers` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `over_mark` int(11) NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `test_papers`
--

INSERT INTO `test_papers` (`id`, `title`, `date`, `start_time`, `end_time`, `over_mark`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'CA: applied didatics', '2019-06-22', '08:00:00', '09:25:00', 30, 3, '2019-06-17 17:17:29', '2019-06-17 17:17:29'),
(3, 'Exam: advanced applied didatics good', '2019-07-01', '08:00:00', '13:33:00', 70, 3, '2019-06-17 17:28:02', '2019-06-17 17:28:02');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAllowed` tinyint(1) NOT NULL DEFAULT '1',
  `sex` tinyint(1) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isTeacher` tinyint(1) NOT NULL DEFAULT '0',
  `option` tinyint(1) DEFAULT NULL,
  `matricule` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `isAllowed`, `sex`, `isAdmin`, `isTeacher`, `option`, `matricule`, `year`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dada tangouo geraldine', 672121212, '$2y$10$G756YuWUerdgk7vbyTaFeOWLdGN.HpWz1zXPIilUxWeYVOt/klvl.', 1, 1, 1, 1, NULL, NULL, NULL, 'MwHYMnCtPVO8JNIqAZoVVjzaQW6qa9Y60v8l1GhDKAD8xLY2bvtjnZqbOoPM', '2019-06-16 20:03:43', '2019-06-16 20:03:43'),
(2, 'madom line', 673131313, '$2y$10$GLcjm6/HySA58xztS00gWOxFpeJKkhLBoNJgFWTPIrS.GGkDf7SxK', 1, 1, 1, 0, 0, '14t0207', 5, '3XDskqUZ9jgPuSi89jmHrOCnwDKVZ8OQv37Vte4SIADSP0pFhhFblBmz6QKl', '2019-06-16 20:05:33', '2019-06-16 20:05:33'),
(3, 'hubue rosa', 671111111, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '18t0200', 1, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(4, 'Gante yves', 672111111, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '18t0201', 1, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(5, 'Abawa jean de dieu', 673111111, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '18t0203', 1, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(6, 'Mesebe Cyrille', 674111111, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '18t0205', 1, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(7, 'njie honore', 676111111, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '18t0206', 1, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(8, 'lele madule torres', 671111112, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 1, '18t0101', 1, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(9, 'Noume horchele noumbo', 672111112, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '14t0112', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(10, 'Tsasse marine garcia', 673111114, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '14t0113', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(11, 'Tsinda ryan', 674111115, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '14t0114', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(12, 'Neba gounda leo', 676111116, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '14t0115', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(13, 'Ngahan murielle', 671111116, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 1, '18t0107', 1, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(14, 'tasse esquivel', 672111122, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '17t0102', 2, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(15, 'djanga kevine', 673111124, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '17t0103', 2, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(16, 'nzui vanessa', 674111125, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '17t0105', 2, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(17, 'bouling axcel', 676111126, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '17t0106', 2, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(18, 'Ngoba valery', 671111126, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 1, '17t0107', 2, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(19, 'tasse erelson', 672111123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '17t0202', 2, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(20, 'suigen kevine', 673111123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '17t0203', 2, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(21, 'temdje vanessa', 674111123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '17t0205', 2, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(22, 'hegba axcel', 676111123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '17t0206', 2, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(23, 'djuikam valery', 671111123, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 0, '17t0207', 2, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(34, 'tasse erelson', 672731123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '16t0202', 3, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(35, 'suigen kevine', 673763123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '16t0203', 3, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(36, 'temdje vanessa', 674711123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '16t0205', 3, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(37, 'hegba axcel', 676711123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '16t0206', 3, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(38, 'djuikam valery', 671711123, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 0, '16t0207', 3, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(54, 'tasse erelson', 674731423, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '15t0202', 4, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(55, 'suigen kevine', 674763123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '15t0203', 4, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(56, 'temdje vanessa', 675714124, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '14t0205', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(57, 'hegba axcel', 675711523, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '14t0208', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(58, 'djuikam valery', 674741123, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 0, '14t0217', 5, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(64, 'tasse erelson', 670731123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '16t0102', 3, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(65, 'suigen kevine', 670763123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '16t0103', 3, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(66, 'temdje vanessa', 670710123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '16t0105', 3, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(67, 'hegba axcel', 670719123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '16t0106', 3, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(68, 'djuikam valery', 670711123, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 1, '16t0107', 3, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(69, 'tasse erelson', 659731423, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '15t0102', 4, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(70, 'suigen kevine', 654763123, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '15t0103', 4, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(71, 'temdje vanessa', 695714124, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '14t0105', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(72, 'hegba axcel', 695711523, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '14t0108', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(73, 'djuikam valery', 694741123, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 1, '14t0117', 5, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(86, 'ekono vanessa', 675714120, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '14t0224', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(87, 'chimi axcel', 675711520, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '14t0218', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(88, 'towa valery', 674741120, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 0, '14t0220', 5, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(89, 'kuidja vanessa', 695714120, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '14t0121', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(90, 'bangue axcel', 695711520, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '14t0128', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(91, 'mabou valery', 694741120, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 1, '14t0122', 5, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(92, 'melongue vanessa', 675714180, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '14t0230', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(93, 'pougo axcel', 675711580, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '14t0232', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(94, 'siembe valery', 674741180, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 0, '14t0233', 5, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(95, 'keinje vanessa', 695714180, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '14t0134', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(96, 'tangouo axcel', 695711580, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '14t0136', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(97, 'audrey valery', 694741180, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 1, '14t0139', 5, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(98, 'zebaze alvine', 651422222, '$2y$10$8i3nVSXhKcHCHT2Ip6b3PunUJpujoJ1tEAShpktwIPEHRNLDn0vRq', 1, 0, 0, 1, NULL, NULL, NULL, 'SwKqBGvPeTeZiRqecXwNocw5fI8aUyt4pa6zOPyAVy4j5zK5Po7BK0ujqkHX', '2019-06-16 20:53:06', '2019-06-16 20:53:06'),
(99, 'tchahou christian ', 651622222, '$2y$10$8i3nVSXhKcHCHT2Ip6b3PunUJpujoJ1tEAShpktwIPEHRNLDn0vRq', 1, 0, 0, 1, NULL, NULL, NULL, 'SwKqBGvPeTeZiRqecXwNocw5fI8aUyt4pa6zOPyAVy4j5zK5Po7BK0ujqkHX', '2019-06-16 20:53:06', '2019-06-16 20:53:06'),
(100, 'tchasso severin', 651422220, '$2y$10$8i3nVSXhKcHCHT2Ip6b3PunUJpujoJ1tEAShpktwIPEHRNLDn0vRq', 1, 0, 0, 1, NULL, NULL, NULL, 'SwKqBGvPeTeZiRqecXwNocw5fI8aUyt4pa6zOPyAVy4j5zK5Po7BK0ujqkHX', '2019-06-16 20:53:06', '2019-06-16 20:53:06'),
(101, 'jean pierre lieunou', 651622220, '$2y$10$8i3nVSXhKcHCHT2Ip6b3PunUJpujoJ1tEAShpktwIPEHRNLDn0vRq', 1, 0, 0, 1, NULL, NULL, NULL, 'SwKqBGvPeTeZiRqecXwNocw5fI8aUyt4pa6zOPyAVy4j5zK5Po7BK0ujqkHX', '2019-06-16 20:53:06', '2019-06-16 20:53:06'),
(105, 'demanou christian ', 651622226, '$2y$10$8i3nVSXhKcHCHT2Ip6b3PunUJpujoJ1tEAShpktwIPEHRNLDn0vRq', 1, 0, 0, 1, NULL, NULL, NULL, 'SwKqBGvPeTeZiRqecXwNocw5fI8aUyt4pa6zOPyAVy4j5zK5Po7BK0ujqkHX', '2019-06-16 20:53:06', '2019-06-16 20:53:06'),
(106, 'pougom severin', 651422237, '$2y$10$8i3nVSXhKcHCHT2Ip6b3PunUJpujoJ1tEAShpktwIPEHRNLDn0vRq', 1, 0, 0, 1, NULL, NULL, NULL, 'SwKqBGvPeTeZiRqecXwNocw5fI8aUyt4pa6zOPyAVy4j5zK5Po7BK0ujqkHX', '2019-06-16 20:53:06', '2019-06-16 20:53:06'),
(107, 'pfubong simon', 651622820, '$2y$10$8i3nVSXhKcHCHT2Ip6b3PunUJpujoJ1tEAShpktwIPEHRNLDn0vRq', 1, 0, 0, 1, NULL, NULL, NULL, 'SwKqBGvPeTeZiRqecXwNocw5fI8aUyt4pa6zOPyAVy4j5zK5Po7BK0ujqkHX', '2019-06-16 20:53:06', '2019-06-16 20:53:06'),
(108, 'marie melongue vanessa', 675714787, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 0, '14t0248', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(109, ' guengue pougo axcel', 675719680, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 0, '14t0243', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(110, 'elonbe suzi valery', 674745680, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 1, '14t0244', 5, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(111, 'ketcha ketcha vanessa', 695719480, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 1, 0, 0, 1, '14t0148', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(112, 'tchaleu axcel', 695799580, '$2y$10$bXtzQZWg3zLixYJFW4PxOOXz/imJwOVtsx8F2XoDOXELLMOGBSVEy', 1, 0, 0, 0, 1, '14t0146', 5, 'yjJgpyZKBCRZQ9EUkBN56QRLTQq1jTUheBlQRbWnWZNtz8jvwh70aT1HU1Aq', '2019-06-16 20:06:48', '2019-06-16 20:06:48'),
(113, 'suizeu valery', 698641180, '$2y$10$N5UD27OrtdjlUHktVaQCROeXnjk95Oxmfhk.MoCaNmn.5/qUbcFLu', 1, 0, 0, 0, 1, '14t0156', 5, 'GZ05sLwZydjebrZVFaoDdck8WmeDIu2wvZSHgzw2pXjKQB1WfbVxY8eHseCh', '2019-06-16 20:12:46', '2019-06-16 20:12:46'),
(114, 'tchowa', 670070213, '$2y$10$e4Ui46zVex1p5zPYBGSB3OfIzYez9P71CBZFypPQB2reO.KwpImpC', 1, 0, 0, 0, 0, '14t0209', 5, '6MbnfLuYlQfNgIRO0NGbBUW08vKIJ2uUEO0jmAJriDoghjgDcuWGwSIA1cZi', '2019-06-22 16:18:52', '2019-06-22 16:18:52');

-- --------------------------------------------------------

--
-- Structure de la table `written_test_papers`
--

CREATE TABLE `written_test_papers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `test_paper_id` int(10) UNSIGNED NOT NULL,
  `mark_obtained` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `written_test_papers`
--

INSERT INTO `written_test_papers` (`id`, `user_id`, `test_paper_id`, `mark_obtained`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 23, NULL, NULL),
(2, 9, 1, 25, NULL, NULL),
(3, 10, 1, 22, NULL, NULL),
(4, 11, 1, 13, NULL, NULL),
(5, 12, 1, 19, NULL, NULL),
(6, 56, 1, 19, NULL, NULL),
(7, 57, 1, 28, NULL, NULL),
(8, 58, 1, 25, NULL, NULL),
(9, 71, 1, 18, NULL, NULL),
(10, 72, 1, 27, NULL, NULL),
(11, 73, 1, 27, NULL, NULL),
(12, 86, 1, 29, NULL, NULL),
(13, 87, 1, 30, NULL, NULL),
(14, 88, 1, 26, NULL, NULL),
(15, 89, 1, 15, NULL, NULL),
(16, 90, 1, 20, NULL, NULL),
(17, 91, 1, 11, NULL, NULL),
(18, 92, 1, 27, NULL, NULL),
(19, 93, 1, 28, NULL, NULL),
(20, 93, 1, 2, NULL, NULL),
(21, 94, 1, 28, NULL, NULL),
(22, 95, 1, 14, NULL, NULL),
(23, 96, 1, 18, NULL, NULL),
(24, 97, 1, 28, NULL, NULL),
(25, 108, 1, 22, NULL, NULL),
(26, 109, 1, 28, NULL, NULL),
(27, 110, 1, 14, NULL, NULL),
(28, 111, 1, 18, NULL, NULL),
(29, 112, 1, 28, NULL, NULL),
(30, 113, 1, 17, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_code_unique` (`code`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `question_distractors`
--
ALTER TABLE `question_distractors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `repeating_courses`
--
ALTER TABLE `repeating_courses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `test_papers`
--
ALTER TABLE `test_papers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_matricule_unique` (`matricule`);

--
-- Index pour la table `written_test_papers`
--
ALTER TABLE `written_test_papers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `question_distractors`
--
ALTER TABLE `question_distractors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `repeating_courses`
--
ALTER TABLE `repeating_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `test_papers`
--
ALTER TABLE `test_papers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT pour la table `written_test_papers`
--
ALTER TABLE `written_test_papers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
