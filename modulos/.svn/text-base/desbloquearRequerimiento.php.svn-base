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
$sql = "select count(*) from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and r.estado ilike 'Bloqueado' and ar.reasignada = 'f'";
$result = sql_query($con, $sql);
if($row = sql_fetch_array($result)){
	$totalregistros =  $row['count'];
}
$totalpaginas = ceil($totalregistros / $MAX_PAGE_SIZE);
$ULTIMA_PAGINA = ($totalpaginas * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;

if($totalregistros > 0){
?>

<table width="810px" border="0" align="center" >
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
$sql = "select aa.idasignacion, r.idrequerimiento, aa.idusuario, r.idusuario, u.nombre as nombre1, u.apellido, r.asunto, d.nombre as nombre2, r.fechacreacion from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and r.estado ilike 'Bloqueado' and ar.reasignada = 'f' order by r.idrequerimiento desc limit $MAX_PAGE_SIZE offset $offset;";
$result = sql_query($con, $sql);
if(sql_num_rows($result) > 0){
?>
<table border="0" cellpadding="2" cellspacing="1" width="810px"
	class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="7">Requerimientos bloqueados</td>
	</tr>
	<tr class="header">
		<td class="tabla-header">N&ordm; de Orden</td>
		<td class="tabla-header">Fecha  de creaci&oacute;n</td>
		<td class="tabla-header">Hora  de creaci&oacute;n</td>
		<td class="tabla-header">Usuario</td>
		<td class="tabla-header">Direcci&oacute;n</td>
		<td class="tabla-header">Requerimiento</td>
		<td class="tabla-header">&nbsp;</td>
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
			echo "<tr title=\"Desbloquear Requerimiento {$row['idrequerimiento']}\" class=\"dark-row2\"id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=12&idrequerimiento={$row['idrequerimiento']}$string';\">";
		}
		else{
			echo "<tr title=\"Desbloquear Requerimiento {$row['idrequerimiento']}\" class=\"dark-row\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=12&idrequerimiento={$row['idrequerimiento']}$string';\">";
		}
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">{$row['idrequerimiento']}</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok($row['fechacreacion'], " ")."</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok(substr($row['fechacreacion'], 10),".")."</td>";
		echo "<td class=\"tabla-text\" width=\"15%\" align=\"center\">".$row['nombre1']." ". $row['apellido']."</td>";
		echo "<td class=\"tabla-text\" width=\"25%\" align=\"center\">{$row['nombre2']}</td>";
		echo "<td class=\"tabla-text\" width=\"30%\" align=\"center\">{$row['asunto']}</td>";
		if($row['idrequerimiento'] == $REQUERIMIENTO_ACTUAL){
			echo "<td><img src=\"images/open.gif\" height=\"20px\" name=\"boton1\"></td>";
		}
		else{
			echo "<td><img src=\"images/close.gif\" height=\"20px\" name=\"boton1\"></td>";
		}
		
		echo "</tr>";
		$i++;
	}
		if($totalpaginas > 1){
		?>
	<tr class="header">
		<td colspan="7">
		
		<table width="100%" border="0">
			<tr>
				<td align="left" width="30%">&nbsp;
				<?if($offset != $PRIMERA_PAGINA){?>
					<a class="paginacion" href="?modulo=administracion&accion=12&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>&pag=<?echo $pagina-1?>"><img src='styles/<?echo $_SESSION['tema']?>/atras.gif' border=0 alt='[Atras]' title='Atras'></a>
					<a class="paginacion" href="?modulo=administracion&accion=12&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=first&pag=<?echo 1?>"><img src='styles/<?echo $_SESSION['tema']?>/primera.gif' border=0 alt='[Primera]' title='Primera'></a>
				<?}?>
				</td>
				<td align="center" width="40%">
					<?
						if($totalpaginas > 5){
							$inicio = $pagina-2;
							$fin = $pagina+2;
							
							if($inicio < 1){
								if($inicio == 0 || $inicio == -1){
									$inicio = 1;
									$fin +=2;
								}
								else{
									$inicio = 2;
									$fin +=2;
								}
								
							}
							if($fin > $totalpaginas){
								$fin = $totalpaginas;
								$inicio -=2;
							}
							for($i = $inicio; $i <= $fin; $i++){
								if($pagina != $i){
									echo "&nbsp;<a class=\"paginacion\" href=\"?modulo=administracion&accion=12&idrequerimiento=$REQUERIMIENTO_ACTUAL&action=next&offset=".(($MAX_PAGE_SIZE * $i)-$MAX_PAGE_SIZE)."&pag=$i\">$i</a>";
								}
								else{
									echo ("<font size=1 color='black'><b>&nbsp;$i</b></font>");
								}
							}
						}
						else{
							for($i =1; $i <= $totalpaginas; $i++){
								if($pagina != $i){
									echo "&nbsp;<a class=\"paginacion\" href=\"?modulo=administracion&accion=12&idrequerimiento=$REQUERIMIENTO_ACTUAL&action=next&offset=".(($MAX_PAGE_SIZE * $i)-$MAX_PAGE_SIZE)."&pag=$i\">$i</a>";
								}
								else{
									echo("<font size=1 color='black'><b>&nbsp;$i</b></font>");
								}
							}
						}
						
						?>
				
				
					<font size="1">&nbsp;</font>
				</td>
				<td align="right"  width="30%">&nbsp;
					<?if($offset != $ULTIMA_PAGINA){?>
					<a class="paginacion" href="?modulo=administracion&accion=12&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=last&pag=<?echo $totalpaginas?>"><img src='styles/<?echo $_SESSION['tema']?>/ultima.gif' border=0 alt='[&Uacute;ltima]' title='&Uacute;ltima'></a>
					<a class="paginacion" href="?modulo=administracion&accion=12&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>&pag=<?echo $pagina+1?>"><img src='styles/<?echo $_SESSION['tema']?>/siguiente.gif' border=0 alt='[Siguiente]' title='Siguiente'></a>
					<?}?>
				</td>
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
</table>

<?
if(isset($_POST['desbloquear'])){
	$sql_1 = "update requerimientos set estado = 'Pendiente' where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
	$sql_2 = "update requerimientosbloqueados set fechadesbloqueo = CURRENT_TIMESTAMP where idrequerimiento = $REQUERIMIENTO_ACTUAL;"; 
	sql_query($con, "begin");
	sql_query($con, $sql_1);
	sql_query($con, $sql_2);
	sql_query($con, "commit");
	echo "<script>location.href='?modulo=administracion&accion=12'</script>";
}
$sql = "select r.idrequerimiento, r.fechacreacion, r.asunto, r.diagnostico, t.tipoderequerimiento, r.mantenimiento, r.observacion, r.mantenimiento, b.nota, b.fechabloqueo from requerimientos as r,requerimientosbloqueados as b, tiposderequerimientos as t where r.idrequerimiento = b.idrequerimiento and r.idtiporequerimiento = t.idtiporequerimiento and r.idrequerimiento = $REQUERIMIENTO_ACTUAL order by b.idrequerimientobloqueado desc";
$result =@sql_query($con,$sql);
if($row = @sql_fetch_array($result)){
	
?>
<form action="" method="POST" onsubmit="return confirm('Ha eligido desbloquear este requerimiento')">
<input type="hidden" name="desbloquear" value="true">
<table border="0" cellpadding="2" cellspacing="1" width="810px"	class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="6">Detalles del requerimiento bloqueado</td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" width="15%" align='right'><b<i>N&uacute;mero:</i></b></td>
		<td class="tabla-text" width="10%" align='center'><?echo $REQUERIMIENTO_ACTUAL; ?></td>
		<td class="tabla-text" width="20%" align='right'><b<i>Fecha del requerimiento:</i></b></td>
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
		?>
		</td>
		<td class="tabla-text" width="20%"align='right'><b<i>Hora del requerimiento:</i></b></td>
		<td class="tabla-text" width="15%" align='center'><?echo $hora.":".$minuto." ".$a?></td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" align='right'><b<i>Requerimiento:</i></b></td>
		<td class="tabla-text" colspan="3" align='left'><?echo $row['asunto']; ?> </td>
		<td class="tabla-text" align='right'><b<i>Mantenimiento:</i></b></td>
		<td class="tabla-text" colspan="3" align='center'><?echo $row['mantenimiento']; ?> </td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" align='right'><b<i>Analista asignado:</i></b></td>
		<td class="tabla-text" colspan="3" align='left'>
		<?
		$sql_1 ="select idasignacion from departamentos as d, requerimientos as r, tiposderequerimientos as tr, usuarios as u, asignacionesderequerimientos as ar where r.idusuario = u.idusuario  and u.iddepartamento = d.iddepartamento and tr.idtiporequerimiento = r.idtiporequerimiento and ar.idrequerimiento = r.idrequerimiento and r.idrequerimiento = {$REQUERIMIENTO_ACTUAL} order by idasignacion desc";
			$result_1 = sql_query($con, $sql_1);
			if($row_1 = sql_fetch_array($result_1)){
				$idasignacion_analista = $row_1['idasignacion'];
			}
		$sql2 = "select u.nombre,  u.apellido from asignacion_analista as aa, usuarios as u  where aa.idusuario = u.idusuario and aa.idasignacion = $idasignacion_analista";
		$result2 = @sql_query($con, $sql2);
		$i = 0;
		while($row2 = @sql_fetch_array($result2)){
			if($i > 0){
				echo ", ";
			}
			echo $row2['nombre']." ". $row2['apellido'];
			$i++;
		}
		$analistas = "";
		?>
		</td>
		<td class="tabla-text" align='right'><b<i>Tipo de requerimiento:</i></b></td>
		<td class="tabla-text" align='center'><?echo $row['tipoderequerimiento']; ?></td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" align='right'><b<i>Diagnostico:</i></b></td>
		<td class="tabla-text" colspan="5" align='left'> <?echo $row['diagnostico']; ?></td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" align='right'><b<i>Observaci&oacute;n:</i></b></td>
		<td class="tabla-text" colspan="5" align='left'> <?echo $row['observacion']; ?></td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" align='right'><b<i>Nota de bloqueo:</i></b></td>
		<td class="tabla-text" colspan="5" align='left'><?echo $row['nota']; ?> </td>
	</tr>
	<tr class="dark-row">
		<td class="tabla-text" align='right' colspan="2"><b<i>Fecha de bloqueo:</i></b></td>
		<td class="tabla-text" align='center'>
		<?
		$fecha = $row['fechabloqueo'];
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
		?>
		</td>
		<td class="tabla-text" align='right' colspan="2"><b<i>Hora de bloqueo:</i></b></td>
		<td class="tabla-text" align='center'> <?echo $hora.":".$minuto." ".$a?></td>
	</tr>
	<tr class="header">
		<td colspan="6" align="center" class="tabla-text" valign="top">
			<input type='submit' value='Desbloquear' title="Desbloquear el requerimiento">
		</td>
	</tr>
</table>
</form>
<?}
}else {
	?>
<br/>
<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/alert.gif' height='25px'></td>
		<td><font size="2px"><b>No hay requerimientos bloqueados</b></td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?
}
sql_disconnect();
?>