<?php 
header("content-type:text/html;charset=utf8");


//数组打印函数
function dump($arr=[]){
	if(is_array($arr)){
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}else{
		var_dump($arr);
	}
}

//刷新跳转
function redirect($url='',$msg='',$waitSeconds = 2){
	header("refresh:$waitSeconds;url=$url");

	die("<h4>".$msg."</h4>");
}

 ?>