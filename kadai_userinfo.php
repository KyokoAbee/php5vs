<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/userinfo.css">

    <script>

        // フォーム送信前に確認ダイアログを表示
        function validateForm() {
        const name = document.getElementById("username").value;
        const gender = document.querySelector('input[name="gender"]:checked');
        const birthday = document.getElementById("birthday").value;
        const mail = document.getElementById("mail").value;
        const password = document.getElementById("password").value;  // パスワードの追加チェック

        // 名前のチェック
        if (name.trim() === "") {
            alert("氏名を入力してください。");
            return false;
            }

        // 性別のチェック
        if (!gender) {
            alert("性別を選択してください。");
            return false;
            }

        // 生年月日のチェック
        const today = new Date();
        const birthDate = new Date(birthday);
        if (birthDate > today) {
            alert("誕生日が未来の日付です。");
            return false;
            }

        // メールアドレスのチェック
        const mailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!mail.match(mailPattern)) {
            alert("無効なメールアドレスです。");
            return false;
            }
        
        // パスワードのチェック
        if (password.trim() === "") {
            alert("パスワードを入力してください。");
            return false;
        }

        // 確認ダイアログ
        return confirm("登録内容を確認してください。");
        }
    </script>
</head>
<body>
<form action="kadai_usercreate.php" method="POST" onsubmit="return validateForm()"> 
        <!-- メンバー情報 -->
        <fieldset>
            <legend>ユーザー登録</legend>
            <label for="username">氏名：</label>
            <input type="text" id="username" name="username" required><br>

            <label for="gender">性別：</label>
            <input type="radio" id="male" name="gender" value="男性" required> 男性
            <input type="radio" id="female" name="gender" value="女性"> 女性
            <input type="radio" id="none" name="gender" value="答えたくない"> 答えたくない<br>

            <label for="birthday">生年月日：</label>
            <input type="date" id="birthday" name="birthday" required><br>

            <label for="mail">メールアドレス：</label>
            <input type="mail" id="mail" name="mail" required><br>

            <!-- 追加: パスワード入力 -->
            <label for="password">パスワード：</label>
            <input type="password" id="password" name="password" required><br>
        </fieldset>

        <button type="submit">登録</button>
</body>
</html>