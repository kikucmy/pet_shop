<?php

require_once __DIR__ . '/functions.php';

// データベースに接続
$dbh = connectDb();

// SQL文の組み立て
$sql = 'SELECT * FROM animals';

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// プリペアドステートメントの実行
$stmt->execute();

// 結果の受け取り
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHPとデータベースの連携 課題1</title>
    </head>
    <body>
        <h2>本日のご紹介ペット！</h2>
        <?php foreach ($animals as $animal): ?>
            <p><?= nl2br(createMsg($animal)) ?></p>
            <hr>
        <?php endforeach; ?>
    </body>
</html>
