<?php
include_once '../checksession.php';
//1. 接收前台的数据
$id = $_POST['id'];
//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
$m = new Mysql();
//3. 拼接SQL语句
$sql = "delete from ali_user where user_id=$id";
$num = $m->execute($sql);
//4. 返回结果
if($num > 0){
    echo 1;
} else {
    echo 2;
}