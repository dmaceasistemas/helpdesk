<?php
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

if(isset($_GET['idrequerimiento'])){
	$REQUERIMIENTO_ACTUAL = $_GET['idrequerimiento'];
	
	#########################################################################################
	# Abrir el requerimiento actual
	#########################################################################################
	if(isset($_POST['abrir'])){
		$sql = "update requerimientos set estado = 'Pendiente' where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
		sql_query($con, $sql);
		
		if(!empty($_GET['analista'])){
			echo "<script>location.href='?modulo=administracion&accion=19'</script>";
		}
		else{
			echo "<script>location.href='?modulo=administracion&accion=4'</script>";
		}
	}	

	//Verifico si es un requerimiento asignado
	if($_GET['a'] == "t"){
		$sql_1 = "select tipoderegistro,tg.tiposgenerales, td.tiposdetallados, tr.tipoderequerimiento, ar.idasignacion, r.idrequerimiento, r.fechacreacion, r.asunto, r.estado, r.prioridad, r.mantenimiento, r.fechadiagnostico, r.diagnostico, r.observacion, u.nombre || ' ' || u.apellido as nombreusuario, d.nombre as nombredireccion, d.nombredirector || ' ' || d.apellidodirector as nombredirector from usuarios as u, departamentos as d, requerimientos as r, asignacionesderequerimientos as ar, tiposderequerimientos as tr, tiposdetallados as td, tiposgenerales as tg where u.iddepartamento = d.iddepartamento and r.idusuario = u.idusuario and ar.idrequerimiento = r.idrequerimiento and tr.idtiporequerimiento = r.idtiporequerimiento and r.idtiposdetallados = td.idtiposdetallados and tg.idtiposgenerales = td.idtiposgenerales and ar.reasignada = 'f' and r.idrequerimiento = $REQUERIMIENTO_ACTUAL;;";
	}
	else{
		$sql_1 = "select tipoderegistro,tg.tiposgenerales, td.tiposdetallados, tr.tipoderequerimiento, r.idrequerimiento, r.fechacreacion, r.asunto, r.estado, r.prioridad, r.mantenimiento, r.fechadiagnostico, r.diagnostico, r.observacion, u.nombre || ' ' || u.apellido as nombreusuario, d.nombre as nombredireccion, d.nombredirector || ' ' || d.apellidodirector as nombredirector from usuarios as u, departamentos as d, requerimientos as r, tiposderequerimientos as tr, tiposdetallados as td, tiposgenerales as tg where u.iddepartamento = d.iddepartamento and r.idusuario = u.idusuario and tr.idtiporequerimiento = r.idtiporequerimiento and r.idtiposdetallados = td.idtiposdetallados and tg.idtiposgenerales = td.idtiposgenerales  and r.idrequerimiento = $REQUERIMIENTO_ACTUAL;";
	}
	
	$con = sql_connect();
	$rs = sql_query($con, $sql_1);

	if($row = sql_fetch_array($rs)){
		
?>

<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center" class="tablas">
<tr><td>
<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center">
	<tr class="header">
		<td align="center" colspan="6" class="tabla-header">Detalles del Requerimiento</td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" width="10%" align='right'><b><i>N&ordm; de Orden:</i></b></td>
		<td class="tabla-text" width="5%" align='center'><b><i><?echo $REQUERIMIENTO_ACTUAL ?></i></b></td>
		<td class="tabla-text" width="8%" align='right'><b><i>Fecha de creaci&oacute;n:</i></b></td>
		<td class="tabla-text" width="20%" align='center'><b><i>
			<?
			$fecha = $row['fechacreacion'];
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
			echo $tok1;
			echo " ".$hora.":".$minuto." ".$a
			?>
		</i></b></td>
		<td class="tabla-text" width="15%" align='right'><b><i>Requerimiento:</i></b></td>
		<td class="tabla-text" width="*" align='left'><b><i><?echo $row['asunto'] ?></i></b></td>
	</tr>
</table>
<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center">
	<tr class="dark-row">
		<td class="tabla-text" width="10%" align='right'><b><i>Estado:</i></b></td>
		<td class="tabla-text" width="20%" align='left'><b><i><?echo $row['estado']?></i></b></td>
		<td class="tabla-text" width="10%" align='right'><b><i>Prioridad:</i></b></td>
		<td class="tabla-text" width="20%" align='left'><b><i><?echo $row['prioridad'] != "" ? $row['prioridad'] :"N/A"?></i></b></td>
		<td class="tabla-text" width="20%" align='right'><b><i>Mantenimiento:</i></b></td>
		<td class="tabla-text" width="20%" align='left'><b><i><?echo $row['mantenimiento'] != "" ?  $row['mantenimiento'] : "N/A" ?></i></b></td>
	</tr>
</table>
<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center">
<tr class="dark-row">
		<td class="tabla-text" width="10%" align='right'><b><i>Fecha de diagn&oacute;stico:</i></b></td>
		<td class="tabla-text" width="15%" align='center'><b><i>
			<?
			$fecha = $row['fechadiagnostico'];
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
			if($row['fechadiagnostico'] == ""){
				echo "N/A";
			}
			else{
				echo $tok1;
				echo " ".$hora.":".$minuto." ".$a;
			} 
			?>
		</i></b></td>
		<td class="tabla-text" width="10%" align='right'><b><i>Diagn&oacute;stico:</i></b></td>
		<td class="tabla-text" width="20%" align='left'><b><i><?echo $row['diagnostico'] != "" ?  $row['diagnostico'] : "N/A" ?></i></b></td>
		<td class="tabla-text" width="15%" align='right'><b><i>Observaci&oacute;n:</i></b></td>
		<td class="tabla-text" width="*" align='left'><b><i><?echo $row['observacion'] != "" ?  $row['observacion'] : "N/A" ?></i></b></td>
	</tr>
</table>
<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center">
	<tr class="dark-row">
		<td class="tabla-text" align='right'><b><i>Tipo:</i></b></td>
		<td class="tabla-text" align='left'><b><i><?echo $row['tipoderequerimiento'] ?></i></b></td>
		<td class="tabla-text" align='left' colspan=2><b><i><?echo $row['tiposgenerales'] ?></i></b></td>
		<td class="tabla-text" align='left' colspan=2><b><i><?echo $row['tiposdetallados'] ?></i></b></td>
		<td class="tabla-text" align='left' colspan=2><b><i>Registrado: <?echo $row['tipoderegistro'] ==""?"DESCONOCIDO":$row['tipoderegistro'] ?></i></b></td>
	</tr>
</table>
<?
if($_GET['a'] == "t"){
?>
<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center">
	<tr class="header">
		<td align="center" colspan="6" class="tabla-header">Detalles de la Asignaci&oacute;n</td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" width="8%" align='right'><b><i>Fecha de asignaci&oacute;n:</i></b></td>
		<?
		$sql_2 = "select * from asignacionesderequerimientos where idrequerimiento = $REQUERIMIENTO_ACTUAL order by idrequerimiento desc";
		$result = sql_query($con, $sql_2);
		if($row2 = sql_fetch_array($result)){
			$fecha = $row2['fechaasignacion'];
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

			echo "<td class=\"tabla-text\" align=\"center\" width=\"20%\">".$tok1." ".$hora.":".$minuto." ".$a."</td>";

			$sql2 = "select u.nombre,  u.apellido from asignacion_analista as aa, usuarios as u  where aa.idusuario = u.idusuario and aa.idasignacion = {$row['idasignacion']}";
			$result2 = sql_query($con, $sql2);
			$i = 0;
			echo "<td class=\"tabla-text\" width=\"15%\" align='right'><b<i>Analistas asignados:</i></b></td>";
			echo "<td class=\"tabla-text\" align=\"center\"  width=\"20%\"><b><i>";
			while($row3 = sql_fetch_array($result2)){
				if($i > 0){
					echo ", ";
				}
				echo $row3['nombre']." ". $row3['apellido'];
				$i++;
			}
			//$analistas = "";
		}
	?>
		
		</i></b></td>
		<td class="tabla-text" width="18%" align='center' colspan=2 ><input type="button" value="Historial" title="Ver registro de asignaciones" onclick="openPopUp('historiaDeAsignaciones.php?id=<?echo $REQUERIMIENTO_ACTUAL?>','Demo','',700,250,'true');"></td>
	</tr>
</table>

<?}?>
<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center">
	<tr class="header">
		<td align="center" colspan="6" class="tabla-header">Detalles del Usuario</td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" width="10%" align='right'><b><i>Nombre:</i></b></td>
		<td class="tabla-text" width="15%" align='center'><b><i><?echo $row ['nombreusuario'] ?></i></b></td>
		<td class="tabla-text" width="10%" align='right'><b><i>Direcci&oacute;n:</i></b></td>
		<td class="tabla-text" width="*" align='center'><b><i><?echo $row ['nombredireccion'] ?></i></b></td>
		<td class="tabla-text" width="10%" align='right'><b><i>Director:</i></b></td>
		<td class="tabla-text" width="20%" align='center'><b><i><?echo $row ['nombredirector'] ?></i></b></td>
	</tr>	
</table>
<? if($row['estado'] == "Cerrado") {
	$sql_3 = "select * from solucionesderequerimientos where idasignacion = {$row['idasignacion']}";
	$rs_3 = sql_query($con, $sql_3);
	if($a = sql_fetch_array($rs_3)){
	 ?>
<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center">
	<tr class="header">
		<td align="center" colspan="8" class="tabla-header">Detalles de la Soluci&oacute;n</td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" width="5%" align='right'><b><i>Fecha:</i></b></td>
		<td class="tabla-text" width="10%" align='right'><b><i>
		<?
		$fecha = $a['fechasolucion'];
		$tok1 = strtok($fecha, " ");
		$s1 = substr($fecha, 10);
		$tok2 = strtok($s1, ".");
		
		$hora = strtok($tok2,":");
		$minuto = strtok(":");
		$ap = "AM";
		if($hora > 12){
			$hora -= 12;
			$ap = "PM";
		}
		elseif($hora == 0){
			$hora = 12;
		}
		if($a['fechasolucion'] == ""){
			echo "N/A";
		}
		else{
			echo $tok1;
			echo " ".$hora.":".$minuto." ".$ap;
		}  
		?>
		</i></b></td>
		<td class="tabla-text" width="10%" align='right'><b><i>Soluci&oacute;n:</i></b></td>
		<td class="tabla-text" width="*" align='left'><b><i><?echo $a['solucion'] ?></i></b></td>
		<td class="tabla-text" width="10%" align='right'><b><i>nivel:</i></b></td>
		<td class="tabla-text" width="10%" align='center'><b><i><?echo $a['nivel'] ?></i></b></td>
		<td class="tabla-text" width="10%" align='center' valign="baseline">
			<form action="" method="post">
				<input type="hidden" name="abrir" value="true">
				<input type="hidden" name="requerimiento" value="<?echo $REQUERIMIENTO_ACTUAL?>">
				<input type="submit" value="Abrir" title="Abrir este requerimiento" onclick="return confirm('Desea abrir el requerimiento actual')">
			</form>
		</td>
	</tr>
	<tr class="dark-row">
		<?
		$sql_t = "SELECT (fechaasignacion - fechacreacion) as fecha1, (fechasolucion - fechaasignacion) as fecha2 , (fechasolucion - fechacreacion) as fecha3 from solucionesderequerimientos as s, asignacionesderequerimientos as a, requerimientos as r where a.idasignacion = s.idasignacion and a.idrequerimiento = $REQUERIMIENTO_ACTUAL and a.idrequerimiento = r.idrequerimiento order by s.idsolucion desc;";
		$rs_t = sql_query($con, $sql_t);
		if($row_t = sql_fetch_array($rs_t)){
		?>
		<td  class="tabla-text" width="10%" align='right' colspan="3">
			Tiempo creaci&oacute;n - asignaci&oacute;n: <?echo $row_t['fecha1'];?>
		</td>
		<td class="tabla-text" align='right'>
			Tiempo asignaci&oacute;n - soluci&oacute;n: <?echo $row_t['fecha2'];?>
		</td>
		<td  class="tabla-text" align='right' colspan="3">
			Tiempo creaci&oacute;n - soluci&oacute;n:  <?echo $row_t['fecha3'];?>
		</td>
		<?}
		?>
	</tr>
</table>
<?	}
}
elseif($row['estado'] == "Bloqueado"){
	$sql_3 = "select * from requerimientosbloqueados where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
	$rs_3 = sql_query($con, $sql_3);
	if($a = sql_fetch_array($rs_3)){
?>
<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center">
	<tr class="header">
		<td align="center" colspan="6" class="tabla-header">Detalles del Bloqueo</td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" width="10%" align='right'><b><i>Fecha:</i></b></td>
		<td class="tabla-text" width="15%" align='center'><b><i>
		<?
		$fecha = $a['fechabloqueo'];
		$tok1 = strtok($fecha, " ");
		$s1 = substr($fecha, 10);
		$tok2 = strtok($s1, ".");
		
		$hora = strtok($tok2,":");
		$minuto = strtok(":");
		$ap = "AM";
		if($hora > 12){
			$hora -= 12;
			$ap = "PM";
		}
		elseif($hora == 0){
			$hora = 12;
		}
		if($a['fechabloqueo'] == ""){
			echo "N/A";
		}
		else{
			echo $tok1;
			echo " ".$hora.":".$minuto." ".$ap;
		}  
		?>
		
		</i></b></td>
		<td class="tabla-text" width="25%" align='right'><b><i>Nota de bloqueo:</i></b></td>
		<td class="tabla-text" width="*" align='left'><b><i><?echo $a['nota'] ?></i></b></td>
	</tr>
</table>
<?
	}
}
elseif($row['estado'] == "Anulado"){
	$sql_3 = "select * from requerimientosanulados where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
	$rs_3 = sql_query($con, $sql_3);
	if($a = sql_fetch_array($rs_3)){
?>
<table border="0" cellpadding="2" cellspacing="1" width="800px" align="center">
	<tr class="header">
		<td align="center" colspan="6" class="tabla-header">Detalles de la Anulaci&oacute;n</td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" width="25%" align='right'><b><i>Nota de Anulaci&oacute;n:</i></b></td>
		<td class="tabla-text" width="*" align='left'><b><i><?echo $a['nota'] ?></i></b></td>
	</tr>
</table>
<?
	}
}?>
</td></tr>
	<tr class="header">
		<td align="center" colspan="6" class="tabla-header">
	<!--	<?
		if(!empty($_GET['analista'])){
		?>
			<a href='?modulo=administracion&accion=19' class="paginacion"> Volver</a>
		<?}
		else{?>
			<a href='?modulo=administracion&accion=4' class="paginacion"> Volver</a>
		<?}?>-->
		<a href='javascript:history.go(-1);' class="paginacion"> Volver</a>
		</td>
		
	</tr>
</table>

<?
		}
sql_disconnect();
	}
	
?>


