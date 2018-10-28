<?php
$sert = imagecreatetruecolor(400, 500);
$backColor = imagecolorallocate($sert, 120,random_int(1,255),random_int(1,255));
$textColor = imagecolorallocate($sert, 10, random_int(1,255),random_int(1,255));
imagefill($sert, 0, 0, $backColor);
$fontFile = __DIR__.'/ARIAL.TTF';
$text = $_GET['name'];
imagefttext($sert, 80, 0, 0, 250, $textColor, $fontFile, $text);
header('Content-type: image/png');
imagepng($sert);
imagedestroy($sert);
?>