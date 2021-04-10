<?php

require_once __DIR__ . '/config.php';

// 接続処理を行う関数
function connectDb()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

// エスケープ処理
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// メッセージの編集
function createMsg($animal)
{
    $msg = <<<EOM
{$animal['type']}の{$animal['classification']}ちゃん
{$animal['description']}
{$animal['birthday']} 生まれ
出身地 {$animal['birthplace']}
EOM;

    return h($msg);
}
