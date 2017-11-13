<?php 
	// 读取json文件  string
	$jsonStr = file_get_contents('info/data.json');

	// 转化为 php数组 array
	$totalArr = json_decode($jsonStr);
	

	// 从数组中随机获取10个值 返回的是一个随机key 数组
	$randomKeys = array_rand($totalArr,10);

	// print_r($randomKeys);


	// 准备一个新的数组 php中的数组长度是可变的
	$newArr = array(); //长度为0

	// 使用随机的key  去取随机的值 count(数组) 可以获取php中数组的长度
	for ($i=0; $i <count($randomKeys) ; $i++) { 
		// 获取 索引数组中的 每一个key
		$key = $randomKeys[$i];

		// 使用key从总数组中获取key对应的值 对象
		$obj = $totalArr[$key];

		// 放到一个新的数组中
		$newArr[$i] = $obj;  //数组的长度 随着索引值的更改而改变
	}
	// 测试结果
	// print_r($newArr);
	
	// 将这10个值 转化为 json 格式字符串 发回给浏览器
	echo json_encode($newArr);

 ?>