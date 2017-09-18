<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="1" rules="all">
	<tr>
		<th>名称</th>
		<th>价格</th>
		<th>销量</th>
	</tr>

<?php 
header("content-type:text/html;charset=utf8");


$goods =[
	// 对应表格的一行数据
	// 名称、价格  对应一列数据
	['goodsName'=>'三星note 8','price'=>6988,'sales'=>400],
	['goodsName'=>'小米6','price'=>4988,'sales'=>3400],
	['goodsName'=>'三星note 3','price'=>3400,'sales'=>200],
	['goodsName'=>'vivo V9','price'=>3400,'sales'=>120]
];

foreach ($goods as $k => $v) {
	// $v 代表一个一维数组
	echo "<tr>
			<td>".$v["goodsName"]."</td>
			<td>".$v["price"]."</td>
			<td>".$v["sales"]."</td>
		</tr>";	
	}
 ?>
 </table>
</body>
</html>