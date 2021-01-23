-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2021 at 01:04 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thetechglitch`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs`
(
    `id`         bigint UNSIGNED                                               NOT NULL,
    `uuid`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci         NOT NULL,
    `queue`      text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci         NOT NULL,
    `payload`    longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci     NOT NULL,
    `exception`  longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci     NOT NULL,
    `failed_at`  timestamp                                                     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ips`
--

CREATE TABLE `ips`
(
    `id`         bigint UNSIGNED                                               NOT NULL,
    `address`    varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `phone`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp                                                     NULL DEFAULT NULL,
    `updated_at` timestamp                                                     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `ips`
--

INSERT INTO `ips` (`id`, `address`, `phone`, `created_at`, `updated_at`)
VALUES (1, 'hello', '254792289271', '2021-01-16 06:51:06', '2021-01-16 06:51:06'),
       (2, 'hello', '254792289271', '2021-01-16 07:00:40', '2021-01-16 07:00:40'),
       (3, 'hello', '254792289271', '2021-01-16 07:38:43', '2021-01-16 07:38:43'),
       (4, 'hello', '254792289271', '2021-01-16 07:44:28', '2021-01-16 07:44:28'),
       (5, 'hello', '254792289271', '2021-01-16 08:01:24', '2021-01-16 08:01:24'),
       (6, 'hello', '254792289271', '2021-01-16 08:01:43', '2021-01-16 08:01:43'),
       (7, 'hello', '254792289271', '2021-01-16 08:04:21', '2021-01-16 08:04:21'),
       (8, '192.168.200.87', '254792289271', '2021-01-16 12:43:31', '2021-01-16 12:43:31'),
       (9, '192.168.200.87', '254792289271', '2021-01-16 12:50:28', '2021-01-16 12:50:28'),
       (10, '192.168.200.87', '254792289271', '2021-01-16 12:51:18', '2021-01-16 12:51:18'),
       (11, '192.168.200.100', '254792289271', '2021-01-16 13:23:38', '2021-01-16 13:23:38'),
       (12, '192.168.200.100', '254792289271', '2021-01-16 13:23:44', '2021-01-16 13:23:44'),
       (13, '192.168.200.93', '254792289271', '2021-01-16 17:56:39', '2021-01-16 17:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages`
(
    `id`         bigint UNSIGNED                                               NOT NULL,
    `username`   varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `phone`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `message`    varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `type`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp                                                     NULL DEFAULT NULL,
    `updated_at` timestamp                                                     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations`
(
    `id`        int UNSIGNED                                                  NOT NULL,
    `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch`     int                                                           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (1, '2014_10_12_000000_create_users_table', 1),
       (2, '2014_10_12_100000_create_password_resets_table', 1),
       (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
       (4, '2019_08_19_000000_create_failed_jobs_table', 1),
       (5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
       (6, '2020_05_21_100000_create_teams_table', 1),
       (7, '2020_05_21_200000_create_team_user_table', 1),
       (8, '2020_11_28_111829_create_sessions_table', 1),
       (9, '2020_11_30_135658_create_payments_table', 1),
       (10, '2020_11_30_140225_create_payment_clicks_table', 1),
       (11, '2020_11_30_140418_create_ips_table', 1),
       (12, '2020_11_30_160520_create_messages_table', 1),
       (13, '2020_12_02_032604_create_packages_table', 1),
       (14, '2020_12_02_032908_create_pppoe_packages_table', 1),
       (15, '2020_12_02_034148_create_subscriptions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages`
(
    `id`         bigint UNSIGNED                                               NOT NULL,
    `name`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `speed`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `devices`    varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `price`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `time`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp                                                     NULL DEFAULT NULL,
    `updated_at` timestamp                                                     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets`
(
    `email`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `token`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp                                                     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments`
(
    `id`             bigint UNSIGNED                                               NOT NULL,
    `phone`          varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `receipt_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `amount`         double                                                        NOT NULL,
    `type`           varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`     timestamp                                                     NULL     DEFAULT CURRENT_TIMESTAMP,
    `updated_at`     timestamp                                                     NULL     DEFAULT CURRENT_TIMESTAMP,
    `checked`        tinyint(1)                                                    NOT NULL DEFAULT '0'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `phone`, `receipt_number`, `amount`, `type`, `created_at`, `updated_at`, `checked`)
VALUES (1, '0792289271', 'PAG6O2U4GA', 30, 'hotspot', '2021-01-16 06:04:00', '2021-01-16 06:04:00', 1),
       (2, '0792289271', 'PAG3OEKYIN', 30, 'hotspot', '2021-01-16 10:51:33', '2021-01-16 10:51:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_clicks`
--

CREATE TABLE `payment_clicks`
(
    `id`         bigint UNSIGNED                                               NOT NULL,
    `phone`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `package`    varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `amount`     double                                                        NOT NULL,
    `type`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp                                                     NULL DEFAULT NULL,
    `updated_at` timestamp                                                     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens`
(
    `id`             bigint UNSIGNED                                               NOT NULL,
    `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `tokenable_id`   bigint UNSIGNED                                               NOT NULL,
    `name`           varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `token`          varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NOT NULL,
    `abilities`      text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `last_used_at`   timestamp                                                     NULL DEFAULT NULL,
    `created_at`     timestamp                                                     NULL DEFAULT NULL,
    `updated_at`     timestamp                                                     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pppoe_packages`
--

CREATE TABLE `pppoe_packages`
(
    `id`         bigint UNSIGNED                                               NOT NULL,
    `name`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `price`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `time`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `speed`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp                                                     NULL DEFAULT NULL,
    `updated_at` timestamp                                                     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions`
(
    `id`            varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id`       bigint UNSIGNED                                              DEFAULT NULL,
    `ip_address`    varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `user_agent`    text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `payload`       text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci         NOT NULL,
    `last_activity` int                                                           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`)
VALUES ('4wCQW72wBWUvYs6oGly7o1Y6bU6dh9ST3wMWALa1', 19, '192.168.200.1',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
        'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiajRnZXRkUGVwTXkwRGpYSE8wQTRleUQyekRRMm1JN2hUYjZSdktpeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9kZXYudGhldGVjaGdsaXRjaC5uZXQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTk7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6MTE6IjFMb3ZlVGVycnkhIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6MTE6IjFMb3ZlVGVycnkhIjt9',
        1610884887),
       ('6m1bvKcVV8BVK3SlaJJ3IZe9dkRGuGysoFn4WSZW', NULL, '192.168.200.1',
        'Mozilla/5.0 (Linux; Android 10; TECNO CD7 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.141 Mobile Safari/537.36',
        'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ285U2pVNUNmbEVrUTE2YUthNkU3VlJGUnhUcVlXODJCVWJUNWRPbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHA6Ly90aGV0ZWNoZ2xpdGNoLm5ldC8/aXA9MTkyLjE2OC4yMDAuNDYmbWFjPURFJTNBMzQlM0E5RSUzQTA1JTNBRjIlM0E0OSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',
        1610882168),
       ('aisij1EAnhGGu22LqAk5Imrw5t1qIxCqAHzJ62Tl', 26, '192.168.200.1',
        'Mozilla/5.0 (Linux; Android 10; STK-L21 Build/HUAWEISTK-L21; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/85.0.4183.101 Mobile Safari/537.36',
        'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOWVKWkxpSW9hZEdlT2tRZXdDS2luTWxoZzBvN3l0WlhaTUc1WG9TSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHA6Ly90aGV0ZWNoZ2xpdGNoLm5ldC8/aXA9MTkyLjE2OC4yMDAuODUmbWFjPTQ0JTNBNTUlM0FDNCUzQTFCJTNBMUQlM0EzNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI2O30=',
        1610883951),
       ('pl2Aw49dmRYaAlJLCFq5oa251n3cBbm0PSoyQSpe', NULL, '192.168.200.46',
        'Mozilla/5.0 (Linux; Android 10; TECNO CD7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36',
        'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUVBOFVKb0U2RnVRYk02MTFrUjVMcU51V0RRNnBRME9MSWkwTHd1WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly90aGV0ZWNoZ2xpdGNoLm5ldCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',
        1610884179),
       ('ryCMofn4pmh7DZxDPVJmoknY1NyqEdhqgJhiVmJG', 19, '192.168.200.1',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
        'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiR051QjRpSnRXYXNIVEQzekFwME8zTFV0dnIydDlLVU5jeTh0ZG55MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly90aGV0ZWNoZ2xpdGNoLm5ldCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjExOiIxTG92ZVRlcnJ5ISI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjExOiIxTG92ZVRlcnJ5ISI7fQ==',
        1610884449),
       ('tY3VI437dseNKgMC15ni3g7ccRTkysM3mGGKlUp9', NULL, '192.168.200.1',
        'Mozilla/5.0 (Linux; Android 10; STK-L21 Build/HUAWEISTK-L21; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/85.0.4183.101 Mobile Safari/537.36',
        'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYWMyZHdlY0NwTWZDM1JwU2RCdEVDaThVZmpSaEdIcUpSNEZTVmNQTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',
        1610883987),
       ('YtFHO1r0gHw1W9jn2d8HDCT4iQnibQwz1AqLeXFH', 18, '192.168.200.46',
        'Mozilla/5.0 (Linux; Android 10; TECNO CD7 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.141 Mobile Safari/537.36',
        'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMEM1ZlEzS0N4TmZqRTJiNXJRb1FTQmZjQURqN3ZVNEJlQzBTOTFFYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHA6Ly90aGV0ZWNoZ2xpdGNoLm5ldC8/aXA9MTkyLjE2OC4yMDAuNDYmbWFjPURFJTNBMzQlM0E5RSUzQTA1JTNBRjIlM0E0OSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE4O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjg6IjEyMzQ1Njc4IjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6ODoiMTIzNDU2NzgiO30=',
        1610884160);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions`
(
    `id`         bigint UNSIGNED                                               NOT NULL,
    `username`   varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `phone`      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `type`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `amount`     varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `package`    varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp                                                     NULL DEFAULT NULL,
    `updated_at` timestamp                                                     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams`
(
    `id`            bigint UNSIGNED                                               NOT NULL,
    `user_id`       bigint UNSIGNED                                               NOT NULL,
    `name`          varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `personal_team` tinyint(1)                                                    NOT NULL,
    `created_at`    timestamp                                                     NULL DEFAULT NULL,
    `updated_at`    timestamp                                                     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `name`, `personal_team`, `created_at`, `updated_at`)
VALUES (1, 1, '\'s Team', 1, '2021-01-05 15:49:54', '2021-01-05 15:49:54'),
       (2, 16, '\'s Team', 1, '2021-01-16 06:49:48', '2021-01-16 06:49:48'),
       (3, 17, '\'s Team', 1, '2021-01-16 11:40:06', '2021-01-16 11:40:06'),
       (4, 18, '\'s Team', 1, '2021-01-16 11:42:23', '2021-01-16 11:42:23'),
       (5, 19, '\'s Team', 1, '2021-01-16 13:22:56', '2021-01-16 13:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user`
(
    `id`         bigint UNSIGNED NOT NULL,
    `team_id`    bigint UNSIGNED NOT NULL,
    `user_id`    bigint UNSIGNED NOT NULL,
    `role`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp       NULL                                          DEFAULT NULL,
    `updated_at` timestamp       NULL                                          DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
    `id`                        bigint UNSIGNED                                               NOT NULL,
    `username`                  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `phone`                     varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`                     varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `password`                  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `two_factor_secret`         text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `admin`                     tinyint(1)                                                    NOT NULL DEFAULT '0',
    `remember_token`            varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `profile_photo_path`        text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `type`                      varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `created_at`                timestamp                                                     NULL     DEFAULT NULL,
    `updated_at`                timestamp                                                     NULL     DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `email`, `password`, `two_factor_secret`, `two_factor_recovery_codes`,
                     `admin`, `remember_token`, `profile_photo_path`, `type`, `created_at`, `updated_at`)
VALUES (18, 'fabianmuema', '0792289271', 'muemafabian@gmail.com', '12345678', NULL, NULL, 0,
        'gL2h3mCeCT9WuljjYxoVpItz89j7tZHQHC60kMdd153ECaRSrFMV3tYM9wpb', NULL, 'Hotspot', '2021-01-16 11:42:23',
        '2021-01-16 11:42:23'),
       (19, 'muema', '0742324193', 'info@thetechglitch.com', '1LoveTerry!', NULL, NULL, 1,
        'cqszNYnjfleELX06ic14XRXbrtnXyngQk0uaifNjfnnxzh2JBAi39Xv6l44w', NULL, 'Hotspot', '2021-01-16 13:22:56',
        '2021-01-16 13:22:56'),
       (20, 'Felista', '0757916726', 'example2@gmail.com', 'Felista1', NULL, NULL, 0, NULL, NULL, 'Hotspot',
        '2021-01-16 13:40:15', '2021-01-16 13:40:15'),
       (21, 'Fleet', '0716794015', 'example4@gmail.com', 'Fl##t', NULL, NULL, 0, NULL, NULL, 'Hotspot',
        '2021-01-16 13:43:01', '2021-01-16 13:43:01'),
       (22, 'Laston', '0740420410', 'example10@gmail.com', 'quelmotdepasse?', NULL, NULL, 0, NULL, NULL, 'Hotspot',
        '2021-01-16 13:45:14', '2021-01-16 13:45:14'),
       (23, 'NelsonOrangi', '0717523979', 'example11@gmail.com', 'flight360', NULL, NULL, 0, NULL, NULL, 'Hotspot',
        '2021-01-16 13:46:51', '2021-01-16 13:46:51'),
       (24, 'Irene', '0710848895', 'exampl@mail.com', 'Irene2015', NULL, NULL, 0, NULL, NULL, 'Hotspot',
        '2021-01-16 13:49:10', '2021-01-16 13:49:10'),
       (25, 'Martin', '0719230366', 'example34@gmail.com', 'martin2030', NULL, NULL, 0, NULL, NULL, 'Hotspot',
        '2021-01-16 13:51:06', '2021-01-16 13:51:06'),
       (26, 'Slyrozee', '0726627190', 'example20@gmail.com', 'slyrozee2029', NULL, NULL, 0,
        'OcBydb4i3V2DG1oCLqwIPCMNAiITaxEonDbeSXbTclTQNSUIYjpg5urcqfVn', NULL, 'Hotspot', '2021-01-16 13:54:35',
        '2021-01-16 13:54:35'),
       (27, 'Fabian', '1234567890', 'muemafaian@gmail.com', '12345', NULL, NULL, 0, NULL, NULL, 'Hotspot',
        '2021-01-16 13:56:54', '2021-01-16 13:56:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `ips`
--
ALTER TABLE `ips`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
    ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_clicks`
--
ALTER TABLE `payment_clicks`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`);

--
-- Indexes for table `pppoe_packages`
--
ALTER TABLE `pppoe_packages`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
    ADD PRIMARY KEY (`id`),
    ADD KEY `sessions_user_id_index` (`user_id`),
    ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
    ADD PRIMARY KEY (`id`),
    ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`, `user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `users_phone_unique` (`phone`),
    ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ips`
--
ALTER TABLE `ips`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 16;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `payment_clicks`
--
ALTER TABLE `payment_clicks`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pppoe_packages`
--
ALTER TABLE `pppoe_packages`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
