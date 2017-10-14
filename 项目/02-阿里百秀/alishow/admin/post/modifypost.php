<?php
header('Content-type:text/html;charset=utf-8');
//1. 接收表单数据
$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$category = $_POST['category'];
$updtime = $_POST['created'];
$status = $_POST['status'];

include_once '../tools/Mysql.class.php';
$m = new Mysql();
$old_path = '';
$new_path = '';
//2. 文件上传
if($_FILES['feature']['error'] == 0){
    $tmp_arr = pathinfo($_FILES['feature']['name']);
    $name = md5($tmp_arr['filename'].time()).'.'.$tmp_arr['extension'];
    move_uploaded_file($_FILES['feature']['tmp_name'], "../uploads/$name");
    //查询原来的图片路径
    $sql = "select post_file from ali_post where post_id=$id";
    $tmp = $m->selectOne($sql);
    //将原来的图片路径保存好，等到数据表修改完成之后，再删除图片
    $old_path = $tmp['post_file'];
    //保存新图片路径
    $new_path = "../uploads/$name";
}

//3. 拼接修改数据表的sql语句
if($new_path != ''){
    $sql = "update ali_post set post_title='$title',post_content='$content',
    post_slug='$slug',post_cateid=$category,post_updtime=$updtime,
    post_state='$status',post_file='$new_path' where post_id=$id";
} else {
    $sql = "update ali_post set post_title='$title',post_content='$content',
    post_slug='$slug',post_cateid=$category,post_updtime=$updtime,
    post_state='$status' where post_id=$id";
}

$num = $m->execute($sql);
if($num > 0){
    //修改成功时，判断老图片的路径是否为空，如果不为空删除老图片
    if($old_path != ''){
        unlink($old_path);
    }
    echo "修改成功";
    header('Refresh:2;url=posts.php');
} else {
    echo "修改失败";
    header('Refresh:2;url=editpost.php?id='.$id);
}















