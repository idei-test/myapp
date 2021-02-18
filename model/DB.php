<?php
// このクラスのなかにpdoクラスを所持させる
// 外部にたいしてデータベースにアクセスしやすいメソッド提供する
// バリデーションしない
class DB
{
    private  $db;
    function __construct()
    {
        $this->db = new PDO("mysql:dbname=quiz;host=localhost", "root", "");
    }

    // 新しくユーザー追加
    public function insertUser(array $data)
    {
        //$data['mail']がデーターベースにあるかチェックする処理追加予定
        $stmt = $this->db->prepare(
            "INSERT INTO quiz_user(name,password,email)values(?,?,?)"
        );
        $stmt->bindValue(1, $data['name']);
        $stmt->bindValue(2, $data['password']);
        $stmt->bindValue(3, $data['mail']);
        $stmt->execute();
        $this->db = NULL;
        return $data;
    }
    // bool 指定のユーザーはいるか
    public function hasUser(string $mail, string $pass)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM quiz_user WHERE email=? AND password=?"
        );
        $stmt->bindValue(1, $mail);
        $stmt->bindValue(2, $pass);
        $stmt->execute();
        $this->db = NULL;
        if ($stmt->fetchAll(PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;
    }
    // user 表示
    public function getUser(string $mail, string $pass)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM quiz_user WHERE email=? AND password=?"
        );
        $stmt->bindValue(1, $mail);
        $stmt->bindValue(2, $pass);
        $stmt->execute();
        $this->db = NULL;

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //------------クイズの操作
    // 全体から　タイトルとidを取得
    public function getQuizTitle()
    {
        $stmt = $this->db->prepare(
            "SELECT title,quiz_id FROM quiz_data"
        );
        $stmt->execute();
        $this->db = NULL;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // idを指定して　クイズを検索
    public function getQuiz(string $number)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM quiz_data WHERE quiz_id=?"
        );
        $stmt->bindValue(1, $number);
        $stmt->execute();
        $this->db = NULL;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
