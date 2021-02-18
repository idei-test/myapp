<?php
session_start();
$_SESSION['login'] = 'login';
require_once("model\\DB.php");
require_once("util.php");

// htmlからのpostを信用しない
if (myCken($_POST)) {
    $_POST = myEscap($_POST);
    // 文字チェック
    if (my_reg_match_ofEmail($_POST['mail'])) {
        $db = new DB();
        $data = $db->insertUser($_POST);
    } else {
        echo "失敗"; // 今度分岐をしっかり書く
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
</head>

<body>
    <p>登録しました　</p>
    <div>
        <?php
        foreach ($data as $k => $val) {
            if ($k == 'id') {
                continue;
            }
            echo $val . "<br>";
        }
        ?>
        <a href="index.php">マイページへ</a>
    </div>
    <!-- 登録失敗時 -->
</body>

</html>