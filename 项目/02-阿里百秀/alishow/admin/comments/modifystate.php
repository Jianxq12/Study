<meta charset="utf-8">
<?php
//1. 接收前台传递至
$id = $_GET['id'];
$state = $_GET['state'];
//echo $state;die;
//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
$m = new Mysql();

//3. 拼接sql语句
if($state == '批准'){
    $sql = "update ali_comment set cmt_state='驳回' where cmt_id=$id";
} else {
    $sql = "update ali_comment set cmt_state='批准' where cmt_id=$id";
}

//4. 执行修改
$num = $m->execute($sql);
if($num > 0){
    echo "修改成功";
    header('Refresh:2;url=comments.php');
} else {
    echo "修改失败";
    header('Refresh:2;url=comments.php');
}