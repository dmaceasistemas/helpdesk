<?php

// quick thumbnailer
// pretty self explanatory, uses PHP GD to thumbnail photographs in the directory marked by $config['path'];
// just a three minute script thats good for people looking for an easy quick thumbnailer.
// ~dovka

$config = array();
$config['path'] = "./";
$config['t_width'] = 120;
$config['t_height'] = 98;
$config['ignore'] = array("",".","..");
$config['prefix'] = "thumb_";

// don't edit below this line
// start with defining variables

$done = 0;
define("IMAGE_JPG", 2);
define("ENDL", "\n");

if($handle = opendir($config['path'])) {
        while(false !== ($file = readdir($handle))) {
                if(!array_search($file,$config['ignore'])) {
                        // check for JPG
                        list($im_width, $im_height, $type) = getimagesize($file);
                        if($type != IMAGE_JPG) {
                                continue;
                        }
                        
                        $op .= "found -> <a href='{$file}'>$file</a>" . ENDL;
                        $im = @imagecreatefromjpeg($file);
                        if(!$im) {
                                $op .= "fail -> couldn't create sour image pointer." . ENDL;        
                                continue;
                        }
                        
                        if(file_exists($config['prefix'] . $file) || substr($file, 0, strlen($config['prefix'])) == $config['prefix']) {
                                $op .= "note -> this file has already got a thumbnail." . ENDL;        
                                continue;
                        }

                        $to = imagecreatetruecolor($config['t_width'],$config['t_height']);
                        if(!$to) {
                                $op .= "fail -> couldn't create dest image pointer." . ENDL;        
                                continue;
                        }                        
                        
                        if(!imagecopyresampled($to, $im, 0, 0, 0, 0, $config['t_width'], $config['t_height'], $im_width, $im_height)) {
                                $op .= "fail -> couldn't create thumbnail. php fail." . ENDL;        
                                continue;
                        }
                        
                        // save file
                        imagejpeg($to, $config['prefix'] . $file);
                        $op .= "done -> created thumb: <a href='{$config['prefix']}{$file}'>{$config['prefix']}{$file}</a>" . ENDL;        
                        $done++;
                }
        }
}
closedir($handle);
$op .= "fin -> {$done} file(s) written" . ENDL;

echo "<pre>";
echo $op;
echo "</pre>";

exit;

?>
