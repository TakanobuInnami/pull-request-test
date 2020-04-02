<?php
session_start();
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
    $sql = "SELECT employee_id,family_name,first_name,section_id,mail,gender_id FROM employee";
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
<!-- 表の表示部分 -->
<table border="1">
  <tr>
    <th>社員ID</th>
    <th>社員名</th>
    <th>所属セクション</th>
    <th>メールアドレス</th>
    <th>性別</th>
  </tr>
  <!-- データベース取り込み -->
  <?php
    while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
  ?>
  <tr>
    <td><a href="edit.php?employee_id=<?php echo $row['employee_id']?>"><?php echo htmlspecialchars($row['employee_id'])?></a></td>
    <td><?=htmlspecialchars($row['family_name'])?> <?=htmlspecialchars($row['first_name'])?></td>
    <td><?php if(htmlspecialchars($row['section_id'])==1){
          echo "シス開";
        }elseif(htmlspecialchars($row['section_id'])==2){
          echo "ビジソル";
        }elseif(htmlspecialchars($row['section_id'])==3){
          echo "サビ開";
        } ?>
    </td>
    <td><?=htmlspecialchars($row['mail'])?></td>
    <td><?php if(htmlspecialchars($row['gender_id'])==1){
          echo "男性";
        }elseif(htmlspecialchars($row['gender_id'])==2){
          echo "女性";
        }?>
    </td>
  </tr>
  <?php
    }
    $pdo = null;
  ?>
</table>

<p><a href="http://localhost/Directory/Registory.php">社員登録画面</a></p>
<p><a href="http://localhost/Directory/Directory.php">メニュー画面</a></p>
</body>
</html>