<?php 
header("content-type:text/html;charset=utf8");

include "checklogin.php";
include "connect.php";
include "function.php";

// 接收参数
$id = isset($_GET["id"]) ? $_GET["id"] : "";
if(empty($id)){
	redirect("index.php","学号非法");
}

//构建执行SQL语句
$sql = "delete from student where id = $id";

if(mysql_query($sql)){
	redirect("index.php","删除成功");
}else{
	redirect("index.php","删除失败请重试");
}

 ?>
