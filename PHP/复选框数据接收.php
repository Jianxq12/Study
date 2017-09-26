<?php 
header("content-type:text/html;charset=utf8");

// 未设置表单action 数据提交在本页面
// 判断是否提交
if(!empty($_POST)){
	$hobbys = $_POST['hobby'];
	echo "<pre>";
	print_r($hobbys);
	echo "</pre>";
}

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>复选框数据接收</title>
 </head>
 <body>
 	<form action="" method="POST">
 		爱好：
 		<!-- 设置数据回显时的默认选中 -->
 	<!-- 已提交数据且对应项的值在数组中时，设置该项checked -->
 		<input type="checkbox" name="hobby[]" value="1" <?php if(isset($hobbys) && in_array('1', $hobbys)){echo "checked";}?>>eat
 		<input type="checkbox" name="hobby[]" value="2" <?php if(isset($hobbys) && in_array('2', $hobbys)){echo "checked";}?>>code
 		<input type="checkbox" name="hobby[]" value="3" <?php if(isset($hobbys) && in_array('3', $hobbys)){echo "checked";}?>>sleep <br>

 		<input type="submit" value="提交">
 	</form>
 </body>
 </html>