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



$CREAR_CUENTA = 26;
$CERRAR_CUENTA = 27;
session_start();
if(!empty ($_POST)) {
	$tiporequerimiento = $_POST['tiporequerimiento'];
	$tipogeneral = $_POST['tiposgenerales'];
	$tipodetallado = $_POST['tiposdetallados'];
	$requerimiento = $_POST['requerimiento'];
	$cedula = $_POST['cedula'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$direccion = $_POST['departamento'];
	$extension = $_POST['extension'];
	$piso = $_POST['piso'];
	$valido = false;
	$mensaje = "";
	##################################################################################################
	# Validacion del formulario dinamico (Previamente validado con js)
	##################################################################################################
	if($tipodetallado == $CREAR_CUENTA){
		if(empty($cedula)){
			$mensaje .= "Ingrese la c&eacute;dula del usuario<br/>";
		}
		if(empty($nombre)){
			$mensaje .= "Ingrese el nombre del usuario<br/>";
		}
		if(empty($apellido)){
			$mensaje .= "Ingrese el apellido del usuario<br/>";
		}
		if(empty($direccion)){
			$mensaje .= "Ingrese la direcci&oacute;n del usuario<br/>";
		}
		if(empty($extension)){
			$mensaje .= "Ingrese la extensi&oacute;n del usuario<br/>";
		}
		if(empty($piso)){
			$mensaje .= "Ingrese el piso<br/>";
		}
	}
	elseif($tipodetallado == $CERRAR_CUENTA){
		if(empty($cedula)){
			$mensaje .= "Ingrese la c&eacute;dula del usuario<br/>";
		}
		if(empty($nombre)){
			$mensaje .= "Ingrese en nombre del usuario<br/>";
		}
		if(empty($direccion)){
			$mensaje .= "Ingrese la direcci&oacute;n del usuario<br/>";
		}
	}
	else{
		if(empty($requerimiento)){
			$mensaje .= "No ingreso ningun requerimiento<br/>";
		}
	}

	if(empty($tipogeneral)){
		$mensaje .= "Seleccione el tipo de requerimiento general<br/>";
	}
	if(empty($tipodetallado)){
		$mensaje .= "Seleccione el tipo de requerimientos detallado<br/>";
	}
	/*if(empty($tiporequerimiento)){
	$mensaje .= "Seleccione el tipo de requerimiento";
	}*/

	if(!empty($mensaje)){
		echo mensaje("Campos Incompletos",$mensaje);
	}
	else{
		if($tipodetallado == $CREAR_CUENTA){
			##################################################################################################
			# Se crea un nuevo requerimiento de cuenta de usuario y se guardan los datos del usuario
			##################################################################################################
			$idusuario =  $_SESSION['usuario'];
			$con = sql_connect();

			$result = sql_query($con, "select * from usuarios where cedula = $cedula ;");
			if(sql_num_rows($result) > 0){
				echo "<script>location.href='?modulo=administracion&accion=20&msg=3&error=true'</script>";
			}
			else {
			//Comienzo una transaccion
			sql_query($con, "BEGIN;");
			
			//Busco el tipo de requermiento
			$sql_1 = "select idtiporequerimiento from tiposdetallados where idtiposdetallados = $tipodetallado ;";

			$result_1 = sql_query($con, $sql_1);
			if($rs = sql_fetch_array($result_1)){
				$tiporequerimiento = $rs['idtiporequerimiento'];
				
			}
			//Ingreso el nuevo requerimiento
			$sql = "INSERT INTO requerimientos (asunto, idusuario, estado, fechacreacion, diagnostico, fechadiagnostico, revisado, origen, prioridad, mantenimiento, observacion, idtiporequerimiento, asignado,idtiposdetallados, aprobado, tipoderegistro)" .
			"VALUES ('$cedula', $idusuario, 'Cuenta', CURRENT_TIMESTAMP, NULL, NULL, 'f', NULL, NULL, NULL, NULL ,$tiporequerimiento ,'f', $tipodetallado, false,'EN LINEA');";

			$result = sql_query($con, $sql);
			
			//Ingreso el usuario
			$sql_usuario = "INSERT INTO Usuarios (activo,nombre,apellido,idcargousuario,cedula,iddepartamento,password,ultimologin,idtipousuario,extension) VALUES ('f','$nombre', '$apellido',1,$cedula,$direccion,'1234',NULL,5,'$extension');";

			$result = sql_query($con, $sql_usuario);
			
			$result = sql_query($con, "COMMIT;");
			echo "<script>location.href='?modulo=administracion&accion=20&msg=2'</script>";
			$valido = true;
			}
		
		}
		elseif($tipodetallado == $CERRAR_CUENTA){
			##################################################################################################
			# Se crea un nuevo requerimiento y se guardan los datos del usuario
			##################################################################################################
			?>
				<br>
				<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
					<tr>
						<td width="10%" rowspan=2><font color='white' size='2'><img src='images/info.gif' height='25px'></td>
						<td><font size="2px"><b>Su solicitud de cerrar cuenta de usuarios ha sido registrada, para su confirmaci&oacute;n envie un memo a la Direcci&oacute;n de Tecnolog&iacute;a de la Informaci&oacute;n </b></td>
					</tr>
				</table>
				<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			<?
			echo "En desarrollo.....";
			$valido = true;
		}
		else{
			##################################################################################################
			# Ingreso un nuevo requerimiento
			##################################################################################################
			$idusuario =  $_SESSION['usuario'];
			$con = sql_connect();

			$sql_1 = "select tiposdetallados.idtiporequerimiento, tiposdetallados.tiposdetallados from tiposdetallados where idtiposdetallados = $tipodetallado ";
			$result_1 = sql_query($con, $sql_1);

			if($rs = sql_fetch_array($result_1)){
				$tiporequerimiento = $rs['idtiporequerimiento'];
 				$tiposdetallados = $rs['tiposdetallados'];
//  				$generales = $rs['tiposgenerales'];
 			//////////////*********--------**/////////			
			}

			$sql_1 = "select * from tiposgenerales where idtiposgenerales = $tipogeneral";
			$result_1 = sql_query($con, $sql_1);
				
			if($rs = sql_fetch_array($result_1)){
				$generales = $rs['tiposgenerales'];
			}
			
			////////////////////////////BUSCAR USUARIO////////////////
				$sql_1= "select apellido, nombre from usuarios where idusuario = $idusuario AND activo ='true'";
				$result_1 = sql_query($con, $sql_1);
				
				if($rs = sql_fetch_array($result_1)){
					$nombre = $rs['nombre'];
					$apellido = $rs['apellido'];
					
				
			}
			
			
			$sql = "INSERT INTO requerimientos (asunto, idusuario, estado, fechacreacion, diagnostico, fechadiagnostico, revisado, origen, prioridad, mantenimiento, observacion, idtiporequerimiento, asignado,idtiposdetallados,tipoderegistro)" .
			"VALUES ('$requerimiento', $idusuario, 'Nuevo', CURRENT_TIMESTAMP, NULL, NULL, 'f', NULL, NULL, NULL, NULL ,$tiporequerimiento ,'f', $tipodetallado, 'EN LINEA')";

			$result = sql_query($con, $sql);
			
////////////////// Buscar los Nombres de General y Detalle

		

			enviarRequerimiento($generales,$tiposdetallados,$requerimiento,$nombre.' '.$apellido);

			$valido = true;

			echo "<script>location.href='?modulo=administracion&accion=8&nuevo=true'</script>";
		}

	}

}
if(!$valido){
?>
<div id="mensaje"></div>
<form action='' method='POST' onsubmit="return nuevoRequerimiento();" name="nuevo">
	<table border="0" cellpadding="2" cellspacing="1" width="500px" align="center" class="tablas">
		<tr class="header" >
			<td colspan=2>Nuevo Requerimiento</td>
		</tr>
		<tr class="dark-row">
			<td align="right"><b><i>General:</i></b></td>
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
			<td align="right"><b><i>Detallado:</i></b></td>
			<td align="left" >
				<div id="detallado"></div>
				<script>
				document.getElementById('detallado').innerHTML= "<select name='tiposdetallados'><option value=0>----------------------------------------Seleccione-----------------------------------------</option></select>"
				</script>
			</td>
		</tr>
		<tr class="dark-row">
			<td align='center' colspan=2>
				<div id="formdinamico"></div>
				<script>
				document.getElementById('formdinamico').innerHTML= "<b><i>Requerimiento:</i></b><textarea name=\"requerimiento\" cols=\"65\" rows=\"12\"></textarea>"
				</script>
			</td>
		</tr>
		<tr class="header">
			<td align="center" colspan=2>
				<input type="submit" value="Registrar">
			</td>
		</tr>
	</table>
</form>
<br>
<?
$sql = "select count(*) from requerimientos where (estado = 'Pendiente' OR estado = 'Nuevo') and idusuario = $idusuario;";
$result = sql_query($con, $sql);

if($rs =sql_fetch_array($result)){
?>
<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/info.gif' height='25px'></td>
		<td><font size="2px"><b><?echo "Ud tiene ".$rs[0]." requerimiento".($rs[0] > 1?"s":"")." abierto".($rs[0] > 1?"s":"")?></b></td>
	</tr>
</table>
<?
}
} sql_disconnect()
?>