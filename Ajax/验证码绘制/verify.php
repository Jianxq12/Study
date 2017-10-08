<?php
header('Content-Type:image/png');
//echo sprintf('%c', 67);

//1. 产生验证码字符串
$code = '';
//每次循环随机产生一个字符，拼接到$code中
for($i = 0; $i < 4; $i++){
    $tmp = rand(1,3);
    switch ($tmp){
        case 1:
            //随机产生一个0-9之间的数字，拼接到$code中
            $code .= sprintf('%c', rand(48, 57));
            break;
        case 2:
            //随机产生一个A-Z之间的字符，拼接到$code中
            $code .= sprintf('%c', rand(65, 90));
            break;
        case 3:
            //随机产生一个a-z之间的字符，拼接到$code中
            $code .= sprintf('%c', rand(97, 122));
            break;
    }
}
//开启session
session_start();
//将验证码存入session
$_SESSION['code'] = $code;


//2. 绘制验证码
//① 创建画布
$img = imagecreatetruecolor(90, 30);
//② 创建画笔
$red = imagecolorallocate($img, 255, 0, 0);
$green = imagecolorallocate($img, 0, 255, 0);
$blue = imagecolorallocate($img, 0, 0, 255);
$white = imagecolorallocate($img, 255, 255, 255);
$black = imagecolorallocate($img, 0, 0, 0);
$tmp = imagecolorallocate($img, 128, 128, 128);
$arr = array($red, $green, $blue, $white, $black);
//③ 填充背景色
imagefill($img, 0, 0, $tmp);
//④ 绘制验证码
for($i = 0; $i < 4; $i++){
        imagettftext(
        $img,    //画布资源
        rand(15, 20),   //字体大小
        rand(-30, 30),  //倾斜角度
        10 + 18 * $i,         //绘制文字的起始X坐标点
        20,         //绘制文字的起始Y坐标点
        $arr[rand(0,4)], //绘制文字的颜色
        'SIMSUN.TTC',   //字体文件路径
        $code[$i]       //绘制的字符串
    );
}

//⑤ 显示图片
imagepng($img);
//⑥ 销毁图片资源
imagedestroy($img);


