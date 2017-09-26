<?php
// print_r($_FILES);
// 文件上传
if($_FILES['f']['error'] == 0){
	$name = iconv('utf-8', 'gb2312', $_FILES['f']['name']);
	if(move_uploaded_file($_FILES['f']['tmp_name'],$name)){
		// 制作缩略图
		// 引入制作缩略图的封装函数
		include_once 'func.php';
		$save_path = thumb($name);
		$arr = array(
			'ori' => $name,
			'sma' => $save_path
			);
		echo json_encode($arr);
		// echo("上传成功");
	}else{
		echo "上传失败";
	}
}else{
	echo "上传出错";
}




