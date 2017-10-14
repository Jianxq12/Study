<?php
//1. 接收前台传递数据
$id = $_POST['id'];
$state = $_POST['val'];

//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
$m = new Mysql();
$sql = "update ali_pic set pic_state='$state' where pic_id=$id";

//3. 执行修改
$num = $m->execute($sql);
if($num > 0){
    echo 1;
} else {
    echo 2;
}