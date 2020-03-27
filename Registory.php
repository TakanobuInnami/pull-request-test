<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" href="style.css">
<head>
<meta charset="UTF-8">
<title>社員登録画面</title>
<h1>社員登録画面</h1>
</head>
<body>
<form action="" method="post">
  <dl>
    <dt>社員ID*</dt>
      <dd><input type="text" name="id"><br></dd>
    <dt>社員名*</dt>
      <dd><input type="text" name="lastname" placeholder="山田">
    <input type="text" name="firstname" placeholder="太郎"><br></dd>
    <dt>所属セクション*</dt>
    <dd>
      <select name="section">
        <option>システム開発</option>
        <option>経理</option>
      </select><br>
    </dd>
    <dt>メールアドレス*</dt>
      <dd><input type="text" name="mailaddress"><br></dd>
    <dt>性別*</dt>
      <dd><input type="radio">男性<input type="radio">女性<br></dd>
      <div class="must">*必須項目</div>
  </dl>
  <input type="submit" class="button" value="登録">
</form>

<p><a href="http://localhost/Directory/Directory.php">メニュー画面</a></p>
</body>
</html>