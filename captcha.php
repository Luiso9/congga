<?php
session_start();
header('Content-type: image/jpeg');

// Generate a random verification code
$text = rand(10000, 99999);
$_SESSION["vercode"] = $text;

// Set the dimensions of the CAPTCHA image
$height = 25;
$width = 65;
$image_p = imagecreate($width, $height);

// Allocate colors
$black = imagecolorallocate($image_p, 0, 0, 0);
$white = imagecolorallocate($image_p, 255, 255, 255);

// Set the font size and position
$font_size = 5; // For imagestring, use a value between 1 and 5
$x = 5;
$y = 5;

// Fill the background with black color
imagefilledrectangle($image_p, 0, 0, $width, $height, $black);

// Draw the random text in white color
imagestring($image_p, $font_size, $x, $y, $text, $white);

// Output the image as JPEG with quality 80
imagejpeg($image_p, null, 80);

// Free memory
imagedestroy($image_p);
?>
