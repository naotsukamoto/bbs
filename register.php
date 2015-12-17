<?php
//エラーの表示、eの有効化
require_once 'initialize.php';
require_once 'funCheck.php';

//エラーメッセージの初期化
$errorMessage="";

//ログインボタンが押された時
if(isset($_POST['register'])){

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
	    print 'POSTデータがきていません';
	    exit();
	}

	//未定義チェック
	$post = $_POST;
	$name = check($post, 'name');
	$pwd = check($post, 'passwd');

	//ユーザIDのチェック
	if(empty($name)){
		$errorMessage='名前が未入力です';
	}else if(empty($pwd)){
		$errorMessage='パスワードが未入力です';
	}

	//名前とパスワードの文字数チェック
	if(strlen($name)>10){
		$errorMessage="ユーザー名の文字数がオーバーしています。";
		exit();
	}
	if(strlen($pwd)>12){
		$errorMessage="パスワードの文字数がオーバーしています。";
		exit();
	}

}


//名前とパスワードがあれば
if(isset($name)&&isset($pwd)){

	try{
	    require_once 'DBManager.php';

	    $str = $db->prepare("INSERT INTO member (name, passwd) VALUES (?,?)");
	    
	    $str->bindParam(1,$name,PDO::PARAM_STR); //bindValueメソッドは、プレイホルダに値をセットする //名前無しパラメータのインデックスは1~
	   	$str->bindParam(2,$pwd,PDO::PARAM_STR);//bind時には型を指定する

	    $str->execute();

	    print "</br>登録完了！";

	}catch(PDOException $e){
	    print "エラーコード:{$e->getCode()} </br>";
	    die("エラーメッセージ:{$e->getMessage()}");
	}
}

?>

<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>会員登録画面</title>
	<link rel="stylesheet" href="login.css">
</head>
<body>
	<h1>会員登録画面</h1>
	<p class="notice">※名前は10文字以内で入力してください。</p>
	<p class="notice">※パスワードは12字以内で入力してください。</p>
	<div><?php print $errorMessage; ?></div>
	<form action="register.php" method="post" name="form" onSubmit="return checkForm();">
		ユーザー名：<input type="text" maxlength='10' name="name" placeholder="田中太郎" pattern="^[0-9A-Za-z]+$"></br>
		パスワード：<input type="password" name="passwd" maxlength="12" pattern="^[0-9A-Za-z]+$"></br>
		<!-- パスワード(再):<input type="password" name="passwd"></br> -->
		<input type="submit" name="register" class="btn" value="登録">
	</form>
	<a href="login.php">ログイン画面へ</a>
	<script type="text/javascript">
	function checkForm(){

		if(document.form.elements[0].value==""||document.form.elements[1].value==""){
			alert("※未記入項目があります。");
			return false;
		}
	}
	</script>
</body>

