<html>
    <head>
        <title>お問い合わせフォーム</title>
    </head>
    <body>
        <h2>ログイン</h2>
        <form method="post" action="index.php">
            <label for="username">ユーザー名:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">パスワード:</label><br>
            <input type="password" id="password" name="password"><br>
            <input type="submit" name="login" value="ログイン"><br>
        </form>
        <h2>アカウント作成</h2>
        <form method="post" action="index.php">
            <label for="username">ユーザー名:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">パスワード:</label><br>
            <input type="password" id="password" name="password"><br>
            <input type="submit" name="create_account" value="アカウント作成"><br>
        </form>
    </body>
</html>