<?php
header("Content-type:text/html;charset=utf-8");
$upfile = '';
//1. 上传文件
if($_FILES['image']['error'] == 0){
    //上传文件成功
    //处理上传文件名     假设111.png  tmp['filename']=111  tmp['extension']=png
    $tmp = pathinfo($_FILES['image']['name']);
    $name = md5($tmp['filename'].time()).'.'.$tmp['extension'];
    $upfile = "../uploads/$name";
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$name");
}

//2. 接收表单其他数据
$text = $_POST['text'];
$link = $_POST['link'];
$state = '不显示';

//3. 引入Mysql类，拼接sql语句，执行数据写入
include_once '../tools/Mysql.class.php';
$m = new Mysql();
$sql = "insert into ali_pic values(null, '$upfile', '$text', '$link', '$state')";

//4. 执行sql
$num = $m->execute($sql);
if($num > 0){
    echo "添加图片轮播成功";
    header('Refresh:2;url=slides.php');
} else {
    echo "添加图片轮播失败";
    header('Refresh:2;url=slides.php');
}




