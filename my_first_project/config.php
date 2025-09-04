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
    
} catch(PDOException $e) {
    // 接続失敗
    die("❌ データベース接続エラー: " . $e->getMessage());
}
function save_user($user_name,$user_age,$pdo){
    // ユーザー情報をデータベースに保存する関数
    $stmt = $pdo->prepare("INSERT INTO users (name, age) VALUES (:name, :age)");
    $stmt->execute([':name' => $user_name, ':age' => $user_age]);
}
function get_users($pdo){
    // ユーザー情報をデータベースから取得する関数
    $stmt = $pdo->query("SELECT * FROM users ORDER BY ID DESC");
    return $stmt->fetchAll();
}
function get_users_limit($pdo,$page,$limit = 10){
    $offset = ($page - 1) * $limit;
    if ($offset < 0) {
        $offset = 0;
    }
    $stmt = $pdo->query("SELECT * FROM users ORDER BY ID DESC LIMIT $limit OFFSET $offset");
    return $stmt->fetchAll();
}
function get_user_search($keyword, $pdo){
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name LIKE :keyword ORDER BY ID DESC");
    $stmt->execute([':keyword' => "%{$keyword}%"]);
    return $stmt->fetchAll();
}
function get_user_search_limit($keyword, $pdo,$page,$limit=10){
    $offset = ($page - 1) * $limit;
    if ($offset < 0) {
        $offset = 0;
    }
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name LIKE :keyword ORDER BY ID DESC LIMIT $limit OFFSET $offset");
    $stmt->execute([':keyword' => "%{$keyword}%"]);
    return $stmt->fetchAll();
}
function get_total_users($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    return $stmt->fetchColumn();
}
function get_total_users_search($keyword,$pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE name LIKE :keyword");
    $stmt->execute([':keyword' => "%{$keyword}%"]);
    return $stmt->fetchColumn();
}
function update_user($id, $name, $age, $pdo){
    // ユーザー情報を更新する関数
    $stmt = $pdo->prepare("UPDATE users SET name = :name, age = :age WHERE ID = :id");
    $stmt->execute([':name' => $name, ':age' => $age, ':id' => $id]);
}
function delete_user($id,$pdo){
    $stmt = $pdo->prepare("DELETE FROM users WHERE ID = :id");
    $stmt->execute([':id' => $id]);
}
function save_loginuser($username, $password, $pdo) {
    $stmt = $pdo->prepare("INSERT INTO login_users (username, password) VALUES (:username, :password)");
    $stmt->execute([':username' => $username, ':password' => password_hash($password, PASSWORD_DEFAULT)]);
    return true;
}
function check_login($username, $password, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM login_users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["username"] = $user['username'];
        return true;
    }
    return false;
}


?>