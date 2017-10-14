<?php
//1. 接收前台传递的参数   1,2,3
$ids = $_POST['ids'];
//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
$m = new Mysql();
$sql = "update ali_comment set cmt_state='批准' where cmt_id in ($ids)";
//3. 执行
$num = $m->execute($sql);
if($num > 0){
    echo 1;
} else {
    echo 2;
}