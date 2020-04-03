<!-- 削除結果画面 -->
<?php
session_start();

//入力されたデータがない場合登録画面に戻る
if(!isset($_SESSION['delete'])){
  header('Location:Registory.php');
  exit();
}
$_POST = $_SESSION;

//MySQL接続用
$dsn = 'mysql:host=127.0.0.1; dbname=company_directory;charset=utf8mb4';
$db_user = 'root';
$db_pass='';
$dbh = new PDO($dsn,$db_user,$db_pass);
//データ更新
try{
  $unique_id = $_POST['id'];
  $employee_id = $_POST['employee_id'];

//SQL文
  $sql = "DELETE FROM employee WHERE id =$unique_id";
  $stmt = $dbh->prepare($sql);
  $params = array(':id' =>$unique_id);
  $stmt->execute($params);
  //$row = $stmt->fetch(PDO::FETCH_ASSOC);
  //echo   $unique_id;
  echo "データ削除成功";
}catch(PDOException $e){
  exit('データ削除に失敗しました'.$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>削除完了画面</title>
<h1>データを削除しました</h1>
</head>
<body>
<ul>
<li><a href="http://localhost/Directory/Registory.php">社員登録画面</a> </li>
<li><a href="http://localhost/Directory/List.php">社員一覧画面</a></li>
<li><a href="http://localhost/Directory/Directory.php">メニュー画面</a></li>
</ul>
</body>
</html>