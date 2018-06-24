<?php
$connection = pg_connect("host=192.168.0.1 port=5432 dbname=db_prueba user=postgres password=b1s2d2d1t4s");
pg_query( $connection  , "SET search_path TO helpdesk;");
$mes_actual = date("m");
$anio_actual = date("Y");


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
for ($i = 0; $i < 6;$i++){
	$sql = "select count(*) as cantidad from requerimientos where fechacreacion between '$anio_actual-$mes_actual-01 00:00:00.000' and '$anio_actual-$mes_actual-$dias_total 23:59:59.999999';";
	//echo $sql;
	$result = pg_query($connection,$sql);
	$row = pg_fetch_array($result);
	$cantidad = $row['cantidad'];

	$valores[$mes_letra[$mes_actual]] = $cantidad;
	
	if($mes_actual > 1){
		$mes_actual--;
	}
	elseif($mes_actual == 1){
		$mes_actual = 12;
		$anio_actual = $anio_actual - 1;
	}
	if($mes_actual < 10){
		$mes_actual = "0".$mes_actual;
	}
	$dias_total = $maximo_dias[$mes_actual];
}
$valores = array_reverse($valores);

$xml = "";
$xml .= "<chart caption='Requerimientos' xAxisName='Mes' yAxisName='Cantidad' showValues='0' decimals='0' formatNumberScale='0'>";

foreach($valores as $mes => $valor) {
	$xml .= "<set label='$mes' value='$valor' />";
}
$xml .= "</chart>	";

include 'class.archivos.php';
include 'class.folder.php'; 
archivos::escribir("Data/","Column3D.xml","$xml");
?>
