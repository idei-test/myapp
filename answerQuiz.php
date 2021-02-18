<?php
session_start();
require_once('model\\DB.php');

if (!isset($_POST['number'])) {
    header("location:./index.php");
}
if (isset($_GET['ans'])) {
    echo "ans ok";
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

    <head>
        <h1>クイズ回答</h1>
    </head>
    <!-- 指定した問題をとってくる -->
    <?php
    $db = new DB();
    $quiz = $db->getQuiz($_POST['number']);
    $js = json_encode($quiz[0], JSON_UNESCAPED_UNICODE);
    ?>

    <!-- 問題を出力する形を定義 -->
    <p id='title'></p>
    <p id='quiz'></p>
    <button onclick="answer('1')">〇</button><button onclick=" answer('0')">×</button>
    <p id='answer'></p>


    <!-- マイページに戻る -->
    <form action="index.php"><input type="submit" value='戻る'></form>

    <!-- 表示処理 -->
    <script>
        const p = document.getElementById('quiz');
        const q = <?php echo $js; ?>;
        p.textContent = q.quiz;

        const a = document.getElementById('answer');

        function answer(x) {
            if (x === q.answer) {
                p.textContent = "正解";
            } else {
                p.textContent = "不正解";
            }
        }
    </script>

</body>

</html>