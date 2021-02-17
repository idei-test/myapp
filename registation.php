<?php
session_start();
// セッションで登録しているか確認する（新規登録or登録変更）
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
</head>

<body>
    <!-- 新規 　dbへ登録するためにpost送信-->
    <!--  セッションの有無で新規か変更かを識別させる（違うファイルにpostさせる -->
    <?php if (true) : ?>
        <form action="register_confirm.php" method="post">

            <div>
                <div>必須</div><label>ニックネーム</label><br>
                <input type="text" class="formbox" size="40" name="name" required>
            </div>
            <div>
                <!-- 登録されているアドレスが無いか確認したいajaxで -->
                <div>必須</div><label>メールアドレス</label><br>
                <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9]+\.[a-z]{2,3}$" required>
            </div>

            <div>
                <div>必須</div><label>パスワード(英数字6文字以上)</label><br>
                <input type="text" class="formbox" size="40" name="password" id="password" pattern="^[a-zA-z0-9]{6,}$" required>
            </div>
            <div>
                <div>必須</div><label>パスワード(確認用)</label><br>
                <input type="text" class="formbox" size="40" name="confirm_password" id="confirm" oninput="ConfirmPassword(this)" required>
            </div>
            <div class="submit">
                <input type="submit" name="sb_btn" size="35" value="登録する">
            </div>

        </form>

        <form action="index.php"><input type="submit" value="トップページに戻る"></form>

    <?php else : ?>
        <!-- 変更　パスワードを答えさせる -->
        <form action="" method="post">
            <div>必須</div><label>パスワード</label><br>
            <input type="text" class="formbox" size="40" name="password" id="password" pattern="^[a-zA-z0-9]{6,}$" required>
            </div>
        </form>

    <?php endif ?>

    <script>
        // カスタムバリデーションでpassが一致しているか伝える
        function ConfirmPassword(confirm) {
            var input1 = password.value;
            var input2 = confirm.value;
            if (input1 !== input2) {
                confirm.setCustomValidity("パスワードが一致しません");
            } else {
                confirm.setCustomValidity("");
            }
        }
    </script>
</body>

</html>