<?php
//エラーの表示、eの有効化
require_once 'initialize.php';
session_start();
//セッションの破棄
session_destroy();
header("Location:login.php");
?>