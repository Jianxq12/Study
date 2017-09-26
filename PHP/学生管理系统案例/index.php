<?php 
// echo "index.php";
header("content-type:text/html;charset=utf8");

include "connect.php";
include "function.php";

//查询数据
$sql = "select id,name,tel from student";
//执行SQL
$res = mysql_query($sql);
if(!$res || mysql_num_rows($res) == 0){
	die("暂无数据");
}

//解析结果集
while($line = mysql_fetch_assoc($res)){
	$rows[] = $line;
}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>学生信息列表</title>
 </head>
 <body>
 	<table border="1" rules="all" align="center" width="50%">
 	<caption><h4>学生信息列表</h4><a href="add.php">添加学生信息</a>&nbsp;&nbsp;&nbsp;<a href="login.php">登录</a>&nbsp;&nbsp;&nbsp;<a href="exit.php">退出</a></caption>
 		<tr>
 			<th>学号</th>
 			<th>姓名</th>
 			<th>手机</th>
 			<th>操作</th>
 		</tr>

		<?php foreach($rows as $v):?>
 		<tr align="center">
 			<td><?php echo $v["id"]?></td>
 			<!-- 点击姓名跳转到对应详情页detail.php -->
 			<td><a href="detail.php?id=<?php echo $v['id']?>"><?php echo $v["name"]?></a></td>
 			<td><?php echo $v["tel"]?></td>
 			<!-- 点击编辑跳转到信息编辑页edit.php -->
 			<!-- 点击删除跳转到删除页delete.php -->
 			<td><a href="edit.php?id=<?php echo $v["id"]?>">编辑</a> || <a href="delete.php?id=<?php echo $v["id"]?>" onclick="return confirm('确定删除吗')">删除</td>
 		</tr>
 	<?php endforeach;?>
 	</table>
 </body>
 </html>