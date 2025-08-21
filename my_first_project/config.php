<?php
// config.php - データベース接続設定

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
    
    // 接続成功
    echo "✅ データベース接続成功！<br>";
    
} catch(PDOException $e) {
    // 接続失敗
    die("❌ データベース接続エラー: " . $e->getMessage());
}

function save_user($user_name,$user_age,$pdo){
    // ユーザー情報をデータベースに保存する関数
    $stmt = $pdo->prepare("INSERT INTO users (name, age) VALUES (:name, :age)");
    $stmt->execute([':name' => $user_name, ':age' => $user_age]);
    echo "✅ ユーザー情報を保存しました！";
}
if (isset($_POST["name"])&&isset($_POST["age"])) {
    $user_name = $_POST["name"];
    $user_age = $_POST["age"];
    // ユーザー情報を保存
    try {
        save_user($user_name, $user_age, $pdo);
    } catch (PDOException $e) {
        echo "❌ DBエラー: " . $e->getMessage();
    }
} else {
    echo "❌ ユーザー情報が送信されていません。";
}
?>