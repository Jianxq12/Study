<?php

// 制作缩略图函数封装

function thumb($path){
	$arr = getimagesize($path);

	$width = $arr[0];
	$height = $arr[1];

	$src_img = imagecreatefromjpeg($path);

	$dst_img = imagecreatetruecolor($width/2,$height/2);

	imagecopyresampled(
		$dst_img,
		$src_img,
		0,0,
		0,0,
		$width/2,$height/2,
		$width,$height
		);

	$save_path = time().'.png';

	imagepng($dst_img,$save_path);

	imagedestroy($dst_img);
	imagedestroy($src_img);

	return $save_path;
}




