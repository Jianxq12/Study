<?php 
header("content-type:text/html;charset=utf8");

$str1 = "Hello World";
$str2 = strtolower($str1);
echo $str1,"<br>",$str2;

$str3 = strtoupper($str2);
echo "<br>",$str3;

$str4 = ucfirst($str2);
echo "<br>",$str4;

echo "<br>";
//去除空白函数
$str5 = "abc";
$str6 = "   def";
$str7 = "   ghi   ";
echo $str5,$str7,"<br>";
echo $str5,ltrim($str7),"<br>";
echo $str5,trim($str7),ltrim($str6),"<br>";
echo "<hr>";

//数组与字符串转换
$url = "www.abc.com/admin/index.php";
$res = explode("/",$url);
echo "<pre>";
print_r($res);

$myurl = implode("@", $res);
echo "<br>",$myurl;

$string1 = "frontend14";
$result1 = str_split($string1,2);
echo "<pre>";
print_r($result1);

$string2 = "前端移动";
$result2 = str_split($string2,3);
echo "<pre>";
print_r($result2);

//位置查找函数
$file = "1-file.html.php";
$pos = strpos($file, ".");
echo $pos;
$pos1 = strrpos($file, ".");
echo "<br>",$pos1;

//截取子字符串
echo "<br>"."文件扩展名为".substr($file, $pos1);

echo "<br>"."文件扩展名为".strchr($file,".");

echo "<br>"."文件扩展名为".strrchr($file, ".");

echo "<br />$file 文件的扩展名为".strrchr($file,'.');

echo "\n\$file 文件的扩展名为".strrchr($file,'.');

echo '\n\$file 文件的扩展名为'.strrchr($file,'.');
