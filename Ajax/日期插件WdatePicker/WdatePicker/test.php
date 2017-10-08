<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>WdatePicker插件测试</title>

	<!-- 引入jquery核心包和WdatePicker.js文件 -->
	<script type="text/javascript" src="jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="WdatePicker/WdatePicker.js"></script>
</head>
<body>

<!-- 文本框中使用onfocus事件来触发WdatePicker函数，并设置日期格式 -->

	<input type="text" id="date" name="date" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})">


	<!-- 时间转换为时间戳 strtotime -->
	<?php
		echo strtotime('2017/10/08 10:12:34');
	?>
</body>
</html>