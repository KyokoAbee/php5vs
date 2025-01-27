-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2025-01-27 15:16:19
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
-- テーブルの構造 `comment_table`
--

CREATE TABLE `comment_table` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment_title` varchar(1000) NOT NULL,
  `comment` mediumtext NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `comment_table`
--

INSERT INTO `comment_table` (`id`, `userid`, `comment_title`, `comment`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 2, 'サクッと読めて笑えるエッセイを探しています', '部署異動し、多忙な毎日です。寝る前に20 分くらい本を読むのですが、気持ちがリフレッシュできるようなエッセイを探しています。サクッと読めて、クスっと笑えるようなおすすめ本がありましたら是非教えていただきたいです。', '2025-01-24 12:43:15', '2025-01-24 12:43:15', '0000-00-00 00:00:00'),
(2, 3, 'ミステリー小説のおすすめを教えてください', '最近、ミステリー小説に興味があります。どんでん返しがあるような本を探しています。おすすめがあれば教えてください！', '2025-01-24 13:03:45', '2025-01-24 13:03:45', '0000-00-00 00:00:00'),
(3, 4, '進路に悩んでいます。おすすめの本はありますか？', '進路について悩んでいて、将来のことを考えると不安です。将来に対する漠然とした不安があります。進路選びに役立ったり、未来に希望が持てるような本があれば教えてください。', '2025-01-24 13:08:26', '2025-01-24 13:08:26', '0000-00-00 00:00:00');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comment_table`
--
ALTER TABLE `comment_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
