<?php
const SERVER = 'mysql213.phy.lolipop.lan';
const DBNAME = 'LAA1516906-sample';
const USER = 'LAA1516906';
const PASS = 'Pass1006';

$connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>本管理システム - 本を削除する</title>
    <link rel="stylesheet" href="./css/book-branch.css">
</head>
<body>
    <h2>本を削除する</h2>
    <button class="beer" onclick="location.href='index.php'" value="メニューに戻る">メニューに戻る</button><hr>
    <?php
try {
    // データベースに接続
    $conn = new PDO($connect, USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_books'])) {
        // 選択された本を削除する
        $selected_books = $_POST['selected_books'];

        foreach ($selected_books as $selected_book_id) {
            $delete_query = "DELETE FROM book WHERE 本ID = :selected_book_id";
            $delete_statement = $conn->prepare($delete_query);
            $delete_statement->bindParam(':selected_book_id', $selected_book_id, PDO::PARAM_INT);
            $delete_statement->execute();
        }

        echo "選択した本が正常に削除されました";
    }

    // データを取得するクエリ
    $sql = "SELECT * FROM book";
    $result = $conn->query($sql);

    // データを表示するフォーム
    if ($result->rowCount() > 0) {
        echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">'; // 同じページにフォームデータを送信
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<label>';
            echo '<input type="checkbox" name="selected_books[]" value="' . $row["本ID"] . '">';
            echo '本ID: ' . $row["本ID"] . ' - 題名: ' . $row["題名"] . ' - 作者名: ' . $row["作者名"];
            echo '</label><br>';
        }
        echo '<input type="submit" value="選択した本を削除">';
        echo '</form>';
    } else {
        echo "0 件の結果が見つかりませんでした";
    }

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
} finally {
    // データベースの接続を閉じる
    $conn = null;
}
?>
