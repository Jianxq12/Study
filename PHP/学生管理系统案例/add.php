<?php 
include "connect.php";
include "checklogin.php";
// 查询所有班级信息
//构建SQL语句并执行
$sql = "select id,classname from class";
$res = mysql_query($sql);
if(!$res || mysql_num_rows($res) == 0){
	die("暂无开班信息");
}
// 解析结果集
	while ($line = mysql_fetch_assoc($res)) {
		$rows[] = $line;
	}

//当前班级信息存放在二维数组中

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>添加学生</title>
 </head>
 <body>
 	<!-- 信息添加完毕后提交到数据处理页面insert.php -->
 	<form action="insert.php" method="POST" enctype="multipart/form-data">
 		<table border="1" rules="all" align="center" width="60%">
 			<caption><h4>添加学生</h4></caption>
 			<tr>
 				<th>姓名</th>
 				<td><input type="text" name="name"></td>
 			</tr>

 			<tr>
 				<th>年龄</th>
 				<td><input type="text" name="age"></td>
 			</tr>

 			<tr>
 				<th>性别</th>
 				<td>
 					<input type="radio" name="sex" value="男">男
 					<input type="radio" name="sex" value="女">女
 					<input type="radio" name="sex" value="保密">保密
 				</td>
 			</tr>

 			<tr>
 				<th>班级</th>
 				<td>
 				<select name="classId" id="">
 				<?php foreach ($rows as $v) :?>
 					<option value="<?php echo $v["id"]?>"><?php echo $v["classname"]?></option>
 				<?php endforeach;?>
 				</select>
 				</td>
 			</tr>

 			<tr>
 				<th>手机号</th>
 				<td><input type="tel" name="tel"></td>
 			</tr>

 			<tr>
 				<th>地址</th>
 				<td><input type="text" name="address"></td>
 			</tr>

 			<tr>
 				<th>电子图像</th>
 				<td><input type="file" name="upload"></td>
 			</tr>

 			<tr>
 				<td></td>
 				<td><input type="submit" value="添加"></td>
 			</tr>
 		</table>
 	</form>
 </body>
 </html>