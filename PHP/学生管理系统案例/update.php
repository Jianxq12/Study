<?php 
header("content-type:text/html;charset=utf8");
include "checklogin.php";
include "connect.php";
include "function.php";

// 测试是否接收到数据
echo "<pre>";
print_r($_POST);
print_r($_GET);

$id = isset($_GET["id"]) ? $_GET["id"] : "";
if(empty($id)){
	redirect("index.php","学号非法");
}

$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$classId = $_POST['classId'];
$tel = $_POST['tel'];
$address = $_POST['address'];

if(empty($name) || empty($tel)){
	redirect("edit.php?id=$id","姓名及手机号不能为空");
}

// 构建执行SQL语句
$sql = "update student set name = '$name',age = '$age',sex = '$sex',classid = '$classId',tel = '$tel',address = '$address' where id = $id";
// die($sql);
if(mysql_query($sql)){
	// var_dump(mysql_query($sql));
	redirect("index.php","修改成功");
}else{
	redirect("edit.php?id=$id","修改失败请重试");
}

 ?>