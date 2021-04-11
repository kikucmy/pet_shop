<?php

require_once __DIR__ . '/functions.php';

// キーワードの取得
$keyword = h($_GET['keyword']);

// データベースに接続
$dbh = connectDb();

// SQL文の組み立て(共通部分)
$sql = 'SELECT * FROM animals';

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// キーワードが入力されている場合
if (!empty($keyword)) {
    // WHERE句の追加
    $sql = $sql . ' WHERE description LIKE :keyword';

    // プリペアドステートメントの再設定
    $stmt = $dbh->prepare($sql);

    // パラメータのバインド
    $keyword_param = '%' . $keyword . '%';
    $stmt->bindParam(':keyword', $keyword_param, PDO::PARAM_STR);
}

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
        <form method="get">
            <label>キーワード</label>:
            <input name="keyword" type="text" value="キーワードの入力">
            <input type="submit" value="検索">
        </form>
        <?php foreach ($animals as $animal): ?>
            <p><?= nl2br(createMsg($animal)) ?></p>
            <hr>
        <?php endforeach; ?>
    </body>
</html>
