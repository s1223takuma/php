<?php
require_once 'config.php';
$name = null;
$age = null;
if (isset($_POST["submit"])){
    if (isset($_POST["name"]) && isset($_POST["age"])) {
        $name = $_POST["name"];
        $age = $_POST["age"];
        $user_name = $_POST["name"];
        $user_age = $_POST["age"];
        // ユーザー情報を保存
    if ($name != "" && $age != "") {
            try {
                save_user($user_name, $user_age, $pdo);
            } catch (PDOException $e) {
            }
        }
    }
}else if (isset($_POST["delete"])) {
    delete_user($_POST["delete"], $pdo);
}
else if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $age = $_POST["age"];
    if (isset($_POST["name"]) && isset($_POST["age"])) {
        $id = $_POST["update"];
        try {
            update_user($id, $name, $age, $pdo);
        } catch (PDOException $e) {
            echo "❌ DBエラー: " . $e->getMessage();
        }
    } else {
        echo "❌ ユーザー情報が送信されていません。";
    }
}
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}
if (isset($_POST["search"]) && $_POST["search"] != "") {
    $data = get_user_search_limit($_POST["search"], $pdo,$page);
}
else{
    $data = get_users_limit($pdo,$page);
}

$hobbies = ["読書","ゲーム","プログラミング"];
echo "{$name}です。<br>";
echo "年齢は{$age}歳です。<br>";
echo "趣味は";
foreach ($hobbies as $hobbie) {
    echo "{$hobbie},";
}
echo "です。";
echo "<br>";
if ($age < 20){
    echo "学生さんですね！";
}else if ($age >= 20 && $age <65){
    echo "お仕事頑張ってください！";
}else{
    echo "人生の大先輩ですね！";
}
echo "<br>";
echo "<br>";
?>
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
                echo "ID:{$line["ID"]} 名前:{$line["name"]} 年齢:{$line["age"]}" . "<button type='submit' name='update' value='{$line["ID"]}'>編集</button><button type='submit' name='delete' value='{$line["ID"]}'>削除</button>";
                echo "<br>";
            }
            $total_count = get_total_users($pdo);
        $total_pages = ceil($total_count / 10);
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='?page={$i}'>[{$i}]</a> ";
            }
            ?>
        </form>
    </body>
</html>