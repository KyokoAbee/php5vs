-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2025-01-27 15:16:46
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `encounteringbook`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` varchar(10) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `password`, `gender`, `birthday`, `mail`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test01@contoso.com', '111111', '', '', '', 1, '2025-01-17 22:00:42', '2025-01-17 22:00:42', NULL),
(2, 'testuser02', '222222', '', '', '', 1, '2025-01-17 22:00:42', '2025-01-17 22:00:42', NULL),
(3, 'testuser03', '333333', '', '', '', 0, '2025-01-17 22:00:42', '2025-01-17 22:00:42', NULL),
(4, 'testuser04', '444444', '', '', '', 0, '2025-01-17 22:00:42', '2025-01-17 22:00:42', NULL),
(5, 'aa', 'aaa', '男性', '2025-01-01', 'aa@co.jp', 0, '2025-01-21 20:00:21', '2025-01-21 20:00:21', NULL),
(6, 'aa', 'aaa', '男性', '2025-01-01', 'aa@co.jp', 0, '2025-01-21 20:00:37', '2025-01-21 20:00:37', NULL),
(7, 'bb', 'bbb', '男性', '2025-01-01', 'b@co.jp', 0, '2025-01-21 20:01:23', '2025-01-21 20:01:23', NULL),
(8, 'cc', 'ccc', '男性', '2025-01-02', 'c@co.jp', 0, '2025-01-21 20:02:52', '2025-01-21 20:02:52', NULL),
(9, 'd', 'ddd', '男性', '2025-01-01', 'd@co.jp', 0, '2025-01-21 20:08:21', '2025-01-21 20:08:21', NULL),
(10, 'e', 'eee', '女性', '2025-01-03', 'e@co.jp', 0, '2025-01-21 20:09:37', '2025-01-21 20:09:37', NULL),
(11, 'f', 'fff', '男性', '2025-01-03', 'f@co.jp', 0, '2025-01-21 22:43:25', '2025-01-21 22:43:25', NULL),
(12, '123', '123', '男性', '2025-01-01', '123@co.jp', 0, '2025-01-22 19:08:07', '2025-01-22 19:08:07', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
