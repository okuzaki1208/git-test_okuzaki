<!DOCTYPE html>
<html>
<head>
    <title>Git・PHP・SQL テスト課題</title>
    <link rel="stylesheet" type="text/css" href="./CSS/style.css">
</head>
<body>

<main>

    <h1>Git・PHP・SQL テスト課題</h1>

<!-- プロフィールセクション -->
<section id="profile">
    <h2>プロフィール</h2>
    <img src="./Images/zundamon1.png" alt="zundamon1" style="width: 100px;">
    <p>名前：奥崎恭平</p>
    <p>趣味：ゲーム・楽器・釣り・カラオケ・パソコンいじり</p>
    <p>一言：よろしくお願いします。</p>
</section>
 <section>
        <h2>プロフィール・自己紹介</h2>
        <img src="IMAGES/IMG_2248.JPG" alt="プロフィール画像" style="width: 100px; height: 100px;">
       <p>名前：亀ヶ澤泰子</p>
       <p>趣味：お菓子・料理食べることと作ること</p>
        <p>一言：情報交換して、お友達になりませんか？</p>
    </section>
<!-- お問い合わせフォームセクション -->
<section id="contact">
    <h2>お問い合わせフォーム</h2>
    <form method="post" action="submit_contact.php" onsubmit="return validateForm()">
        <label for="subject">宛先:</label><br>
        <input type="text" id="subject" name="subject"required maxlength="255"><br><br>

        <label for="name">名前(最大10文字)</label><br>
        <input type="text" id="name" name="name" required maxlength="10"><br><br>
        
        <label for="email">メールアドレス(最大100文字)</label><br>
        <input type="email" id="email" name="email" required maxlength="100"><br><br>
        
        <label for="message">お問い合わせ内容(必須)</label><br>
        <textarea id="message" name="message" required></textarea><br><br>
        
        <input type="submit" value="送信" onclick="return confirm('本当に送信しますか？')" style="background-color: #fff; color: #000;">
    </form>
</section>

<!-- 今日もらったコメントセクション -->
<section id="contact-timeline">
    <h2>今日もらったコメント</h2>
    <ul>
        <?php
        // データベース接続情報
        $host = 'localhost';
        $dbname = 'git-test'; // データベース名
        $username = 'root'; // データベースユーザー名
        $password = ''; // データベースパスワード

        try {
            // データベースへの接続
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // エラーモードを例外モードに設定
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // 本日の日付を取得
            $today = date("Y-m-d");
           


            // SQL文を準備
           $stmt = $pdo->prepare("SELECT name, email, message, subject FROM comments");
           // プレースホルダーに値をバインド
           $stmt->bindParam(':name', $name);
           $stmt->bindParam(':email', $email);
           $stmt->bindParam(':message', $message);
           $stmt->bindParam(':subject', $subject);
           $stmt->bindParam(':date_time', $date_time);
          // SQL文を実行
           $stmt->execute();
           

            // 結果を取得して表示
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li><strong>{$row['name']}</strong> {$row['email']}<br>{$row['message']} {$row['subject']}</li><br>";
            }

        } catch(PDOException $e) {
            // エラーメッセージを表示
            echo "エラー: " . $e->getMessage();
        }
        ?>
    </ul>
</section>
</main>
</body>
    <script src="./Javascript/script.js"></script>
</html>
