<?php
session_start();
include('FUNCTION.php');
// // セッションIDの検証とタイムアウト処理
// check_session_id();

// var_dump($_POST);
// POSTデータ確認
if (
    !isset($_POST['username']) || $_POST['username'] === '' ||
    !isset($_POST['gender']) || $_POST['gender'] === '' ||
    !isset($_POST['birthday']) || $_POST['birthday'] === '' ||
    !isset($_POST['mail']) || $_POST['mail'] === '' ||
    !isset($_POST['password']) || $_POST['password'] === ''  // パスワードチェック追加
  ) {
    exit('データがありません');
  }

// POSTデータ取得
$username = $_POST['username'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
$mail = $_POST['mail'];
$password = $_POST['password']; // パスワードの取得

// パスワードのハッシュ化（セキュリティのため）
// $password_hash = password_hash($password, PASSWORD_DEFAULT);

// DB接続
$pdo = connect_to_db();

// SQL作成&実行 SQLインジェクション
$sql = 'INSERT INTO users_table (id, username, password, gender, birthday, mail, created_at, updated_at) 
                          VALUES (NULL, :username, :password, :gender, :birthday, :mail,  now(), now())';

$stmt = $pdo->prepare($sql);
// バインド変数を設定
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);  // ハッシュ化せずそのまま保存
// $stmt->bindValue(':password', $password_hash, PDO::PARAM_STR);  // ハッシュ化したパスワードを挿入

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// 登録成功後のセッション処理
session_regenerate_id(true);  // セッションIDを再生成
$_SESSION['session_id'] = session_id();  // セッションIDを保存
$_SESSION['username'] = $username;          // 入力された氏名をセッションに保存
$_SESSION['is_admin'] = 0;              // 初期状態では一般ユーザー

// 登録後のリダイレクト
$user_id = $pdo->lastInsertId();
header("Location:kadai_read.php");
exit();
?>