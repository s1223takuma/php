<?php
// config.php - データベース接続設定

// データベース接続情報
$db_host = 'localhost';
$db_name = 'my_first_db';  // phpMyAdminで作成したDB名
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
    // echo "✅ データベース接続成功！";
    
} catch(PDOException $e) {
    // 接続失敗
    die("❌ データベース接続エラー: " . $e->getMessage());
}

// テーブル作成関数
function createTables($pdo) {
    $sql = "
        CREATE TABLE IF NOT EXISTS messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ";
    
    try {
        $pdo->exec($sql);
        return "✅ テーブル作成完了";
    } catch(PDOException $e) {
        return "❌ テーブル作成エラー: " . $e->getMessage();
    }
}

// 初回実行時のセットアップ
if (isset($_GET['setup'])) {
    echo createTables($pdo);
}
?>