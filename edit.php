<!-- 社員参照画面 -->
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
    $employee = htmlspecialchars($_GET['employee_id'],ENT_QUOTES);
    //プリペアードステートメントの作成
    $stmh = $dbh->prepare('SELECT * FROM employee WHERE employee_id = :employee_id');
    //クエリの実行
    $stmh->execute(array(':employee_id' => $employee));
  }catch(PDOException $e){
    exit('データベース接続失敗'.$e->getMessage());
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>社員参照画面</title>
<h1>社員参照画面</h1>
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
      $_SESSION = $row;
  ?>
  <tr>
    <td><a><?php echo htmlspecialchars($row['employee_id'])?></a></td>
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
<br>
<p><a href="http://localhost/Directory/update.php"><button>編集</button></a> <input type="button" value="削除" onClick="disp()"></p>
<p><a href="http://localhost/Directory/Registory.php">社員登録画面</a></p>
<p><a href="http://localhost/Directory/Directory.php">メニュー画面</a></p>
<!-- 削除確認ダイアログ -->
<script type="text/javascript">
function disp(){
  //OK時の処理
  if(window.confirm('データを削除します。\nよろしいですか？')){
    location.href = "http://localhost/Directory/delete.php";//削除完了画面へジャンプ
    <?php $_SESSION['delete'] = 1;?>
  }
  //キャンセル時の処理
  else{
    window.alert('キャンセルされました');
  }
}
</script>
</body>
</html>