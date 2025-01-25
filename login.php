<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="./css/login_style.css">
</head>
<body>
    <div class="container">
        <div class="section">
            <h2>ログイン</h2>
            <form action="kadai_login_act.php" method="POST">
                <input type="text" placeholder="ユーザー名" name="username" required>
                <input type="password" placeholder="パスワード" name="password" required>
                <!-- CAPTCHA認証 -->
                <div class="g-recaptcha" data-sitekey="6LfLO7sqAAAAANDvpKmM-KVN8LHeNeefBNAh8gbj"></div>
                <button>ログインする</button>
            </form>
        </div>

        <div class="section">
            <h2>初めての方はこちら</h2>
            <form action="kadai_userinfo.php" method="POST">
                <button>新規登録する</button>
            </form>
        </div>

        <p class="note">※パスワードは半角英数字をそれぞれ1文字以上含んだ、8文字以上で設定してください。</p>
    </div>
</body>
</html>
