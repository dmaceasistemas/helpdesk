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
/*
$HOST = "172.16.100.27";
$USER = "jestevez";
$PASSWORD = "1234";
$DATABASE = "helpdesk";
$PORT = "5432";
 */

class PDF extends PDF_SQL_Table
{
function Header()
{
	$lines = file('/etc/helpdesk.conf');
	foreach ($lines as $line_num => $line) {
	        $datos = explode("=", $line);
			$CONFIG[$datos[0]] =$datos[1];
	}
		
	$HOST = trim($CONFIG['host']);
	$USER = trim($CONFIG['usuario']);
	$PASSWORD = trim($CONFIG['clave']);
	$DATABASE = trim($CONFIG['basedatos']);
	$PORT = trim($CONFIG['puerto']);
	
	$con = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
	pg_query( $con  , "SET search_path TO helpdesk;");
	$idusuario = $_SESSION['usuario'];
	$sql = "SELECT nombre,apellido,iddepartamento FROM Usuarios WHERE idusuario = ". $idusuario;
	$result = pg_query($con, $sql);
	if($row = pg_fetch_array($result)){
		$nombreusuario = $row['nombre'] . " " . $row['apellido'];
	}
	//pg_close();						
	$this->SetFont('Arial','',14);
	$this->Cell(0,10,'Historial de Requerimientos ',0,1,'C');
	$this->SetFont('Arial','',8);
	$this->Cell(0,5,'Analista: '.$nombreusuario,0,1,'C');
	
	$fecha ="";
	
	if(isset($_SESSION['FECHA1']) and isset($_SESSION['FECHA2'])){
		$fecha = "Fecha: {$_SESSION['FECHA1']} a {$_SESSION['FECHA2']}";
	} 
	elseif(isset($_SESSION['FECHA1'])){
		$fecha = "Fecha: {$_SESSION['FECHA1']}";
	} 
	elseif(isset($_SESSION['FECHA2'])){
		$fecha = "Fecha: {$_SESSION['FECHA2']}";
	} 
	$this->Cell(0,4,$fecha,0,1,'C');
	$this->Ln(5);
	$this->Image('ocho_estrellas.jpg',18,10,15,15,'JPG');
	$this->Image('min.jpg',35,12,60,10,'JPG');
	$this->Image('mat.jpg',255,10,20,10,'JPG');
	$this->SetFont('Arial','',6);
	parent::Header();
}
}
pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");

$pdf=new PDF("L");
$pdf->Open();
$pdf->AddPage("L");
$pdf->AddCol('idrequerimiento',15,'Nº','C');
$pdf->AddCol('fecha',20,'Fecha','C');
$pdf->AddCol('hora',10,'Hora','C');
$pdf->AddCol('usuario',30,'Usuario','C');
$pdf->AddCol('piso',10,'Piso','C');
$pdf->AddCol('iniciales',20,'Direccion','C');
$pdf->AddCol('mantenimiento',30,'Mantenimiento','C');
$pdf->AddCol('diagnostico',110,'Requerimiento','C');
//$pdf->AddCol('tiposdetallados',60,'Tipo Detallado','C');
$pdf->AddCol('estado',28,'Estado','C');
//$pdf->AddCol('prioridad',20,'Prioridad','C');
$idusuario = $_SESSION['usuario'];
$sql = "select date_part('day', r.fechacreacion) || '/' || date_part('month', r.fechacreacion) || '/' || date_part('year', r.fechacreacion) as fecha, " .
		"date_part('hour', r.fechacreacion) || ':' || date_part('minute', r.fechacreacion) as hora, " .
		"r.mantenimiento, r.estado, r.idrequerimiento, r.idusuario, u.nombre || ' ' || u.apellido as usuario, " .
		"r.asunto, r.diagnostico, d.piso, d.iniciales " .
		"from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa " .
		"where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento  " .
		"and ar.reasignada = 'f' and aa.idusuario = $idusuario ";

if(!empty($_SESSION['QUERY'])){
	$query = $_SESSION['QUERY'];
}
$sql = $sql.$query;
//echo $sql;
$prop=array('HeaderColor'=>array(209,236,255),
			'color1'=>array(255,255,255),
			'color2'=>array(255,255,255),
			'padding'=>2);
$pdf->Table($sql, $prop);
$pdf->Output();
?>
