<?php
const SERVER = 'mysql213.phy.lolipop.lan';
const DBNAME = 'LAA1516906-sample';
const USER = 'LAA1516906';
const PASS = 'Pass1006';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
?>
  <button class="beer" onclick="location.href='index.php'" value="メニューに戻る">メニューに戻る</button><hr>
<?php
    try {
        // データベースに接続
        $conn = new PDO($connect, USER, PASS);
    
        // 更新処理
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
            $bookId = $_POST['book_id'];
            $newTitle = $_POST['new_title'][$bookId];
            $newAuthor = $_POST['new_author'][$bookId];
    
            // 実際のデータベースの更新処理
            $sql = "UPDATE book SET 題名 = :newTitle, 作者名 = :newAuthor WHERE 本ID = :bookId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':newTitle', $newTitle, PDO::PARAM_STR);
            $stmt->bindParam(':newAuthor', $newAuthor, PDO::PARAM_STR);
            $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                echo "データの更新に成功しました。";
            } else {
                echo "データの更新に失敗しました。";
            }
        } else {
            echo "選択してください。";
        }
    
        // データベースの接続を閉じる
        $conn = null;
    } catch (PDOException $e) {
        die("データベースへの接続に失敗しました: " . $e->getMessage());
    }
    ?>
    