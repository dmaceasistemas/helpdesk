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
$con = sql_connect();
$idusuario =  $_SESSION['usuario'];
$sql = "SELECT idtipousuario FROM Usuarios WHERE idusuario = ". $idusuario;
$result = @sql_query($con, $sql);
if($row = @sql_fetch_array($result)){
	$idtipousuario = $row['idtipousuario'];
}

$tipo1 = "";
$tipo2 = "";
$tipo3 = "";

//Soporte
if($idtipousuario == 1 || $idtipousuario == 2 || $idtipousuario == 4){
	$tipo1 = "and (tu.tipodeusuario = 'Analista de Soporte Tecnico' OR tu.tipodeusuario ilike '%Coordinador%')";
	$tipo3 = "and (tr.tipoderequerimiento ilike '%SOPORTE%' OR tr.tipoderequerimiento ilike '%GENERAL%')";
	$tipo2 = "and  (r.idtiporequerimiento = 1 OR r.idtiporequerimiento = 5)";
}
//Redes
elseif($idtipousuario == 6 || $idtipousuario == 8){
	$tipo1 = "and (tu.tipodeusuario = 'Analista de Redes' OR tu.tipodeusuario ilike '%Coordinador%')";
	$tipo3 = "and (tr.tipoderequerimiento ilike '%REDES%' OR tr.tipoderequerimiento ilike '%GENERAL%')";
	$tipo2 = "and  (r.idtiporequerimiento = 2 OR r.idtiporequerimiento = 5)";
}
//Telefonia
elseif($idtipousuario == 11 || $idtipousuario == 12){
	$tipo1 = "and (tu.tipodeusuario = 'Analista de Telecomunicaciones' OR tu.tipodeusuario ilike '%Coordinador%')";
	$tipo3 = "and (tr.tipoderequerimiento ilike '%TELECOMUNICACIONES%' OR tr.tipoderequerimiento ilike '%GENERAL%')";
	$tipo2 = "and  (r.idtiporequerimiento = 4 OR r.idtiporequerimiento = 5)";
}
//Desarrollo
elseif($idtipousuario == 7 || $idtipousuario == 9){
	$tipo1 = "and (tu.tipodeusuario = 'Analista de Desarrollo' OR  tu.tipodeusuario ilike '%Coordinador%')";
	$tipo3 = "and (tr.tipoderequerimiento ilike '%DESARROLLO%' OR tr.tipoderequerimiento ilike '%GENERAL%')";
	$tipo2 = "and (r.idtiporequerimiento = 3 OR r.idtiporequerimiento = 5)";
}
//Administrador
elseif($idtipousuario == 10){
	$tipo1 = "and (tu.tipodeusuario ilike 'Analista%' OR tu.tipodeusuario ilike 'Coordinador%' )";
	$tipo3 = "";
	$tipo2 = "";
}
else{
	$tipo1 = "and (tu.tipodeusuario = '???' OR  tu.tipodeusuario = '???')";
	$tipo3 = "and tr.tipoderequerimiento = '???'";
	$tipo2 = "and (r.idtiporequerimiento = 999 OR r.idtiporequerimiento = 999)";
}

$MAX_PAGE_SIZE = 8;
$REQUERIMIENTO_ACTUAL = 0;

