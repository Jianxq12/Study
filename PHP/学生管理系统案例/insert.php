<?php 
header("content-type:text/html;charset=utf8");

include "checklogin.php";
include "function.php";
include "connect.php";

echo "<pre>";
print_r($_POST);

//接收数据
if(empty($_POST)){
	redirect("add.php","非法请求");
}

$name = $_POST["name"];
$age = $_POST["age"];
$sex = $_POST["sex"];
$classId = $_POST["classId"];
$tel = $_POST["tel"];
$address = $_POST["address"];

//处理图像上传
$pic = '';
if(!empty($_FILES)){
	$file = $_FILES["upload"];
	print_r($file);
	//判断是否发生错误 是否是HTTP POST上传文件
	if($file["error"] == 0 && is_uploaded_file($file["tmp_name"])){
		$ext = strrchr($file["name"], ".");
		$saveName = "upload/".date("YmdHis").mt_rand(1000,9999).$ext;
		if(move_uploaded_file($file["tmp_name"], $saveName)){
			//移动成功 将路径保存在$pic
			$pic = $saveName;
		}
	}
}

//构建执行SQL语句
$sql = "insert into student values (null,'$name','$age','$classId','$sex','$tel','$address','$pic')";

if(mysql_query($sql)){
	//执行成功跳转到首页
	redirect("index.php","添加成功");
}else{
	//执行失败返回添加页
	redirect("add.php","添加失败，请重试");
}

 ?>