# 回答一覧

## 　問題1
### 1.変数 $name に自分の名前を代入
index.php
```php
$name = "soda";
```

### 2.変数 $age に年齢を代入
index.php
```php
$age = 18;
```

### 3.変数 $hobbies に趣味を配列で3つ以上代入
index.php
```php
$hobbies = ["読書","ゲーム","プログラミング"];
```

### 4.HTMLページとして、以下を表示：
* 「こんにちは、[名前]です」
* 「年齢は[年齢]歳です」
* 「趣味：」の後に趣味をリスト形式で表示
index.php
```php
echo "{$name}です。<br>";
echo "年齢は{$age}歳です。<br>";
echo "趣味は";
foreach ($hobbies as $hobbie) {
    echo "{$hobbie},";
}
echo "です。";
echo "<br>";
```

## 問題2
### 1.年齢によってメッセージを変える機能を追加：
* 20歳未満：「学生さんですね！」
* 20歳以上65歳未満：「お仕事頑張ってください！」
* 65歳以上：「人生の大先輩ですね！」
index.php
```php
if ($age < 20){
    echo "学生さんですね！";
}else if ($age >= 20 && $age <65){
    echo "お仕事頑張ってください！";
}else{
    echo "人生の大先輩ですね！";
}
echo "<br>";
```

## 問題3
### 1.名前と年齢を入力できるフォームを作成し、送信時に問題1,2の内容を表示する仕組みを作ってください。
index.php
```php
$name = $_POST["name"];
$age = $_POST["age"];
```
```html
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
    </body>
</html>
```

### 2.フォームが送信された時だけPHPの処理を実行するようにしてみてください。
index.php
```php
if (isset($_POST["submit"])){
    if (isset($_POST["name"]) && isset($_POST["age"])) {
        $name = $_POST["name"];
        $age = $_POST["age"];
    }
}
```

## 問題4
### 1.フォームが送信されたら、名前と年齢をdata.txtに追加保存(保存形式は「名前,年齢」で1行ずつ)
index.php
```php
if (isset($_POST["submit"])){
    if (isset($_POST["name"]) && isset($_POST["age"])) {
        $name = $_POST["name"];
        $age = $_POST["age"];
        file_put_contents("data.txt","名前{$name},年齢{$age}\n",FILE_APPEND);
    }
}
```

### 2.ページ下部に今まで登録された全データを表示
index.php
```html
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
      <input type="submit" value="送信"><br>
    </form>
    <h2>送信されたデータ</h2> // 追加
    <pre> // 追加
    <?php // 追加
        echo htmlspecialchars($data); // 追加
    ?> // 追加
  </body>
</html>
```

## 問題5
### 1.表示されたデータの横に「削除」ボタンを付けて、クリックしたらそのデータを削除できるようにしてください。
index.php
```php
if (isset($_POST["delete"])) {
    $data = file("data.txt", FILE_IGNORE_NEW_LINES);
    unset($data[$_POST["delete"]]);
    file_put_contents("data.txt", implode("\n", $data));
}
```
```html
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
      <input type="submit" value="送信"><br>
    </form>
    <h2>送信されたデータ</h2>
    <form method="post">
    <?php
    foreach (explode("\n", $data) as $index => $line) { // 追加(ここから)
        if (trim($line) !== "") {
            echo $line . "<button type='submit' name='delete' value='{$index}'>削除</button>";
            echo "<br>";
        }
    } // 追加(ここまで)
    ?>
    </form>
```

## 問題6
### 1.``user_data``という名前のデータベースを作成
```
http://localhost/phpmyadmin/index.php?route=/server/databasesで作成
```

### 2.その中に``users``テーブルを作成（以下のカラム）：
* id (INT, AUTO_INCREMENT, PRIMARY KEY)
* name (VARCHAR(100))
* age (INT)
* created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
```
1問目と同じ
```

