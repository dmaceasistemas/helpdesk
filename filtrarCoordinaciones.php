<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.1                                                                #
# Date:     05-05-2006                                                         #
# Author:   Jose Luis Estevez                                                  #
# License:                                                                     #
# Note:                                                                        #
# Company:  Ministerio de Agriculura y Tierras                                 #
# Web:      www.mat.gob.ve                                                     #
################################################################################

session_start();
require_once ('./libreria/lib.php');
$con = @sql_connect();
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
		<title>Sistema de Helpdesk</title>
		<link rel="shortcut icon" href="images/mat.gif">
		<?$tema = $_SESSION['tema'];?>
		<link rel="stylesheet" href="styles/<?echo $tema?>/estilo.css" />
		<script type="text/javascript" src="javascript/javascript.js"></script>
	</head>
	<body marginheight="0" marginwidth="0">
<form name="lista">
<table border="0" cellpadding="2" cellspacing="1" width="100%"  align="center">
	<tr class="header">
		<td  class="tabla-header" align="center" colspan="6">Listado de Direcciones</td>
	</tr>
		
		<tr class="dark-row" id="efecto">
			<td width="5%" class="tabla-text" align="center">
				<input type="checkbox" onchange="marcarCHKCoordinacion2(0,1)" name="idcoordinacion" value="1">
			</td>
			<td class="tabla-text" align="left" onclick="marcarCHKCoordinacion(0,1)">Soporte Tecnico</td>
		</tr>
		<tr class="dark-row" id="efecto">
			<td width="5%" class="tabla-text" align="center">
				<input type="checkbox" onchange="marcarCHKCoordinacion2(1,2)" name="idcoordinacion" value="2">
			</td>
			<td class="tabla-text" align="left" onclick="marcarCHKCoordinacion(1,2)">Redes</td>
		</tr>
		<tr class="dark-row" id="efecto">
			<td width="5%" class="tabla-text" align="center">
				<input type="checkbox" onchange="marcarCHKCoordinacion2(2,4)" name="idcoordinacion" value="4">
			</td>
			<td class="tabla-text" align="left" onclick="marcarCHKCoordinacion(2,4)">Telecomunicaciones</td>
		</tr>
		<tr class="dark-row" id="efecto">
			<td width="5%" class="tabla-text" align="center">
				<input type="checkbox" onchange="marcarCHKCoordinacion2(3,3)" name="idcoordinacion" value="3">
			</td>
			<td class="tabla-text" align="left" onclick="marcarCHKCoordinacion(3,3)">Desarrollo de Sistemas</td>
		</tr>
		<tr class="dark-row" id="efecto">
			<td width="5%" class="tabla-text" align="center">
				<input type="checkbox" onchange="marcarCHKCoordinacion2(4,5)" name="idcoordinacion" value="5">
			</td>
			<td class="tabla-text" align="left" onclick="marcarCHKCoordinacion(4,5)">Generales</td>
		</tr>
		<tr class="header">
			<td  class="tabla-header" align="center" colspan="6">
				<input type="button" value="Cerrar" onclick="window.close();">
			</td>
		</tr>
	</table>
</form>
</body>
</html>
<?
sql_disconnect();
?>