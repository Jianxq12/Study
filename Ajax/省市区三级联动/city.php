<?php 
// 链接数据库服务器
$link = mysql_connect('localhost','root','nanwm');
// 选择数据库
mysql_select_db('itcast',$link);
// 设置字符集
mysql_query('set names utf8');
// 构建SQL语句
$sql = "select * from prov where pid = 0";
// 执行SQL
$res = mysql_query($sql);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>省市区三级联动</title>
</head>
<body>
	<!-- 载入页面 直接显示省的下拉菜单 市和区的下拉菜单为空 -->
	省：
	<select onchange="getinfo(this.value,'city')">
		<option>--请选择--</option>
		<?php while($row = mysql_fetch_assoc($res)):?>
		<option value="<?=$row['id'];?>"><?=$row['name']?></option>
		<?php endwhile;?>
	</select>
	市：
	<select id="city" onchange="getinfo(this.value,'area')">
		<option>--请选择--</option>
	</select>
	区：
	<select id="area">
		<option>--请选择--</option>
	</select>

	<script type="text/javascript">
		function getXmlHttp(){
			var xhr = null;
			try{
				xhr = new XMLHttpRequest();
			}catch(e){
				try{
					xhr = new AcitveXObject('Microsoft.XMLHTTP');
				}catch(ex){
					xhr = new AcitveXObject('Msxml2.XMLHTTP');
				}
			}
			return xhr;
		}

		function getinfo(id,type){
			var xhr = getXmlHttp();
			// 拼接随机数 避免缓存的影响
			xhr.open('get','getcity.php?id='+id+'&_='+Math.random());
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4){
					document.getElementById(type).innerHTML = xhr.responseText;
				}
			}
			xhr.send(null);
		}
	</script>
</body>
</html>