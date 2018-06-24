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
$result = sql_query($con, "select count(*) from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and aa.idusuario = $idusuario and r.estado ilike 'Pendiente' and ar.reasignada = 'f'");
$row = sql_fetch_array($result);
$totalregistros =  $row['0'];
$totalpaginas = ceil($totalregistros / $MAX_PAGE_SIZE);
$ULTIMA_PAGINA = ($totalpaginas * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;
if($totalregistros > 0){
?>

<table width="800px" border="0" cellpadding="2" cellspacing="2" align="center" >
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
$sql = "select u.piso, aa.idasignacion, r.prioridad,r.idrequerimiento, aa.idusuario, r.idusuario, u.nombre as nombre1, u.apellido, r.asunto, d.nombre as nombre2, r.fechacreacion from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and aa.idusuario = $idusuario and r.estado ilike 'Pendiente' and ar.reasignada = 'f' order by r.idrequerimiento desc limit $MAX_PAGE_SIZE offset $offset;";
$result = sql_query($con, $sql);
if(sql_num_rows($result) > 0){
?>
<table border="0" cellpadding="2" cellspacing="1" width="800px"
	class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="8">Mis Requerimientos Pendientes</td>
	</tr>
	<tr class="header">
		<td class="tabla-header">N&ordm; de Orden</td>
		<td class="tabla-header">Fecha de creaci&oacute;n</td>
		<td class="tabla-header">Hora de creaci&oacute;n</td>
		<td class="tabla-header">Usuario</td>
		<td class="tabla-header">Direcci&oacute;n</td>
		<td class="tabla-header">Requerimiento</td>
		<td class="tabla-header">Prioridad</td>
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
			echo "<tr class=\"dark-row2\"id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=15&idrequerimiento={$row['idrequerimiento']}$string';\">";
		}
		else{
			echo "<tr class=\"dark-row\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=15&idrequerimiento={$row['idrequerimiento']}$string';\">";
		}
		echo "<td class=\"tabla-text\" width=\"7%\" align=\"center\">{$row['idrequerimiento']}</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok($row['fechacreacion'], " ")."</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok(substr($row['fechacreacion'], 10),".")."</td>";
		echo "<td class=\"tabla-text\" width=\"15%\" align=\"center\">".$row['nombre1']." ". $row['apellido']."</td>";
		echo "<td class=\"tabla-text\" width=\"20%\" align=\"center\">{$row['nombre2']}</td>";
		echo "<td class=\"tabla-text\" width=\"28%\" align=\"center\">{$row['asunto']}</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">{$row['prioridad']}</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">{$row['piso']}</td>";
		echo "</tr>";
		$i++;
	}
		if($totalpaginas > 1){
		?>
	<tr class="header">
		<td colspan="8">
		<table width="100%" border="0">
			<tr>
				<td align="left" width="30%"><font size="1">&nbsp;
				<?if($offset != $PRIMERA_PAGINA){?>
					<a href="?modulo=administracion&accion=15&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>">[Atras]</a>
					<a href="?modulo=administracion&accion=15&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=first">[Primera]</a>
				<?}?>
				</font></td>
				<td align="center" width="40%">
					<font size="1">&nbsp;</font>
				</td>
				<td align="right"  width="30%"><font size="1">&nbsp;
					<?if($offset != $ULTIMA_PAGINA){?>
					<a href="?modulo=administracion&accion=15&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=last">[&Uacute;ltima]</a>
					<a href="?modulo=administracion&accion=15&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>">[Siguiente]</a>
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
		<td width="50%" align="center">
		<?
			$sql1 = "select aa.idasignacion from  asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and aa.idusuario = $idusuario and r.estado ilike 'Pendiente' and r.idrequerimiento = $REQUERIMIENTO_ACTUAL order by idasignacion desc";
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
		<td width="50%" align="center">
		
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
		<tr>
		<td  valign="top" colspan=2>
		<?
		if(!empty($_POST)){
			$estado = $_POST['estado'];
			//$prioridad = $_POST['prioridad'];
			$mantenimiento = $_POST['mantenimiento'];
			$diagnostico = $_POST['diagnostico'];
			$observacion = $_POST['observacion'];
			$idasignacion = $_POST['idasignacion'];
			$fechaasignacion = $_POST['fechaasignacion'];
			$mensaje = "";
			
			if($estado == "Cerrado"){
				$nivel = $_POST['nivel'];
				$solucion = $_POST['solucion'];
				
				if(empty($nivel)){
					$mensaje .= "Ingrese la soluci&oacute;n para cerrar el requerimiento<br/>";
				}
				if(empty($solucion)){
					$mensaje .= "Ingrese el nivel de la soluci&oacute;n<br/>";
				}
				if(empty($estado)){
					$mensaje .= "Indique el estado del requerimiento<br/>";
				}
				/*if(empty($prioridad)){
					$mensaje .= "Indique la prioridad del requerimiento<br/>";
				}*/
				if(empty($mantenimiento)){
					$mensaje .= "Indique el tipo de mantenimiento<br/>";
				}
				if(!empty($mensaje)){
					mensaje("No se pudo cerrar el requerimiento", $mensaje);
				}
				else{
					######################################################
					
					#**********-----***********---  pruebaaaa  ---------***********---------
					#
					#
					
					# Cerrar el requerimiento
					#  prioridad = '$prioridad', 
                    # cargar el correo del usuario sql
                    
//////////***///***//////////

					$sql_1 = " select email from usuarios  INNER JOIN requerimientos ON requerimientos.idusuario = usuarios.idusuario WHERE requerimientos.idrequerimiento= $REQUERIMIENTO_ACTUAL";
					$result_1 = sql_query($con, $sql_1);
					
					if($rs = sql_fetch_array($result_1)){
						$email = $rs['email'];
					}
					//echo  $email;
					enviarRequerimientoUsuario($solucion,$email,$nivel);
					# armas el mensaje 
					$sql = "update requerimientos set fechadiagnostico = CURRENT_TIMESTAMP, diagnostico = '$diagnostico', observacion = '$observacion', mantenimiento = '$mantenimiento', estado = '$estado' where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
					$sql2 = "INSERT INTO solucionesderequerimientos (idasignacion, fechasolucion, solucion, nivel) VALUES ($idasignacion,CURRENT_TIMESTAMP,'$solucion','$nivel');";
					sql_query($con, "begin");
					sql_query($con, $sql);
					sql_query($con, $sql2);
					sql_query($con, "commit");
					# mandar el mensaje		
											
					echo "<script>location.href='?modulo=administracion&accion=15'</script>";
					
				}
			}
			elseif($estado == "Bloqueado"){
				$nota = $_POST['nota'];
				if(empty($nota)){
					$mensaje .= "Ingrese la nota de bloqueo<br/>";
				}
				if(empty($estado)){
					$mensaje .= "Indique el estado del requerimiento<br/>";
				}
				/*if(empty($prioridad)){
					$mensaje .= "Indique la prioridad del requerimiento<br/>";
				}*/
				if(empty($mantenimiento)){
					$mensaje .= "Indique el tipo de mantenimiento<br/>";
				}
				if(!empty($mensaje)){
					mensaje("No se pudo actualizar el requerimiento", $mensaje);
				}
				else{
					######################################################
					# Bloquear el requerimiento
					# 
					
					$sql = "update requerimientos set fechadiagnostico = CURRENT_TIMESTAMP, diagnostico = '$diagnostico', observacion = '$observacion', mantenimiento = '$mantenimiento', estado = '$estado' where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
					$sql2 = "INSERT INTO requerimientosbloqueados (fechabloqueo, nota, idrequerimiento) VALUES (CURRENT_TIMESTAMP,'$nota',$REQUERIMIENTO_ACTUAL);";
					sql_query($con, "begin");
					sql_query($con, $sql);
					sql_query($con, $sql2);
					sql_query($con, "commit");
					echo "<script>location.href='?modulo=administracion&accion=15'</script>";
				}
			}
			else {
				#########################################################
				# Solo ingresar el diagnostico y actualizar los campos
				# 
				
				if(empty($diagnostico)){
					$mensaje .= "Indique el diagnostico del requerimiento<br/>";	
				}
				if(empty($estado)){
					$mensaje .= "Indique el estado del requerimiento<br/>";
				}
				/*if(empty($prioridad)){
					$mensaje .= "Indique la prioridad del requerimiento<br/>";
				}*/
				if(empty($mantenimiento)){
					$mensaje .= "Indique el tipo de mantenimiento<br/>";
				}
				if(!empty($mensaje)){
					mensaje("No se pudo actualizar el requerimiento", $mensaje);
				}
				else{
					$sql = "update requerimientos set fechadiagnostico = CURRENT_TIMESTAMP, diagnostico = '$diagnostico', observacion = '$observacion', mantenimiento = '$mantenimiento', estado = '$estado' where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
					$result = sql_query($con, $sql);
					sql_fetch_array($result);
					echo "<script>location.href='?modulo=administracion&accion=15'</script>";
				}
			}
		}
		else{
			$sql1 = "select * from requerimientos as r, asignacionesderequerimientos as ar where ar.idrequerimiento = r.idrequerimiento and r.idrequerimiento =  $REQUERIMIENTO_ACTUAL order by idasignacion desc limit 1;";
			$result1 = sql_query($con, $sql1);
			if($row1 = sql_fetch_array($result1)){
				$prioridad = $row1['prioridad'];
				$mantenimiento = $row1['mantenimiento'];
				$estado = $row1['estado'];
				$fechadeasignacion = $row1['fechaasignacion'];
				$idasignacion = $row1['idasignacion'];
				$fechaasignacion = $row1['fechaasignacion'];
				$observacion = $row1['observacion'];
				$diagnostico = $row1['diagnostico'];
			}
		}
		?>
		
		<div id="mensaje"></div>
<form name="pendiente" action="" method="POST" onsubmit="return validarPendiente();" >
<input type="hidden" name="idasignacion" value="<?echo $idasignacion?>">
<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center" class="tablas">
	<tr class="header">
		<td colspan="4" align="center">
			Detalles del Requerimiento
		</td>
	</tr>

		<tr class="dark-row">
		<td align="right">
			<b>N&ordm; de Orden:</b>
		</td>
		<td>
			<?echo $REQUERIMIENTO_ACTUAL?>
		</td>
		<td align="right">
			<b>Asignado:</b>
		</td>
		<td>
			<input type="hidden" name="fechaasignacion" value="<?echo $fechaasignacion?>">
			<?
			$fecha = $fechaasignacion;
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
			echo $tok1 ." a las ". $hora.":".$minuto.$a;
			?>
		</td>
	</tr>
	<tr class="dark-row">
		<?/*
			<td align="right">
			<b>Prioridad:</b>
		</td>
		<td>
		$prioridades = array("Baja","Normal","Urgente","Emergencia");
	  	echo "<select name='prioridad'>";
	  	echo "<option value='0'>-- asignar --</option>";
	  	foreach ($prioridades as $valor){
	  		if($valor == $prioridad){
	  			echo "<option selected>$valor</option>";
	  		}
	  		else{
	  			echo "<option >$valor</option>";
	  		}
	  		
	  	}
	  	echo "</select>";
		*/?>
		  
		</td>
		<td align="right">
			<b>Estado :</b>
		</td>
		<td>
		<select name="estado" onchange="pendienteForm(this.value);">
		  	<option value='0'>-- asignar --</option>
		  	<?
		  	$estados = array("Pendiente","Bloqueado","Cerrado");
		  	foreach ($estados as $valor){
		  		if($valor == $estado){
		  			echo "<option value=$valor selected>$valor</option>";
		  		}
		  		else{
		  			echo "<option value=$valor>$valor</option>";
		  		}
		  		
		  	}
		  	?>
		  </select>
		</td>
		<td align="right">
			<b>Mantenimiento:</b>
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
		<td align="right">
			<font color='red' size='1'>&nbsp; * &nbsp;</font><b>Diagn&oacute;stico :</b>
		</td>
		<td>
			<textarea name="diagnostico" rows="3" cols="30"><?echo $diagnostico?></textarea>
		</td>
		<td align="right">
			<b>Observaci&oacute;n:</b>
		</td>
		<td>
			<textarea name="observacion" rows="3" cols="30"><?echo $observacion?></textarea>
		</td>
	</tr>
	<tr class="dark-row">
		
		<td align="right">
			<div id="titulo"></div>
		</td>
		<td>
			<div id="campo"></div>
		</td>
		<td align="right">
			<div id="titulo2"></div>
		</td>
		<td>
			<div id="campo2"></div>
		</td>
		
	</tr>	
	<tr class="header">
		<td align="center" colspan="2">
			<input type="submit" value="Guardar" />
		</td>
		<td align="center" colspan="2">
			<input type="button" value="Imprimir" onclick="openPopUp('reporteRequerimiento.php?id=<?echo$REQUERIMIENTO_ACTUAL?>','Test','','850','350','true');" title="Imprimir los datos del requerimiento" />
		</td>
	</tr>
</table>
		

		</td>
	</tr>
	<tr>
		<td valign="top">
<!--
		<table border="0" cellpadding="2" cellspacing="1" width="400px" align="center" class="tablas">
	<tr class="header">
		<td colspan="2" align="center">
			Detalles del Usuario
		</td>
	</tr>
	<tr class="dark-row">
		<td align="right">
			<b>Usuario :</b>
		</td>
		<td>
			 Antonio Albarran Moreno
		</td>
	</tr>
	<tr class="dark-row">
		<td align="right">
			<b>Direcci&oacute;n :</b>
		</td>
		<td>
			Despacho del Ministro
		</td>
	</tr>
	
	<tr class="dark-row">
		<td align="right">
			<b>Extensi&oacute;n :</b>
		</td>
		<td>
			5247
		</td>
	</tr>
	</table>
-->
		</td>
		<td valign="top">
			
			
		
		</td>
	<tr>
	</table>

<?}else{?>
<br/>
<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/alert.gif' height='25px'></td>
		<td><font size="2px"><b>No tiene requerimientos pendientes</b></td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?}?>