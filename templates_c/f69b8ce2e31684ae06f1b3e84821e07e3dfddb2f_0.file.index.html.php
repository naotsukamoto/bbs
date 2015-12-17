<?php /* Smarty version 3.1.27, created on 2015-12-11 00:49:36
         compiled from "templates/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:61260920056699f10737be1_24363927%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f69b8ce2e31684ae06f1b3e84821e07e3dfddb2f' => 
    array (
      0 => 'templates/index.html',
      1 => 1449762574,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61260920056699f10737be1_24363927',
  'variables' => 
  array (
    'data' => 0,
    'var' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56699f10921db8_12427544',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56699f10921db8_12427544')) {
function content_56699f10921db8_12427544 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '61260920056699f10737be1_24363927';
echo '<?php
';?>//エラーの表示
error_reporting(-1);
ini_set('display_errors', 1);

session_start();

$sName=$_SESSION['name'];

<?php echo '?>';?>

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
	<th>名前</th><th>本文</th><th>編集</th><th>削除</th>
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
<td>
	<?php if ($_smarty_tpl->tpl_vars['var']->value['edit_flag'] == 1) {?>
	<form action="edit.php" method="POST"><input type="submit" value="編集" name="edit"><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['var']->value['id'];?>
"></form>
	<?php }?>
</td>
<td>
	<?php if ($_smarty_tpl->tpl_vars['var']->value['delete_flag'] == 1) {?>
	<form action="delete.php" method="POST"><input type="submit" value="削除" name="delete"><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['var']->value['id'];?>
"></form>
	<?php }?>
</td>
</tr>
<?php
$_smarty_tpl->tpl_vars['var'] = $foreach_var_Sav;
}
?>
</table>
<a href="post.php">投稿ページへ</a>
<a href="login.php">ログイン画面へ</a>
<a href="sessionDestroy.php">ログアウト</a>
</body>
</html><?php }
}
?>