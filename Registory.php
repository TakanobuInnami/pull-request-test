<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" href="style.css">
<head>
<!--JavaScriptで入力チェック-->
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
        <option>シス開</option>
        <option>ビジソル</option>
        <option>サビ開</option>
      </select><br>
    </dd>
    <dt>メールアドレス*</dt>
      <dd><input type="text" name="mailaddress" placeholder="taro_yaz@yaz.co.jp"><br></dd>
    <dt>性別*</dt>
      <dd><input type="radio" name="sex">男性
      <input type="radio" name="sex">女性<br></dd>
      <div class="must">*必須項目</div>
  </dl>
  <input type="submit" class="button" value="登録">
</form>
<!-- 入力フォーム終わり -->
<p><a href="http://localhost/Directory/Directory.php">メニュー画面</a></p>
</body>
</html>