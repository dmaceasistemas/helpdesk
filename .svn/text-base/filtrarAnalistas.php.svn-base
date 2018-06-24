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
		listaAnalista(0);
	</script>
<form name="lista">
<table border="0" cellpadding="2" cellspacing="1" width="100%"  align="center">
	<tr class="header">
		<td  class="tabla-header" align="center" colspan="6">Listado de Analistas</td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="10%"><!-- <a href="javascript:seleccionarTodosCHKAnalista();">X --></td>
		<td class="tabla-header" width="20%">Nombre</td>
		<td class="tabla-header" width="20%">Apellido</td>
		<td class="tabla-header" width="50%">Cargo :
			<select name="cargos" onchange='listaAnalista(this.value)'>
				<option value="0">---------------Todos---------------</option>
				<option value="6">Analista de Redes</option>
				<option value="1">Analistas de Soporte Tecnico</option>
				<option value="11">Analistas de Telecomunicaciones</option>
				<option value="7">Analistas de Desarrollo</option>
			</select>
		</td>
	</tr>
	</table>
	<div id="listaAnalista"></div>
	<?/*	
	$sql_1 = "select idusuario, nombre, apellido, tipodeusuario from tiposdeusuarios as tu, usuarios as u  where u.idtipousuario = tu.idtipousuario and (u.idtipousuario = 1 OR u.idtipousuario = 6 OR u.idtipousuario = 7 OR u.idtipousuario = 11 OR u.idtipousuario = 12) order by nombre;";
	$result = sql_query($con, $sql_1);
	$i = 0;
		while($row = sql_fetch_array($result)) {
			echo "<tr class=\"dark-row\" id=\"efecto\">";
			echo "<td class=\"tabla-text\" align=\"center\"><input type=\"checkbox\" onchange=\"marcarCHKAnalista2($i,{$row['idusuario']})\" name=\"idanalista\" value=\"{$row['idusuario']}\"></td>";
			echo "<td class=\"tabla-text\" align=\"center\" onclick=\"marcarCHKAnalista($i,{$row['idusuario']})\">{$row['nombre']}</td>";
			echo "<td class=\"tabla-text\" align=\"center\" onclick=\"marcarCHKAnalista($i,{$row['idusuario']})\">{$row['apellido']}</td>";
			echo "<td class=\"tabla-text\" align=\"center\" onclick=\"marcarCHKAnalista($i,{$row['idusuario']})\">{$row['tipodeusuario']}</td>";
			echo "</tr>";
			$i++;
		}*/
	?>
	<table border="0" cellpadding="2" cellspacing="1" width="100%"  align="center">
		<tr class="header">
			<td  class="tabla-header" align="center" colspan="6">
				<input type="button" value="Cerrar" onClick="window.close();">
			</td>
		</tr>
	</table>
</form>
</body>
</html>
<?
sql_disconnect();
?>