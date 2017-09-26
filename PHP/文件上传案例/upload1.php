<?php 
header("content-type:text/html;charset=utf8");

//1.判断数组是否为空
if(empty($_FILES)){
	die("发生未知错误");
}

//将文件信息存放在一个单独变量中
$file = $_FILES["myFile"];
print_r($file);

//2.判断是否发生错误
$errorMsg = "";
if($file["error"] != 0){
	switch ($file["error"]){
		case 1:
			$errorMsg = "文件超过2M";
			break;
		case 4:
			$errorMsg = "没有上传文件";
			break;
		case 6:
			$errorMsg = "没有找到临时文件夹";
			break;
	}
	die($errorMsg);
}

//3.是否是合法的HTTP POST上传文件
if(!is_uploaded_file($file["tmp_name"])){
	die("非法上传的文件");
}

//限定上传文件的大小 设置最大为1.2M
$maxFile = 1.2;
if($file["size"] / 1024 /1024 > $maxFile){
	die("文件大小超过允许上限");
}

//获取当前文件后缀
$ext = strrchr($file["name"], ".");

//避免不同用户上传的文件同名 进行重命名
$saveName = date("YmdHis").mt_rand(1000,9999).$ext;
// die($saveName);

//获取文件MIME类型
//打开finfo资源
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
// var_dump($fileInfo);
// resource(2) of type (file_info)

//返回mime类型
$mime = finfo_file($fileInfo, $file["tmp_name"]);
// die($mime);

//定义网站支持的mime类型
$mimeArr = ["image/png","image/jpeg"];

//判断mime类型是否在数组中存在
if(!in_array($mime, $mimeArr)){
	die("不支持的文件类型");
}

//移动文件到upload文件夹（服务器的永久目录）
if(move_uploaded_file($file["tmp_name"], "upload/".$saveName)){
	echo "<script>alert('文件上传成功')</script>";
}else{
	echo "<script>alert('移动文件失败')</script>";
}


