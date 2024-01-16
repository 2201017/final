<?php
const SERVER = 'mysql213.phy.lolipop.lan';
const DBNAME = 'LAA1516906-sample';
const USER = 'LAA1516906';
const PASS = 'Pass1006';

$connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';

// データベースに接続
try {
    $conn = new PDO($connect, USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'データベースに接続できませんでした: ' . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータを取得
    $本ID = $_POST["本ID"];
    $題名 = $_POST["題名"];
    $作者名 = $_POST["作者名"];

    // SQL文の作成
    $sql = "INSERT INTO book (本ID, 題名, 作者名) VALUES ('$本ID', '$題名', '$作者名')";

    // SQL文の実行
    try {
        $conn->exec($sql);
        echo "本が正常に追加されました";
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}

// データベースの切断
$conn = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>本管理システム</title>
    <link rel="stylesheet" href="./css/book-branch.css">
</head>
<body>
    <h2>本登録フォーム</h2>
    <button class="beer" onclick="location.href='index.php'" value="メニューに戻る">メニューに戻る</button><br><hr>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="本ID">本ID:</label>
        <input type="text" name="本ID" required><br>

        <label for="題名">題名:</label>
        <input type="text" name="題名" required><br>

        <label for="作者名">作者名:</label>
        <input type="text" name="作者名" required><br>

        <input type="submit" value="登録">
    </form>
</body>
</html>
