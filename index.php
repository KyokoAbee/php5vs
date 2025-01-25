<?php
session_start();
include('FUNCTION.php');

// データベース接続
$pdo = connect_to_db();

// コメント情報を取得するSQL
// $sql = 'SELECT comment_title, comment, created_at 
//         FROM comment_table 
//         WHERE deleted_at IS NULL 
//         ORDER BY created_at DESC';

$sql = 'SELECT id, comment_title, SUBSTRING(comment, 1, 50) AS comment_excerpt, created_at 
FROM comment_table 
WHERE deleted_at IS NULL 
ORDER BY created_at DESC';


$stmt = $pdo->prepare($sql);

try {
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>悩み・質問投稿</title>
    <link rel="stylesheet" href="./css/toppage.css">
</head>
<header>
  
    </header>

    <div class="container">
        <h2></h2>
        <a href="login.php" class="cta-button">投稿をして、あなたにピッタリの本と出会おう</a>

        <h2>投稿されたコメント一覧</h2>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
            <div class="comment-title">
                <a href="kadai_post_detail.php?id=<?= htmlspecialchars($comment['id']) ?>">
                    <?= htmlspecialchars($comment['comment_title']) ?>
                </a>
            </div>
            <a href="kadai_post_detail.php?id=<?= htmlspecialchars($comment['id']) ?>">
                <div class="comment-body"><?= nl2br(htmlspecialchars($comment['comment_excerpt'])) ?>...</div>
                </a>

            <div class="comment-info">
                投稿日: <?= htmlspecialchars($comment['created_at']) ?>
                </div>
            </div>
            <?php endforeach; ?>
    </div>

    <footer>
        &copy; 2025 あなたの読書サポートサイト
    </footer>

</html>