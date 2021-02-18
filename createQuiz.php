<?php
session_start();
if (!$_SESSION['login']) {
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問題作成</title>
</head>

<body>
    <form action="createQuiz.php" method="post">
        <label>〇×クイズのタイトル</label><br><input type="text" name="title" required><br>
        <label>〇×クイズの内容</label><br><input type="text" name="quiz" required><br>
        <label>答え</label><br>
        <label>〇<input type="radio" name="answer" value="1"></label>
        <label><input type="radio" name="answer" value="0"></label>
        <br>
        <input type="submit" value="登録">
    </form>
    <p><?php var_export($_POST); ?></p>
</body>

</html>