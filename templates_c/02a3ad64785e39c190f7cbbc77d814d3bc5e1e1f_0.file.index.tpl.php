<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-03 08:42:30
  from 'C:\xampp\htdocs\Directory\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e86dad64b2b12_67317364',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02a3ad64785e39c190f7cbbc77d814d3bc5e1e1f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Directory\\templates\\index.tpl',
      1 => 1585896015,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e86dad64b2b12_67317364 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Smartyテスト</title>
     <link rel="stylesheet" href="comn/style.css">
</head>
<body>
          やあ、<?php echo $_smarty_tpl->tpl_vars['obj']->value->hello;?>
 <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

</body>
</html><?php }
}
