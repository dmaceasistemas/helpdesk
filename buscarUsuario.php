<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.0                                                                #
# Date:     19-06-2006                                                         #
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
	<body marginheight="0" marginwidth="0" bgcolor="Black">
	<script>
		buscarUsuarios(1);
	</script>
<form name="buscarUsuarioForm">
<table border="0" cellpadding="2" cellspacing="1" width="100%"  align="center">
	<tr class="header">
		<td  class="tabla-header" align="center" colspan="6">B&uacute;squeda de Usuarios</td>
	</tr>
</table>
	<table border="0" cellpadding="2" cellspacing="1" width="100%"  align="center">
		<tr class="header">
			<td  class="tabla-header" align="center" colspan="4">
				<input type="button" value="Buscar" onclick="buscarUsuarios(0)">
			</td>
			<!--<td  class="tabla-header" align="center" colspan="3">
				<input type="button" value="Cerrar" onclick="window.close();">
			</td>-->
		</tr>
	</table>
	<div id="buscarUsuarios"></div>
	
</form>
<div class="msg"></div>
</body>
</html>
<?
sql_disconnect();
?>