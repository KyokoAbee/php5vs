<?php
session_start();
include('FUNCTION.php');
// セッションIDの検証とタイムアウト処理
check_session_id();

// データベース接続
$pdo = connect_to_db();

// コメント情報を取得するSQL
$sql = 'SELECT id, comment_title, SUBSTRING(comment, 1, 50) AS comment_excerpt, created_at, (SELECT username FROM users_table WHERE users_table.id = comment_table.userid) AS username 
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

// 管理者権限の有無を確認
if($_SESSION['is_admin'] == 1) {
    $is_admin_link = '<a href="kadai_admin.php">管理者ページ</a>';
}else {
    $is_admin_link = '';
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ようこそ</title>
    <link rel="stylesheet" href="./css/toppage.css">
</head>
<body>
<h1>ようこそ <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?> さん！</h1>

<form action="kadai_post.php" method="POST">
<button>投稿する</button>

<a href="kadai_logout.php">logout</a><br>
<?= $is_admin_link ?>
<div class="container">
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
                    | 投稿者: <?= htmlspecialchars($comment['username']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
   