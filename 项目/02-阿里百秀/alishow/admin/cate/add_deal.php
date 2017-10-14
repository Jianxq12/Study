<?php
header('content-type:text/html;charset=utf-8');
//1. 接收表单提交的数据
$name = $_POST['name'];
$slug = $_POST['slug'];
$class = $_POST['class'];
$state = $_POST['state'];
$show = $_POST['show'];

//2. 引入Mysql.class.php类
include_once '../tools/Mysql.class.php';
//3. 实例化Mysql类
$m = new Mysql();
//4. 拼接添加的sql语句
$sql = "insert into ali_cate values(null, '$name', '$slug', '$class', '$state', '$show')";
//5. 执行sql语句
$num = $m->execute($sql);
//判断影响行数
if($num > 0){
    //添加成功
    echo "添加新分类成功";
    header('Refresh:2;url=addcate.php');
} else {
    echo "添加新分类失败";
    header('Refresh:2;url=addcate.php');
}