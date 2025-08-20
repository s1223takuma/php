<?php
// test.php - 動作確認用ファイル
echo "<h1>🎉 PHP動作確認</h1>";
echo "<p>現在の日時: " . date('Y年m月d日 H:i:s') . "</p>";
echo "<p>PHPバージョン: " . phpversion() . "</p>";

// サーバー情報
echo "<h2>サーバー情報</h2>";
echo "<ul>";
echo "<li>サーバー名: " . $_SERVER['SERVER_NAME'] . "</li>";
echo "<li>ドキュメントルート: " . $_SERVER['DOCUMENT_ROOT'] . "</li>";
echo "<li>スクリプト名: " . $_SERVER['SCRIPT_NAME'] . "</li>";
echo "</ul>";

// 簡単な計算テスト
$a = 10;
$b = 20;
$result = $a + $b;
echo "<h2>計算テスト</h2>";
echo "<p>{$a} + {$b} = {$result}</p>";

// 配列表示テスト
$colors = ['赤', '青', '緑', '黄色', '紫'];
echo "<h2>配列テスト</h2>";
echo "<ul>";
foreach($colors as $color) {
    echo "<li>{$color}</li>";
}
echo "</ul>";

echo "<h2>✅ PHPは正常に動作しています！</h2>";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP動作テスト</title>
    <style>
        body { 
            font-family: 'Helvetica Neue', Arial, sans-serif; 
            max-width: 800px; 
            margin: 0 auto; 
            padding: 20px;
            background-color: #f8f9fa;
        }
        h1 { color: #28a745; }
        h2 { color: #007bff; border-bottom: 2px solid #007bff; }
        ul { background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        p { font-size: 16px; }
    </style>
</head>
<body>
    <!-- PHPコードは上で実行されます -->
</body>
</html>