<html>
    <head>
        <title>お問い合わせフォーム</title>
    </head>
    <body>
        <form method="post" action="index.php">
            <label for="name">名前:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="age">年齢:</label><br>
            <input type="number" id="age" name="age"><br>
            <input type="submit" name="submit" value="送信"><br>
        </form>
        <h2>送信されたデータ</h2>
        <form method="post" action="index.php">
            <input type="text" name="search" placeholder="名前で検索">
            <input type="submit" value="検索">
        </form>
        <h3>ユーザー一覧</h3>
        <form method="post" action="index.php">
            <label for="name">名前(更新用):</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="age">年齢(更新用):</label><br>
            <input type="number" id="age" name="age"><br>
            <?php
            foreach ($data as $index => $line) {
                $num = $index + 1;
                echo "{$num} ID:{$line["ID"]} 名前:{$line["name"]} 年齢:{$line["age"]}" . "<button type='submit' name='update' value='{$line["ID"]}'>編集</button><button type='submit' name='delete' value='{$line["ID"]}'>削除</button>";
                echo "<br>";
            }
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='?page={$i}'>[{$i}]</a> ";
            }
            ?>
        </form>
    </body>
</html>