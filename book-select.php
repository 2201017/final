<!DOCTYPE html>
<html><head>
    <meta charset="UTF-8">
    <title>本管理システム</title>
    <link rel="stylesheet" href="./css/book-branch.css">
</head>
<body>
<h2>本一覧</h2>
<button class="beer" onclick="location.href='index.php'" value="メニューに戻る">メニューに戻る</button><br><hr>
<?php
const SERVER = 'mysql213.phy.lolipop.lan';
const DBNAME = 'LAA1516906-sample';
const USER = 'LAA1516906';
const PASS = 'Pass1006';

$connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';

try {
    // データベースに接続
    $conn = new PDO($connect, USER, PASS);

    // データを取得するクエリ
    $sql = "SELECT * FROM book";
    $result = $conn->query($sql);

    // データを表示する
    if ($result->rowCount() > 0) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "本ID: " . $row["本ID"]. " - 題名: " . $row["題名"]. " - 作者名: " . $row["作者名"]. "<br>";
        }
    } else {
        echo "0 件の結果が見つかりませんでした";
    }

    // データベースの接続を閉じる
    $conn = null;
} catch (PDOException $e) {
    die("データベースへの接続に失敗しました: " . $e->getMessage());
}
?>