$offset = 0;
$PRIMERA_PAGINA = 0;
//$result = sql_query($con, "select count(*) from departamentos as d, requerimientos as r, tiposderequerimientos as tr, usuarios as u where r.idusuario = u.idusuario  and u.iddepartamento = d.iddepartamento and tr.idtiporequerimiento = r.idtiporequerimiento and r.asignado = 'f' and r.estado ilike 'Nuevo' $tipo3;");
$result = sql_query($con, "select count(*) from departamentos as d, requerimientos as r, tiposderequerimientos as tr, usuarios as u where r.idusuario = u.idusuario  and u.iddepartamento = d.iddepartamento and tr.idtiporequerimiento = r.idtiporequerimiento and r.asignado = 'f' and r.estado ilike 'Nuevo' $tipo3;");
$row = sql_fetch_array($result);
$totalregistros =  $row['0'];
$totalpaginas = ceil($totalregistros / $MAX_PAGE_SIZE);
$ULTIMA_PAGINA = ($totalpaginas * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;
if($totalregistros > 0){
?>

<form action="" method="POST" name="tabla">
<table align="center" width="800px" border="0">
	<tr>
		<td colspan="2" align="center">
			<!-- Lista de requerimientos no asignados -->
			<table border="0" cellpadding="2" cellspacing="1" width="800px"  class="tablas" align="center">
				<tr class="header">
					<td align="center" colspan="8">Lista de Requerimientos Abiertos</td>
				</tr>
				<tr class="header">
					<td class="tabla-header">N&ordm; de Orden</td>
					<td class="tabla-header">Fecha de Creaci&oacute;n</td>
					<td class="tabla-header">Hora de Creaci&oacute;n</td>
					<td class="tabla-header">Tipo</td>
					<td class="tabla-header">Usuario</td>
					<td class="tabla-header">Direcci&oacute;n</td>
					<td class="tabla-header">Requerimiento</td>
				</tr>
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
				
				$sql = "select iniciales, asunto, idrequerimiento, fechacreacion,tipoderequerimiento,u.nombre as nombre1, u.apellido, d.nombre as nombre2 from departamentos as d, requerimientos as r, tiposderequerimientos as tr, usuarios as u where r.idusuario = u.idusuario  and u.iddepartamento = d.iddepartamento and tr.idtiporequerimiento = r.idtiporequerimiento and r.asignado = 'f' and r.estado ilike 'Nuevo' $tipo2 order by idrequerimiento limit $MAX_PAGE_SIZE offset $offset;";
				$result = sql_query($con, $sql);
				if(!empty($_GET['action'])){
						$string = "&action=".$_GET['action'];
						if(!empty($_GET['offset'])){
							$string .= "&offset=".$_GET['offset']; 
						}
					}
					//
				if(empty($REQUERIMIENTO_ACTUAL)){
					$REQUERIMIENTO_ACTUAL = $_GET['idrequerimiento'];
				}
				$i =0;
				while($row = sql_fetch_array($result)){
					if(empty($REQUERIMIENTO_ACTUAL)){
						if($i == 0){
							$REQUERIMIENTO_ACTUAL = $row['idrequerimiento'];
						}
					}
					if($row['idrequerimiento'] == $REQUERIMIENTO_ACTUAL){
						echo "<tr class=\"dark-row2\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=10&idrequerimiento=".$row['idrequerimiento'].$string."';\">";
					}
					else{
						echo "<tr class=\"dark-row\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=10&idrequerimiento=".$row['idrequerimiento'].$string."';\">";
					}
					
					if(empty($REQUERIMIENTO_ACTUAL)){
						$REQUERIMIENTO_ACTUAL = $row['idrequerimiento'];
					}
					echo "<td class=\"tabla-text\" width=\"5%\" align=\"center\">".$row['idrequerimiento']."</td>";
					echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok($row['fechacreacion'], " ")."</td>";
					echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok(substr($row['fechacreacion'], 10),".")."</td>";
					echo "<td class=\"tabla-text\" width=\"15%\" align=\"center\">".$row['tipoderequerimiento']."</td>";
					echo "<td class=\"tabla-text\" width=\"20%\" align=\"center\">".$row['nombre1']." ".$row['apellido']."</td>";
					echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\" title=\"{$row['nombre2']}\">".$row['iniciales']."</td>";
					echo "<td class=\"tabla-text\" width=\"30%\" align=\"center\">".$row['asunto']."</td>";
					echo "</tr>";
					$i++;
				}
				?>
		<tr class="header">
			<td colspan="8">
				<table width="100%" border="0">
				<tr>
					<td align="left" width="30%"><font size="1">&nbsp;
						<?if($offset != $PRIMERA_PAGINA){?>
							<a href="?modulo=administracion&accion=10&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>"><img src='styles/<?echo $_SESSION['tema']?>/atras.gif' border=0 alt='[Atras]' title='Atras'></a>
							<a href="?modulo=administracion&accion=10&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=first"><img src='styles/<?echo $_SESSION['tema']?>/primera.gif' border=0 alt='[Primera]' title='Primera'></a>
						<?}?>
					</font></td>
					<td align="center" width="40%">
						<font size="1">&nbsp;</font>
					</td>
					<td align="right"  width="30%"><font size="1">&nbsp;
						<?if($offset != $ULTIMA_PAGINA){?>
						<a href="?modulo=administracion&accion=10&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=last"><img src='styles/<?echo $_SESSION['tema']?>/ultima.gif' border=0 alt='[&Uacute;ltima]' title='&Uacute;ltima'></a>
						<a href="?modulo=administracion&accion=10&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>"><img src='styles/<?echo $_SESSION['tema']?>/siguiente.gif' border=0 alt='[Siguiente]' title='Siguiente'></a>
						<?}?>
					</font></td>
				</tr>
			</table>
			</td>
		</tr>
</table>
<!--  -->
		</td>
	</tr>
	<tr>
		<td align="center" width="60%" valign="top">
		<?
		if(!empty($_POST)){
			$analistasid = $_POST['analistasid'];
			$analistas = $_POST['analistas'];
			$prioridad = $_POST['prioridad'];
			if(empty($prioridad)){
				$mensaje .= "No selecciono la prioridad<br>";
				$valido = false;
			}
			if(empty($analistasid)){
				$mensaje = "Seleccione un analista en la lista de la derecha para reasignarlo al requerimiento";
			}
			if(empty($analistas)){
				$mensaje = "Seleccione un analista en la lista de la derecha para reasignarlo al requerimiento";
			}
			
			if(!empty($mensaje)){
				mensaje("Error de asignaci&oacute;n",$mensaje);
			}
			else{
				#sql_query($con, "begin");
				sql_query($con, "INSERT INTO asignacionesderequerimientos (fechaasignacion, idrequerimiento, reasignacionid, reasignada, idusuarioasigno) VALUES (CURRENT_TIMESTAMP,".$REQUERIMIENTO_ACTUAL.",0,'f', $idusuario);");
				$result = sql_query($con,"SELECT MAX(idasignacion) FROM asignacionesderequerimientos;");
				if($row = sql_fetch_array($result)){
					$idasignacion =  $row['max'];	
				}
				#Cadena de ids de analistas asignados, validacion de mas de un id
				if(substr_count($analistasid, ',') > 0){
					$tok =  strtok($analistasid, ',');
					while ($tok !== false) {
					    sql_query($con,"INSERT INTO asignacion_analista (idasignacion, idusuario) VALUES ({$idasignacion},".trim($tok).");");
					    $tok = strtok(",");
					}
				}
				else{
					sql_query($con,"INSERT INTO asignacion_analista (idasignacion, idusuario) VALUES ({$idasignacion},{$analistasid});");
				}
				
				sql_query($con,"UPDATE requerimientos SET asignado = 't', prioridad = '$prioridad' WHERE idrequerimiento = ".$REQUERIMIENTO_ACTUAL);
				#sql_query($con, "commit");
				echo "<script>location.href='?modulo=administracion&accion=10'</script>";
			}
		}
		?>
		
		<form method="" action="POST">
		<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center" class="tablas">
			<tr class="header">
				<td colspan="2" align="center">
					Detalles del requerimiento abierto
				</td>
			</tr>
			<?
			$sql ="select tiposdetallados, tiposgenerales, fechacreacion,tipoderequerimiento,u.nombre, u.apellido, r.asunto from departamentos as d, requerimientos as r, tiposderequerimientos as tr, usuarios as u, tiposgenerales as tg, tiposdetallados as td where r.idusuario = u.idusuario  and u.iddepartamento = d.iddepartamento and tr.idtiporequerimiento = r.idtiporequerimiento  and td.idtiposgenerales = tg.idtiposgenerales and td.idtiporequerimiento = tr.idtiporequerimiento and idrequerimiento = ".$REQUERIMIENTO_ACTUAL;
			$result = sql_query($con, $sql);
			if($row = sql_fetch_array($result)){
			?>
			<tr class="dark-row">
				<td align="right" width="35%">
					<b>N&ordm; de Orden:</b>
				</td>
				<td width="65%" align="left">
					<?echo $REQUERIMIENTO_ACTUAL?>
				</td>
			</tr>
			<tr class="dark-row">
				<td align="right" width="30%">
					<b>Usuario :</b>
				</td>
				<td width="70%" align="left">
					<?echo $row['nombre'] ." ". $row['apellido']?>
				</td>
			</tr>
			<tr class="dark-row">
				<td align="right">
					<b>Fecha de creaci&oacute;n:</b>
				</td>
				<td align="left">
					<?echo strtok($row['fechacreacion'], " ") ?>
				</td>
			</tr>
			<tr class="dark-row">
				<td align="right">
					<b>Tipo :</b>
				</td>
				<td align="left">
					<font size=1><b><i>
					<?
						$sql2 = "select * from requerimientos as r, tiposderequerimientos as tr, tiposgenerales as tg, tiposdetallados as td where r.idtiporequerimiento = tr.idtiporequerimiento and td.idtiporequerimiento = tr.idtiporequerimiento and tg.idtiposgenerales = td.idtiposgenerales and r.idtiposdetallados = td.idtiposdetallados and  r.idrequerimiento = $REQUERIMIENTO_ACTUAL";
						$stm = sql_query($con, $sql2);
						if($rs = sql_fetch_array($stm)){
							echo $rs['tiposgenerales'] ."->".$rs['tiposdetallados']."->".$rs['tipoderequerimiento'];
						}
					?>
					
					<?//echo $row['tiposdetallados']." -> ".$row['tiposgenerales']." -> ".$row['tipoderequerimiento'] ?></i></b></font>
				</td>
			</tr>
			<tr class="dark-row">
				<td align="right">
					<b>Analista :</b>
				</td>
				<td align="left">
					<input type="hidden" name="analistasid" value="">
					<textarea id="analistas" name="analistas" cols="35" rows="3" ><?#echo $analistas?></textarea>
				</td>
			</tr>
			<tr class="dark-row">
					<td align="right">
						<b>Prioridad :</b>
					</td>
					<td  align="left">
					<?
					$prioridades = array("Baja","Normal","Urgente","Emergencia");
					?>
					  <select name="prioridad">
					  	<option value='0'>-- asignar --</option>
					  	<?
					  	foreach ($prioridades as $valor){
					  		if($valor == $prioridad){
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
				<td align="right">
					<b>Requerimiento :</b>
				</td>
				<td align="left">	
					<a class="download" href="javascript:;" title="Ver asunto del requerimiento" onclick="openPopUp('asuntoDelRequerimiento.php?id=<?echo $REQUERIMIENTO_ACTUAL?>','Demo','',500,400,'true');">ver el asunto del requerimiento</a>
				</td>
			</tr>
			<?}?>
			<tr class="header">
				<td align="right">
					<input type="submit" value="Asignar"/>&nbsp;&nbsp;
				</td>
				<td align="left">
					&nbsp;&nbsp;<input type="reset" value="Borrar"/>
				</td>
			</tr>
		</table>
		</form>
		</td>
		<td align="center" width="40%" valign="top">
		<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center" class="tablas">
			<tr class="header">
				<td colspan="4" align="center">
					Analistas Disponibles
				</td>
			</tr>
			<tr class="header">
				<td width="*" class="tabla-header">
					Nombre
				</td>
				<td width="30%" class="tabla-header" title="Asignaciones pendientes">
					Pendientes
				</td>
				<td width="20%" class="tabla-header" title="Asignadas el d&iacute;a de Hoy">
					Hoy
				</td>
				<!--<td width="40%" class="tabla-header">
					Cargo
				</td>-->
			</tr>
			<?
			$o = 0;
			$MAX_PAGE_SIZE+=20;
			$result = sql_query($con, "select count(*) from usuarios as u, tiposdeusuarios as tu where u.idtipousuario = tu.idtipousuario $tipo1;");
			$row = sql_fetch_array($result);
			$totalregistros2 =  $row['0'];
			$totalpaginas2 = ceil($totalregistros2 / $MAX_PAGE_SIZE);
			$ULTIMA_PAGINA2 = ($totalpaginas2 * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;
			
			if(!empty($_GET['a'])){
					$a = $_GET['a'];
					if($a == 'next'){
						if(!empty($_GET['o'])){
							$o= $_GET['o'];
						}
					}
					elseif($a == 'back'){
						if(!empty($_GET['o'])){
							$o = $_GET['o'];
						}
					}
					elseif($a == 'first'){
						$o = $PRIMERA_PAGINA;
					}
					elseif($a == 'last'){
						$o = $ULTIMA_PAGINA2;
					}
				}
			
			$sql = "select idusuario, nombre, apellido, tipodeusuario from usuarios as u, tiposdeusuarios as tu where u.idtipousuario = tu.idtipousuario $tipo1 order by cedula limit $MAX_PAGE_SIZE offset $o ";
			$result = sql_query($con, $sql);
						
			while($row = sql_fetch_array($result)){
				echo "<tr class=\"dark-row\" id=\"efecto\" onclick=\"marcar('".$row['nombre']." ".$row['apellido']."','".$row['idusuario']."');\">";
				echo "<td align=\"center\" class=\"tabla-text\"  title=\"{$row['nombre']} {$row['apellido']}\">".$row['nombre']." ".$row['apellido']."</td>";
				
				$sql_2 = "select count(*) from asignacion_analista as aa, asignacionesderequerimientos as ar,requerimientos as r where aa.idasignacion = ar.idasignacion and ar.idrequerimiento = r.idrequerimiento and ar.reasignada = 'f' and aa.idusuario = {$row['idusuario']} and (r.estado ilike 'Nuevo' or r.estado ilike 'Pendiente');";
				$rs = sql_query($con, $sql_2);
				if($col = sql_fetch_array($rs)){
					echo "<td align=\"center\" class=\"tabla-text\" title=\"{$row['nombre']} {$row['apellido']} Tiene {$col['0']} asignaciones pendientes\">{$col['0']}</td>";
				}
				
				//Para ver los requerimientos diaros de un analista
				$sql_3 = "select count(*) from asignacion_analista as aa, asignacionesderequerimientos as ar,requerimientos as r where aa.idasignacion = ar.idasignacion and ar.idrequerimiento = r.idrequerimiento and ar.reasignada = 'f' and aa.idusuario = {$row['idusuario']} and fechaasignacion between '".date("Y-m-d")." 00:00:000000' and '".date("Y-m-d")." 23:59:59.999999';";
				$rs = sql_query($con, $sql_3);
				if($col = sql_fetch_array($rs)){
					echo "<td align=\"center\" class=\"tabla-text\"  title=\"{$row['nombre']} {$row['apellido']} Tiene {$col['0']} asignaciones hoy\">{$col['0']}</td>";
				}
				//echo "<td align=\"center\" class=\"tabla-text\">".$row['tipodeusuario']."</td>";
				
				echo "</tr>";
			}
			?>
			
				<tr class="header">
					<td colspan="4">
						<table width="100%" border="0">
							<tr>
								<td align="left" width="30%"><font size="1">&nbsp;
									<?if($o != $PRIMERA_PAGINA){?>
										<a href="?modulo=administracion&accion=11&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&a=back&o=<?echo $o-$MAX_PAGE_SIZE.$string?>"><img src='styles/<?echo $_SESSION['tema']?>/atras.png' border=0 alt='[Atras]' title='Atras'></a>
										<a href="?modulo=administracion&accion=11&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&a=first<?echo $string?>"><img src='styles/<?echo $_SESSION['tema']?>/primera.png' border=0 alt='[Primera]' title='Primera'></a>
									<?}?>
								</font></td>
								<td align="center" width="40%">
									<font size="1">&nbsp;</font>
								</td>
								<td align="right"  width="30%"><font size="1">&nbsp;
									<?if($o != $ULTIMA_PAGINA2){?>
									<a href="?modulo=administracion&accion=11&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&a=last<?echo $string?>"><img src='styles/<?echo $_SESSION['tema']?>/ultima.png' border=0 alt='[&Uacute;ltima]' title='&Uacute;ltima'></a>
									<a href="?modulo=administracion&accion=11&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&a=next&o=<?echo $o+$MAX_PAGE_SIZE.$string?>"><img src='styles/<?echo $_SESSION['tema']?>/siguiente.png' border=0 alt='[Siguiente]' title='Siguiente'></a>
									<?}?>
								</font></td>
							</tr>
						</table>
					</td>
				</tr>
		</table>
		</td>
	</tr>
</table>
</form>
<?}else{?>
	<br/>
<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/alert.gif' height='25px'></td>
		<td><font size="2px"><b>No Hay requerimientos por asignar</b></td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?}?>
<?sql_disconnect() ?>