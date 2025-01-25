<?php
session_start();
include('FUNCTION.php');
// セッションIDの検証とタイムアウト処理
check_session_id();

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
</head>
<body>
<h1>ようこそ <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?> さん！</h1>

<form action="kadai_post.php" method="POST">
<button>投稿する</button>

<a href="kadai_logout.php">logout</a><br>
<?= $is_admin_link ?>
</body>
</html>
   