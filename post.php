<?php
//エラーの表示、eの有効化
require_once 'initialize.php';

session_start();

$flag=0;
//セッション情報の確認
if(isset($_SESSION['name'])){
	$sName=$_SESSION['name'];
	$flag=1;
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>掲示板2(smartyによる掲示板作成)</title>
	<link rel="stylesheet" href="post.css">
</head>
<body>
	<h1>掲示板2(smartyによる掲示板作成)</h1>
	<h2>メイン画面</h2>
	<p>ユーザ名と本文を投稿しよう</p>
	<p class="notice">※名前は10文字以内で入力してください。</p>
	<p class="notice">※本文は50以内で入力してください。</p>
	<form name="form" action="index2.php" method="post" onSubmit="return checkForm();">
		名前：<?php if($flag==1){ ?><input type="text" id="name" maxlength="10" name="name" readonly="readonly" value="<?php print $sName; ?>"></br><?php }else{ ?>
		<input type="text" id="name" name="name" placeholder="田中太郎"></br><?php } ?>
		本文：</br>
		<textarea id="sentence" name="sentence" maxlength="50" rows="4" cols="20" placeholder="ここに本文を記入してください"></textarea></br>
		<input class="btn" type="submit" value="投稿">
	</form>
	<a href="login.php">ログイン画面へ</a>
	<a href="sessionDestroy.php">ログアウト</a>

	<script type="text/javascript">
	function checkForm(){

		if(document.form.elements[0].value==""||document.form.elements[1].value==""){
			alert("※未記入項目があります。");
			return false;
		}
	}
	</script>

</body>
</html>