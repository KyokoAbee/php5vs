<?php 
// env.phpの読み込み
require_once 'env.php';

// DB に接続するための情報
function connect_to_db()
{
  try {
    return new PDO(DB_DSN, DB_USER, DB_PASSWORD);
  } catch (PDOException $e) {
    exit('dbError:'.$e->getMessage());
  }
}

// ログイン状態のチェック関数
function check_session_id()
{
  if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] !== session_id()) {
    header('Location:kadai_login.php');
    exit();
  } else {
    session_regenerate_id(true); //セッションIDの再生成
    $_SESSION["session_id"] = session_id();
    check_session_timeout(); //セッションタイムアウトを確認
  }
}

// セッションタイムアウトを確認する関数
function check_session_timeout()
{
  $timeout = 10; //タイムアウト時間(秒)
  if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time(); //最初のアクセス時に記録
  }else {
    $elapsed_time = time() - $_SESSION['last_activity']; //経過時間を計算
    if($elapsed_time > $timeout) {
      //タイムアウト処理：ログアウト
      session_unset();
      session_destroy();
      header('Location: kadai_timeout.php');
      exit();
    }
  }
  $_SESSION['last_activity'] = time();
}

// reCAPTCHA検証関数
function verify_recaptcha($recaptcha_response)
{
    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => RECAPTCHA_SECRET_KEY, // env.phpで定義した定数を使用
        'response' => $recaptcha_response
    ];

    // cURLでPOSTリクエストを送信
    $options = [
        CURLOPT_URL => $verify_url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);
    $verify_response = curl_exec($curl);
    
    // cURLのエラーチェック
    if ($verify_response === false) {
        $error_msg = curl_error($curl);
        curl_close($curl);
        return ['success' => false, 'error' => $error_msg];
    }

    curl_close($curl);

    // JSONレスポンスのデコード
    $verify_result = json_decode($verify_response, true);

    // json_decodeの結果がnullの場合の処理
    if ($verify_result === null) {
        return ['success' => false, 'error' => 'JSON decode failed'];
    }

    return $verify_result;
}

// 管理者かどうかを判断する関数
function check_is_admin()
{
  // 管理者じゃない場合はログイン画面に
  if (
    !isset($_SESSION['is_admin']) ||
    $_SESSION['is_admin'] != 1
  ) {
    header('Location:kadai_login.php');
    exit();
  }
}

?>