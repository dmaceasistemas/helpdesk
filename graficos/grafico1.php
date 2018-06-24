<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.0                                                                #
# Date:     04-09-2008                                                         #
# Author:   Marco Antonio López                                                #
# License:                                                                     #
# Note:                                                                        #
# Company:  CVA AZUCAR                                                         #
# Web:      www.cvaa.gob.ve                                                    #
################################################################################
?>
<?php

include "src/jpgraph.php";
include ("src/jpgraph_pie.php");
include ("src/jpgraph_pie3d.php");


//$lines = file('C:\www\helpdesk\install\helpdesk.conf');
$lines = file('../helpdesk.conf');
foreach ($lines as $line_num => $line) {
        $datos = explode("=", $line);
		$CONFIG[$datos[0]] =$datos[1];
}
	
$HOST = trim($CONFIG['host']);
$USER = trim($CONFIG['usuario']);
$PASSWORD = trim($CONFIG['clave']);
$DATABASE = trim($CONFIG['basedatos']);
$PORT = trim($CONFIG['puerto']);
$TIPODEUSUARIOS = 1; //Analistas de Soporte por defecto

if(isset($_GET['tipo'])){
	$TIPODEUSUARIOS = $_GET['tipo'];
}

if($TIPODEUSUARIOS == 1){
	$query = "where idtipousuario = 1 or idtipousuario = 2";
	$titulo = "Requerimientos de Soporte Tecnico";
}
if($TIPODEUSUARIOS == 11){
	$query = " where idtipousuario = 11 or idtipousuario = 12";
	$titulo = "Requerimientos de Telecomunicaciones";
}
if($TIPODEUSUARIOS == 6){
	$query = " where idtipousuario = 6 or idtipousuario = 8";
	$titulo = "Requerimientos de Redes";
}
if($TIPODEUSUARIOS == 7){
	$query = " where idtipousuario = 7 or idtipousuario = 9";
	$titulo = "Requerimientos de Desarrollo";
}
$connection = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
pg_query( $connection  , "SET search_path TO helpdesk;");
$sql = "select idusuario, nombre || ' ' || apellido as nombre from usuarios $query";

$result = pg_query($connection,$sql);
$i =0;
while ($row = pg_fetch_array($result)){
	$analistas[$i] = $row['nombre'];
	
	$sql2 = "select count(*) from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and aa.idusuario = {$row['idusuario']} and r.estado ilike 'Cerrado' and ar.reasignada = 'f'";
	$result2 = pg_query($connection,$sql2);
	$row2 = pg_fetch_array($result2);
	$valores[$i] = $row2['0'];
	$i++;
}


$total = array_sum($valores);
for($i=0; $i<count($valores); $i++) {
    $porcentajes[] = round(($valores[$i]/$total)*100, 2);
    $angulos[] = round(($porcentajes[$i]*360)/100);
    }



$data = $porcentajes;

$graph = new PieGraph(650,450,"auto");
$graph->SetShadow();

$graph->title->Set($titulo);
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$p1 = new PiePlot3D($data);
$p1->SetAngle(20);
$p1->title->Set("Total de requerimientos = ".$total);
$p1->SetSize(0.5);
$p1->SetCenter(0.45);
$p1->SetLegends($analistas);

$graph->Add($p1);
$graph->Stroke();

pg_close($connection);
?>
