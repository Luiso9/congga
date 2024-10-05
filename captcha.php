<?php
session_start();
header('Content-type: image/jpeg');
$text = rand(10000, 99999);
$_SESSION["vercode"] = $text;

$height = 25;
$width = 65;
$image_p = imagecreate($width, $height);

$black = imagecolorallocate($image_p, 0, 0, 0);
$white = imagecolorallocate($image_p, 255, 255, 255);

$font_size = 5; 
$x = 5;
$y = 5;

imagefilledrectangle($image_p, 0, 0, $width, $height, $black);

imagestring($image_p, $font_size, $x, $y, $text, $white);

imagejpeg($image_p, null, 80);

imagedestroy($image_p);
?>
