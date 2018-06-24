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
?>
<form action="?modulo=administracion&accion=19" method="POST" onsubmit="return validarBusqueda()" name="busquedaForm">
	<input type="hidden" name="auditar" value="1">
	<table border="0" cellpadding="2" cellspacing="1" width="100%"	class="tablas" align="center">
		<tr class="header">
			<td class="tabla-header" align="center" colspan="8"><img height="18px" align="left" src="images/buscar.gif">B&uacute;squeda de Requerimientos</td>
		</tr>
		<tr class="dark-row">
			<td class="tabla-text" align="right"><b>Mantenimiento</b></td>
			<td class="tabla-text">
				<select name="mantenimiento">
					<option value="0">--------Todos-------</option>
					<option>Preventivo</option>
					<option>Correctivo</option>
				</select>
			</td>
			<td class="tabla-text" align="right"><b>Estado</b></td>
			<td class="tabla-text">
				<select name="estado">
					<option value="0">--------Todos-------</option>
					<option>Nuevo</option>
					<option>Pendiente</option>
					<option>Cerrado</option>
					<option>Bloqueado</option>
				</select>
			</td>
			<td class="tabla-text" align="right"><b>Prioridad</b></td>
			<td class="tabla-text">
				<select name="prioridad">
					<option value="0">--------Todos-------</option>
					<option>Baja</option>
					<option>Normal</option>
					<option>Urgente</option>
					<option>Emergencia</option>
				</select>
			</td>
		</tr>
		<tr class="dark-row">
			<td class="tabla-text" align="right"><b>N&ordm; de  Orden</b></td>
			<td class="tabla-text">
				<input type="text" name="idrequerimiento" value="" size="18" maxlength="4">
			</td>
			<td class="tabla-text" align="right"><b>Fecha desde</b></td>
			<td class="tabla-text">
			
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
			<td class="tabla-text" align="right"><b>Fecha hasta</b></td>
			<td class="tabla-text">
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
		<tr class="dark-row">
			<td class="tabla-text" align="right"><b>Direcci&oacute;n</b></td>
			<td class="tabla-text" colspan=6>
				<?
				$con =  sql_connect();
	echo "<select name='departamento'>";
	$a = sql_query($con, "SELECT * FROM departamentos order by nombre");
	if (sql_num_rows($a) == 0) {
		echo "<option value=0>No hay direcciones</option>";
	} else {
		echo "<option value=0>Seleccione una direcci&oacute;n</option>";
		while ($b = sql_fetch_array($a)) {
			echo "<option value=".$b['iddepartamento']." ". (($b['iddepartamento'] == $departamento) ? "selected" : "").">".htmlspecialchars($b['nombre'])."</option>";
		}
		echo "</select>";
	}
				?>
			</td>
		</tr>
		<tr class="header">
			<td align="center" colspan="9">
				<input type="submit" value="BUSCAR">
			</td>
		</tr>
</table>
</form>
<?
session_start();
$idusuario = $_SESSION['usuario'];

$MAX_PAGE_SIZE = 10;
$con = sql_connect();

$offset = 0;
$pagina = 1;
$PRIMERA_PAGINA = 0;
#################################################################################################################
# uso los datos del formulario para construir el query
#################################################################################################################

$sql_c = "select count(*) from usuarios as u, departamentos as d,asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa " .
	"where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento  and ar.reasignada = 'f' and aa.idusuario = $idusuario";

$sql = "select r.asunto, r.mantenimiento, r.asignado, r.prioridad, r.estado, r.idrequerimiento, r.idusuario, u.nombre as nombre1, u.apellido, r.asunto, d.nombre as nombre2, d.iniciales, r.fechacreacion from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa " .
	"where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento  and ar.reasignada = 'f' and aa.idusuario = $idusuario ";

if(!empty($_POST['auditar'])){
	$_SESSION['FECHA2'] = NULL;
	$_SESSION['FECHA1'] = NULL;
	$estado = $_POST['estado'];
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	$direccion = $_POST['departamento'];
	$mantenimiento = $_POST['mantenimiento'];
	$prioridad = $_POST['prioridad'];
	$idrequerimiento = $_POST['idrequerimiento'];
	
	if(!empty($idrequerimiento)){
		$query .= "and r.idrequerimiento = $idrequerimiento";
	}
	if(!empty($prioridad)){
		$query .= "and r.prioridad ilike '%$prioridad%'";
	}
	if(!empty($_POST['estado'])){
		$query .= "and r.estado ilike '%{$_POST['estado']}%'";
	}
	if(!empty($mantenimiento)){
		$query .= "and r.mantenimiento ilike '%$mantenimiento%'";
	}
	
	if(!empty($_POST['fecha2']) && !empty($_POST['fecha1'])){
		$_SESSION['FECHA2'] = $_POST['fecha2'];
		$_SESSION['FECHA1'] = $_POST['fecha1'];
		$query .= "and (fechacreacion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
	}
	elseif(!empty($_POST['fecha2'])){
		$_SESSION['FECHA2'] = $_POST['fecha2'];
		$query .= "and (fechacreacion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha2']} 23:59:59.999999%' )";
	}
	elseif(!empty($_POST['fecha1'])){
		$_SESSION['FECHA1'] = $_POST['fecha1'];
		$query .= "and (fechacreacion between '%{$_POST['fecha1']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
	}
	if(!empty($_POST['departamento'])){
		$query .= "and d.iddepartamento = {$_POST['departamento']}";
	}
	
	$sql = $sql.$query;
	$sql_c = $sql_c.$query;
	
	$_SESSION['SQL1'] = $sql_c;
	$_SESSION['SQL2'] = $sql;
	$_SESSION['QUERY'] = $query;
}

