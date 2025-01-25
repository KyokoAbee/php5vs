<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>質問投稿</title>
    <link rel="stylesheet" href="./css/post.css">

</head>
<body>
    <div class="container">
        <h2>質問を投稿してください</h2>
        <form action="kadai_post_act.php" method="POST">
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="question">質問文</label>
                <textarea id="question" name="question" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="best_answer_reward">ベストアンサーへのお礼</label>
                <input type="text" id="best_answer_reward" name="best_answer_reward">
            </div>
            <div class="form-group">
                <label for="answer_request">回答リクエスト</label>
                <input type="text" id="answer_request" name="answer_request">
            </div>
            <div class="form-group">
                <button type="submit">確認</button>
                <button type="reset">キャンセル</button>
            </div>
        </form>
    </div>
    <footer>Copyright © 2025</footer>
</body>
</html>
