<?php
//エラーの表示、eの有効化
require_once 'initialize.php';
require_once 'DBManager.php';

session_start();


//エラーメッセージの初期化
$errorMessage="";

//ログインボタンが押された時
if(isset($_POST['login'])){


	// POSTできてることをチェック
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
	exit();
	}

	//未定義チェックの関数の宣言
	function check($post, $key){
	return isset($post[$key]) ? $post[$key] : null;
	}

	//未定義チェック
	$post = $_POST;
	$name = check($post, 'name');
	//パスワードはハッシュ化したほうがよい？？？？？
	$pwd = check($post, 'passwd');

	//ユーザIDのチェック
	if(empty($name)){
		$errorMessage='名前が未入力です';
	}else if(empty($pwd)){
		$errorMessage='パスワードが未入力です';
	}
}

//名前とパスワードが入力されていたら認証する
if(isset($name)&&isset($pwd)){
	//mysqlへ接続
	try{
	
	    $stt = $db->prepare("SELECT id,name,sentence FROM member WHERE name=?");
	    $stt->bindParams(1,$name,PDO::PARAM_STR);

	    //select命令を実行
	    $stt->execute();

	    //パスワードの取り出し
	    while($row=$stt->fetch(PDO::FETCH_ASSOC)){
	    	$db_pwd=$row['passwd'];
	    	$db_id=$row['id'];
	    }

	    if(isset($db_pwd)){
	    	//画面から入力されたパスワードとDBのパスワードを比較
	    	if($pwd === $db_pwd){
		    	//認証成功ならセッションに渡す
		    	$_SESSION['name'] = $name;
		    	header('Location:index2.php');
		    	exit();
	    	}else{
	    		$errorMessage='ユーザー名かパスワード、もしくはその両方が正しくない場合があります。もう一度確認してください。';
	    	}
    	}	

	}catch(PDOException $e){
	    print "エラーコード:{$e->getCode()} </br>";
	    die("エラーメッセージ:{$e->getMessage()}");
	}
}

?>

<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン画面</title>
	<link rel="stylesheet" href="login.css">
</head>
<body>
	<h1>ログイン画面</h1>
	<div><?php print $errorMessage; ?></div>
	<form action="login.php" method="post" >
		名前：<input type="text" name="name" maxlength="10" placeholder="田中太郎"></br>
		パスワード：<input type="password" name="passwd" maxlength="12"></br>
		<input type="hidden" name="id" value="id">
		<input type="submit" name="login" class="btn" value="ログイン">
	</form>
	<a href="post.php">ログインせずに投稿へ進む</a>
	<a href="register.php">会員登録</a>
	<a href="sessionDestroy.php">ログアウト</a>
</body>