<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.0                                                                #
# Date:     12-04-2006                                                         #
# Author:   Jose Luis Estevez                                                  #
# License:                                                                     #
# Note:                                                                        #
# Company:  Ministerio de Agriculura y Tierras                                 #
# Web:      www.mat.gob.ve                                                     #
################################################################################
?>
<?php
session_start();
$valores = $_SESSION['TOTALES'];
$analistas = $_SESSION['NOMBRES'];

$total = array_sum($valores);
for($i=0; $i<count($valores); $i++) {
    $porcentajes[$i] = @round(($valores[$i]/$total)*100, 2);
    $angulos[$i] = @round(($porcentajes[$i]*360)/100);
    }

header("Content-type: image/png");

$imagen = imagecreate(650,500);
$bg = imagecolorallocate($imagen,255,255,255);
$gris = imagecolorallocate($imagen,100,100,100);

$color1 = imagecolorallocate($imagen,227,203,93);
$color2 = imagecolorallocate($imagen,93,227,144);
$color3 = imagecolorallocate($imagen,93,169,227);
$color4 = imagecolorallocate($imagen,207,93,227);
$color5 = imagecolorallocate($imagen,227,93,93);
$color6 = imagecolorallocate($imagen,255,255,93);
$color7 = imagecolorallocate($imagen,0,100,93);
$color8 = imagecolorallocate($imagen,0,200,93);
$color9 = imagecolorallocate($imagen,0,0,93);
$color10 = imagecolorallocate($imagen,222,150,93);

$color11 = imagecolorallocate($imagen,100,100,100);
$color12 = imagecolorallocate($imagen,0,100,255);
$color13 = imagecolorallocate($imagen,222,250,100);
$color14 = imagecolorallocate($imagen,222,190,193);
$color15 = imagecolorallocate($imagen,222,0,93);
$color16 = imagecolorallocate($imagen,1,250,34);
$color17 = imagecolorallocate($imagen,3,2,76);
$color18 = imagecolorallocate($imagen,5,43,22);
$color19 = imagecolorallocate($imagen,55,75,44);
$color20 = imagecolorallocate($imagen,78,89,77);

$color21 = imagecolorallocate($imagen,0,0,100);
$color22 = imagecolorallocate($imagen,0,0,255);
$color23 = imagecolorallocate($imagen,0,0,100);
$color24 = imagecolorallocate($imagen,0,0,193);
$color25 = imagecolorallocate($imagen,0,0,93);


$colores = array($color1,$color2,$color3,$color4,$color5, $color6, $color7, $color8, $color9, $color10
				,$color11,$color12,$color13,$color14,$color15, $color16, $color17, $color18, $color19, $color20
				,$color21,$color22,$color23,$color24,$color25
);

$cx = 120;
$cy = 200;
$ancho = 220;
$alto = 220;

$inicio = 0;

for($i=0;$i<count($valores);$i++) {
	if ($valores[$i]!=0){
    imagefilledarc($imagen, $cx, $cy, $ancho, $alto, $inicio, $angulos[$i]+$inicio, $colores[$i], IMG_ARC_PIE);
    imagefilledrectangle($imagen, 250, 122+($i*15), 264, 134+($i*15), $colores[$i]);
    imagestring($imagen, 3, 276, 122+($i*15), strtoupper($analistas[$i]." (".$porcentajes[$i]."%) $valores[$i] Requerimientos"), $gris);
    $inicio += $angulos[$i];}
}
imagestring($imagen, 3, 100, 55, strtoupper($_SESSION['titulo_fecha']), $gris);
imagepng($imagen);
imagedestroy($imagen);

?>