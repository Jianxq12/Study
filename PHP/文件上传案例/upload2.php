<?php 
header("content-type:text/html;charset=utf8");

// 多文件上传简单实例 不做详细判断（文件类型、大小等）

//将文件信息存放在一个单独变量中
$files = $_FILES["myFile"];
echo "<pre>";
print_r($files);
echo "</pre>";

//遍历数组 获取每个文件的错误信息
foreach ($files["error"] as $key => $value) {
	// $key  表示下标 0,1,2
	// $value  表示每个文件的错误代号
	if($value == 0){
		// 获取每个文件的完整信息
		$oneFile["name"] = $files["name"][$key];
		$oneFile["tmp_name"] = $files["tmp_name"][$key];
		$oneFile["type"] = $files["type"][$key];
		$oneFile["size"] = $files["size"][$key];
		$oneFile["error"] = $files["error"][$key];
		echo "<pre>";
		print_r($oneFile);
		echo "</pre>";

		//处理单个文件上传
		// 文件进行重命名
		$ext = strrchr($oneFile["name"], ".");
		$saveName = date("Ymd-His").mt_rand(1000,9999).$ext;

		//判断是否是POST上传文件
		if(is_uploaded_file($oneFile["tmp_name"])){
			// 移动文件到永久目录
			move_uploaded_file($oneFile["tmp_name"], "upload/".$saveName);
		}
	}
}

echo "上传成功";