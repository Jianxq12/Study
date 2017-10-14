<?php
//1. 接收post表单提交的数据
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$pwd = md5($_POST['password']);

//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
$m = new Mysql();

//3. 拼接SQL语句，执行SQL
$sql = "insert into ali_user values(null, '$email', '$slug', '$nickname', '$pwd', ' ', 1)";

$num = $m->execute($sql);

//4. 判断影响行数，返回结果给前台
if($num > 0){
    echo "添加成功";
    //header('Refresh:2;url=users.php');
    echo "<script>var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>";
} else {
    echo "添加失败";
    //header('Refresh:2;url=users.php');
    echo "<script>var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>";
}