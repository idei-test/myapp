<?php
session_start();
require_once('DB.php');

if (!isset($_POST['number'])) {
    header("location:./index.php");
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問題</title>
</head>

<body>
    <!-- 問題のタイトル、本文、作者、を表示 -->
    <?php
    $db = new DB();
    $quiz = $db->getQuiz($_POST['number']);
    $js = json_encode($quiz[0], JSON_UNESCAPED_UNICODE);

    ?>

    <!-- 問題は〇×なので2つボタン作る -->
    <br>
    <p id='answerTag'></p>


    <!-- マイページに戻る -->
    <form action="index.php"><input type="submit" value='戻る'></form>
    <script>
        let q = <?php echo $js; ?>;
    </script>
    <script src=temple.js></script>
</body>

</html>