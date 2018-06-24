<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.0                                                                #
# Date:     12-04-2006                                                         #
# Author:   Jose Luis Estevez                                                  #
# License:                                                                     #
# Note:     Grafico de Promedio Mensual de Requerimientos                      #
# Company:  Ministerio de Agriculura y Tierras                                 #
# Web:      www.mat.gob.ve                                                     #
################################################################################
?>
<?php
//$lines = file('C:\www\helpdesk\install\helpdesk.conf');
$lines = file('/var/www/helpdesk/helpdesk.conf');
foreach ($lines as $line_num => $line) {
        $datos = explode("=", $line);
		$CONFIG[$datos[0]] =$datos[1];
}
	
$HOST = trim($CONFIG['host']);
$USER = trim($CONFIG['usuario']);
$PASSWORD = trim($CONFIG['clave']);
$DATABASE = trim($CONFIG['basedatos']);
$PORT = trim($CONFIG['puerto']);

$mes_actual = date("m");
$anio_actual = date("Y");

$connection = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
pg_query( $connection  , "SET search_path TO helpdesk;");
$maximo_dias = array(
    "01" => 31,
    "02" => 27,
    "03" => 31,
    "04" => 30,
    "05" => 31,
    "06" => 30,
    "07" => 31,
    "08" => 31,
    "09" => 30,
    "10" => 31,
    "11" => 30,
    "12" => 31
    );

$mes_letra = array(
    "01" => "ENE",
    "02" => "FEB",
    "03" => "MAR",
    "04" => "ABR",
    "05" => "MAY",
    "06" => "JUN",
    "07" => "JUL",
    "08" => "AGO",
    "09" => "SEP",
    "10" => "OCT",
    "11" => "NOV",
    "12" => "DIC"
    );
$dias_total = $maximo_dias[$mes_actual];

for ($i = 0; $i < 5;$i++){
	
	$sql = "select count(*) as cantidad from requerimientos where fechacreacion between '$anio_actual-$mes_actual-01 00:00:00.000' and '$anio_actual-$mes_actual-$dias_total 23:59:59.999999';";
	$result = pg_query($connection,$sql);
	$row = pg_fetch_array($result);
	$cantidad = $row['cantidad'];
	
	
	
	$valores[$mes_letra[$mes_actual]] = $cantidad;
	
	if($mes_actual > 1){
		$mes_actual--;
	}
	elseif($mes_actual == 1){
		$mes_actual = 12;
	}
	if($mes_actual < 10){
		$mes_actual = "0".$mes_actual;
	}
	$dias_total = $maximo_dias[$mes_actual];
}
$valores = array_reverse($valores);

header("Content-type: image/gif");

// Definimos las dimensiones de la grafica
$im_w = 320; // Ancho de la imagen
$im_h = 200; // Alto de la imagen
$im_margen = 50; // Margen lateral
$origen = $im_h-35; // Origen de las barras

// Creamos la imagen
$imagen = imagecreate($im_w,$im_h);

// Definimos los colores
$bg = imagecolorallocate($imagen,255,255,255);
$negro = imagecolorallocate($imagen,0,0,0);
$rojo = imagecolorallocate($imagen,255,0,0);
$sombra = imagecolorallocate($imagen,195,195,195);
$gris = imagecolorallocate($imagen,150,150,150);

// Obtenemos la cantidad de valores
$cant = count($valores);

// Distancia entre las barras
$dist = ($im_w - ($im_margen*2))/$cant;

// Máximo y Mínimo de los valores
$max = max($valores);
$min = min($valores);

// Obtenemos la escala según el valor máximo
// y el espacio vertical de la imagen desde
// el origen dejando un margen superior de 10px
$escala = ($origen - 10)/$max;

// Definimos la fuente
$f = 3;
// Obtenemos el ancho y alto de la fuente
$f_w = imagefontwidth($f);
$f_h = imagefontheight($f);

// dibujar la línea de los límites
// mínimo y máximo

// línea del máximo
imageline($imagen,40,$origen-($max*$escala),
$im_w-40,$origen-($max*$escala),$sombra);
// línea del mínimo
imageline($imagen,40,$origen-($min*$escala),
$im_w-40,$origen-($min*$escala),$sombra);

// texto del valor máximo
imagestring($imagen,$f,35-($f_w*strlen($max)),
$origen-($max*$escala)-($f_h/2),$max,$gris);

imagestring($imagen,$f,$im_w-35,
$origen-($max*$escala)-($f_h/2),$max,$gris);

// texto del valor mínimo
imagestring($imagen,$f,35-($f_w*strlen($min)),
$origen-($min*$escala)-($f_h/2),$min,$gris);

imagestring($imagen,$f,$im_w-35,
$origen-($min*$escala)-($f_h/2),$min,$gris);

// ==========================================

// Definimos el ancho de las barras
imagesetthickness($imagen,16);

// Por cada valor, dibujamos una barra
$barra = 0;
foreach($valores as $mes => $valor) {
    // Obtenemos las coordenadas de la barra
    $x = intval($im_margen+($dist/2)+
    ($dist*$barra));
    $y = intval($origen-($valor*$escala));
    // Dibujamos la sombra de la barra
    imageline($imagen,$x-6,$y+6,$x-6,
    $origen,$sombra);
    // Dibujamos la barra
    imageline($imagen,$x,$y,$x,$origen,$rojo);
    // Escribimos el mes
    imagestringup($imagen,$f,$x-($f_h/2),
    $origen+5+(strlen($mes)*$f_w),$mes,$negro);
    // Escribimos el valor
    imagestringup($imagen,$f,$x-($f_h/2),
    $origen-5,$valor,$bg);

    $barra++;
    }

imagesetthickness($imagen,1);
imageline($imagen,10,$origen,$im_w-10,$origen,
$negro);

imagegif($imagen);

imagedestroy($imagen);
pg_close($connection);
?>
