<?php // トップページ=状態(login or logout) 登録、変更　　回答、作成
require_once('DB.php');

//   セッション危険？ログイン時の認証が成功した段階でセッションIDを再発行する。
session_start();
// postでログインアウト処理
if (isset($_POST['logout'])) {
    unset($_SESSION['login']);
}

// ログイン時のデータベース判定
if (isset($_POST['mail']) && isset($_POST['password'])) {
    $db = new DB();
    if ($db->hasUser($_POST['mail'], $_POST['password'])) {
        $_SESSION['login'] = 'login';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クイズ！</title>
</head>

<body>
    <?php if (isset($_SESSION['login'])) : ?>
        <p>マイページ</p>
        <!-- ログインアウト -->
        <form action="index.php" method="post">
            <input type="submit" name="logout" value="ログアウト">
        </form>
        <!-- 問題作成 -->
        <form action=""><input type="submit" value="クイズ作成"></form>
        <!-- ユーザー情報変更 -->
        <form action=""><input type="submit" value="アカウント情報変更"></form>

    <?php else : ?>
        <p>トップページ</p>
        <!-- 新規登録　registationへ -->
        <form action="registation.php">
            <input type="submit" value="新規登録">
        </form>
        <!-- ログインフォーム -->
        <form action="index.php" method="post">
            <label>アドレス　</label>
            <input type="email" name='mail' size="40" placeholder="xxx@yyy.zzz"><br>
            <label>パスワード</label>
            <input type="password" name="password" size="40" placeholder="パスワード"><br>
            <input type="submit" value="ログイン">
        </form>

    <?php endif ?>
    <!-- クイズ -->
    <div>
        <p>クイズ一覧</p>
        <?php
        // クイズタイトル取得
        $qdb = new DB();
        $quiz_array = $qdb->getQuizTitle();

        // test
        var_dump($quiz_array);

        // jsで記述してajaxで返却してほしい
        foreach ($quiz_array as $q) {
            echo "<form action='answerQuiz.php' method='post'>";
            echo "<input type='hidden' value =" . $q['quiz_id'] . " name='number'>";
            echo "<input type='submit' value='挑戦する'><label>" . $q['title'] . "</label>";
            echo "</form>";
        }
        ?>
    </div>
</body>

</html>