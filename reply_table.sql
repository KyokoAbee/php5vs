-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2025-01-27 15:16:35
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
-- テーブルの構造 `reply_table`
--

CREATE TABLE `reply_table` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `reply` varchar(10000) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `reply_table`
--

INSERT INTO `reply_table` (`id`, `comment_id`, `userid`, `reply`, `created_at`) VALUES
(1, 2, 2, ' 3人の視点から描かれる物語で、予想外の真実が浮かび上がる衝撃的な結末が特徴です', '2025-01-25 15:17:08'),
(2, 2, 2, '館シリーズの一作目で、最後の一行で世界がひっくり返る驚愕の展開が待っています。', '2025-01-27 21:21:47'),
(3, 1, 3, '作者のユーモアと温かさが詰まったエッセイ集です。日常の出来事や家族とのエピローグが、作者独自の視点で描かれており、読むたびにクスっと笑ってしまいます。', '2025-01-27 22:36:40'),
(4, 2, 2, '天才数学者が繰り広げる巧妙なトリックと感動的な結末が魅力です!!ぜひ読んでみてほしいです。', '2025-01-27 22:37:54');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `reply_table`
--
ALTER TABLE `reply_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `reply_table`
--
ALTER TABLE `reply_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
