<?php
const SERVER = 'mysql213.phy.lolipop.lan';
const DBNAME = 'LAA1516906-sample';
const USER = 'LAA1516906';
const PASS = 'Pass1006';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>本管理システム</title>
    <link rel="stylesheet" href="./css/book-branch.css">
</head>
<body>
    <h2>本の情報を更新する</h2>
    <button class="beer" onclick="location.href='index.php'" value="メニューに戻る">メニューに戻る</button><hr>
    
   <form method="post" action="book-update-result.php">

    <?php
    try {
        // データベースに接続
        $conn = new PDO($connect, USER, PASS);

        // データを取得するクエリ
        $sql = "SELECT * FROM book";
        $result = $conn->query($sql);

        // データを表示する
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $本ID = $row["本ID"];
                $title = $row["題名"];
                $author = $row["作者名"];

                // ラジオボタンとテキストボックス
                echo '<input type="radio" name="book_id" value="' . $本ID. '">';
                echo " 本ID: " . $本ID . " - 題名: " . $title . " - 作者名: " . $author;
                echo ' <input type="text" name="new_title[' . $本ID . ']" placeholder="新しい題名">';
                echo ' <input type="text" name="new_author[' . $本ID . ']" placeholder="新しい作者名"><br>';
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

    <input type="submit" value="選択した本を更新する">
    <form method="submit" action="index.php">
</form>
