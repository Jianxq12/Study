<?php 
header("content-type:text/html;charset=utf8");

// 未设置表单action  数据提交在本页面

// 判断有没有提交
if(!empty($_POST)){
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	$sex = $_POST['sex'];
}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>单选项数据接收</title>
 </head>
 <body>
 	<form action="" method="POST">
 	性别：
 	<!-- 设置数据回显时的默认选中 -->
 	<!-- 已提交数据且与对应项的值相等时，设置该项checked -->
 	<input type="radio" name="sex" value="1" <?php echo (isset($sex) && $sex == '1') ? 'checked' : ''?>>男
 	<input type="radio" name="sex" value="2" <?php echo (isset($sex) && $sex == '2') ? 'checked' : ''?>>女
 	<input type="radio" name="sex" value="3" <?php echo (isset($sex) && $sex == '3') ? 'checked' : ''?>>保密<br>
 	
 	<input type="submit" value="提交">
 	</form>
 </body>
 </html>