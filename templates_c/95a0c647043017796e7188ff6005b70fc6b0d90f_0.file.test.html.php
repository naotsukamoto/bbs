<?php /* Smarty version 3.1.27, created on 2015-12-04 00:21:01
         compiled from "templates/test.html" */ ?>
<?php
/*%%SmartyHeaderCode:121407880656605ddd109a56_48467012%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95a0c647043017796e7188ff6005b70fc6b0d90f' => 
    array (
      0 => 'templates/test.html',
      1 => 1449156058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121407880656605ddd109a56_48467012',
  'variables' => 
  array (
    'data' => 0,
    'var' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56605ddd2ca604_72183409',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56605ddd2ca604_72183409')) {
function content_56605ddd2ca604_72183409 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '121407880656605ddd109a56_48467012';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>smartyによる出力</title>
</head>
<body>
<h1>データベース結果一覧</h1>
<!-- データベースの結果をテーブルで出力 -->
<table border="1">
<tr>
	<th>名前</th><th>本文</th>
</tr>
<?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['var'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['var']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
$foreach_var_Sav = $_smarty_tpl->tpl_vars['var'];
?>
<tr>
<td><?php echo $_smarty_tpl->tpl_vars['var']->value['name'];?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['sentence'], ENT_QUOTES, 'UTF-8', true);?>
</td>
</tr>
<?php
$_smarty_tpl->tpl_vars['var'] = $foreach_var_Sav;
}
?>
</table>

</body>
</html><?php }
}
?>