<!DOCTYPE html>
<html>
<head>
    <title>Git・PHP・SQL テスト課題</title>
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
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : ''; // subjectを追加
$date_time = date("Y-m-d H:i:s"); // 送信時の日付

try {
    // データベースへの接続
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // エラーモードを例外モードに設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  

// パラメータをバインド
$stmt = $pdo->prepare("INSERT INTO comments (name, email, message, subject, date_time) VALUES (:name, :email, :message, :subject, :date_time)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':message', $message);
$stmt->bindParam(':subject', $subject); // バインド追加
$stmt->bindParam(':date_time', $date_time);
    // SQL文を実行
    $stmt->execute();
   
    echo "SQL Query: " . $stmt->queryString;

    // 成功メッセージを表示
    echo "お問い合わせが送信されました。<br><br>";
    
// データベースからsubjectを取得
$stmt = $pdo->prepare("SELECT subject FROM comments WHERE id = LAST_INSERT_ID()");
$stmt->execute();
$subject_result = $stmt->fetchColumn();


    echo "<a href='index.php'>戻る</a>"; // index.phpへのリンク
} catch(PDOException $e) {
    // エラーメッセージを表示
    echo "エラー: " . $e->getMessage();
}
?>
</main>
</body>
</html>
