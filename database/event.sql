-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 24 avr. 2022 à 17:35
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `event`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `name`, `website`, `comment`, `event_id`, `created_at`, `updated_at`, `email`) VALUES
(1, 'Philippe', 'geekofgeek.com', 'very nice event indeed. I appreciate', 2, '2022-04-08 11:46:52', '2022-04-08 11:46:52', 'philtsongo90@gmail.com'),
(2, 'Philippe', NULL, 'It sounds good this event!', 2, '2022-04-08 12:09:11', '2022-04-08 12:09:11', 'philtsongo90@gmail.com'),
(3, 'Jonas', NULL, 'whaouh! it gonna be good this event.', 2, '2022-04-08 12:10:08', '2022-04-08 12:10:08', 'Jonasmumber@gmail.com'),
(4, 'Zed', 'www.zedking.com', 'wow! what a good event is this?', 4, '2022-04-08 14:03:24', '2022-04-08 14:03:24', 'zedking@gmail.com'),
(5, 'Joseph', 'letcode.com', 'Whaouh! what a great event', 5, '2022-04-11 10:47:49', '2022-04-11 10:47:49', 'Joseph@gmail.com'),
(6, 'Moise', NULL, 'Whouh. very nice', 9, '2022-04-12 07:44:08', '2022-04-12 07:44:08', 'moisesive@gmail.com'),
(7, 'Philippe', NULL, 'wow! what a good event!', 6, '2022-04-20 12:13:11', '2022-04-20 12:13:11', 'philtsongo90@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `starts_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `slug`, `content`, `premium`, `starts_at`, `end_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Event 1', 'event', 'Super Event 1', 0, '2022-04-28 13:09:15', '2022-04-21 14:11:32', 1, '2022-04-07 11:55:14', '2022-04-12 10:59:56'),
(2, 'Event 2', 'event-2', 'Super Event 2. The greatest one.', 0, '2022-04-30 13:58:33', '2022-04-21 14:11:41', 3, '2022-04-07 11:56:11', '2022-04-13 11:58:33'),
(3, 'Event 3', 'event-3', 'Super Event 3', 1, '2022-04-27 15:18:55', '2022-04-21 14:11:51', 2, '2022-04-07 12:09:07', '2022-04-07 12:09:07'),
(4, 'Event 4', 'event-4', 'Super Event 4  a good event', 1, '2022-05-04 14:16:45', '2022-04-21 14:12:02', 3, '2022-04-08 13:43:10', '2022-04-13 12:16:45'),
(5, 'Event 5', 'event-5', 'Super Event 5', 0, '2022-05-02 22:00:00', '2022-04-21 14:12:46', 3, '2022-04-10 12:12:44', '2022-04-11 12:02:10'),
(6, 'Event 6', 'event-6', 'super event 6', 0, '2022-04-26 11:33:01', '2022-04-21 14:13:02', 2, '2022-04-11 10:53:38', '2022-04-11 11:46:04'),
(7, 'Event 7', 'event-7', 'Super Event 7', 0, '2022-04-12 11:33:04', '2022-04-12 11:33:04', 1, '2022-04-11 11:15:21', '2022-04-11 11:19:34'),
(8, 'Event 8', 'event-8', 'Super Event 8', 0, '2022-04-21 22:00:00', '2022-04-12 10:03:20', 3, '2022-04-11 13:09:17', '2022-04-12 08:03:20');

-- --------------------------------------------------------

--
-- Structure de la table `event_tag`
--

CREATE TABLE `event_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event_tag`
--

