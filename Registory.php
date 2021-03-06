<?php 
  session_start();
  error_reporting(E_ALL & ~E_NOTICE);
  
  //サーバーサイドの入力チェック
  if (isset($_POST)){
    //文字の長さ計算
    $id_len = mb_strlen($_POST['id']);
    $ln_len = mb_strlen($_POST['lastname']);
    $fn_len = mb_strlen($_POST['firstname']);
    $mail_len = mb_strlen($_POST['mailaddress']);

    //IDのチェック
    if(empty($_POST['id'])){
      echo "IDは必ず入力してください<br>";
      $err = 1;
    }elseif($id_len > 10){
      echo "文字数は10文字以内で入力してください<br>";
      $err = 1;
    }elseif(!preg_match("/YZ+\d{8}$/i",$_POST["id"])){
      echo "IDはYZ＋8桁の数字で入力してください<br>";
      $err = 1;
    }
    //姓のチェック
    if(empty($_POST['lastname'])){
      echo "姓は必ず入力してください<br>";
      $err = 1;
    }elseif($ln_len > 25){
      echo "姓は25文字以内で入力してください<br>";
      $err = 1;
    }
    //名のチェック
    if(empty($_POST['firstname'])){
      echo "名は必ず入力してください<br>";
      $err = 1;
    }elseif($fn_len > 25){
      echo "名は25文字以内で入力してください<br>";
      $err = 1;
    }
    //所属セクションのチェック
    if(empty($_POST['section'])){
      echo "所属セクションは必ず入力してください<br>";
      $err = 1;
    }elseif($_POST['section'] != "1" && $_POST['section'] != "2" && $_POST['section'] != "3"){
      echo "シス開かビジソルかサビ開を選択してください<br>";
      $err = 1;
    }
    //メールアドレスのチェック
    if(empty($_POST['mailaddress'])){
      echo "メールアドレスは必ず入力してください<br>";
      $err = 1;
    }elseif($mail_len > 256){
      echo "文字数は256文字以内で入力してください<br>";
    }elseif(!preg_match("/[!#-9A-~]+@+[a-z0-9]+.+[^.]$/i",$_POST["mailaddress"])){
      echo "メールアドレスを正しく入力してください<br>";
      $err = 1;
    }else{
      $email = $_POST['mailaddress'];
    }
    //性別のチェック
    if(empty($_POST['sex'])){
      echo "性別は必ず入力してください<br>";
      $err = 1;
    }elseif($_POST['sex'] != "1" && $_POST['sex'] != "2"){
      echo "男性か女性を選択してください<br>";
      $err = 1;
    }
    //エラーなければ社員IDとメールアドレス重複チェック
    if(empty($err)){echo "test";
      $dsn = 'mysql:host=127.0.0.1; dbname=company_directory;charset=utf8mb4';
      $db_user = 'root';
      $db_pass='';
      $options = array(
        // SQL実行失敗時に例外をスルー
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // デフォルトフェッチモードを連想配列形式に設定
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // バッファードクエリを使う（一度に結果セットを全て取得し、サーバー負荷を軽減）
        // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
      );
      $dbh = new PDO($dsn,$db_user,$db_pass,$options);
      $query = $dbh->prepare('SELECT * FROM employee WHERE mail = :mail limit 1');
      $query->execute(array(':mail' => $email));
      $result = $query->fetch();
      if($result > 0){
        echo "このE-mailは既に使用されています";    
      }else{
      $_SESSION['input_data'] = $_POST;
      // header('Location:join.php');
      exit();
      }
    }
  }

  session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" href="style.css">
<head>
<!-- JavaScriptで入力チェック-->
  <script type="text/javascript">
    function check(frm){
      // 必須入力のname属性
      var mustData = Array("id","lastname","firstname","mailaddress","sex");
      //アラート表示用
      var mustName = Array("ID","姓","名","メールアドレス","性別");
      //必須入力の数
      var len = mustData.length;
      for(i=0; i<len; i++){
        var obj = frm.elements[mustData[i]];
        //テキストボックスが入力されているか調べる。
        if(obj.type="text"){
          if(obj.value==""){
            //入力されていなかったらアラート表示
              alert(mustName[i]+"を入力してください");
              //未入力要素にフォーカス当てる
              frm.elements[mustData[i]].focus();
              return false;
          }else if(mustData[i]=="id"){
            //id正規表現チェック
            var idData = obj.value;
            var idSeiki = /YZ+\d{8}$/i;
            if(idData.match(idSeiki)){//matchの否定形調べる
            }else{
                alert("IDはYZ＋8桁の数字で入力してください");
                return false;
            }
          }else if(mustData[i]=="mailaddress"){
            //メールアドレス正規表現チェック
            var mailData = obj.value;
            var mailSeiki = /[!#-9A-~]+@+[a-z0-9]+.+[^.]$/i;
            if(mailData.match(mailSeiki)){//matchの否定形調べる
            }else{
                alert("メールアドレスは正しく入力してください");
                return false;
            }
          }

        }else{
          //radioボタンがチェックされているか調べる
          for(var j=0,chk=0;j<obj.length;j++){
            //チェックしている場合
            if(obj[j].checked) chk++;
          }
           if(chk==0){
            //１つもチェックされていない場合はfalseを返してフォーム送信しない
            alert(mustName[i]+"を入力してください");
            return false;
          }
        }
      }
        //必須入力項目が全て入力されている場合はtrue返す
        return true;
    }
  </script>
<meta charset="UTF-8">
<title>社員登録画面</title>
<h1>社員登録画面</h1>
</head>
<body>
<!-- 入力フォーム開始 -->
<form  method="post" action ="http://localhost/Directory/Registory.php" onsubmit="return check(this)">
  <dl>
    <dt>社員ID*</dt>
      <dd><input type="text" name="id" placeholder="YZ12345678" size="10"><br></dd>
    <dt>社員名*</dt>
      <dd><input type="text" name="lastname" placeholder="姓">
      <input type="text" name="firstname" placeholder="名"><br></dd>
    <dt>所属セクション*</dt>
    <dd>
      <select name="section">
      <option value="選択してください">選択してください</option>
        <option value="1">シス開</option>
        <option value="2">ビジソル</option>
        <option value="3">サビ開</option>
      </select><br>
    </dd>
    <dt>メールアドレス*</dt>
      <dd><input type="text" name="mailaddress" placeholder="taro_yaz@yaz.co.jp"><br></dd>
    <dt>性別*</dt>
      <dd><input type="radio" name="sex" value="1">男性
      <input type="radio" name="sex" value="2">女性<br></dd>
      <div class="must">*必須項目</div>
  </dl>
  <input type="submit" class="button" value="登録">
</form>
<!-- 入力フォーム終わり -->
<p><a href="http://localhost/Directory/Directory.php">メニュー画面</a></p>
</body>
</html>