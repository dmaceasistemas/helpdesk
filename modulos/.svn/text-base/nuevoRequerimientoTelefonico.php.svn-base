<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.1                                                                #
# Date:     18-05-2006                                                         #
# Author:   Jose Luis Estevez                                                  #
# License:                                                                     #
# Note:                                                                        #
# Company:  Ministerio de Agriculura y Tierras                                 #
# Web:      www.mat.gob.ve                                                     #
################################################################################

?>
<?
$idusuario = $_POST['idusuario'];
$tipogeneral = $_POST['tiposgenerales'];
$tipodetallado = $_POST['tiposdetallados'];
$requerimiento = $_POST['requerimiento'];

if(empty($idusuario)){
	$mensaje .= "Seleccione el usuario<br/>";
}
if(empty($tipogeneral)){
	$mensaje .= "Seleccione el tipo de requerimiento general<br/>";
}
if(empty($tipodetallado)){
	$mensaje .= "Seleccione el tipo de requerimiento detallado<br/>";
}
if(empty($requerimiento)){
	$mensaje .= "Ingrese la descripci&oacute;n del requerimiento<br/>";
}
if(!empty($mensaje)){
	echo "<script>imprimirMensaje(\"$mensaje\", \"Faltan datos en el registro\", \"error\");</script>";
}
else{
	$con = sql_connect();

	$sql_1 = "select idtiporequerimiento from tiposdetallados where idtiposdetallados = $tipodetallado";
	$result_1 = sql_query($con, $sql_1);

	if($rs = sql_fetch_array($result_1)){
		$tiporequerimiento = $rs['idtiporequerimiento'];
	}

	$sql = "INSERT INTO requerimientos (asunto, idusuario, estado, fechacreacion, diagnostico, fechadiagnostico, revisado, origen, prioridad, mantenimiento, observacion, idtiporequerimiento, asignado,idtiposdetallados,tipoderegistro)" .
	"VALUES ('$requerimiento', $idusuario, 'Nuevo', CURRENT_TIMESTAMP, NULL, NULL, 'f', NULL, NULL, NULL, NULL ,$tiporequerimiento ,'f', $tipodetallado, 'TELEFONICO')";

	$result = sql_query($con, $sql);

	$valido = true;

	echo "<script>location.href='?modulo=administracion&accion=20&msg=1'</script>";
}

?>
<div id="mensaje"></div>
<form action='' method='POST' name="telefonico" onsubmit="return validarTelefonico();">
	<table border="0" cellpadding="2" cellspacing="1" width="600px" align="center" class="tablas">
		<tr class="header">
			<td colspan="2">Nuevo Requerimiento v&iacute;a Telef&oacute;nica</td>
		</tr>
		<tr class="dark-row">
			<td align="center"  colspan="2"><font color='red' size='1'>&nbsp; * Campo Obligatorio&nbsp;</font></td>
		</tr>
		<tr class="dark-row">
			<td align="right">
				<font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Usuario:</i></b>
			</td>
			<td align="left">
				<table width="100%" cellpadding="0" cellspacing="0" width="1">
					<tr>
						<td width="80%"><div id="datosUsuario"></div><input type="hidden" name="idusuario" value="0"></td>
						<td>
							<input type="button" value="Buscar" onclick="openPopUp('buscarUsuario.php','Demo','',600,500,'true');">
						</td>
					</tr>
				</table>
			</td>
				
		</tr>
		<tr class="dark-row">
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>General:</i></b></td>
			<td align="left">
				<?php
				echo "<select name='tiposgenerales' onchange='detallados(this.value)' >";
				$a = sql_query($con, "SELECT * FROM tiposgenerales");
				if (sql_num_rows($a) == 0) {
					echo "<option value=0>--------------------------No hay Tipos de requerimientos generales-------------------------</option>";
				} else {
					echo "<option value=0>----------------------------------------Seleccione-----------------------------------------</option>";
					while ($b = sql_fetch_array($a)) {
						echo "<option value=".$b['idtiposgenerales']." ". (($b['idtiposgenerales'] == $tiporequerimiento) ? "selected" : "").">".htmlspecialchars($b['tiposgenerales'])."</option>";

					}
					echo "</select>";
				}
				?>
			</td>
		</tr>
		<tr class="dark-row">
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Detallado:</i></b></td>
			<td align="left" >
				<div id="detallado"></div>
				<script>
				document.getElementById('detallado').innerHTML= "<select name='tiposdetallados'><option value=0>----------------------------------------Seleccione-----------------------------------------</option></select>"
				</script>
			</td>
		</tr>
		<tr class="dark-row">
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Requerimiento:</i></b></td>
			<td>
				<textarea name="requerimiento" cols="45" rows="6"><? echo $requerimiento?></textarea>
			</td>
		</tr>
		<tr class="header">
			<td align="center" colspan="2">
				<input type="submit" value="Registrar">
			</td>
		</tr>
	</table>
</form>