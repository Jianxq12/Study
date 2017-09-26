<?php 
header("content-type:text/html;charset=utf8");

include "checklogin.php";
include "connect.php";
include "function.php";

//接收参数
$id = isset($_GET["id"]) ? $_GET["id"] : '';

//判断是否为空
if(empty($id)){
	// sleep(2);
	redirect("index.php","非法的请求");
}
// var_dump($_GET);
$sql = "select * from student where id = $id";
$res = mysql_query($sql);
if(!$res || mysql_num_rows($res) == 0){
	redirect("index.php","非法的学号");
}
//解析结果集
// 当前结果集只有一行数据 无需循环
$line = mysql_fetch_assoc($res);

//打印学生信息
// print_r($line);
// die;

//查询所有开班信息
$sql = "select id,classname from class";
$res = mysql_query($sql);
if(!$res || mysql_num_rows($res) == 0){
	redirect("index.php","暂无开班信息");
}

//解析结果集
while ($result = mysql_fetch_assoc($res)) {
	$rows[] = $result;
}

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>修改学生信息</title>
 </head>
 <body>
 	<form action="update.php?id=<?php echo $line["id"]?>" method="POST" enctype="multipart/form-data">
 		<table border="1" rules="all" width="60%" align="center">
 			<caption><h4>修改学生信息</h4></caption>
 			<tr>
 				<th>姓名</th>
 				<td><input type="text" name="name" value="<?php echo $line["name"]?>"></td>
 			</tr>

 			<tr>
 				<th>年龄</th>
 				<td><input type="text" name="age" value="<?php echo $line["age"]?>"></td>
 			</tr>

 			<tr>
 				<th>性别</th>
 				<td>
 				<input type="radio" name="sex" value="男" <?php echo $line["sex"] == "男" ? "checked" : ''?>>男
 				<input type="radio" name="sex" value="女" <?php echo $line["sex"] == "女" ? "checked" : ""?>>女
 				<input type="radio" name="sex" value="保密" <?php echo $line["sex"] == "保密" ? "checked" : ""?>>保密
 				</td>
 			</tr>

 			<tr>
 				<th>班级</th>
 				<td>
 					<select name="classId" id="">
 					<?php foreach ($rows as $v):?>
 						<option value="<?php echo $v["id"]?>" <?php echo $v["id"] == $line["classid"] ? "selected" : ""?>><?php echo $v["classname"]?></option>
 					<?php endforeach;?>
 					</select>
 				</td>
 			</tr>

 			<tr>
 				<th>手机号</th>
 				<td><input type="text" name="tel" value="<?php echo $line["tel"]?>"></td>
 			</tr>

 			<tr>
 				<th>地址</th>
 				<td><input type="text" name="address" value="<?php echo $line["address"]?>"></td>
 			</tr>

 			<tr>
 				<td></td>
 				<td><input type="submit" value="修改"></td>
 			</tr>
 		</table>
 	</form>
 </body>
 </html>