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

session_start();
$MAX_PAGE_SIZE = 5;
$REQUERIMIENTO_ACTUAL = 0;
$idusuario =  $_SESSION['usuario'];

$con = sql_connect();
if(!empty($_GET['idrequerimiento'])){
	$sql = "select * from requerimientos where (estado = 'Nuevo' or estado = 'Pendiente') and idrequerimiento = " . $_GET['idrequerimiento'];
	
}
else {
	$sql = "select * from requerimientos where (estado = 'Nuevo' or estado = 'Pendiente') and idusuario = ". $idusuario ." order by idrequerimiento desc limit 1";
}

$result = sql_query($con, $sql);
$count = sql_num_rows($result);
if ($count > 0) {
	if($row = sql_fetch_array($result)){
		$idrequerimiento = $row['idrequerimiento'];
		$REQUERIMIENTO_ACTUAL = $idrequerimiento;
		$asunto = $row['asunto'];
		$estado = $row['estado'];
		$fechacreacion = $row['fechacreacion'];
		$diagnostico = $row['diagnostico'];
		$fechadiagnostico = $row['fechadiagnostico'];
		$revisado = $row['revisado'];
		$origen = $row['origen'];
		$prioridad = $row['prioridad'];
		$mantenimiento = $row['mantenimiento'];
		$observacion = $row['observacion'];
		$idtiporequerimiento = $row['idtiporequerimiento'];
		$asignado = $row['asignado'];
	}
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" >
	<tr>
		<td colspan="2">
		<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center">
	<tr class="header">
		<td align="center" colspan="6" class="tabla-header">Detalles del Requerimiento</td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" width="10%" align='right'>N&ordm; de Orden:</td>
		<td class="tabla-text" width="5%" align='center'><?echo $REQUERIMIENTO_ACTUAL ?></td>
		<td class="tabla-text" width="8%" align='right'>Fecha de creaci&oacute;n:</td>
		<td class="tabla-text" width="20%" align='center'>
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
		</td>
		<td class="tabla-text" width="15%" align='right'>Requerimiento:</td>
		<td class="tabla-text" width="*" align='left'><?echo $row['asunto'] ?>
		<?$sql2 = "select * from requerimientos as r, tiposderequerimientos as tr, tiposgenerales as tg, tiposdetallados as td where r.idtiporequerimiento = tr.idtiporequerimiento and td.idtiporequerimiento = tr.idtiporequerimiento and tg.idtiposgenerales = td.idtiposgenerales and r.idtiposdetallados = td.idtiposdetallados and  r.idrequerimiento = $REQUERIMIENTO_ACTUAL";
$stm = sql_query($con, $sql2);
if($rs = sql_fetch_array($stm)){?>
	<tr class="dark-row">
		<td class="tabla-text" align='right'>Tipo:</td>
		<td class="tabla-text" align='left'><?echo $rs['tipoderequerimiento'] ?></td>
		<td class="tabla-text" align='left' colspan=2><?echo $rs['tiposgenerales'] ?></td>
		<td class="tabla-text" align='left' colspan=2><?echo $rs['tiposdetallados'] ?></td>
	</tr>
</table>
<?}?>

<?
if($asignado == 't'){
	$sql = "select * from asignacionesderequerimientos as a, requerimientos as r  where r.idrequerimiento= a.idrequerimiento and r.idrequerimiento = {$REQUERIMIENTO_ACTUAL}  order by idasignacion desc";
	$result = sql_query($con, $sql);
	if($row = sql_fetch_array($result)){
?>
<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center">
<tr class="header">
	<td colspan="6" align="center" class="tabla-header">
		Detalles de la Asignaci&oacute;n
	</td>
</tr>
	<?
		$sql2 = "select * from asignacion_analista as a, usuarios as u where idasignacion = {$row['idasignacion']} and a.idusuario = u.idusuario;";
		//echo $sql2;
		$rs = sql_query($con, $sql2);		
	?>
	<tr class="dark-row">
		<td align="right" class="tabla-text">
			Analista(s):
		</td>
		<td class="tabla-text" colspan="5">
<?
$i = 0;
		while($row2 = sql_fetch_array($rs)){
			if($i > 0){
					echo ",  ";
				}
			echo $row2['nombre'] ." ".$row2['apellido'] ." extensi&oacute;n ".$row2['extension'];
			$i++;
		}
?>
		</td>
	</tr>
	
	<?if($row['revisado'] != 'f' && $row['revisado'] != 'false'){ ?>
	<tr class="dark-row">
		<td align="right" class="tabla-text">
			Visualizada:
		</td>
		<td class="tabla-text">
			<?echo $row['revisado'] == 'f' ? "No" : "Si"?>
		</td>
		<td align="right" class="tabla-text">
			Fecha de posible atenci&oacute;n:
		</td>
		<td class="tabla-text">
			<?
			$fecha = $row['fechadeatencion'];
			$tok1 = strtok($fecha, " ");
			$s1 = substr($fecha, 10);
			$tok2 = strtok($s1, ".");
			echo empty($row['fechadeatencion']) ? "No establecida" : $tok1?>
			<?
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
			
			echo empty($row['fechadeatencion']) ? "No establecida" : $hora.":".$minuto." ".$a?>
		</td>
	<?if($row['reasignacionid'] > 0){?>
		<td colspan="1" align="center" class="tabla-text">Su requerimiento ha sido reasignado</td>
	</tr>
	
	<?}?>
	
	<?}?>
	
	</table>
<?}?>
<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center">
<tr class="dark-row">
		<td class="tabla-text" width="10%" align='right'>Fecha de diagn&oacute;stico:</td>
		<td class="tabla-text" width="15%" align='center'>
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
		<td class="tabla-text" width="10%" align='right'>Diagn&oacute;stico:</td>
		<td class="tabla-text" width="25%" align='left'><?echo $row['diagnostico'] != "" ?  $row['diagnostico'] : "N/A" ?></td>
		<td class="tabla-text" width="10%" align='right'>Observaci&oacute;n:</i></b></td>
		<td class="tabla-text" width="*" align='left'><?echo $row['observacion'] != "" ?  $row['observacion'] : "N/A" ?></td>
	</tr>
</table>
<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center">
	<tr class="dark-row">
		<td class="tabla-text" width="10%" align='right'>Estado:</td>
		<td class="tabla-text" width="20%" align='left'><?echo $row['estado']?></td>
		<td class="tabla-text" width="10%" align='right'>Prioridad:</td>
		<td class="tabla-text" width="20%" align='left'><?echo $row['prioridad'] != "" ? $row['prioridad'] :"N/A"?></td>
		<td class="tabla-text" width="20%" align='right'>Mantenimiento:</td>
		<td class="tabla-text" width="20%" align='left'><?echo $row['mantenimiento'] != "" ?  $row['mantenimiento'] : "N/A" ?></td>
	</tr>
	</table>
<?}?>

<?
if(isset($_POST['Aprobar'])){
	$sql ="UPDATE requerimientos set aprobado = true where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
	sql_query($con, $sql);
	echo "<script>location.href='?modulo=administracion&accion=8'</script>";
}
?>
<form action="" method="POST" onsubmit="return confirm('Usted esta conforme con la actuaci&oacute;n del analista,\n ha realizado su requerimiento exitosamente.')">
<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center">
	<tr class="dark-row">
		<?
		$sql3 = "select count(*) from seguimientousuario where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
		$result3 = sql_query($con, $sql3);
		$row3 =  sql_fetch_array($result3);
		if($row3['0'] > 0){
		?>
		<td align='right' class="tabla-text" width="10%">Seguimiento:</td>
		<td align="left" colspan="3">
			<a class="download" href="javascript:;" title="Ver notas de seguimiento" onclick="openPopUp('notasdeseguimiento.php?id=<?echo $REQUERIMIENTO_ACTUAL?>','Demo','',500,400,'true');">[Ver Notas de Seguimiento]</a>
		</td>
		<?}?>
		<?if($asignado == 't'){
			if($row['aprobado'] == false){
			?>
			<td align='right' class="tabla-text" width="30%">Aprobar el Trabajo del Analista:</td>
			<td align='right' class="tabla-text" width="10%">
				<input type="submit" value="Aprobar" name="Aprobar">
			</td>
			<?}
			else{
				?>
			<td align='right' class="tabla-text" width="40%">Usted confirm&oacute; la realizaci&oacute;n del requerimiento</td>
		<?}
		}?>
	</tr>
</table>
</form>
		</td>
	</tr>
	<tr>
		<td width="50%" valign="top">

			<div id="mensaje"></div>
<form action="" method="POST" name="seguimiento" onsubmit="return validarNotaDeSeguimiento()">
<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
	<tr class="header">
		<td align="center" colspan="2" class="tabla-header">Notas de Seguimiento</td>
	</tr>
	
	<tr class="dark-row">
		<td align="right" class="tabla-text">
			<font color='red' size='1'>&nbsp; * &nbsp;</font>Nota:
		</td>
		<td align="left">
			<textarea name="nota" cols="40" rows="3"></textarea>
		</td>
	</tr>
	<tr class="header">
		<td colspan="2" align="center">
			<input type="submit" value="Enviar Nota">
		</td>
	</tr>
</table>
</form>
<?
	if($_POST['nota']!= null){
		if(!empty($_POST['nota'])){
			$nota = $_POST['nota'];
			$sql ="INSERT INTO seguimientousuario (notadeseguimiento, idrequerimiento, idusuario, fechadeseguimiento) VALUES ('$nota',$REQUERIMIENTO_ACTUAL, $idusuario, CURRENT_TIMESTAMP);";
			sql_query($con, $sql);
			echo "<script>location.href='?modulo=administracion&accion=8'</script>";
		}
		/*else{
			mensaje("Error al anular","Debe especificar porque desea anular este requerimiento");
			echo "<br/>";
		}*/
	}
?>

		</td>
		<td width="50%" valign="top">	
<?
if($asignado != 't'){
?>
<div id="mensaje2"></div>
<form method="POST" action="" onsubmit="return validarAnular()" name="anular">
<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
<tr class="header">
	<td colspan="2" align="center" class="tabla-header">
		Anular este requerimiento
	</td>
</tr>
<tr class="dark-row">
	<td align="right" class="tabla-text">
		<font color='red' size='1' >&nbsp; * &nbsp;</font>Nota:
	</td>
	<td width="*">
		<textarea name="notadecancelar" cols="40" rows="3"></textarea>
	</td>
</tr>
<tr class="header">
	<td colspan="2">
		<input type="submit" value="Anular">
	</td>
</tr>
</table>
</form>
<?
	if($_POST['notadecancelar']!= null){
		if(!empty($_POST['notadecancelar'])){
			$nota = $_POST['notadecancelar'];
			$sql2 ="update requerimientos set estado = 'Anulado' where idrequerimiento = {$REQUERIMIENTO_ACTUAL};";
			$sql1 = "insert into requerimientosanulados (nota, idrequerimiento) values ('{$nota}',{$REQUERIMIENTO_ACTUAL});";
			sql_query($con, "begin");
			sql_query($con, $sql1);
			sql_query($con, $sql2);
			sql_query($con, "commit");
			echo "<script>location.href='?modulo=administracion&accion=8'</script>";
		}
		/*else{
			mensaje("Error al anular","Debe especificar porque desea anular este requerimiento");
			echo "<br/>";
		}*/
	}
}
?>
		</td>
	</tr>
</table>
<!-------------------------------------------------------------------------------------->



<!-------------------------------------------------------------------------------------->




			<!-- detalles de la asignacion -->

		
		
		
			<!-- lista de requerimientos abiertos  -->
			<table border="0" cellpadding="2" cellspacing="1" width="100%"  class="tablas" align="center">
		<tr class="header">
			<td align="center" colspan="6">Lista de Requerimientos Abiertos</td>
		</tr>
		<tr class="header">
			<td class="tabla-header">N&ordm; de Orden</td>
			<td class="tabla-header">Fecha de creaci&oacute;n</td>
			<td class="tabla-header">Hora de creaci&oacute;n</td>
			<td class="tabla-header">Asignado</td>
			<td class="tabla-header">Estado</td>
			<td class="tabla-header">Tipo</td>
		</tr>
		
		<?
		$offset = 0;
		
		$PRIMERA_PAGINA = 0;
		$result = sql_query($con, "select count(*) from requerimientos where idusuario = " .$idusuario ."and (estado ilike 'Nuevo' or estado ilike 'Pendiente')");
		$row = sql_fetch_array($result);
		$totalregistros =  $row['0'];
		$totalpaginas = ceil($totalregistros / $MAX_PAGE_SIZE);
		$ULTIMA_PAGINA = ($totalpaginas * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;
		
		if(!empty($_GET['action'])){
			$action = $_GET['action'];
			if($action == 'next'){
				if(!empty($_GET['offset'])){
					$offset = $_GET['offset'];
				}
			}
			elseif($action == 'back'){
				if(!empty($_GET['offset'])){
					$offset = $_GET['offset'];
				}
			}
			elseif($action == 'first'){
				$offset = $PRIMERA_PAGINA;
			}
			elseif($action == 'last'){
				$offset = $ULTIMA_PAGINA;
			}
		}
		$sql = "select * from requerimientos where idusuario = " .$idusuario. " and (estado ilike 'Nuevo' or estado ilike 'Pendiente')  order by idrequerimiento desc  limit $MAX_PAGE_SIZE offset $offset; ";
		$result = sql_query($con, $sql);
		$count = sql_num_rows($result);
		if ($count <= 0) {?>
		<tr class="dark-row" id="efecto" onclick="javascript:location.href='?modulo=administracion&accion=8';">
			<td colspan='6' align='center'><b>Usted no tiene requerimientos abiertos</b></td>
		</tr>
		<?} else {
			while ($row = sql_fetch_array($result)){
				if(!empty($_GET['action'])){
					$string = "&action=".$_GET['action'];
					if(!empty($_GET['offset'])){
						$string .= "&offset=".$_GET['offset']; 
					}
				}
				if($row['idrequerimiento'] == $REQUERIMIENTO_ACTUAL){
					echo "<tr class=\"dark-row2\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=8&idrequerimiento=".$row['idrequerimiento'].$string."';\">";
				}
				else{
					echo "<tr class=\"dark-row\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=8&idrequerimiento=".$row['idrequerimiento'].$string."';\">";
				}
				echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".$row['idrequerimiento']."</td>";
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
				echo "<td class=\"tabla-text\" width=\"15%\" align=\"center\">".$tok1."</td>";
				echo "<td class=\"tabla-text\" width=\"15%\" align=\"center\">".$hora.":".$minuto." ".$a."</td>";
				echo "<td class=\"tabla-text\" width=\"20%\" align=\"center\">".($row['asignado'] == 'f' ? "No esta asignado" : "Ya ha sido asignado")."</td>";
				echo "<td class=\"tabla-text\" width=\"20%\" align=\"center\">".$row['estado']."</td>";
				$result1 = sql_query($con, "select tipoderequerimiento from tiposderequerimientos where idtiporequerimiento = " .$row['idtiporequerimiento']);
				$row1 = sql_fetch_array($result1);
				echo "<td class=\"tabla-text\" width=\"20%\" align=\"center\">".$row1['tipoderequerimiento']."</td>";
				echo "</tr>";
			}
		}
		if($totalpaginas > 1){
		?>
		<tr class="header">
			<td colspan="6">
				<table width="100%" border="0">
				<tr>
					<td align="left" width="30%"><font size="1">&nbsp;
						<?if($offset != $PRIMERA_PAGINA){?>
							<a href="?modulo=administracion&accion=8&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>"><img src='styles/<?echo $_SESSION['tema']?>/atras.gf' border=0 alt='[Atras]' title='Atras'></a>
							<a href="?modulo=administracion&accion=8&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=first"><img src='styles/<?echo $_SESSION['tema']?>/primera.gf' border=0 alt='[Primera]' title='Primera'></a>
						<?}?>
					</font></td>
					<td align="center" width="40%">
						<font size="1">&nbsp;</font>
					</td>
					<td align="right"  width="30%"><font size="1">&nbsp;
						<?if($offset != $ULTIMA_PAGINA){?>
						<a href="?modulo=administracion&accion=8&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=last"><img src='styles/<?echo $_SESSION['tema']?>/ultima.gf' border=0 alt='[&Uacute;ltima]' title='&Uacute;ltima'></a>
						<a href="?modulo=administracion&accion=8&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>"><img src='styles/<?echo $_SESSION['tema']?>/siguiente.gf' border=0 alt='[Siguiente]' title='Siguiente'></a>
						<?}?>
					</font></td>
				</tr>
			</table>
			</td>
		</tr>
		<?}?>
		
</table>

		</td>
	</tr>
</table>
<?}
else{
	?>
		<br>
<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/alert.gif' height='25px'></td>
		<td><font size="2px"><b>Usted no tiene requerimientos abiertos</b></td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?}?>