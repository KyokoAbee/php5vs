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

// コメント詳細情報を取得するSQL+username も取得
$sql = 'SELECT id, comment_title, comment, created_at, 
                -- users_table からusername を取り出すためのサブクエリ
                (SELECT username FROM users_table WHERE users_table.id = comment_table.userid) AS username 
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

// 返信情報を取得するSQL
// $sql = 'SELECT r.reply, r.created_at, u.username 
//         FROM reply_table r 
//         JOIN users_table u ON r.userid = u.id 
//         WHERE r.comment_id = :comment_id 
//         ORDER BY r.created_at DESC';

$sql = 'SELECT r.id, r.comment_id, u.username, r.reply, r.created_at
FROM reply_table r
JOIN users_table u ON r.userid = u.id
WHERE r.comment_id = :comment_id;
ORDER BY r.created_at DESC';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':comment_id', $id, PDO::PARAM_INT);
$stmt->execute();
$replies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ログインしているかをチェック
$is_logged_in = isset($_SESSION['username']);
// var_dump($is_logged_in); // true か false を確認
// var_dump($_SESSION); // セッション内容を確認
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
            <!-- ログイン済みなら、username 表示 -->
            <?php if ($is_logged_in): ?>
                | 投稿者: <?= htmlspecialchars($comment['username']) ?>
            <?php endif; ?>
        </div>
        <a href="index.php" class="cta-button">戻る</a>
        <!-- ログイン済みなら、返信 -->

        <?php if ($is_logged_in): ?>
            <a href="kadai_reply.php?id=<?= htmlspecialchars($comment['id']) ?>" class="cta-button">返信</a>

        <?php else: ?>
            <a href="kadai_login.php" class="cta-button">ログインして返信</a>
        <?php endif; ?>

        <h3>返信一覧</h3>
        <?php foreach ($replies as $reply): ?>
            <div class="reply">
                <div class="reply-body"><?= nl2br(htmlspecialchars($reply['reply'])) ?></div>
                <div class="reply-info">
                    返信者: <?= htmlspecialchars($reply['username']) ?> | 投稿日: <?= htmlspecialchars($reply['created_at']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <footer>
        &copy; 2025 created by kyoko
    </footer>
</body>
</html>


