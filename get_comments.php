<?php
// データベース接続情報
$host = 'localhost';
$dbname = 'json_test_okuzaki'; // データベース名
$username = 'root'; // データベースユーザー名
$password = ''; // データベースパスワード

try {
    // データベースへの接続
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // エラーモードを例外モードに設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 本日の日付を取得
    $today = date("Y-m-d");

    // SQL文を準備
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE DATE(date_time) = :today ORDER BY id DESC LIMIT 10");
    $stmt->bindParam(':today', $today);
    // SQL文を実行
    $stmt->execute();

    // 結果を取得してJSON形式で返す
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($comments);

} catch (PDOException $e) {
    // エラーメッセージを表示
    echo "エラー: " . $e->getMessage();
}
?>
