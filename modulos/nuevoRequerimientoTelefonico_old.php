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
if(!empty ($_POST)) {
	$requerimiento = $_POST['requerimiento'];
	$tiporequerimiento = $_POST['tiporequerimiento'];
	$departamento = $_POST['departamento'];
	$usuario = $_POST['usuario'];
	$tipodetallado = 1;
	
	$valido = false;
	$mensaje = "";
	if(empty($requerimiento)){
		$mensaje .= "No ingreso ningun requerimiento<br/>";
	}
	if(empty($tiporequerimiento)){
		$mensaje .= "Seleccione el tipo de requerimiento<br/>";
	}
	else{
		switch ($tiporequerimiento) {
			case 1:
				$tipodetallado = 40;
				break;
			case 2:
				$tipodetallado = 41;
				break;
			case 3:
				$tipodetallado = 43;
				break;
			case 4:
				$tipodetallado = 42;
				break;
			default:
				$tipodetallado = 44;
				break;
		}
	}
	if(empty($usuario)){
		$mensaje .= "No ha seleccionado el usuario<br/>";
	}
	if(!empty($mensaje)){
		echo mensaje("Campos Incompletos",$mensaje);
		echo "<br/>";
	}
	else{
		$idusuario =  $_SESSION['usuario'];
		$con = sql_connect();
		
		$sql = "INSERT INTO requerimientos (asunto, idusuario, estado, fechacreacion, diagnostico, fechadiagnostico, revisado, origen, prioridad, mantenimiento, observacion, idtiporequerimiento, asignado, idtiposdetallados, aprobado,tipoderegistro)" .
				"VALUES ('$requerimiento', $usuario, 'Nuevo', CURRENT_TIMESTAMP, NULL, NULL, 'f', NULL, NULL, NULL, NULL ,$tiporequerimiento ,'f',$tipodetallado, false, 'TELEFONICO')";

		$result = sql_query($con, $sql);
		
		$valido = true;
		echo "<script>location.href='?modulo=administracion&accion=20&msg=1'</script>";
		
	}
}
if(!empty($_GET)){
	$departamento =  $_GET['ida'];
}
if(!$valido){
?>
<form action='' method='POST'>
	<table border="0" cellpadding="2" cellspacing="1" width="600px" align="center" class="tablas">
		<tr class="header">
			<td colspan="3">Nuevo Requerimiento v&iacute;a Telef&oacute;nica</td>
		</tr>
		<tr class="dark-row">
			<td align="center"  colspan="3"><font color='red' size='1'>&nbsp; * Campo Obligatorio&nbsp;</font></td>
		</tr>
		<tr class="dark-row">
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Tipo de Direcci&oacute;n:</i></b></td>
			<td align="left">
			<?php
				$con = sql_connect();
				echo "<select name='departamento' onchange=\"departamentos(this.value)\">";
				$a = sql_query($con, "select * from tiposdepartamentos");
				if (sql_num_rows($a) == 0) {
					echo "<option value=0>------------------------------No Hay Tipos de Direcciones--------------------------------</option>";
				} else {
					echo "<option value=0>----------------------------------------Seleccione-----------------------------------------</option>";
					while ($b = sql_fetch_array($a)) {
						echo "<option value=".$b['idtipodepartamento']." ". (($b['idtipodepartamento'] == $departamento) ? "selected" : "").">".htmlspecialchars($b['tipo'])."</option>";
					}
					echo "</select>";
				}
			?>
			</td>
		</tr>
		<tr class="dark-row">
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Direcci&oacute;n:</i></b></td>
			<td align="left">
			<div id="departamentos"></div>
			<script>
					document.getElementById('departamentos').innerHTML= "<select name='departamento'><option value=0>----------------------------------------Seleccione-----------------------------------------</option></select>"
				</script>
			</td>
			</tr>
			<tr class="dark-row">
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Usuario:</i></b></td>
			<td align="left">
				<div id="usuarios"></div>
				<script>
					document.getElementById('usuarios').innerHTML= "<select name='usuario'><option value=0>----------------------------------------Seleccione-----------------------------------------</option></select>"
				</script>
			</td>
		</tr>
			<!--	<tr class="dark-row">
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Tipo :</i></b></td>
			<td align="left" colspan="2">
			<?php/*
				$con = sql_connect();
				echo "<select name='tiporequerimiento'>";
				$a = sql_query($con, "SELECT * FROM tiposderequerimientos");
				if (sql_num_rows($a) == 0) {
					echo "<option value=0>No hay Tipos</option>";
				} else {
					echo "<option value=0>Seleccione un Tipo</option>";
					while ($b = sql_fetch_array($a)) {
						echo "<option value=".$b['idtiporequerimiento']." ". (($b['idtiporequerimiento'] == $tiporequerimiento) ? "selected" : "").">".htmlspecialchars($b['tipoderequerimiento'])."</option>";

					}
					echo "</select>";
				}
			*/?>
			</td>
			</tr>-->
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
			<td colspan="2">
				<textarea name="requerimiento" cols="45" rows="6"><? echo $requerimiento?></textarea>
			</td>
		</tr>
		<tr class="header">
			<td align="center" colspan="3">
				<input type="submit" value="Registrar">
			</td>
		</tr>
	</table>
</form>
<?
} sql_disconnect()
?>