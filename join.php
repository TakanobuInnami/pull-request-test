<?php
//MySQL接続用
$dsn = 'mysql:host=127.0.0.1; dbname=company_directory;chrset=utf8mb4';
$db_user = 'root';
$db_pass='';

try{
  $pdo = new PDO($dsn,$db_user,$db_pass);
  echo "DB接続成功<br>";
}catch(PDOException $e){
  exit('データベース接続失敗'.$e->getMessage());
}

?>