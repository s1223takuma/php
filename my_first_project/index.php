<?php
$name = "ゲスト";
$age = 0;
if (isset($_POST["name"]) && isset($_POST["age"])) {
    $name = $_POST["name"];
    $age = $_POST["age"];
    if ($name != "" || $age != "") {
        file_put_contents("data.txt","名前{$name},年齢{$age}\n",FILE_APPEND);
    }
}
if (isset($_POST["delete"])) {
    $data = file("data.txt", FILE_IGNORE_NEW_LINES);
    unset($data[$_POST["delete"]]);
    file_put_contents("data.txt", implode("\n", $data));
}
$hobbies = ["読書","ゲーム","プログラミング"];
$data = file_get_contents("data.txt");
echo "こんにちは{$name}です。";
echo "年齢は{$age}歳です。";
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
?>
<html>
  <head>
    <title>お問い合わせフォーム</title>
  </head>
  <body>
    <form method="post" action="config.php">
      <label for="name">名前:</label><br>
      <input type="text" id="name" name="name"><br>
      <label for="age">年齢:</label><br>
      <input type="number" id="age" name="age"><br>
      <input type="submit" value="送信"><br>
    </form>
    <h2>送信されたデータ</h2>
    <form method="post">
    <?php
    foreach (explode("\n", $data) as $index => $line) {
        if (trim($line) !== "") {
            echo $line . "<button type='submit' name='delete' value='{$index}'>削除</button>";
            echo "<br>";
        }
    }
    ?>
    </form>
  </body>
</html>
