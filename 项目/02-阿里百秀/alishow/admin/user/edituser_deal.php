<?php
//1. 接收表单数据
$id = $_POST['id'];  //隐藏域传递的值
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];

//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
$m = new Mysql();
$sql = "update ali_user set 
        user_email='$email',user_slug='$slug',user_nickname='$nickname' where user_id=$id";

$num = $m->execute($sql);
if($num > 0){
    echo 1;
} else {
    echo 2;
}