-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 25 Feb 2025 pada 06.59
-- Versi server: 10.11.9-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `endpoint`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `device`
--

CREATE TABLE `device` (
  `device_id` varchar(255) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `mac_address` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `device`
--

INSERT INTO `device` (`device_id`, `device_name`, `ip_address`, `mac_address`, `type`, `description`) VALUES
('e-nose_1', 'Electronic Nose prototype', '', '', 'e-nose', ''),
('edge_1', 'raspi DC', '', '', 'edge', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `device_user_mapping`
--

CREATE TABLE `device_user_mapping` (
  `user_name` varchar(255) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `device_user_mapping`
--

INSERT INTO `device_user_mapping` (`user_name`, `device_id`, `description`) VALUES
('dedyrw', 'e-nose_1', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_enose`
--

CREATE TABLE `transaction_enose` (
  `user_key` text NOT NULL,
  `device_id` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `type` varchar(200) NOT NULL,
  `data_send` text NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaction_enose`
--

INSERT INTO `transaction_enose` (`user_key`, `device_id`, `date_time`, `type`, `data_send`, `value`) VALUES
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', '10.251.251.172:8080', '2025-02-07 15:41:57', 'greentea', '[{\"MQ3\":562,\"TGS822\":36,\"TGS2602\":48,\"MQ5\":46,\"MQ138\":394,\"TGS2620\":63}]', '{\"0\":{\"Class\":\"Cacat Mutu\",\"Score\":[42.6],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1/1.0', '2025-02-07 15:42:51', 'greentea', '[{\"MQ3\":562,\"TGS822\":36,\"TGS2602\":48,\"MQ5\":46,\"MQ138\":394,\"TGS2620\":63}]', '{\"0\":{\"Class\":\"Cacat Mutu\",\"Score\":[42.6],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-07 15:43:13', 'greentea', '[{\"MQ3\":562,\"TGS822\":36,\"TGS2602\":48,\"MQ5\":46,\"MQ138\":394,\"TGS2620\":63}]', '{\"0\":{\"Class\":\"Cacat Mutu\",\"Score\":[42.6],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'python-requests/2.32.3', '2025-02-07 15:46:39', 'greentea', '[{\"MQ3\":488.1333333333,\"TGS822\":34.5333333333,\"TGS2602\":42.1166666667,\"MQ5\":48.3333333333,\"MQ138\":345.7333333333,\"TGS2620\":69.7166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.6],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-07 15:51:46', 'greentea', '[{\"MQ3\":522.9833333333,\"TGS822\":37.9,\"TGS2602\":45.9166666667,\"MQ5\":50.7666666667,\"MQ138\":356.2833333333,\"TGS2620\":69.5166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-07 16:05:30', 'greentea', '[{\"MQ3\":562,\"TGS822\":36,\"TGS2602\":48,\"MQ5\":46,\"MQ138\":394,\"TGS2620\":63}]', '{\"0\":{\"Class\":\"Cacat Mutu\",\"Score\":[42.6],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-07 16:17:39', 'greentea', '[{\"MQ3\":520.5833333333,\"TGS822\":37.7666666667,\"TGS2602\":45.9333333333,\"MQ5\":50.0,\"MQ138\":354.2666666667,\"TGS2620\":67.7666666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-07 16:22:25', 'greentea', '[{\"MQ3\":510.65,\"TGS822\":36.65,\"TGS2602\":44.5,\"MQ5\":52.0,\"MQ138\":374.35,\"TGS2620\":77.9333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.4],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 12:40:54', 'greentea', '[{\"MQ3\":510.0,\"TGS822\":35.2166666667,\"TGS2602\":42.0,\"MQ5\":52.0,\"MQ138\":337.0,\"TGS2620\":55.0}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 13:12:57', 'greentea', '[{\"MQ3\":510.0333333333,\"TGS822\":35.4166666667,\"TGS2602\":41.1166666667,\"MQ5\":50.1833333333,\"MQ138\":336.05,\"TGS2620\":54.8833333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 13:34:05', 'greentea', '[{\"MQ3\":501.4333333333,\"TGS822\":34.9333333333,\"TGS2602\":40.3166666667,\"MQ5\":49.3166666667,\"MQ138\":335.65,\"TGS2620\":54.25}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 14:02:15', 'greentea', '[{\"MQ3\":499.5333333333,\"TGS822\":34.55,\"TGS2602\":39.3833333333,\"MQ5\":48.1166666667,\"MQ138\":334.0166666667,\"TGS2620\":54.0166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 14:13:53', 'greentea', '[{\"MQ3\":499.6,\"TGS822\":35.2666666667,\"TGS2602\":40.1,\"MQ5\":48.7166666667,\"MQ138\":335.0,\"TGS2620\":53.9166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 15:02:56', 'greentea', '[{\"MQ3\":498.55,\"TGS822\":34.4333333333,\"TGS2602\":39.3333333333,\"MQ5\":47.2166666667,\"MQ138\":333.0166666667,\"TGS2620\":53.0}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 15:12:06', 'greentea', '[{\"MQ3\":505.9833333333,\"TGS822\":35.0,\"TGS2602\":39.6333333333,\"MQ5\":46.7,\"MQ138\":331.9166666667,\"TGS2620\":52.7833333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 15:34:39', 'greentea', '[{\"MQ3\":508.05,\"TGS822\":36.75,\"TGS2602\":41.0166666667,\"MQ5\":47.9,\"MQ138\":335.85,\"TGS2620\":54.0333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 15:55:02', 'greentea', '[{\"MQ3\":510.1,\"TGS822\":36.85,\"TGS2602\":42.6833333333,\"MQ5\":48.6666666667,\"MQ138\":339.7666666667,\"TGS2620\":57.0}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 16:00:13', 'greentea', '[{\"MQ3\":503.4666666667,\"TGS822\":36.1833333333,\"TGS2602\":42.3,\"MQ5\":48.6,\"MQ138\":339.25,\"TGS2620\":59.0333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-10 16:18:10', 'greentea', '[{\"MQ3\":513.1333333333,\"TGS822\":36.9833333333,\"TGS2602\":45.0,\"MQ5\":49.2,\"MQ138\":347.5833333333,\"TGS2620\":61.1333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.6],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-12 12:44:17', 'greentea', '[{\"MQ3\":509.8,\"TGS822\":37.3666666667,\"TGS2602\":47.05,\"MQ5\":63.8666666667,\"MQ138\":354.5333333333,\"TGS2620\":68.1333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-12 13:18:00', 'greentea', '[{\"MQ3\":519.4666666667,\"TGS822\":38.7333333333,\"TGS2602\":48.0,\"MQ5\":60.1333333333,\"MQ138\":356.3666666667,\"TGS2620\":69.7833333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-12 13:21:42', 'greentea', '[{\"MQ3\":519.05,\"TGS822\":38.15,\"TGS2602\":47.1666666667,\"MQ5\":59.1166666667,\"MQ138\":353.4166666667,\"TGS2620\":68.5666666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-12 13:51:18', 'greentea', '[{\"MQ3\":510.35,\"TGS822\":37.3666666667,\"TGS2602\":47.2,\"MQ5\":56.6,\"MQ138\":355.0333333333,\"TGS2620\":68.0166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-12 14:01:50', 'greentea', '[{\"MQ3\":519.0,\"TGS822\":38.0833333333,\"TGS2602\":47.1166666667,\"MQ5\":55.2166666667,\"MQ138\":351.6166666667,\"TGS2620\":67.25}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-12 15:22:18', 'greentea', '[{\"MQ3\":514.8666666667,\"TGS822\":37.0,\"TGS2602\":41.95,\"MQ5\":48.0,\"MQ138\":338.0,\"TGS2620\":58.4666666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-12 16:12:35', 'greentea', '[{\"MQ3\":510.3666666667,\"TGS822\":36.0833333333,\"TGS2602\":40.35,\"MQ5\":46.1166666667,\"MQ138\":340.2333333333,\"TGS2620\":56.5166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-12 16:35:38', 'greentea', '[{\"MQ3\":503.4666666667,\"TGS822\":36.3666666667,\"TGS2602\":40.9,\"MQ5\":47.1166666667,\"MQ138\":344.6833333333,\"TGS2620\":58.65}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-13 11:20:46', 'greentea', '[{\"MQ3\":523.5,\"TGS822\":38.0333333333,\"TGS2602\":47.0666666667,\"MQ5\":57.2833333333,\"MQ138\":361.7666666667,\"TGS2620\":71.5}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[46.9],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-13 11:45:57', 'greentea', '[{\"MQ3\":523.3166666667,\"TGS822\":37.2,\"TGS2602\":45.5833333333,\"MQ5\":52.2166666667,\"MQ138\":354.4,\"TGS2620\":67.15}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.4],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-13 13:38:46', 'greentea', '[{\"MQ3\":515.2833333333,\"TGS822\":36.3833333333,\"TGS2602\":48.1833333333,\"MQ5\":50.15,\"MQ138\":363.0,\"TGS2620\":72.4833333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-13 15:27:26', 'greentea', '[{\"MQ3\":526.7333333333,\"TGS822\":38.9,\"TGS2602\":48.8833333333,\"MQ5\":51.7166666667,\"MQ138\":371.0,\"TGS2620\":78.9333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-13 15:42:11', 'greentea', '[{\"MQ3\":526.9333333333,\"TGS822\":39.4666666667,\"TGS2602\":49.6666666667,\"MQ5\":51.4333333333,\"MQ138\":370.7833333333,\"TGS2620\":80.3333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 11:13:37', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":59,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 20:39:20', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":59,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 20:56:38', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":59,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 20:58:37', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":59,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 21:16:25', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":59,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 21:20:12', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":59,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 21:21:53', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":58,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 21:22:28', 'greentea', '[{\"MQ3\":548,\"TGS822\":39,\"TGS2602\":52,\"MQ5\":50,\"MQ138\":404,\"TGS2620\":70}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.2],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 21:27:47', 'greentea', '[{\"MQ3\":549,\"TGS822\":38,\"TGS2602\":49,\"MQ5\":48,\"MQ138\":408,\"TGS2620\":64}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[51.9],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 21:30:00', 'greentea', '[{\"MQ3\":560,\"TGS822\":35,\"TGS2602\":45,\"MQ5\":47,\"MQ138\":384,\"TGS2620\":61}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[0.0],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 21:31:51', 'greentea', '[{\"MQ3\":549,\"TGS822\":38,\"TGS2602\":49,\"MQ5\":48,\"MQ138\":408,\"TGS2620\":64}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[51.9],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 21:36:57', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":59,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-15 22:00:22', 'greentea', '[{\"MQ3\":560,\"TGS822\":35,\"TGS2602\":45,\"MQ5\":47,\"MQ138\":384,\"TGS2620\":61}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[0.0],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 11:25:20', 'greentea', '[{\"MQ3\":527.9833333333,\"TGS822\":42.0333333333,\"TGS2602\":56.1333333333,\"MQ5\":132.9666666667,\"MQ138\":407.65,\"TGS2620\":93.3166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[45.9],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 11:36:56', 'greentea', '[{\"MQ3\":529.0166666667,\"TGS822\":41.7666666667,\"TGS2602\":53.7166666667,\"MQ5\":103.9333333333,\"MQ138\":392.1,\"TGS2620\":86.0166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.7],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 11:52:20', 'greentea', '[{\"MQ3\":530.7166666667,\"TGS822\":41.8333333333,\"TGS2602\":54.0333333333,\"MQ5\":91.2166666667,\"MQ138\":387.9166666667,\"TGS2620\":86.7166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.7],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 12:11:52', 'greentea', '[{\"MQ3\":531.7,\"TGS822\":40.8333333333,\"TGS2602\":53.25,\"MQ5\":78.9333333333,\"MQ138\":380.8166666667,\"TGS2620\":84.5666666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.7],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 12:21:03', 'greentea', '[{\"MQ3\":531.9,\"TGS822\":40.8666666667,\"TGS2602\":51.7666666667,\"MQ5\":71.7833333333,\"MQ138\":374.3333333333,\"TGS2620\":79.7333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.7],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 12:28:49', 'greentea', '[{\"MQ3\":531.8666666667,\"TGS822\":40.2833333333,\"TGS2602\":50.9166666667,\"MQ5\":67.9333333333,\"MQ138\":370.7,\"TGS2620\":76.9666666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 13:50:25', 'greentea', '[{\"MQ3\":521.5666666667,\"TGS822\":37.1666666667,\"TGS2602\":43.1333333333,\"MQ5\":50.1166666667,\"MQ138\":348.5,\"TGS2620\":59.5333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.1],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 14:05:36', 'greentea', '[{\"MQ3\":524.0,\"TGS822\":37.9,\"TGS2602\":44.0,\"MQ5\":51.95,\"MQ138\":354.45,\"TGS2620\":63.2333333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.6],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 14:11:27', 'greentea', '[{\"MQ3\":524.4666666667,\"TGS822\":37.9,\"TGS2602\":43.5833333333,\"MQ5\":51.15,\"MQ138\":350.35,\"TGS2620\":63.1166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.6],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 14:18:27', 'greentea', '[{\"MQ3\":525.0,\"TGS822\":38.0,\"TGS2602\":44.0166666667,\"MQ5\":51.5333333333,\"MQ138\":352.4166666667,\"TGS2620\":63.75}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.6],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 14:35:42', 'greentea', '[{\"MQ3\":526.0333333333,\"TGS822\":38.65,\"TGS2602\":45.9166666667,\"MQ5\":52.9166666667,\"MQ138\":357.6333333333,\"TGS2620\":66.8666666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.4],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 14:53:54', 'greentea', '[{\"MQ3\":526.0,\"TGS822\":38.0,\"TGS2602\":43.75,\"MQ5\":50.0,\"MQ138\":348.55,\"TGS2620\":64.1833333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.6],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 15:18:34', 'greentea', '[{\"MQ3\":526.0333333333,\"TGS822\":38.4833333333,\"TGS2602\":43.9666666667,\"MQ5\":49.6666666667,\"MQ138\":349.4333333333,\"TGS2620\":63.9833333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.6],\"Multiclass\":[\"D\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-17 15:40:24', 'greentea', '[{\"MQ3\":516.25,\"TGS822\":37.4,\"TGS2602\":44.25,\"MQ5\":49.8666666667,\"MQ138\":354.45,\"TGS2620\":65.0}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-18 10:39:47', 'greentea', '[{\"MQ3\":566,\"TGS822\":40,\"TGS2602\":65,\"MQ5\":62,\"MQ138\":408,\"TGS2620\":80}]', '{\"0\":{\"Class\":\"Cacat Mutu\",\"Score\":[48.7],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-18 10:53:19', 'greentea', '[{\"MQ3\":566,\"TGS822\":40,\"TGS2602\":65,\"MQ5\":62,\"MQ138\":408,\"TGS2620\":80}]', '{\"0\":{\"Class\":\"Cacat Mutu\",\"Score\":[48.7],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-18 11:14:41', 'greentea', '[{\"MQ3\":566,\"TGS822\":40,\"TGS2602\":65,\"MQ5\":62,\"MQ138\":408,\"TGS2620\":80}]', '{\"0\":{\"Class\":\"Cacat Mutu\",\"Score\":[48.7],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-20 14:58:41', 'greentea', '[{\"MQ3\":519.4833333333,\"TGS822\":43.9666666667,\"TGS2602\":53.1666666667,\"MQ5\":60.1,\"MQ138\":373.3333333333,\"TGS2620\":81.7833333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.7],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-20 15:10:44', 'greentea', '[{\"MQ3\":516.3833333333,\"TGS822\":42.8333333333,\"TGS2602\":49.3833333333,\"MQ5\":54.3666666667,\"MQ138\":360.5166666667,\"TGS2620\":72.6166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.8],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-21 11:38:38', 'greentea', '[{\"MQ3\":560,\"TGS822\":35,\"TGS2602\":45,\"MQ5\":47,\"MQ138\":384,\"TGS2620\":61}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[0.0],\"Multiclass\":[\"A\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-21 11:39:26', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":59,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-21 11:42:04', 'greentea', '[{\"MQ3\":549,\"TGS822\":40,\"TGS2602\":59,\"MQ5\":53,\"MQ138\":416,\"TGS2620\":74}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[50.6],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-21 20:02:28', 'greentea', '[{\"MQ3\":557,\"TGS822\":38,\"TGS2602\":46,\"MQ5\":48,\"MQ138\":402,\"TGS2620\":63}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[47.2],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-21 20:04:27', 'greentea', '[{\"MQ3\":554,\"TGS822\":38,\"TGS2602\":44,\"MQ5\":47,\"MQ138\":396,\"TGS2620\":61}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.5],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-21 20:09:25', 'greentea', '[{\"MQ3\":554,\"TGS822\":38,\"TGS2602\":44,\"MQ5\":47,\"MQ138\":396,\"TGS2620\":61}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[49.5],\"Multiclass\":[\"E\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-24 14:13:11', 'greentea', '[{\"MQ3\":520.6666666667,\"TGS822\":51.6833333333,\"TGS2602\":58.1,\"MQ5\":74.0166666667,\"MQ138\":375.2,\"TGS2620\":84.1666666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.7],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-24 14:46:32', 'greentea', '[{\"MQ3\":518.0166666667,\"TGS822\":52.2666666667,\"TGS2602\":58.4,\"MQ5\":72.4166666667,\"MQ138\":371.95,\"TGS2620\":84.0166666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.7],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-24 15:12:13', 'greentea', '[{\"MQ3\":517.0,\"TGS822\":51.05,\"TGS2602\":57.05,\"MQ5\":70.0166666667,\"MQ138\":370.7166666667,\"TGS2620\":82.2833333333}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.7],\"Multiclass\":[\"C\"]}}'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk', 'e-nose_1', '2025-02-24 15:16:14', 'greentea', '[{\"MQ3\":517.0,\"TGS822\":51.4333333333,\"TGS2602\":57.8,\"MQ5\":70.1333333333,\"MQ138\":371.0666666667,\"TGS2620\":83.0666666667}]', '{\"0\":{\"Class\":\"Baik\",\"Score\":[44.7],\"Multiclass\":[\"C\"]}}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_object_detection`
--

CREATE TABLE `transaction_object_detection` (
  `detection_time` datetime NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `device_id` varchar(255) DEFAULT '1',
  `user_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaction_object_detection`
--

INSERT INTO `transaction_object_detection` (`detection_time`, `type`, `value`, `device_id`, `user_key`) VALUES
('2025-02-19 13:09:43', 'car', 5, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:09:43', 'bus', 3, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:09:43', 'bicycle', 15, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:09:43', 'people', 36, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:10:21', 'car', 5, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:10:21', 'bus', 3, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:10:21', 'bicycle', 15, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:10:21', 'people', 36, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:11:44', 'car', 5, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:11:44', 'bus', 3, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:11:44', 'bicycle', 15, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 13:11:44', 'people', 36, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 14:51:11', 'dosen-staff', 1, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-19 14:51:11', 'mahasiswa', 1, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-20 14:59:12', 'mahasiswa', 1, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-20 15:01:42', 'mahasiswa', 1, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk'),
('2025-02-20 15:09:05', 'mahasiswa', 1, 'edge_1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJsaWNfaWQiOiI5OTRlZmIxNi01N2Y3LTQwZmItYTgyZi1kYmFhNGZiYTUwODEiLCJleHAiOjE2NjA5NzIyNjF9.oKQl5BMeQq1RGsHvqG2ROBn0Qb3iYyNpphOGZpG0oKk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_group` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_name`, `password`, `user_group`, `status`) VALUES
('dedyrw', 'jangansampailupa', 'admin', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_detail`
--

CREATE TABLE `user_detail` (
  `user_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`);

--
-- Indeks untuk tabel `device_user_mapping`
--
ALTER TABLE `device_user_mapping`
  ADD PRIMARY KEY (`user_name`,`device_id`),
  ADD KEY `fk_device_mapping` (`device_id`);

--
-- Indeks untuk tabel `transaction_enose`
--
ALTER TABLE `transaction_enose`
  ADD KEY `fk_device_enose_transaction` (`device_id`);

--
-- Indeks untuk tabel `transaction_object_detection`
--
ALTER TABLE `transaction_object_detection`
  ADD KEY `fk_device_object_detection_transaction` (`device_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_name`);

--
-- Indeks untuk tabel `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`user_name`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `device_user_mapping`
--
ALTER TABLE `device_user_mapping`
  ADD CONSTRAINT `fk_device_mapping` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_mapping` FOREIGN KEY (`user_name`) REFERENCES `user` (`user_name`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction_enose`
--
ALTER TABLE `transaction_enose`
  ADD CONSTRAINT `fk_device_enose_transaction` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`);

--
-- Ketidakleluasaan untuk tabel `transaction_object_detection`
--
ALTER TABLE `transaction_object_detection`
  ADD CONSTRAINT `fk_device_object_detection_transaction` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_detail`
--
ALTER TABLE `user_detail`
  ADD CONSTRAINT `fk_user_detail` FOREIGN KEY (`user_name`) REFERENCES `user` (`user_name`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
