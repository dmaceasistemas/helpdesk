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
$idusuario = $_SESSION['usuario'];
$MAX_PAGE_SIZE = 5;
$con = sql_connect();
$offset = 0;
$PRIMERA_PAGINA = 0;
$sql = "select count(*) from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and aa.idusuario = $idusuario and r.estado ilike 'Nuevo' and ar.reasignada = 'f'";

$result = @sql_query($con, $sql);
if($row = @sql_fetch_array($result)){
	$totalregistros =  $row['count'];
}
$totalpaginas = ceil($totalregistros / $MAX_PAGE_SIZE);
$ULTIMA_PAGINA = ($totalpaginas * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;

if($totalregistros > 0){
?>

<table width="800px" border="0" align="center" >
	<tr>
		<td colspan="2">
<?

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
$sql = "select u.piso, aa.idasignacion, r.idrequerimiento, aa.idusuario, r.idusuario, u.nombre as nombre1, u.apellido, r.asunto, d.nombre as nombre2, r.fechacreacion from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and aa.idusuario = $idusuario and r.estado ilike 'Nuevo' and ar.reasignada = 'f' order by r.idrequerimiento desc limit $MAX_PAGE_SIZE offset $offset;";
$result = sql_query($con, $sql);
if(sql_num_rows($result) > 0){
?>
<table border="0" cellpadding="2" cellspacing="1" width="100%"
	class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="7">Mis Requerimientos Nuevos</td>
	</tr>
	<tr class="header">
		<td class="tabla-header">N&ordm; de Orden</td>
		<td class="tabla-header">Fecha de creaci&oacute;n</td>
		<td class="tabla-header">Hora de creaci&oacute;n</td>
		<td class="tabla-header">Usuario</td>
		<td class="tabla-header">Direcci&oacute;n</td>
		<td class="tabla-header">Requerimiento</td>
		<td class="tabla-header">Piso</td>
	</tr>
	<?
	$i =0;
	$idasignacion =0;
	if(!empty($_GET['action'])){
		$string = "&action=".$_GET['action'];
		if(!empty($_GET['offset'])){
			$string .= "&offset=".$_GET['offset']; 
		}
	}
	while ($row = sql_fetch_array($result)){
		if(!empty($_GET['idrequerimiento'])){
			$REQUERIMIENTO_ACTUAL = $_GET['idrequerimiento'];
		}
		else{
			if($i == 0){
				$REQUERIMIENTO_ACTUAL = $row['idrequerimiento'];
			}
		}
		if($row['idrequerimiento'] == $REQUERIMIENTO_ACTUAL){
			echo "<tr class=\"dark-row2\"id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=14&idrequerimiento={$row['idrequerimiento']}$string';\">";
		}
		else{
			echo "<tr class=\"dark-row\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=14&idrequerimiento={$row['idrequerimiento']}$string';\">";
		}
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">{$row['idrequerimiento']}</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok($row['fechacreacion'], " ")."</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok(substr($row['fechacreacion'], 10),".")."</td>";
		echo "<td class=\"tabla-text\" width=\"15%\" align=\"center\">".$row['nombre1']." ". $row['apellido']."</td>";
		echo "<td class=\"tabla-text\" width=\"25%\" align=\"center\">{$row['nombre2']}</td>";
		echo "<td class=\"tabla-text\" width=\"30%\" align=\"center\">{$row['asunto']}</td>";
		echo "<td class=\"tabla-text\" width=\"30%\" align=\"center\">{$row['piso']}</td>";
		echo "</tr>";
		$i++;
	}
		if($totalpaginas > 1){
		?>
	<tr class="header">
		<td colspan="7">
		<table width="100%" border="0">
			<tr>
				<td align="left" width="30%"><font size="1">&nbsp;
				<?if($offset != $PRIMERA_PAGINA){?>
					<a href="?modulo=administracion&accion=14&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>">[Atras]</a>
					<a href="?modulo=administracion&accion=14&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=first">[Primera]</a>
				<?}?>
				</font></td>
				<td align="center" width="40%">
					<font size="1">&nbsp;</font>
				</td>
				<td align="right"  width="30%"><font size="1">&nbsp;
					<?if($offset != $ULTIMA_PAGINA){?>
					<a href="?modulo=administracion&accion=14&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=last">[&Uacute;ltima]</a>
					<a href="?modulo=administracion&accion=14&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>">[Siguiente]</a>
					<?}?>
				</font></td>
			</tr>
		</table>
		</td>
	</tr>
	<?}?>
</table>
<? 
}?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table align="center" width="100%">
				<tr>
					<td width="50%">
						<?
			$sql1 = "select aa.idasignacion from  asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and aa.idusuario = $idusuario and r.estado ilike 'Nuevo' and r.idrequerimiento = $REQUERIMIENTO_ACTUAL order by idasignacion desc";
			$rs1 = sql_query($con, $sql1);
			if($row = sql_fetch_array($rs1)){
				$ida = $row['idasignacion'];	
			}
			$sql2 ="select nombre, apellido, u.idusuario  from asignacion_analista as aa, usuarios as u where u.idusuario = aa.idusuario and idasignacion = $ida";
			$rs2 = sql_query($con, $sql2);
			if(sql_num_rows($rs2) > 1){
			?>
			<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
				<tr>
					<td width="10%" rowspan=2><font color='white' size='2'><img src='images/info.gif' height='25px'></td>
					<td><font size="2px"><b>Usted a sido asignado junto a:</b></td>
				</tr>
				<tr>
					<td align="center"><font size=1px><b>
						<?
						$i = 0;
						while($row2 = sql_fetch_array($rs2)){
							if($row2['idusuario'] !=  $_SESSION['usuario']){
								if($i > 0){
									echo ", ";
								}
								echo $row2['nombre']. " ". $row2['apellido'];
								$i++;
							}
						}
						?>
						</b></font>
					</td>
				</tr>
			</table>
			<?}?>
					
					
					</td>
					<td width="50%">
						<?
		$sql3 = "select count(*) from seguimientousuario where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
		$result3 = sql_query($con, $sql3);
		$row3 =  sql_fetch_array($result3);
		if($row3['0'] > 0){
		?>
			<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
				<tr>
				<td align="center"><font color='white' size='2'><blink><img src='images/alert.gif' height='25px'></blink></td>
		
		<td align="center">
			<a class="download" href="javascript:;" title="Ver notas de seguimiento" onclick="openPopUp('notasdeseguimiento.php?id=<?echo $REQUERIMIENTO_ACTUAL?>','Demo','',500,400,'true');"><blink>[Tiene <?echo $row3['0']?> mensajes de seguimiento del Usuario]</blink></a>
		</td>
		
				</tr>
			</table>
			
			<?}?>
					</td>
				</tr>
				
			</table>
		</td>
	</tr>
	<!--  -->
		<tr>
		<td width="40%" valign="top">
		<!--  -->
		<?
		$sql1 = "select mantenimiento, prioridad from requerimientos where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
		$result1 = sql_query($con, $sql1);
		if($row1 = sql_fetch_array($result1)){
			$prioridad = $row1['prioridad'];
			$mantenimiento = $row1['mantenimiento'];
		}
		if(!empty($_POST)){
			$mantenimiento = $_POST['mantenimiento'];
			$calendar = $_POST['calendar'];

			$valido = true;
			$mensaje = "";
			
			if(empty($mantenimiento)){
				$valido = false;
				$mensaje .= "No selecciono el tipo de mantenimiento<br>";
			}
			if(empty($calendar)){
				$valido = false;
				$mensaje .= "No selecciono la fecha de atenci&oacute;n<br>";
			}
			
			if($valido){
				$sql2 = "update requerimientos set estado = 'Pendiente', revisado = 'true', mantenimiento = '$mantenimiento' where idrequerimiento = $REQUERIMIENTO_ACTUAL";
				$sql3 = "update asignacionesderequerimientos set fechadeatencion = '{$calendar}' where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
				echo $sql3;
				sql_query($con, "begin");
				sql_query($con, $sql2);
				sql_query($con, $sql3);
				sql_query($con, "commit");
				echo "<script>location.href='?modulo=administracion&accion=15'</script>";
				
			}
			else{
				mensaje("No se pudo guardar",$mensaje);
				echo "<br>";
			}
			
		}
		?>
			<form action="" method="POST" >
			<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center" class="tablas">
				<tr class="header">
					<td colspan="2" align="center">
						Visualizar el requerimiento
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right">
						<b><i>N&ordm; de Orden :</i></b>
					</td>
					<td>
						<?echo $REQUERIMIENTO_ACTUAL?>
					</td>
				</tr>
				
				<tr class="dark-row">
					<td align="right">
						<b><i>Mantenimiento :</i></b>
					</td>
					<td>
					<?
					$mantenimientos = array("Preventivo","Correctivo");
					?>
						<select name="mantenimiento">
							<option value='0'>-- asignar --</option>
					    	<?
					    	foreach($mantenimientos as $valor){
					    		if($valor == $mantenimiento){
					  				echo "<option selected>$valor</option>";
						  		}
						  		else{
						  			echo "<option >$valor</option>";
						  		}
					    	}
					    	?>
					  	</select>
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right"><b><i>Fecha de atenci&oacute;n:</i></b></td>
					<td >
						    <input type="text" id="calendar" name="calendar" size="18" value="" readonly="readonly" />
						    <button id="trigger">...</button>
						   <script type="text/javascript">//<![CDATA[
						      Zapatec.Calendar.setup({
						         firstDay          : 1,
						        weekNumbers       : true,
						        showOthers        : false,
						        showsTime         : true,
						        timeFormat        : "12",
						        step              : 2,
						        range             : [1900.01, 2999.12],
						        electric          : false,
						        singleClick       : true,
						        inputField        : "calendar",
						        button            : "trigger",
						        ifFormat          : "%Y-%m-%d %I:%M %P",
						        daFormat          : "%d/%m/%Y",
						        align             : "BC"
						      });
						    //]]></script>
						<noscript>
						Habilitar JavaScript
						</noscript>
					</td>
				</tr>
				<tr class="header">
					<td align="center" colspan="2">
						<input type="submit" value="Guardar" title="Guardar la asignaci&oacute;n de prioridad y mantenimiento" />
					</td>
					<!--
					<td align="center">
						<input type="submit" value="Guardar e Imprimir" onclick="probar('Hola');" title="Guardar los cambios de prioridad y mantenimiento e imprimir los datos del requerimiento" />
					</td>
					-->
				</tr>
			</table>
			</form>
		</td>
		<td width="60%" valign="top">
		<?
		#
		$sql = "select u.cedula, u.nombre, u.apellido, u.extension, c.cargo from requerimientos as r, usuarios as u, cargosdeusuarios as c where r.idusuario = u.idusuario and c.idcargosusuario = u.idcargousuario and r.idrequerimiento = $REQUERIMIENTO_ACTUAL";
		$result = sql_query($con, $sql);
		if($row = sql_fetch_array($result)){
		?>
			<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center" class="tablas">
				<tr class="header">
					<td colspan="2" align="center">
						Detalles del Usuario
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right" width="30%">
						<b><i>C&eacute;dula :</i></b>
					</td>
					<td width="70%">
						<?echo $row['cedula']?>
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right">
						<b><i>Nombre :</i></b>
					</td>
					<td>
						<?echo $row['nombre'] ." " . $row['apellido'] ?>
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right">
						<b><i>Cargo :</i></b>
					</td>
					<td>
						<?echo $row['cargo']?>
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right">
						<b><i>Extensi&oacute;n :</i></b>
					</td>
					<td>
						<?echo $row['extension']?>
					</td>
				</tr>
			</table>
			<?}?>
		</td>
	</tr>
</table>
<?}else{?>
<br/>
<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/alert.gif' height='25px'></td>
		<td><font size="2px"><b>No tiene requerimientos nuevos asignados</b></td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?}
sql_disconnect(); 
?>