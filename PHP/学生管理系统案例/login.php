<?php 
header("content-type:text/html;charset=utf8");

// 判断是否有登录成功标志
session_start();
if(isset($_SESSION['user'])){
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
	<form action="validate.php" method="POST">
		用户名：
		<input type="text" name="user"><br>
		密码：
		<input type="password" name="pass"><br>
		<input type="submit" value="登录">
	</form>
</body>
</html>
