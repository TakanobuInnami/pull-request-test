<?php
//MySQL接続用
  try{$dsn = 'mysql:host=127.0.0.1; dbname=company_directory;charset=utf8mb4';
    $db_user = 'root';
    $db_pass='';
    $dbh = new PDO($dsn,$db_user,$db_pass);
    // エラー情報の取得
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // 安全なプリペアドステートメントを使う為の準備
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //SQL文
    $sql = "SELECT * FROM  employee";
    //プリペアードステートメントの作成
    $stmh = $dbh->prepare($sql);
    //クエリの実行
    $stmh->execute();
  }catch(PDOException $e){
    exit('データベース接続失敗'.$e->getMessage());
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>社員一覧画面</title>
<h1>社員一覧画面</h1>
</head>
<body>
<table border="1">
  <tr>
    <th>社員ID</th>
    <th>社員名</th>
    <th>所属セクション</th>
    <th>メールアドレス</th>
    <th>性別</th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>

<p><a href="http://localhost/Directory/Directory.php">メニュー画面</a></p>
</body>
</html>