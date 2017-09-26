<?php 
// 接收前台传来的id
$id = $_GET['id'];
// 链接数据库服务器
$link = mysql_connect('localhost','root','nanwm');
// 选择数据库
mysql_select_db('itcast',$link);
// 设置字符集
mysql_query("set names utf8");
// 构建SQL语句
$sql = "select * from prov where pid = $id";
// 执行SQL
$res = mysql_query($sql);
// 将结果集资源转为一个option标签的字符串
//前台接收到之后，可以直接写入市或区的select标签中
$str = "<option value='0'>--请选择--</option>";

while ($row = mysql_fetch_assoc($res)) {
	$str .="<option value='{$row['id']}'>{$row['name']}</option>";
}
echo $str;

