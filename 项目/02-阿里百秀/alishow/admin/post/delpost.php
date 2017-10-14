<?php
//1. 接收id值
$id = $_POST['id'];
//2. 根据id查询图片路径
include_once '../tools/Mysql.class.php';
$m = new Mysql();
$sql = "select post_file from ali_post where post_id=$id";
$post_info = $m->selectOne($sql);
//3. 根据id删除post表中的数据
$sql = "delete from ali_post where post_id=$id";
$num = $m->execute($sql);
if($num > 0){
    //删除文件函数
    //参数: 要删除的文件的路径
    unlink($post_info['post_file']);
    echo 1;
} else {
    echo 2;
}