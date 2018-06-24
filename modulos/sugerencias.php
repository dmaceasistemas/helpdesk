<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.0                                                                #
# Date:     17-04-2006                                                         #
# Author:   Jose Luis Estevez                                                  #
# License:                                                                     #
# Note:     Formulario de sugerencias por parte de los usuarios                #
# Company:  Ministerio de Agriculura y Tierras                                 #
# Web:      www.mat.gob.ve                                                     #
################################################################################
?>

<?
if(!empty ($_POST)) {
	$nombre  = $_POST['nombre'];
	$sugerencia = $_POST['sugerencia'];
	$mensaje = "";
	
	if(empty($nombre)){
		$nombre = "Anónimo";
	}
	if(empty($sugerencia)){
		$mensaje .= "Ingrese la sugerencia<br/>";
	}
	if(!empty($mensaje)){
		
	}
	else {
		$con = sql_connect();
		$sql = "INSERT INTO sugerencias (sugerencia, nombre, fecha) VALUES ('$sugerencia', '$nombre', CURRENT_TIMESTAMP);";
		$result = sql_query($con, $sql);
		echo "<script>location.href='?modulo=administracion&accion=20&msg=5'</script>";
	}
}
?>
<!--
<br>
<center><font class="texto3">Escriba aqu&iacute; sus dudas reclamos o sugerencias del sistema de helpdesk mat</font></center>
<br>
-->
<div id="mensaje"></div>
<form action='' method='POST' onsubmit="return validarSugerencia();" name="sugerenciaform">
	<table border="0" cellpadding="2" cellspacing="1" width="500px" align="center" class="tablas">
		<tr class="header">
			<td colspan="3">Sugerencias</td>
		</tr>
		<tr class="dark-row">
			<td align="center" colspan="3"><font color='red' size='1'>&nbsp;<b>* Campo Obligatorio</b>&nbsp;</font></td>
		</tr>
		<tr class="dark-row">
			<td align='right'>
				<b><i>Nombre:</i></b>
			</td>
			<td colspan=2>
				<input type="text" name="nombre" value="" size="50">
			</td>
		</tr>
		<tr class="dark-row">
			<td align='right'>
				<font color='red' size='1'>&nbsp;*&nbsp;</font><b><i>Reclamo &oacute; Sugerencia:</i></b>
			</td>
			<td colspan=2>
				<textarea cols="50" rows="5" name="sugerencia"></textarea>
			</td>
		</tr>
		<tr class="header">
			<td align="center" colspan=3>
				<input type="submit" value="Registrar">
			</td>
		</tr>
	</table>
</form>
<?
sql_disconnect()
?>