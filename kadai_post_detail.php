<?php
session_start();
include('FUNCTION.php');

// データベース接続
$pdo = connect_to_db();

// 投稿IDを取得
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>無効なリクエストです。</p>";
    exit();
}

$id = $_GET['id'];

// コメント詳細情報を取得するSQL
$sql = 'SELECT comment_title, comment, created_at 
        FROM comment_table 
        WHERE id = :id AND deleted_at IS NULL';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
    $stmt->execute();
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$comment) {
        echo "<p>指定された投稿は存在しません。</p>";
        exit();
    }
} catch (PDOException $e) {
    echo "<p>エラーが発生しました。</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($comment['comment_title']) ?></title>
    <link rel="stylesheet" href="./css/toppage.css">
</head>
<body>
    <header>
        <!-- 必要ならここにヘッダーコンテンツを追加 -->
    </header>

    <div class="container">
        <h2><?= htmlspecialchars($comment['comment_title']) ?></h2>
        <div class="comment-body"><?= nl2br(htmlspecialchars($comment['comment'])) ?></div>
        <div class="comment-info">
            投稿日: <?= htmlspecialchars($comment['created_at']) ?>
        </div>
        <a href="index.php" class="cta-button">戻る</a>
    </div>

    <footer>
        &copy; 2025 あなたの読書サポートサイト
    </footer>
</body>
</html>


