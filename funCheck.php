<?php
//関数の宣言
//未定義チェックの関数の宣言
function check($post, $key){
    return isset($post[$key]) ? $post[$key] : null;
}
?>