//Guardo el sql generado en la session
if(!empty($_SESSION['SQL1'])){
	$sql_c = $_SESSION['SQL1'];
}

$result = sql_query($con, $sql_c);

$row = sql_fetch_array($result);
$totalregistros =  $row['0'];
$totalpaginas = ceil($totalregistros / $MAX_PAGE_SIZE);
$ULTIMA_PAGINA = ($totalpaginas * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;
if($totalregistros > 0){
?>
<table width="800px" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td align="left" >
			<a class="download" href='reportes/historial.php' target="_black">Descargar reporte en pdf</a>
		</td>
		<td align="right"><font class="texto1">Total encontrados = <?echo $totalregistros ?></font></td>
	</tr>
</table>
<table width="100%" border="0" align="center" >
	<tr>
		<td colspan="2">
<?
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

if(!empty($_SESSION['SQL2'])){
	$sql = $_SESSION['SQL2'];
}

$result = sql_query($con, $sql." order by r.idrequerimiento desc  limit $MAX_PAGE_SIZE offset $offset");


if(sql_num_rows($result) > 0){
?>
<table border="0" cellpadding="2" cellspacing="1" width="800px"
	class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="8">Lista de Requerimientos</td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="5%">N&ordm; de Orden</td>
		<td class="tabla-header" width="10%">Fecha de creaci&oacute;n</td>
		<td class="tabla-header" width="10%">Hora de creaci&oacute;n</td>
		<td class="tabla-header" width="15%">Usuario</td>
		<td class="tabla-header" width="8%">Direcci&oacute;n</td>
		<td class="tabla-header" width="*">Requerimiento</td>
		<td class="tabla-header" width="8%">Prioridad</td>
		<td class="tabla-header" width="8%">Estado</td>
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
		echo "<tr class=\"dark-row\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=17&idrequerimiento={$row['idrequerimiento']}&a={$row['asignado']}$string&analista=true';\">";
		echo "<td class=\"tabla-text\" width=\"7%\" align=\"center\">{$row['idrequerimiento']}</td>";
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
		
		echo "<td class=\"tabla-text\" align=\"center\">$tok1</td>";
		
		echo "<td class=\"tabla-text\" align=\"center\">$hora:$minuto $a</td>";
		echo "<td class=\"tabla-text\" align=\"center\">".$row['nombre1']." ". $row['apellido']."</td>";
		echo "<td class=\"tabla-text\" align=\"center\" title='{$row['nombre2']}'>{$row['iniciales']}</td>";
		echo "<td class=\"tabla-text\" align=\"center\">{$row['asunto']}</td>";
		echo "<td class=\"tabla-text\" align=\"center\" title='".($row['prioridad'] == "" ? "Requerimiento no asignado" : "Prioridad ".$row['prioridad'])."'>".($row['prioridad'] == "" ? "N/A" : $row['prioridad'])."</td>";
		echo "<td class=\"tabla-text\" align=\"center\">{$row['estado']}</td>";
		echo "</tr>";
		$i++;
	}
		if($totalpaginas > 1){
		?>
	<tr class="header">
		<td colspan="8">
		<table width="100%" border="0">
			<tr>
				<td align="left" width="30%">&nbsp;
				<?if($offset != $PRIMERA_PAGINA){?>
					<a class="paginacion" href="?modulo=administracion&accion=19&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>&pag=<?echo $pagina-1?>"><img src='styles/<?echo $_SESSION['tema']?>/atras.gif' border=0 alt='[Atras]' title='Atras'></a>
					<a class="paginacion" href="?modulo=administracion&accion=19&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=first&pag=<?echo 1?>"><img src='styles/<?echo $_SESSION['tema']?>/primera.gif' border=0 alt='[Primera]' title='Primera'></a>
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
									echo "&nbsp;<a class=\"paginacion\" href=\"?modulo=administracion&accion=19&idrequerimiento=$REQUERIMIENTO_ACTUAL&action=next&offset=".(($MAX_PAGE_SIZE * $i)-$MAX_PAGE_SIZE)."&pag=$i\">$i</a>";
								}
								else{
									echo ("<font size=1 color='black'><b>&nbsp;$i</b></font>");
								}
							}
						}
						else{
							for($i =1; $i <= $totalpaginas; $i++){
								if($pagina != $i){
									echo "&nbsp;<a class=\"paginacion\" href=\"?modulo=administracion&accion=19&idrequerimiento=$REQUERIMIENTO_ACTUAL&action=next&offset=".(($MAX_PAGE_SIZE * $i)-$MAX_PAGE_SIZE)."&pag=$i\">$i</a>";
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
					<a class="paginacion" href="?modulo=administracion&accion=19&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=last&pag=<?echo $totalpaginas?>"><img src='styles/<?echo $_SESSION['tema']?>/ultima.gif' border=0 alt='[&Uacute;ltima]' title='&Uacute;ltima'></a>
					<a class="paginacion" href="?modulo=administracion&accion=19&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>&pag=<?echo $pagina+1?>"><img src='styles/<?echo $_SESSION['tema']?>/siguiente.gif' border=0 alt='[Siguiente]' title='Siguiente'></a>
					<?}?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<?}?>
</table>
<? 
}
}else{?>
	<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/info.gif' height='25px'></td>
		<td><font size="2px"><b>La búsqueda no encontro ningun resultado</b></td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?}?>