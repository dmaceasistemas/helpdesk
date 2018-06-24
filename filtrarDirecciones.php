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
	<script>
		listaDireccion(0);
	</script>
<form name="lista">
<table border="0" cellpadding="2" cellspacing="1" width="100%"  align="center">
	<tr class="header">
		<td  class="tabla-header" align="center" colspan="6">Listado de Direcciones</td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="5%"><!-- <a href="javascript:seleccionarTodosCHKAnalista();">X --></td>
		<td class="tabla-header" width="*">Nombre</td>
		<td class="tabla-header" width="10%">Iniciales</td>
		<td class="tabla-header" width="40%">Tipo :
			<select name="cargos" onchange='listaDireccion(this.value)'>
				<option value="0">---------------Todas---------------</option>
				<option value="2">VICE MINISTERIOS</option>
				<option value="3">DIRECCIONES GENERALES</option>
				<option value="4">DIRECCIONES DE LINEAS</option>
				<option value="5">EQUIPOS DE TRABAJO</option>
			</select>
		</td>
	</tr>
	</table>
	<div id="listaDireccion"></div>
	<table border="0" cellpadding="2" cellspacing="1" width="100%"  align="center">
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