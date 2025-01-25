<?php
session_start();
include('FUNCTION.php');

// セッションIDの検証とタイムアウト処理
check_session_id();

// データベース接続
$pdo = connect_to_db();

$comment_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reply = $_POST['reply'];
    $userid = $_SESSION['userid'];

    $sql = 'INSERT INTO reply_table (comment_id, userid, reply, created_at) 
        VALUES (:comment_id, :userid, :reply, NOW())';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
    $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    $stmt->bindValue(':reply', $reply, PDO::PARAM_STR);
    if ($stmt->execute()) {
        header('Location: kadai_post_detail.php?id=' . $comment_id);
        exit();
    } else {
        echo '<p>エラーが発生しました。返信を投稿できません。</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>返信</title>
    <link rel="stylesheet" href="./css/toppage.css">
</head>
<body>
    <header></header>

    <div class="container">
        <h2>返信</h2>
        <form action="" method="POST">
            <textarea name="reply" rows="5" required></textarea>
            <button type="submit" class="cta-button">投稿</button>
        </form>
        <a href="kadai_post_detail.php?id=<?= htmlspecialchars($comment_id) ?>" class="cta-button">戻る</a>
    </div>

    <footer>
        &copy; 2025 created by kyoko
    </footer>
</body>
</html>
