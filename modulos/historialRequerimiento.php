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
$MAX_PAGE_SIZE = 10;
$REQUERIMIENTO_ACTUAL = 0;
$idusuario =  $_SESSION['usuario'];
$con = sql_connect();

$query = "select * from requerimientos where idusuario = ". $idusuario ." order by idrequerimiento desc limit 1";
$rs = sql_query($con, $query);
if($a = sql_fetch_array($rs)){
if(!empty($_GET['idrequerimiento'])){
	$REQUERIMIENTO_ACTUAL = $_GET['idrequerimiento'];
	$sql = "select * from requerimientos where idrequerimiento = " . $_GET['idrequerimiento'] ."and idusuario = ".$idusuario;
	$result = sql_query($con, $sql);
	if(!sql_num_rows($result) > 0){
		$sql = "select * from requerimientos where idusuario = ". $idusuario ." order by idrequerimiento desc limit 1";
		$result = sql_query($con, $sql);
	}
}
else {
	$sql = "select * from requerimientos where idusuario = ". $idusuario ." order by idrequerimiento desc limit 1";
	$result = sql_query($con, $sql);
}
if($row = sql_fetch_array($result)){
	$REQUERIMIENTO_ACTUAL = $row['idrequerimiento'];
?>
<table border="0" cellpadding="2" cellspacing="1" width="750px" align="center">
	<tr>
		<td valign="top">
			<!-- Detalles del requerimiento -->
			<table border="0" cellpadding="2" cellspacing="1" width="100%" align="center" class="tablas">
				<tr class="header">
					<td colspan="4" align="center">
						Detalles del Requerimiento
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right" width="50%" colspan="2">
						<b><i>Diagn&oacute;stico :</i></b>
					</td>
					<td width="50%" colspan="2">
						<?echo empty($row['diagnostico']) ? "N/A" : $row['diagnostico'] ?>
					</td>
				</tr>
				<? if(!empty($row['diagnostico'])){ ?>
				<tr class="dark-row">
					<td align="right">
						<b><i>Fecha de diagn&oacute;stico:</i></b>
					</td>
					<td>
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
						echo $tok1;

						?>
					</td>
					<td align="right">
						<b><i>Hora de diagn&oacute;stico:</i></b>
					</td>
					<td>
						<?echo  $hora.":".$minuto.$a ?>
					</td>
				</tr>
				<?}?>
				<tr class="dark-row">
					<td align="right" width="40%" colspan="2">
						<b><i>Analistas :</i></b>
					</td>
					<td width="60%" colspan="2">
						<?
							if($row['asignado'] == 'f'){
								echo "N/A";
							}
							else{
								$sql1 = "select * from asignacionesderequerimientos as a, requerimientos as r  where r.idrequerimiento= a.idrequerimiento and r.idrequerimiento = {$row['idrequerimiento']}  order by a.idasignacion desc";
								
								$result1 = sql_query($con, $sql1);
								if($row1 = sql_fetch_array($result1)){
									$idasignacion = $row1['idasignacion'];
									$sql2 = "select * from asignacion_analista as a, usuarios as u where idasignacion = {$row1['idasignacion']} and a.idusuario = u.idusuario;";
									$rs = sql_query($con, $sql2);
									$i =0;
									while($row2 = sql_fetch_array($rs)){
										if($i > 0){
											echo ", ";
										}
										echo "<a href='javascript:;' title='Ver los datos del analista'>";
										echo $row2['nombre'] ." ".$row2['apellido'];
										echo "</a>";
										$i++;
									}
								}
							}
						?>
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right" width="40%" colspan="2">
						<b><i>Mantenimiento :</i></b>
					</td>
					<td width="60%" colspan="2">
						<?echo empty($row['mantenimiento']) ? "N/A" : $row['mantenimiento']?>
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right" width="40%" colspan="2">
						<b><i>Observaci&oacute;n :</i></b>
					</td>
					<td width="60%" colspan="2">
						<?echo empty($row['observacion']) ? "N/A" : $row['observacion']?>
					</td>
				</tr>
				<tr class="dark-row">
				<?if($row['asignado']  == 't'){
					if($row['aprobado'] == false){
					?>
<?
if(isset($_POST['Aprobar'])){
	$sql ="UPDATE requerimientos set aprobado = true where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
	sql_query($con, $sql);
	echo "<script>location.href='?modulo=administracion&accion=9'</script>";
}
?>

<form action="" method="POST" onsubmit="return confirm('Usted esta conforme con la actuación del analista,\n ha realizado su requerimiento exitosamente.')">
					<td align='right' colspan="3"><b>Aprobar el Trabajo del Analista:</b></td>
					<td align='center' colspan="1">
						<input type="submit" value="Aprobar" name="Aprobar">
					</td>
</form>
					<?}
					else{
						?>
					<td align='right' colspan="4" align="center"><b></i>Usted confirm&oacute; la realizaci&oacute;n del requerimiento</b></i></td>
				<?}
				}?>
				</tr>
				<?
				if($row['estado'] == 'Bloqueado'){
				$sql_1 = "select* from requerimientosbloqueados where idrequerimiento = $REQUERIMIENTO_ACTUAL;";

				$rs_1 = sql_query($con, $sql_1);
				if($a = sql_fetch_array($rs_1)){
					?>
					<tr class="dark-row">
					<td align="right" width="40%" colspan="2">
						<b><i>Nota de Bloqueo:</i></b>
					</td>
					<td width="60%" colspan="2">
						<?echo $a['nota'] ?>
					</td>
					<tr class="dark-row">
					<td align="right">
						<b><i>Fecha de Bloqueo:</i></b>
					</td>
					<td>
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
						echo $tok1;
						?>
					</td>
					<td align="right">
						<b><i>Hora de Bloqueo:</i></b>
					</td>
					<td>
						 <? echo $hora.":".$minuto.$ap ?>
					</td>
				
				</tr>
				<?}
				}
				elseif($row['estado'] == 'Cerrado'){
					$sql_2 = "select * from solucionesderequerimientos where idasignacion = $idasignacion";
					$rs_2 = sql_query($con, $sql_2);
					if($a = sql_fetch_array($rs_2)){
				?>
					<tr class="dark-row">
					<td align="right" width="40%" colspan="2"> 
						<b><i>Soluci&oacute;n :</i></b>
					</td>
					<td width="60%" colspan="2">
						<?echo $a['solucion'] ?>
					</td>
				</tr>
				<tr class="dark-row">
					<td align="right">
						<b><i>Fecha:</i></b>
					</td>
					<td>
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
						echo $tok1;
						?>
					</td>
					<td align="right">
						<b><i>Hora:</i></b>
					</td>
					<td>
						<? echo $hora.":".$minuto.$ap ?>
					</td>
				</tr>
				
				<?
					}
				}
				elseif($row['estado'] == 'Anulado'){?>
					<tr class="dark-row">
					<td align="right" width="40%" colspan="2">
						<b><i>Nota de Anulaci&oacute;n:</i></b>
					</td>
					<td width="60%" colspan="2">
						<?
						$query = "select nota from requerimientosanulados where idrequerimiento = $REQUERIMIENTO_ACTUAL;";
						$rs = sql_query($con, $query);
						if($row1 = sql_fetch_array($rs)){
							echo $row1['nota'];
						}
						?>
					</td>
				</tr>
				<?}?>
			</table>
			<?}?>
		</td>
		<td valign="top" align="right">
			<!-- Busqueda -->
			<form action="" method="POST">
				<table border="0" cellpadding="2" cellspacing="1" width="100%"
						class="tablas" align="right">
						<tr class="header">
							<td align="center" colspan="2">B&uacute;squeda</td>
						</tr>
						<tr class="dark-row">
							<td class="tabla-text" width="40%" align="right"><b>Requerimiento</b></td>
							<td class="tabla-text" width="60%" align="left"><input type="text" name="requerimiento"></td>
						</tr>
						<tr class="dark-row">
							<td class="tabla-text" width="40%" align="right"><b>Fecha desde</b></td>
							<td class="tabla-text" width="60%" align="left">
							
							<input type="text" id="fecha2" name="fecha2" size="10" value="" readonly="readonly" />
						    &nbsp;&nbsp;<button id="boton2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
						    <script type="text/javascript">//<![CDATA[
						      Zapatec.Calendar.setup({
						        firstDay          : 1,
						        weekNumbers       : true,
						        showOthers        : false,
						        showsTime         : false,
						        timeFormat        : "24",
						        step              : 2,
						        range             : [1900.01, 2999.12],
						        electric          : false,
						        singleClick       : true,
						        inputField        : "fecha2",
						        button            : "boton2",
						        ifFormat          : "%Y-%m-%d",
						        daFormat          : "%Y-%m-%d",
						        align             : "BC"
						      });
						    //]]></script>
								<noscript>
								<br/>
								Para visualizar el calendario <br/> su navegador debe soportar javascript
								</noscript>
							
							</td>
						</tr>
						<tr class="dark-row">
							<td class="tabla-text" width="40%" align="right"><b>Fecha hasta</b></td>
							<td class="tabla-text" width="60%" align="left">
							<input type="text" id="fecha1" name="fecha1" size="10" value="" readonly="readonly" />
						    &nbsp;&nbsp;<button id="boton1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
						    <script type="text/javascript">//<![CDATA[
						      Zapatec.Calendar.setup({
						        firstDay          : 1,
						        weekNumbers       : true,
						        showOthers        : false,
						        showsTime         : false,
						        timeFormat        : "24",
						        step              : 2,
						        range             : [1900.01, 2999.12],
						        electric          : false,
						        singleClick       : true,
						        inputField        : "fecha1",
						        button            : "boton1",
						        ifFormat          : "%Y-%m-%d",
						        daFormat          : "%Y-%m-%d",
						        align             : "BC"
						      });
						    //]]></script>
						<noscript>
						<br/>
						Para visualizar el calendario<br/> su navegador debe soportar javascript
						</noscript>
							
							</td>
						</tr>
						<tr class="dark-row">
							<td class="tabla-text" width="40%" align="right"><b>Estado</b></td>
							<td class="tabla-text" width="60%" align="left">
								<select name="estado">
									<option>Todos</option>
									<option>Nuevo</option>
									<option>Pendiente</option>
									<option>Cerrado</option>
									<option>Bloqueado</option>
									<option>Anulado</option>
								</select>
							</td>
						</tr>
						<tr class="dark-row">
							<td class="tabla-text" width="40%" align="right"><b>Tipo</b></td>
							<td class="tabla-text" width="60%" align="left">
								<select name="tipo">
									<option>Todos</option>
									<?
									$sql = "select * from tiposderequerimientos";
									$result = sql_query($con,$sql);
									while($row = sql_fetch_array($result)){
										echo "<option value='".$row['idtiporequerimiento']."'>".$row['tipoderequerimiento']."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr class="header">
							<td align="center" colspan="2">
								<input type="submit" value="BUSCAR">
							</td>
						</tr>
				</table>
				</form>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<!-- Lista -->
			<?
			if(!empty ($_POST)) {
				$requerimiento = $_POST['requerimiento'];
				$fecha2 = $_POST['fecha2'];
				$fecha1 = $_POST['fecha1'];
				$tipo = $_POST['tipo'];
				$estado = $_POST['estado'];
				$sqladd ="";
				if(!empty($requerimiento)){
					$sqladd .= " and asunto ilike '%$requerimiento%' ";
				}
				if($tipo != 0){
					$sqladd .= " and idtiporequerimiento = $tipo ";
				}
				if($estado != 'Todos'){
					$sqladd .= " and estado ilike '%$estado%' ";
				}
				if(!empty($fecha1) && !empty($fecha2)){
					$sqladd .= " and (fechacreacion between '%".$fecha1." 00:00:00.000000%' and '%".$fecha2." 23:59:59.999999%')";
				}
				elseif(!empty($fecha1)){
					$sqladd .= " and fechacreacion between '%".$fecha1." 00:00:00.000000%' and '%".$fecha1." 23:59:59.999999%'";
				}
				elseif(!empty($fecha2)){
					$sqladd .= " and fechacreacion between '%".$fecha2." 00:00:00.000000%' and '%".$fecha2." 23:59:59.999999%'";
				}
			}
			
			$offset = 0;
			$PRIMERA_PAGINA = 0;
			$sql = "select count(*) from requerimientos where idusuario = " .$idusuario . " " .$sqladd;
			$result = sql_query($con, $sql);
			$row = sql_fetch_array($result);
			$totalregistros =  $row['0'];
			$totalpaginas = ceil($totalregistros / $MAX_PAGE_SIZE);
			$ULTIMA_PAGINA = ($totalpaginas * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;
			if(!empty($_GET['pag'])){
				$pagina = $_GET['pag'];
			}
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
			
			$sql = "select * from requerimientos where idusuario = " .$idusuario . " " .$sqladd. " order by idrequerimiento desc  limit $MAX_PAGE_SIZE offset $offset; ";
			$result = sql_query($con, $sql);
			$count = sql_num_rows($result);
			?>
			<table border="0" cellpadding="2" cellspacing="1" width="755px"
				class="tablas" align="center">
				<tr class="header">
					<td align="center" colspan="5">Historial de Requerimientos</td>
				</tr>
				<tr class="header">
					<td class="tabla-header">N&ordm; de Orden</td>
					<td class="tabla-header">Fecha de creaci&oacute;n</td>
					<td class="tabla-header">Estado</td>
					<td class="tabla-header">Tipo</td>
					<td class="tabla-header">Requerimiento</td>
				</tr>
				<?
					if ($count <= 0) {?>
					<tr class="dark-row" id="efecto"onclick="javascript:location.href='?modulo=administracion&accion=10&idrequerimiento=".$row['idrequerimiento'].$string."';">
						<td colspan='5' align='center'><b>No se encontraron requerimientos</b></td>
					</tr>
					<?}else{
						while ($row = sql_fetch_array($result)){
							if($row['idrequerimiento'] != $_GET['idrequerimiento']){
								echo "<tr class=\"dark-row\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=9&idrequerimiento={$row['idrequerimiento']}';\">";
							}
							else{
								echo "<tr class=\"dark-row2\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=9&idrequerimiento={$row['idrequerimiento']}';\">";
							}
							
							echo "<td class=\"tabla-text\" width=\"10%\" align= \"center\">".$row['idrequerimiento']."</td>";
							echo "<td class=\"tabla-text\" width=\"10%\" align= \"center\">".strtok($row['fechacreacion']," ")."</td>";
							echo "<td class=\"tabla-text\" width=\"15%\" align= \"center\">".$row['estado']."</td>";
							$result1 = sql_query($con,"select tipoderequerimiento from tiposderequerimientos where idtiporequerimiento = " .$row['idtiporequerimiento']);
							$row1 = sql_fetch_array($result1);
							echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".$row1['tipoderequerimiento']."</td>";
							echo "<td class=\"tabla-text\" width=\"55%\">".$row['asunto']."</td>";
							echo "</tr>";
						}
					}
					if($totalpaginas > 1){
					?>
				<tr class="header">
					<td colspan="5">
					<table width="100%" border="0">
						<tr>
							<td align="left" width="30%"><font size="1">&nbsp;
							<?if($offset != $PRIMERA_PAGINA){?>
								<a href="?modulo=administracion&accion=9&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>&pag=<?echo $pagina-1?>""><img src='styles/<?echo $_SESSION['tema']?>/atras.gif' border=0 alt='[Atras]' title='Atras'></a>
								<a href="?modulo=administracion&accion=9&action=first&pag=1"><img src='styles/<?echo $_SESSION['tema']?>/primera.gif' border=0 alt='[Primera]' title='Primera'></a>
							<?}?>
							</font></td>
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
									echo "&nbsp;<a class=\"paginacion\" href=\"?modulo=administracion&accion=9&idrequerimiento=$REQUERIMIENTO_ACTUAL&action=next&offset=".(($MAX_PAGE_SIZE * $i)-$MAX_PAGE_SIZE)."&pag=$i\">$i</a>";
								}
								else{
									echo ("<font size=1 color='black'><b>&nbsp;$i</b></font>");
								}
							}
						}
						else{
							for($i =1; $i <= $totalpaginas; $i++){
								if($pagina != $i){
									echo "&nbsp;<a class=\"paginacion\" href=\"?modulo=administracion&accion=9&idrequerimiento=$REQUERIMIENTO_ACTUAL&action=next&offset=".(($MAX_PAGE_SIZE * $i)-$MAX_PAGE_SIZE)."&pag=$i\">$i</a>";
								}
								else{
									echo("<font size=1 color='black'><b>&nbsp;$i</b></font>");
								}
							}
						}
						
						?>

							</td>
							<td align="right"  width="30%"><font size="1">&nbsp;
							<?if($offset != $ULTIMA_PAGINA){?>
								<a href="?modulo=administracion&accion=9&action=last&pag=<?echo $totalpaginas?>"><img src='styles/<?echo $_SESSION['tema']?>/ultima.gif' border=0 alt='[&Uacute;ltima]' title='&Uacute;ltima'></a>
								<a href="?modulo=administracion&accion=9&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>&pag=<?echo $pagina+1?>"><img src='styles/<?echo $_SESSION['tema']?>/siguiente.gif' border=0 alt='[Siguiente]' title='Siguiente'></a>
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

<?}else{?>
<br/>
<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/alert.gif' height='25px'></td>
		<td><font size="2px"><b>Su historial de requerimientos esta vacio</b></td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?}?>
<?sql_disconnect() ?>