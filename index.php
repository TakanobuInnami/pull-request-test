<?php

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
require_once(realpath(__DIR__) . "/smarty/Smarty.class.php");
$smarty = new Smarty();

Smarty_Autoloader::register();
//各種フォルダの場所を指定する
// $smarty->template_dir = __Dir__."/templates/";
// $smarty->compile_dir = __Dir__."/templates_c/";
// $smarty->config_dir = __Dir__."/configs/";
// $smarty->chache_dir = __Dir__."/cache/";

$name = 'okutani';

$obj = new StdClass();
$obj->hello = 'こんにちは！';

$smarty = new Smarty();
//変数に値を代入する
$smarty->assign('name', $name);
$smarty->assign('obj', $obj);
$smarty->display('index.tpl');
?>