<!DOCTYPE html>
<html>
<head>
    <title>Git・PHP・SQL　テスト課題</title>
    <link rel="stylesheet" type="text/css" href="./CSS/style.css">
</head>
<body>
<main>
<?php
// データベース接続情報
$host = 'localhost';
$dbname = 'git-test'; // データベース名
$username = 'root'; // データベースユーザー名
$password = ''; // データベースパスワード

// 入力されたお問い合わせ情報を取得
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$date_time = date("Y-m-d H:i:s"); // 送信時の日付

try {
    // データベースへの接続
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // エラーモードを例外モードに設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL文を準備
    $stmt = $pdo->prepare("INSERT INTO comments (name, email, message, date_time) VALUES (:name, :email, :message, :date_time)");
    
    // パラメータをバインド
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':date_time', $date_time);
    
    // SQL文を実行
    $stmt->execute();


    // 成功メッセージを表示
    echo "お問い合わせが送信されました。<br><br>";
    echo "<a href='index.php'>戻る</a>"; // index.phpへのリンク

} catch(PDOException $e) {
    // エラーメッセージを表示
    echo "エラー: " . $e->getMessage();
}
?>
</main>
</body>
</html>
