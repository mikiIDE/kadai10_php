<!-- DBとの接続と、SQLの作成を担当する -->
<?php
//エラー表示。下記内容をphpファイルすべての頭にくっ付けるとエラーが見える化する。
ini_set("display_errors", 1);

//1. POSTデータ取得
$name = $_POST["name"];
$email = $_POST["email"];
$naiyou = $_POST["naiyou"];

//2. fileopen、ではなく、DB接続します。PHP DATA OBJECTでPDO！
try {
    //Password:MAMP='root',XAMPP='' dbname=自分で作成したdb名, 'root',''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage()); //データベース接続で起きたエラーを取得する！
}


//３．データ登録SQL作成 vindValueを介することでSQLインジェクションを避けることができる
$sql = "INSERT INTO gs_an_table(name,email,naiyou,indate)VALUES(:name,:email,:naiyou, sysdate() );"; //:バインド変数（橋渡し役の変数）
$stmt = $pdo->prepare($sql); //クエリ（要求）をセット。
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（文字の場合 PDO::PARAM_STR)（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);
$status = $stmt->execute(); //クエリ（要求）実行役。trueかfalseが返ってくる

//４．データ登録処理後
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
} else {
    //５．index.phpへリダイレクト。処理が終わったら（うまくいったら）ドコドコに戻す。
    header("Location:index.php");
    exit();
}
?>