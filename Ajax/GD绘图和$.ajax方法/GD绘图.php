<?php
//设置响应类型
header("content-type:image/png");


// 创建真色彩画布
//参数1/2: 画布的宽高
//返回值: 画布资源
$img = imagecreatetruecolor(200,200);

// 创建画笔
//参数1:画布资源
//参数2/3/4: 红绿蓝的色值
$red = imagecolorallocate($img,255,0,0);
$green = imagecolorallocate($img,0,255,0);
$blue = imagecolorallocate($img,0,0,255);
$white = imagecolorallocate($img,255,255,255);
$black = imagecolorallocate($img,0,0,0);

// 填充背景色
//参数1:画布资源
//参数2/3: 坐标点，只需要在画布的宽高之内即可
//参数4:背景色
imagefill($img,100,100,$blue);

// 绘图
//参数1:画布资源
//参数2:字体大小  1-7
//参数3/4: 绘制的起始坐标点
//参数5: 要绘制的字符串
//参数6: 绘制的颜色
imagestring($img, 6, 30, 90, "hello ajax", $black);

// 保存/显示
//参数1: 画布资源
//参数2:保存路径，可选。不设置，则只进行显示。设置，则只进行保存
imagepng($img);
//imagepng($img, 'd:/a.png');
//imagejpeg($image);
//imagegif($image);
//imagewbmp($image)

// 销毁画布资源
imagedestroy($img);


