<?php
session_start();
include('FUNCTION.php');

// reCAPTCHAレスポンスの受け取り
$recaptcha_response = $_POST['g-recaptcha-response'];

// reCAPTCHAの結果を確認
$verify_result = verify_recaptcha($recaptcha_response);
// $verify_resultがfalseの場合のチェックを追加
if (!$verify_result['success']) {
    echo "<p>CAPTCHA認証に失敗しました。</p>";
    if (isset($verify_result['error'])) {
      echo "<p>Error: " . $verify_result['error'] . "</p>";
  }
    echo "<a href='index.php'>ログイン画面に戻る</a>";
    exit();
}

// データ受け取り
$username = $_POST['username'];
$password = $_POST['password'];

// DB接続
$pdo = connect_to_db();

// SQL実行
// username，password，deleted_atの3項目全ての条件満たすデータを抽出する．
$sql = 'SELECT * FROM users_table WHERE username=:username AND password=:password AND deleted_at IS NULL';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// ユーザ有無で条件分岐

$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
  echo "<p>ログイン情報に誤りがあります</p>";
  echo "<a href=index.php>ログイン</a>";
  exit();
} else {

// // パスワードのハッシュを照合
// if (!password_verify($password, $user['password'])) {
//   echo "<p>ログイン情報に誤りがあります</p>";
//       echo "<a href=index.php>ログイン</a>";
//       exit();
//   }



// ログイン成功後にセッションIDを再生成
session_regenerate_id(true);  // 新しいセッションIDを生成

// セッションにユーザー情報を保存
$_SESSION['session_id'] = session_id();  // 新しいセッションIDを保存
$_SESSION['userid'] = $user['id']; //ユーザーIDをセッションに保存
$_SESSION['is_admin'] = $user['is_admin'];
$_SESSION['username'] = $user['username'];

    // デバッグ用出力
    var_dump($_SESSION);

// ログイン後にkadai_read.phpにリダイレクト
  header("Location:kadai_read.php");
  exit();
}
