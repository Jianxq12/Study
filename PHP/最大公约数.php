<?php 
header("content-type:text/html;charset=utf8");

/*辗转相除法算法：使用两数相除，
余数为0，此时的除数为最大公约数
余数不为0：
使用原先的除数作为被除数，
原先的余数作为除数，进行相除。
直至余数为0.此时的除数，为最大公约数。*/

$num1 = 48;
$num2 = 24;

if(empty($num1) || empty($num2)){
	die("参数不能为0");
}

do {
	$mode = $num1 % $num2;
	
		$num1 = $num2;
		$num2 = $mode;
	
} while ($mode != 0);
echo "最大公约数".$num1;

 ?>