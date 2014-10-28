<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 10/28/14
 * Time: 6:15 PM
 * To change this template use File | Settings | File Templates.
 */

$filename = './'.$_REQUEST['img'].'.jpg';
$w = 500;
$h = 200;

$percent = 0.5;

// Content type
if ($w == "gif")
    header('Content-Type: image/gif');
else
    header('Content-Type: image/jpeg');

// Get new sizes
list($width, $height) = getimagesize($filename);
//$newwidth = $width * $percent;
//$newheight = $height * $percent;
$newwidth = 500;
$newheight = 200;

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Output
imagejpeg($thumb);
?>