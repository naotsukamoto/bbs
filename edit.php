<?php
//エラーの表示、eの有効化
require_once 'initialize.php';
require_once 'DBManager.php';

session_start();
if(isset($_SESSION['name'])){
    $sName=$_SESSION['name'];
}

//変数の初期化
$name="";
$sentence="";

if(isset($_POST['id'])){
	$id=$_POST['id'];

	try{

        $str = $db->prepare("SELECT name,sentence FROM bbs WHERE id=?");

        $str->bindParam(1,$id,PDO::PARAM_INT);
        //select命令を実行
        $str->execute();

        $data = array();

       	$row = $str->fetch(PDO::FETCH_ASSOC);

       	$name=$row['name'];
       	$sentence=$row['sentence'];

   	}catch(PDOException $e){
	    print "エラーコード:{$e->getCode()} </br>";
	    die("エラーメッセージ:{$e->getMessage()}");
	}
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>編集画面</title>
	<link rel="stylesheet" href="edit.css">
</head>
<body>
	<h1>掲示板2(smartyによる掲示板作成)</h1>
	<p>投稿を編集する</p>
	
	<form name="form" action="index2.php" method="post" onSubmit="return checkForm();">
		名前：<input type="text" id="name" name="rename" readonly="<?php if ($name==$sName) echo 'readonly'; ?>" value="<?php print $name; ?>"></br>
		本文：</br>		
		<textarea id="sentence" name="resentence" rows="4" cols="20"><?php print $sentence; ?></textarea></br>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input class="btn" type="submit" value="編集">

	</form>
	<a href="login.php">ログイン画面へ</a>
	<a href="post.php">新しく投稿する</a>

	<script type="text/javascript">
	function checkForm(){

		if(document.form.elements[0].value==""||document.form.elements[1].value==""){
			alert("※未記入項目があります。");
			return false;
		}
	}
	</script>
	<a href="sessionDestroy.php">ログアウト</a>
</body>
</html>