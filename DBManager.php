<?php

$dsn = 'mysql:dbname=php; host=localhost';
$usr = 'member_ad';
$passwd = 'memberad';

//データベースの接続を確率
$db = new PDO($dsn, $usr,$passwd);
//エラーの通知方法を設定
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
//エミュレートをオフ⇒静的プレースホルダを用いる(プリペアドステートメントを使用するように設定);
//ソース（http://qiita.com/stk2k/items/c46cc921a4f7b6e4bab2）
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//データベース接続時に使用する文字エンコードを指定
$db->exec('SET NAMES utf8');

?>