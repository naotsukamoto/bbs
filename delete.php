<?php
//エラーの表示、eの有効化
require_once 'initialize.php';
require_once 'DBManager.php';

session_start();
$sName=$_SESSION['name'];


if(isset($_POST['id'])){
	$id=$_POST['id'];
}

try{
	print '削除中...';

    $str = $db->prepare("DELETE FROM bbs WHERE id=?");

    $str->bindParam(1,$id,PDO::PARAM_INT);

    //select命令を実行
    $str->execute();

    header("Location:index2.php");

}catch(PDOException $e){
    print "エラーコード:{$e->getCode()} </br>";
    die("エラーメッセージ:{$e->getMessage()}");
}

?>