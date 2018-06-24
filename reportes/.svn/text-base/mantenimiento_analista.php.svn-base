<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.0                                                                #
# Date:     17-03-2006                                                         #
# Author:   Jose Luis Estevez                                                  #
# License:                                                                     #
# Note:     Generador de PDF del reporte de requerimiento                      #
# Company:  Ministerio de Agriculura y Tierras                                 #
# Web:      www.mat.gob.ve                                                     #
################################################################################
?>
<?php
@session_start();
define('FPDF_FONTPATH','font/');
require('sql_table.php');

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


class PDF extends PDF_SQL_Table
{
function Header()
{
	$this->SetFont('Arial','',12);
	$this->Cell(0,30,"Reportes de Mantenimientos {$_SESSION['titulo_fecha']}",20,20,'C');
//	$this->Ln(10);
	$this->Image('ocho_estrellas.jpg',30,9,7,10,'JPG');
	$this->Image('min.jpg',40,9,40,10,'JPG');
	$this->Image('mat.jpg',160,9,20,10,'JPG');
	$this->SetFont('Arial','',6);
	parent::Header();
}
}

//Connect to database
$connection = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
pg_query( $connection  , "SET search_path TO helpdesk;");
$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();

$pdf->AddCol('nombre',30,'Nombre','C');
$pdf->AddCol('apellido',30,'Apellido','C');
$pdf->AddCol('preventivos',30,'Preventivos','C');
$pdf->AddCol('correctivos',30,'Correctivos','C');
$pdf->AddCol('totales',30,'Totales','C');


$sql = "SELECT DISTINCT (u.nombre), u.idusuario, apellido,"
."(SELECT COUNT(distinct(r2.idrequerimiento)) from solucionesderequerimientos as sr2, usuarios as u2, asignacionesderequerimientos ar2, requerimientos as r2, asignacion_analista as aa2 where ar2.idasignacion = aa2.idasignacion and r2.idrequerimiento = ar2.idrequerimiento and r2.idusuario = u2.idusuario and ar2.reasignada = 'f' and aa2.idusuario = u.idusuario  and r2.mantenimiento = 'Preventivo' and sr2.idasignacion = ar2.idasignacion ) as preventivos,"
."(SELECT COUNT(distinct(r2.idrequerimiento)) from solucionesderequerimientos as sr2, usuarios as u2, asignacionesderequerimientos ar2, requerimientos as r2, asignacion_analista as aa2 where ar2.idasignacion = aa2.idasignacion and r2.idrequerimiento = ar2.idrequerimiento and r2.idusuario = u2.idusuario and ar2.reasignada = 'f' and aa2.idusuario = u.idusuario  and r2.mantenimiento = 'Correctivo' and sr2.idasignacion = ar2.idasignacion ) as correctivos"
.",(SELECT COUNT(distinct(r2.idrequerimiento)) from solucionesderequerimientos as sr2, usuarios as u2, asignacionesderequerimientos ar2, requerimientos as r2, asignacion_analista as aa2 where ar2.idasignacion = aa2.idasignacion and r2.idrequerimiento = ar2.idrequerimiento and r2.idusuario = u2.idusuario and ar2.reasignada = 'f' and aa2.idusuario = u.idusuario  and (r2.mantenimiento = 'Correctivo' or r2.mantenimiento = 'Preventivo' )  and sr2.idasignacion = ar2.idasignacion ) as totales"
." FROM usuarios as u where (u.idtipousuario = 1 OR u.idtipousuario = 6 OR u.idtipousuario = 7 OR u.idtipousuario = 11 OR u.idtipousuario = 2 OR u.idtipousuario = 8 OR u.idtipousuario = 9 OR u.idtipousuario = 12)"
 ." ORDER BY u.nombre ;";


if(!empty($_SESSION['SQLM1'])){
	$sql = $_SESSION['SQLM1'];
}
$prop=array('HeaderColor'=>array(209,236,255),
			'color1'=>array(255,255,255),
			'color2'=>array(255,255,255),
			'padding'=>2);
$pdf->Table($sql, $prop);
$pdf->Output();
?>
