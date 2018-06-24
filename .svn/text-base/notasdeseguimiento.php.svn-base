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
if(isset($_GET['id'])){
	$REQUERIMIENTO_ACTUAL = $_GET['id'];
	$sql = " select * from seguimientousuario where idrequerimiento = $REQUERIMIENTO_ACTUAL order by idseguimiento desc";
	$con = sql_connect();
?>
<html>
<head>
<title>Sistema de Helpdesk</title>
		<link rel="shortcut icon" href="images/mat.gif">
		<?
		$tema = $_SESSION['tema'];
		?>
		<link rel="stylesheet" href="styles/<?echo $tema?>/estilo.css" />
	</head>
</head>
<body bgcolor="black">
<table border="0" cellpadding="2" cellspacing="1" width="100%"
	class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="3">Notas de Seguimiento</td>
	</tr>
	<tr class="header">
		<td class="tabla-header">Fecha</td>
		<td class="tabla-header">Hora</td>
		<td class="tabla-header">Nota de Seguimiento</td>
	</tr>

	<?
	$result = sql_query($con, $sql);
		while($row = sql_fetch_array($result)) {
			$fecha = $row['fechadeseguimiento'];
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
			echo "<td class=\"tabla-text\" align=\"center\">".$row['notadeseguimiento']."</td>";
			echo "</tr>";
		}
	?>
	
</tabla>
</body>
</html><?
sql_disconnect();
}?>