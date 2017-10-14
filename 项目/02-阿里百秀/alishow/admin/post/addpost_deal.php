<?php
header('Content-type:text/html;charset=utf-8');
include_once '../checksession.php';
//1. 接收表单数据
$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$category = $_POST['category'];
$updtime = $addtime = $_POST['created'];
$status = $_POST['status'];

//2. 上传文件处理
$upfile = '';
if($_FILES['feature']['error'] == 0){
    //将上传文件拆解成后缀和文件名
    $tmp_arr = pathinfo($_FILES['feature']['name']);
    //重新组装上传后的文件名
    $filename = md5($tmp_arr['filename'].time()).'.'.$tmp_arr['extension'];
    //定义要保存到数据表中的路径信息
    $upfile = "/admin/uploads/$filename";
    //文件正常上传，则移动到admin/uploads目录下
    move_uploaded_file($_FILES['feature']['tmp_name'], "../uploads/$filename");
}

//3. 补充其他所需数据
//文章摘要，将内容的前100个字符截取出来
$desc = substr($content, 0, 100);
//作者id
$author = $_SESSION['id'];
//初始化点击量
$click = rand(100, 500);
//初始化赞和踩
$goods = rand(50, 200);
$bad = rand(8,20);

//4. 引入Mysql类，编写SQL语句，执行写入操作
include_once '../tools/Mysql.class.php';
$m = new Mysql();
$sql = "insert into ali_post 
        values(null, '$title', '$slug', '$desc', '$content', '$author', '$category', '$upfile', 
        '$addtime', '$updtime', '$status', '$click', '$goods', '$bad')";
$num = $m->execute($sql);
if($num > 0){
    echo "添加文章成功";
    header('Refresh:2;url=posts.php');
} else {
    echo "添加文章失败";
    header('Refresh:2;url=addpost.php');
}













