<?php
require_once 'config.php';
if (isset($_POST["submit"])){
    if (isset($_POST["name"]) && isset($_POST["age"])) {
        $name = $_POST["name"];
        $age = $_POST["age"];
        // if ($name != "" || $age != "") {
        //     file_put_contents("data.txt","名前{$name},年齢{$age}\n",FILE_APPEND);
        // }
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
//     $data = file("data.txt", FILE_IGNORE_NEW_LINES);
//     unset($data[$_POST["delete"]]);
//     file_put_contents("data.txt", implode("\n", $data));
// }

$hobbies = ["読書","ゲーム","プログラミング"];
// $data = file_get_contents("data.txt");
$data = get_users($pdo);
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
            <?php
            foreach ($data as $index => $line) {
                echo "ID:{$line["ID"]} 名前:{$line["name"]} 年齢:{$line["age"]}" . "<button type='submit' name='delete' value='{$line["ID"]}'>削除</button>";
                echo "<br>";
            }
            ?>
        </form>
    </body>
</html>