## 問題7
### 1.PHPでMySQLに接続するコードを書いてください：
* PDOを使用
* ホスト：localhost
* ユーザー：root
* パスワード：（通常は空）
* データベース：user_data
cobfig.php
```php
// データベース接続情報
$db_host = 'localhost';
$db_name = 'user_data';  // phpMyAdminで作成したDB名
$db_user = 'root';         // XAMPPのデフォルトユーザー
$db_pass = '';             // XAMPPのデフォルトパスワード（空）

try {
    // PDOでMySQL接続
    $pdo = new PDO(
        "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4",
        $db_user,
        $db_pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    
} catch(PDOException $e) {
    // 接続失敗
    die("❌ データベース接続エラー: " . $e->getMessage());
}
```

## 問題8
### 1.フォームから送信されたデータをファイルではなく、データベースに保存するように変更してください。
config.php
```php
function save_user($user_name,$user_age,$pdo){
    // ユーザー情報をデータベースに保存する関数
    $stmt = $pdo->prepare("INSERT INTO users (name, age) VALUES (:name, :age)");
    $stmt->execute([':name' => $user_name, ':age' => $user_age]);
}
```

index.php
```php
if (isset($_POST["submit"])){
    if (isset($_POST["name"]) && isset($_POST["age"])) {
        $name = $_POST["name"];
        $age = $_POST["age"];
        $user_name = $_POST["name"];
        $user_age = $_POST["age"];
    if ($name != "" && $age != "") {
            try {
                save_user($user_name, $user_age, $pdo);
            } catch (PDOException $e) {
            }
        }
    }
```
## 問題9
### 1.保存したデータを表示する機能を追加してください：
* データベースから全ユーザー情報を取得
* テーブル形式で表示（ID、名前、年齢、登録日時）
* 各行に削除ボタンを追加

config.php
```php
function get_users($pdo){
    // ユーザー情報をデータベースから取得する関数
    $stmt = $pdo->query("SELECT * FROM users ORDER BY ID DESC");
    return $stmt->fetchAll();
}
```

index.php
```php
$data = get_users($pdo);
```
```html
<?php
    foreach ($data as $index => $line) { //少し変更
        echo "ID:{$line["ID"]} 名前:{$line["name"]} 年齢:{$line["age"]}" . "<button type='submit' name='delete' value='{$line["ID"]}'>削除</button>";
        echo "<br>";
    }
?>
```
## 問題10
### 1.削除ボタンがクリックされたら、そのIDのレコードをデータベースから削除
config.php
```php
function delete_user($id,$pdo){
    $stmt = $pdo->prepare("DELETE FROM users WHERE ID = :id");
    $stmt->execute([':id' => $id]);
}
```

index.php
```php
if (isset($_POST["delete"])) {
    delete_user($_POST["delete"], $pdo);
}
```

## 問題11
### 1.検索フォームを追加（名前で部分検索）
```html
<form method="post" action="index.php">
    <input type="text" name="search" placeholder="名前で検索">
    <input type="submit" value="検索">
</form>
```

### 2.検索結果のみを表示する機能

```php
if (isset($_POST["search"]) && $_POST["search"] != "") {
    $data = get_user_search($_POST["search"], $pdo);
}
else{
    $data = get_users_limit($pdo,$page);
}
```

## 問題12
### 1.各データに「編集」ボタンを追加

### 2.クリックすると名前と年齢を変更できるフォームを表示

### 3.更新処理

## 問題13
### データが多くなった時に1ページ10件ずつ表示する機能

## 問題14
### 1.ログイン機能の初期設定
* phpMyAdminで新しいテーブル``login_users``を作成
> * id (INT, AUTO_INCREMENT, PRIMARY KEY)
> * username (VARCHAR(50), UNIQUE)
> * password (VARCHAR(255))
> * created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)

## 問題15
### 1.ユーザー登録フォームの作成

### 2.パスワードを``password_hash()``を使って暗号化し保存

### 3.同じユーザー名を登録できないように

## 問題16
### 1.ログインフォームの作成

### 2.``password_verify()``でパスワード照合

### 3.ログイン成功時はセッションに情報保存

### 4.ログイン済みユーザーのみデータ操作可能にする