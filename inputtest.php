<script type="text/javascript">
    /**
     * [関数名] chkHissu
     * [機　能] 必須項目入力チェック
     * [説　明] フォーム送信時に必須項目が全て入力されているか調べる
     * [引　数] 
     * @param frm フォームオブジェクト
     * [返り値]
     * @return true(必須項目が全て入力されている場合) | false(未入力がある場合)
    */
    function chkHissu(frm){
        /* 必須入力のname属性 */
        var hissu=Array("name","age","sex","comment");
        /* アラート表示用 */
        var hissu_nm = Array("名前","年齢","性別","備考");
        /* 必須入力の数 */
        var len=hissu.length;
        for(i=0; i<len; i++){
            var obj=frm.elements[hissu[i]];
            /* テキストボックス or テキストエリアが入力されているか調べる */
            if(obj.type=="text" || obj.type=="textarea"){
                if(obj.value==""){
                    /* 入力されていなかったらアラート表示 */
                    alert(hissu_nm[i]+"は必須入力項目です");
                    /* 未入力のエレメントにフォーカスを当てる */
                    frm.elements[hissu[i]].focus();
                    return false;
                }
            }else{
                /* radioボタンがチェックされているか調べる */
                for(var j=0, chk=0; j<obj.length; j++){
                    /* チェックされていたらchkフラグをプラス */
                    if(obj[j].checked) chk++;
                }
                if(chk==0){
                    /* 1つもチェックされていない場合はfalseを返してフォーム送信しない */
                    alert(hissu_nm[i]+"は必須入力項目です");
                    return false;
                }
            }
        }
        /* 必須入力項目が全て入力されている場合はtrueを返してフォーム送信 */
        return true;
    }
</script>

<form method="post" action="content/demo/test.php" onsubmit="return chkHissu(this)">
    <fieldset>
        <p>
            名前（必須）：<input type="text" name="name" />
        </p>
        <p>
            年齢（必須）：<input type="text" name="age" size="3" maxlength="2" /> 才
        </p>
        <p>
            性別（必須）：
            <input type="radio" name="sex" value="men" />男
            <input type="radio" name="sex" value="woman" />女
        </p>
        <p>
            備考（必須）：<br>
            <textarea name="comment" cols="40" rows="3"></textarea>
        </p>
        <p>
            確認メール：<input type="checkbox" name="copymail" value="1" />必要
        </p>
        <p>
            <input type="submit" value="送信" />
            <input type="reset" value="リセット" />
        </p>
    </fieldset>
</form>