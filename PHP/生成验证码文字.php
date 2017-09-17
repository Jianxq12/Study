<?php 
header("content-type:text/html;charset=utf8");
include "dump.php";

$arr1 = range("A", "Z");
$arr2 = range("a", "z");
$arr3 = range(1, 9);

//组合新数组
$pool = array_merge($arr1,$arr2,$arr3);

dump($pool);
// 打乱数组元素的顺序
shuffle($pool);

dump($pool);

// 随机返回四个元素的下标
$index = array_rand($pool,4);
dump($index);

$code = '';
// 获取以上数组元素的值
foreach ($index as $v) {
	// $v  $pool数组元素的下标
	$code .= $pool[$v];
}
echo "验证码字符串".$code;
 ?>