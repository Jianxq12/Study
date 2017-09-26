<?php 
header("content-type:text/html;charset=utf8");

include "checklogin.php";
include "connect.php";
include "function.php";


//接受学号
$id = isset($_GET['id']) ? $_GET['id'] : '';
if(empty($id)){
	redirect("index.php","暂无此学生信息");
}

//查询并执行SQL语句
$sql = "select * from student where id = $id";
$res = mysql_query($sql);
if(!$res || mysql_num_rows($res) == 0){
	redirect("index.php","暂无此学生信息");
}

//解析结果集
$line = mysql_fetch_assoc($res);
// var_dump($line);

//查询班级信息
$classid = $line["classid"];
$sql = "select classname from class where id = $classid";
$res = mysql_query($sql);
$classArr = mysql_fetch_assoc($res);
// var_dump($classArr);
$classname = $classArr["classname"];
// print_r($classname);

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>学生详细信息</title>
 </head>
 <body>
 	<table border="1" rules="all" align="center" width="60%">
 		<caption><h4>学生的详细信息</h4></caption>
 		<tr>
 			<th>姓名</th>
			<td><?=$line['name']?></td>
 		</tr>

 		<tr>
 			<th>年龄</th>
 			<td><?=$line['age']?></td>
 		</tr>

 		<tr>
 			<th>性别</th>
 			<td><?=$line['sex']?></td>
 		</tr>

 		<tr>
 			<th>班级</th>
 			<td><?=$classname?></td>
 		</tr>

		<tr>
 			<th>手机号</th>
 			<td><?=$line['tel']?></td>
 		</tr>

 		<tr>
 			<th>地址</th>
 			<td><?=$line['address']?></td>
 		</tr>

 		<tr>
 			<th>学生图像</th>
 			<td><img src="<?=$line['pic_path']?>" alt="" width='150'></td>
 		</tr>
 	</table>
 </body>
 </html>