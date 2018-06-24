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


class PDF extends PDF_SQL_Table
{
function Header()
{
	$this->SetFont('Arial','',18);
	$this->Cell(0,10,'Reporte General de Requerimientos',0,1,'C');
	$this->Ln(10);
	$this->Image('ocho_estrellas.jpg',18,10,15,15,'JPG');
	$this->Image('min.jpg',35,12,60,10,'JPG');
	$this->Image('mat.jpg',255,10,20,10,'JPG');
	$this->SetFont('Arial','',6);
	parent::Header();
}
}
$connection = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
pg_query( $connection  , "SET search_path TO helpdesk;");
$pdf=new PDF("L");
$pdf->Open();
$pdf->AddPage("L");
$pdf->AddCol('idrequerimiento',15,'Nº','C');
$pdf->AddCol('fecha',20,'Fecha','C');
$pdf->AddCol('hora',10,'Hora','C');
$pdf->AddCol('usuario',30,'Usuario','C');
$pdf->AddCol('iniciales',20,'Direccion','C');
$pdf->AddCol('tipoderequerimiento',30,'Tipo','C');
$pdf->AddCol('tiposgenerales',40,'Tipo General','C');
$pdf->AddCol('tiposdetallados',60,'Tipo Detallado','C');
$pdf->AddCol('estado',18,'Estado','C');
$pdf->AddCol('prioridad',20,'Prioridad','C');
$pdf->AddCol('piso',10,'Piso','C');

$sql1 = "select u.piso, date_part('hour', r.fechacreacion) || ':' || date_part('minute', r.fechacreacion) as hora, u.nombre || ' ' || u.apellido as Usuario, d.iniciales, r.idrequerimiento,date_part('day', r.fechacreacion) || '/' || date_part('month', r.fechacreacion) || '/' || date_part('year', r.fechacreacion) as fecha, r.asunto, r.estado, r.prioridad," .
		" tr.tipoderequerimiento , td.tiposdetallados , tg.tiposgenerales from asignacionesderequerimientos ar, requerimientos as r, tiposderequerimientos as tr, tiposgenerales as tg, tiposdetallados as td, usuarios as u, departamentos as d, asignacion_analista as aa " .
		"where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idtiporequerimiento = tr.idtiporequerimiento and r.idtiposdetallados = td.idtiposdetallados and td.idtiposgenerales = tg.idtiposgenerales and u.idusuario = r.idusuario and d.iddepartamento = u.iddepartamento ";

if(!empty($_SESSION['SQL2'])){
	$sql = $_SESSION['SQL2'];
	$pos = stripos($sql, "where");
	$len = strlen($sql);
	$sql2 = substr($sql, $pos+5, $len);
	$query = $sql1." and ".$sql2;
}
else{
	$query= $sql1." order by idrequerimiento desc";
}

$prop=array('HeaderColor'=>array(209,236,255),
			'color1'=>array(255,255,255),
			'color2'=>array(255,255,255),
			'padding'=>2);
$pdf->Table($query, $prop);
$pdf->Output();
?>
