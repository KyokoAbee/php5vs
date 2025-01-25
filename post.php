<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>悩み・質問の投稿</title>
</head>
<body>
    <h1></h1>

    <!-- フォーム -->
    <form action="submit_post.php" method="POST">
        <label for="title">投稿タイトル:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">あなたの悩みや読みたい本を具体的にしてください:</label><br>
        <textarea id="content" name="content" rows="5" cols="40" required></textarea><br><br>

        <input type="submit" value="投稿する">
    </form>

    <!-- 戻るボタン -->
    <button onclick="location.href='index.php'">トップページに戻る</button>
</body>
</html>