INSERT INTO `event_tag` (`id`, `event_id`, `tag_id`) VALUES
(1, 7, 8),
(2, 7, 4),
(3, 6, 9),
(4, 6, 10),
(5, 5, 11),
(6, 2, 4),
(7, 9, 9),
(8, 8, 4),
(9, 8, 1),
(10, 1, 8),
(11, 1, 4),
(12, 2, 4),
(13, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `imageprofiles`
--

CREATE TABLE `imageprofiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `path`, `event_id`, `created_at`, `updated_at`) VALUES
(1, 'eventsimages/16493397141493780435', 1, '2022-04-07 11:55:14', '2022-04-07 11:55:14'),
(2, 'eventsimages/1649339771556958608', 2, '2022-04-07 11:56:12', '2022-04-07 11:56:12'),
(3, 'eventsimages/1649340547426512121', 3, '2022-04-07 12:09:07', '2022-04-07 12:09:07'),
(4, 'eventsimages/16494325901562690195', 4, '2022-04-08 13:43:11', '2022-04-08 13:43:11'),
(5, 'eventsimages/164959963279285543', 5, '2022-04-10 12:07:12', '2022-04-10 12:07:12'),
(6, 'eventsimages/1649599964954258952', 6, '2022-04-10 12:12:44', '2022-04-10 12:12:44'),
(7, 'eventsimages/1649681618938946528', 6, '2022-04-11 10:53:38', '2022-04-11 10:53:38'),
(8, 'eventsimages/1649682921173895083', 7, '2022-04-11 11:15:21', '2022-04-11 11:15:21'),
(9, 'eventsimages/1649689757148775954', 8, '2022-04-11 13:09:18', '2022-04-11 13:09:18'),
(10, 'eventsimages/1649691865973745479', 9, '2022-04-11 13:44:25', '2022-04-11 13:44:25');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(123, '2014_10_12_000000_create_users_table', 1),
(124, '2014_10_12_100000_create_password_resets_table', 1),
(125, '2019_08_19_000000_create_failed_jobs_table', 1),
(126, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(127, '2022_04_03_144646_create_events_table', 1),
(128, '2022_04_03_145623_create_tags_table', 1),
(129, '2022_04_03_164417_create_event_tag_table', 1),
(130, '2022_04_07_130923_create_image_table', 2),
(131, '2022_04_08_120742_create_comments_table', 3),
(132, '2022_04_08_121243_add_email_row_to_comments_table', 4),
(133, '2022_04_11_130125_create_event_tag_table', 5),
(134, '2022_04_11_141022_add_tag_id_row_to_events_table', 6),
(135, '2022_04_13_113215_add_admin_row_to_users_table', 7),
(136, '2022_04_14_124902_create_newsletter_table', 8),
(137, '2022_04_14_124902_create_newsletters_table', 9),
(138, '2022_04_18_125534_add_last_name_and_location_row_to_users_table', 10),
(139, '2022_04_18_130039_add_last_name_and_location_row_to_users_table', 11),
(140, '2022_04_18_134347_create_introduction_table', 12),
(141, '2022_04_18_134347_create_introductions_table', 13),
(142, '2022_04_18_141606_create_introductions_table', 14),
(143, '2022_04_18_143816_create_imageprofiles_table', 15),
(144, '2022_04_18_151454_add_intro_row_to_users_table', 16);

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `newsletters`
--

INSERT INTO `newsletters` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Philippe', 'philippetsongo90@gmail.com', '2022-04-14 11:15:11', '2022-04-14 11:15:11'),
(2, 'Patrique', 'patrique@gmail.com', '2022-04-14 11:21:46', '2022-04-14 11:21:46'),
(3, 'Joseph', 'Joseph@gmail.com', '2022-04-14 11:25:07', '2022-04-14 11:25:07'),
(4, 'Jonas', 'Jonasmumber@gmail.com', '2022-04-14 11:27:38', '2022-04-14 11:27:38'),
(5, 'Jim', 'jim90@gmail.com', '2022-04-24 12:46:46', '2022-04-24 12:46:46');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'php', 'php', '2022-04-05 12:20:22', '2022-04-05 12:20:22'),
(2, 'js', 'js', '2022-04-05 12:20:22', '2022-04-05 12:20:22'),
(3, 'laravel', 'laravel', '2022-04-05 12:20:22', '2022-04-05 12:20:22'),
(4, 'Java', 'java', '2022-04-07 11:46:53', '2022-04-07 11:46:53'),
(5, 'JavasScript', 'javasscript', '2022-04-07 11:46:53', '2022-04-07 11:46:53'),
(6, 'MySql', 'mysql', '2022-04-07 11:56:12', '2022-04-07 11:56:12'),
(7, 'Jquery', 'jquery', '2022-04-07 11:56:12', '2022-04-07 11:56:12'),
(8, 'JavasScript, Ajax', 'javasscript-ajax', '2022-04-11 11:15:21', '2022-04-13 13:34:54'),
(9, 'php, js, laravel', 'php-js-laravel', '2022-04-11 11:45:34', '2022-04-11 11:45:34'),
(10, 'php, js', 'php-js', '2022-04-11 11:46:04', '2022-04-11 11:46:04'),
(11, 'MySql, Php, Jquery', 'mysql-php-jquery', '2022-04-11 12:02:10', '2022-04-11 12:02:10');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `admin`, `last_name`, `location`, `intro`) VALUES
(1, 'Philippe', 'philippetsongo90@gmail.com', NULL, '$2y$10$jF0UaZJAC7TtvemmpC82m.VJmgX4.jY7K8m2mbcyF0SqDMt7nhYUC', NULL, '2022-04-12 09:30:54', '2022-04-20 09:15:24', 1, 'Tsongo', 'Goma', 'I\'m Phil Tsongo'),
(2, 'Patrique', 'patriquemugisho@gmail.com', NULL, '$2y$10$KS9rMZDUjJ8lkNba1cOygu.R97wL6ValodnogELGetEbHiy4KT1eS', NULL, '2022-04-12 09:31:20', '2022-04-18 14:00:27', 0, 'Mugisho', 'Bukavu', 'Tout va bien'),
(3, 'Joseph', 'joseph@gmail.com', NULL, '$2y$10$aocnc5zi9FyR6yjJoPL5WOFLjyEBYBatXDi6eFqooHyyhihdOw0Ay', NULL, '2022-04-15 12:17:08', '2022-04-18 13:23:55', NULL, 'Jodrack', 'Kigali', 'hi! I\'m coding'),
(4, 'jacob', 'jacobkamate@gmail.com', NULL, '$2y$10$6pHM2lnehdgPMVGc3bs3B.hW2pc3frrvrmcscSTduiMXpb00Vkm8.', NULL, '2022-04-24 13:29:51', '2022-04-24 13:29:51', NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `event_tag`
--
ALTER TABLE `event_tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `imageprofiles`
--
ALTER TABLE `imageprofiles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `event_tag`
--
ALTER TABLE `event_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `imageprofiles`
--
ALTER TABLE `imageprofiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT pour la table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
