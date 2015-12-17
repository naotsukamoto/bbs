<?php
//エラーの表示、eの有効化
require_once 'initialize.php';
require_once 'smarty/Smarty.class.php';
require_once 'funCheck.php';
require_once 'DBManager.php';

session_start();

//edit.phpからポストされたid
if(isset($_POST['id'])&&is_int($_POST['id'])){
    $id=$_POST['id'];
}

//edit.phpからポストされたnameとsentence
if(isset($_POST['rename'])&&isset($_POST['resentence'])){
    if(is_string($_POST['name'])&&is_string($_POST['resentence'])){
        if(strlen($_POST['sentence'])<255){
            $rename=$_POST['rename'];
            $resentence=$_POST['resentence'];
        }
    }
}

//login.phpからのセッション情報
if(isset($_SESSION['name'])){
    $sName=$_SESSION['name'];
}else{
    $sName="";
}


//smartyのインスタンス作成
$smarty = new Smarty();
$smarty->template_dir = 'templates/';
$smarty->compile_dir  = 'templates_c/';

try{

    if(isset($rename)&&isset($resentence)){//edit.phpからの遷移
        
        $str = $db->prepare("UPDATE bbs SET sentence=? WHERE id=?");

        $str->bindParam(1,$resentence,PDO::PARAM_INT); //bindValueメソッドは、プレイホルダに値をセットする //名前無しパラメータのインデックスは1~
        $str->bindParam(2,$id,PDO::PARAM_STR);//bind時には型を指定する

        $str->execute();

        $stt = $db->prepare("SELECT id,name,sentence FROM bbs");

    }else if(isset($sName)){//ログインしているかどうか

        if(isset($_POST['name'])&&isset($_POST['sentence'])){
            $name=$_POST['name'];
            $sentence=$_POST['sentence'];
        }


        if(isset($name)){//ログインしててかつpost.phpからの遷移
            $str = $db->prepare("INSERT INTO bbs (name,sentence,user_name) VALUES(?, ?, '$sName')");
   
            //insert命令にポストデータの内容をセット
            $str->bindParam(1,$name,PDO::PARAM_STR); //bindValueメソッドは、プレイホルダに値をセットする //名前無しパラメータのインデックスは1~
            $str->bindParam(2,$sentence,PDO::PARAM_STR);//bind時には型を指定する
            //insert命令を実行する
            $str->execute();
        }

        $stt = $db->prepare("SELECT id,name,sentence FROM bbs");

    }else{//ログインしてなくてかつpost.phpからの遷移

        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            print 'POSTデータがきていません';
            exit();
        }

        //未定義チェック
        $post = $_POST;
        $name = check($post, 'name');
        $sentence = check($post, 'sentence');

        $stt = $db->prepare("INSERT INTO bbs (name,sentence) VALUES(?, ?)");
   
        //insert命令にポストデータの内容をセット
        $stt->bindParam(1,$name,PDO::PARAM_STR); //bindValueメソッドは、プレイホルダに値をセットする //名前無しパラメータのインデックスは1~
        $stt->bindParam(2,$sentence,PDO::PARAM_STR);//bind時には型を指定する

        $errorMessage="登録完了！";
    }

    $stt->execute();

    $data = array();

    //一致したら$flagをtrueに
    while($row = $stt->fetch(PDO::FETCH_ASSOC)){
        
        if($row['name']==$sName){
            $row['owner_flag']=1;
        }else{
            $row['owner_flag']=0;
        }

        $data[]=$row;
    }

    $smarty->assign('data',$data);
    $smarty->assign('errorMessage',$errorMessage);

}catch(PDOException $e){
    // print "エラーコード:{$e->getCode()} </br>";
    // die("エラーメッセージ:{$e->getMessage()}");
    $errorMessage="システムエラーです。";

}

$smarty->display('index.tpl');

?>