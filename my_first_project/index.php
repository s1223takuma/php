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
    if ($name != "" && $age != "") {
            try {
                save_user($user_name, $user_age, $pdo);
            } catch (PDOException $e) {
            }
        }
    }
}else if (isset($_POST["create_account"])){
    session_start();
    $_SESSION["islogin"] = save_loginuser($_POST["username"],$_POST["password"],$pdo);
}else if (isset($_POST["login"])){
    session_start();
    $_SESSION["islogin"] = check_login($_POST["username"],$_POST["password"],$pdo);
}else if (isset($_POST["logout"])){
    session_start();
    $_SESSION = [];
    session_destroy();
}
else if (isset($_POST["delete"])) {
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
    $data = get_user_search($_POST["search"], $pdo);
    // $total_count = get_total_users_search($_POST["search"], $pdo);
    $total_pages = 1;
}
else{
    $data = get_users_limit($pdo,$page);
    $total_count = get_total_users( $pdo);
    $total_pages = ceil($total_count /10);
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
if ($_SESSION["islogin"]){
    include 'content.php';
}else{
    include 'login.php';
}
?>