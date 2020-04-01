<?php
session_start();

//入力されたデータがない場合登録画面に戻る
if(!isset($_SESSION['input_data'])){
  header('Location:Registory.php');
  exit();
}
$_POST = $_SESSION['input_data'];

//MySQL接続用
$dsn = 'mysql:host=127.0.0.1; dbname=company_directory;charset=utf8mb4';
$db_user = 'root';
$db_pass='';
$dbh = new PDO($dsn,$db_user,$db_pass);
//データ登録
try{
  $id = $_POST['id'];
  $lastname = htmlspecialchars( $_POST['lastname'], ENT_QUOTES);
  $firstname = htmlspecialchars($_POST['firstname'], ENT_QUOTES);
  $section = htmlspecialchars($_POST['section'], ENT_QUOTES);
  $mailaddress = htmlspecialchars($_POST['mailaddress'], ENT_QUOTES);
  $sex = htmlspecialchars($_POST['sex'], ENT_QUOTES);

  $sql = "INSERT INTO employee (employee_id,family_name,first_name,section_id,mail,gender_id) VALUES(:employee_id,:family_name,:first_name,:section_id,:mail,:gender_id)";
  $stmt = $dbh->prepare($sql);
  $params = array(':employee_id' =>$id,':family_name' =>$lastname,':first_name' =>$firstname ,':section_id' =>$section,':mail' =>$mailaddress,':gender_id' =>$sex);
  $stmt->execute($params);  
  echo "登録成功";
}catch(PDOException $e){
  exit('データベース接続失敗'.$e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>登録完了画面</title>
<h1>データを登録しました</h1>
</head>
<body>
<ul>
<li><a href="http://localhost/Directory/Registory.php">社員登録画面</a> </li>
<li><a href="http://localhost/Directory/List.php">社員一覧画面</a></li>
<li><a href="http://localhost/Directory/Directory.php">メニュー画面</a></li>
</ul>
</body>
</html>