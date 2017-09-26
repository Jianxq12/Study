<?php
header("content-type:image/png");

// 制作缩略图示例如下：

//获取图片宽高
$arr = getimagesize('1.jpg');
// print_r($arr);

$width = $arr[0];
$height = $arr[1];

// 创建图片画布
//参数：图片路径
$src_img = imagecreatefromjpeg('1.jpg');

// 创建空画布资源 (用来保存缩略图)
$dst_img = imagecreatetruecolor($width/2, $height/2);

// 制作缩略图
imagecopyresampled(
	$dst_img,//空的画布资源，缩略最终要填充在该资源中
	$src_img,//原图，根据该图片来制作缩略图
	0, 0,//从空画布资源的哪个点开始填充图片的像素点
	300, 500,//从原图的哪个点开始复制像素
	$width/2, $height/2,//填充空画布资源的宽高
	$width, $height//复制原图的宽高
	);

// 保存图片
imagepng($dst_img,'e:/thumb.png');

// 销毁原图和缩略图资源
imagedestroy($dst_img);
imagedestroy($src_img);


