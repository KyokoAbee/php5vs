<?php 
include('FUNCTION.php');
$pdo = connect_to_db();
// デバック


if (isset($_GET['id'])) {
    echo 'id パラメータの値: ' . htmlspecialchars($_GET['id']);
} else {
    echo 'id パラメータがありません。';
}
;  // デバッグ用なので、ここでスクリプトを終了


// ユーザーIDをGetする
$user_id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($user_id === 0) {
    exit ('無効なユーザーです。');
}


// SQL作成&実行 SQLインジェクション
$sql = 'SELECT * FROM users_table WHERE id = :id';
$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        exit('ユーザー情報が見つかりません。');
    }
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
    <title>登録情報</title>
</head>
<body>
    <h1>登録情報</h1>
    <p><strong>氏名:</strong> <?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>性別:</strong> <?php echo htmlspecialchars($user['gender'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>生年月日:</strong> <?php echo htmlspecialchars($user['birthday'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>メールアドレス:</strong> <?php echo htmlspecialchars($user['mail'], ENT_QUOTES, 'UTF-8'); ?></p>

<!-- 編集リンク -->
<!-- <p><a href="coaches_useredit.php?id=<?php echo $user['id']; ?>">登録情報を編集する</a></p> -->
<!-- 削除リンク -->
<!-- <p><a href="coaches_userdelete.php?id=<?php echo $user['id']; ?>" onclick="return confirm('本当に削除しますか？');">登録情報を削除する</a></p> -->


    <a href="coaches_userinfo.php">戻る</a>
</body>
</html>