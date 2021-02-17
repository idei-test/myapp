<?php
session_start();
$_SESSION['login'] = 'login';
require_once("DB.php");
require_once("util.php");

$db = new DB();
// htmlからのpostを信用しない
if (myCken($_POST)) {
    $_POST = myEscap($_POST);
    $data = $db->insertUser($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録確認</title>
</head>

<body>
    <p>登録内容</p>
    <div>
        <?php
        foreach ($data[0] as $k => $val) {
            if ($k == 'id') {
                continue;
            }
            echo $val . "<br>";
        }
        ?>
        <a href="index.php">マイページへ</a>
    </div>

</body>

</html>