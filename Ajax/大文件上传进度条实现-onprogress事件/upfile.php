<?php 
if($_FILES['f']['error'] ==0 ){
	// echo $_FILES['f']['name'];
	// 将$_FILES['f']['name']字符串由参数1的字符集，转为参数2的字符集
	$name = iconv('utf-8','gb2312',$_FILES['f']['name']);
	// 如果不进行转换的话，中文会产生乱码。因为我们的程序用的是utf-8，而windows系统用的是gb2312

	//参数1: 临时存放路径
    //参数2: 永久保存路径
	if(move_uploaded_file($_FILES['f']['tmp_name'],$name)){
		echo "上传成功";
	}else{
		echo "上传失败";
	}
}else{
	echo "上传出错";
}


