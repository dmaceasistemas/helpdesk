<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.0                                                                #
# Date:     17-03-2006                                                         #
# Author:   Jose Luis Estevez                                                  #
# License:                                                                     #
# Note:                                                                        #
# Company:  Ministerio de Agriculura y Tierras                                 #
# Web:      www.mat.gob.ve                                                     #
################################################################################

session_start();
require_once ('./libreria/lib.php');
$con = @sql_connect();
if(isset($_GET['id'])){
	$REQUERIMIENTO_ACTUAL = $_GET['id'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
		<title>Sistema de Helpdesk</title>
		<link rel="shortcut icon" href="images/mat.gif">
		<?$tema = $_SESSION['tema'];?>
		<link rel="stylesheet" href="styles/<?echo $tema?>/estilo.css" />
		<link rel="stylesheet" href="styles/<?echo $tema?>/calendar.css" />
		<link rel="stylesheet" href="styles/themes/layouts/big.css" />
		<script type="text/javascript" src="javascript/src/utils.js"></script>
		<script type="text/javascript" src="javascript/src/calendar.js"></script>
		<script type="text/javascript" src="javascript/src/calendar-setup.js"></script>
		<script type="text/javascript" src="javascript/lang/calendar-sp.js"></script>
		<script type="text/javascript" src="javascript/javascript.js"></script>
	</head>
	<body bgcolor="black">
	<?
	if(!empty($REQUERIMIENTO_ACTUAL)){
	?>
<table border="0" cellpadding="2" cellspacing="1" width="100%"  class="tablas" align="center">
	<tr class="header">
		<td  class="tabla-header" align="center" colspan="6">Historial de Asignaciones</td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="10%">Fecha</td>
		<td class="tabla-header" width="10%">Hora</td>
		<td class="tabla-header" width="30%">Analista</td>
		<td class="tabla-header" width="30%">Nota de Rasignaci&oacute;n</td>
		<td class="tabla-header" width="20%">Asignado por</td>
	</tr>
	<?	$sql = "select * from asignacionesderequerimientos where idrequerimiento = $REQUERIMIENTO_ACTUAL";
		$result = sql_query($con, $sql);
		while($row = sql_fetch_array($result)) {
			$fecha = $row['fechaasignacion'];
			$tok1 = strtok($fecha, " ");
			$s1 = substr($fecha, 10);
			$tok2 = strtok($s1, ".");
			
			$hora = strtok($tok2,":");
			$minuto = strtok(":");
			$a = "AM";
			if($hora > 12){
				$hora -= 12;
				$a = "PM";
			}
			elseif($hora == 0){
				$hora = 12;
			}

			echo "<tr class=\"dark-row\" id=\"efecto\">";
			echo "<td class=\"tabla-text\" align=\"center\">".$tok1."</td>";
			echo "<td class=\"tabla-text\" align=\"center\">".$hora.":".$minuto." ".$a."</td>";
			
			$sql2 = "select u.nombre,  u.apellido from asignacion_analista as aa, usuarios as u  where aa.idusuario = u.idusuario and aa.idasignacion = {$row['idasignacion']}";
			
			$result2 = sql_query($con, $sql2);
			$i = 0;
			echo "<td class=\"tabla-text\" align=\"center\">";
			while($row2 = sql_fetch_array($result2)){
				
				if($i > 0){
					echo ", ";
				}
				echo $row2['nombre']." ". $row2['apellido'];
				$i++;
			}
			$analistas = "";

			echo "</td>";
			echo "<td class=\"tabla-text\" align=\"center\">".$row['notareasignacion']."</td>";
			
			$nombreusuario = "DESCONOCIDO";
			if(!empty($row['idusuarioasigno'])){
				$sql3 = "SELECT nombre,apellido FROM Usuarios WHERE idusuario = ".$row['idusuarioasigno'];
				$result3 = @sql_query($con, $sql3);
				if($row3 = @sql_fetch_array($result3)){
					$nombreusuario = $row3['nombre'] . " " . $row3['apellido'];
				}
			}
			echo "<td class=\"tabla-text\" align=\"center\">".$nombreusuario."</td>";
			
			echo "</tr>";
		}
	?>
</table>
<?}?>
</body>
</html>
<?
sql_disconnect();
?>