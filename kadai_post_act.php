<?php
session_start();
include('FUNCTION.php');

// セッション変数の確認
if (!isset($_SESSION['userid'])) {
    echo "<p>ログインしていないため、この操作は許可されていません。</p>";
    var_dump($_SESSION); // デバッグ用にセッション変数を出力
    exit();
}

// ログインユーザのセッションIDを取得
$userid = $_SESSION['userid'];

// フォームからデータ受け取り
$title = $_POST['title'];
$question = $_POST['question'];
$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');

// データベース接続
$pdo = connect_to_db();

// SQL文を作成
$sql = 'INSERT INTO comment_table (userid, comment_title, comment, created_at, updated_at) 
VALUES (:userid, :title, :question, :created_at, :updated_at)';

// SQL実行準備
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':question', $question, PDO::PARAM_STR);
$stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);
$stmt->bindValue(':updated_at', $updated_at, PDO::PARAM_STR);

// SQL実行
try {
  $status = $stmt->execute();
  // 成功したらリダイレクト
  header("Location: kadai_read.php");
  exit();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
