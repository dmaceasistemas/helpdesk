<?
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  2.0                                                                #
# Date:     10-12-2008                                                         #
# Author:   Marco Lopez                                                        #
# License:                                                                     #
# Note:                                                                        #
# Company:  Ministerio de Agriculura y Tierras                                 #
# Web:      www.mat.gob.ve                                                     #
################################################################################

session_start();
$con = sql_connect();
$idusuario =  $_SESSION['usuario'];
?>

<script type="text/javascript">
	function prueba(texto1,texto2){
		alert(texto1);
		alert(texto2);
	}
</script>


<form action="?modulo=administracion&accion=26" method="POST" name="reporteForm">
	<input type="hidden" name="auditar" value="1">
	<input type="hidden" name="filtro" value="0">
	<table border="0" cellpadding="2" cellspacing="1" width="800px"	class="tablas" align="center">
		<tr class="header">
			<td class="tabla-header" align="center" colspan="8"><img height="18px" align="left" src="images/buscar.png">Reportes de Mantenimientos</td>
		</tr>
		<tr class="dark-row">
			<td class="tabla-text" align="right" ><b>Reporte De:</b></td>
			<td class="tabla-text">
				<select name="tipo">
					<option value=1>Analistas</option>
					<option value=2>Coordinaciones</option>
					<option value=3>Direcciones</option>
				</select>
			</td>
			
			<td class="tabla-text" colspan="2" align="center">
				<a class="download" href='javascript:;' onclick="filtrarBusqueda()" title=''>Filtrar b&uacute;squeda</a>
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
		<tr class="header">
			<td align="center" colspan="8">
				<input type="submit" name="buscar" value="BUSCAR"><!-- onclick="alert(document.reporteForm.analistas.value)"  -->
				<input type="hidden" name="id" value=""/>
				<input type="hidden" name="preventivo" value=""/>
			</td>
		</tr>
</table>





<?

$total = 0;
$total_preventivo = 0;
$total_correctivo = 0;

if ($_GET['preventivo']=='0'||$_GET['preventivo']=='1'){
	

		
		
		
		
		
		if(!empty($_POST['tipo'])){
		$tipo = $_POST['tipo'];
	}

	if(!empty($_POST['fecha2']) && !empty($_POST['fecha1'])){
		$fecha = " and (fechasolucion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
		$titulofecha = "de la fecha {$_POST['fecha2']} hasta la fecha {$_POST['fecha1']}";
	}
	elseif(!empty($_POST['fecha2'])){
		$fecha = " and (fechasolucion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha2']} 23:59:59.999999%' )";
		$titulofecha = "de la fecha {$_POST['fecha2']}";
	}
	elseif(!empty($_POST['fecha1'])){
		$fecha = " and (fechasolucion between '%{$_POST['fecha1']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
		$titulofecha = "de la fecha {$_POST['fecha1']}";
	}
	if(!empty($_POST['filtro'])){
		$multiple = strpos($_POST['filtro'], ",");
		
		if($multiple == true){
			
			if(substr_count($_POST['filtro'], ',') > 0){
				$tok =  strtok($_POST['filtro'], ',');
				$query =  "  (";
					$i =0;
					while ($tok !== false) {
						if($i > 0){
							$query .= " OR ";
						}
						$query .= " u.idusuario = ". trim($tok) ;
					    $tok = strtok(",");
					    $i++;
					}
					
				}
			
			$query .= " ) ";
		}
		else{
			$query = " u.idusuario = {$_POST['filtro']}";
		}
	}
	else {
		$query = "(u.idtipousuario = 1 OR u.idtipousuario = 6 OR u.idtipousuario = 7 OR u.idtipousuario = 11 OR u.idtipousuario = 2 OR u.idtipousuario = 8 OR u.idtipousuario = 9 OR u.idtipousuario = 12)";
	}

	if ($_GET['preventivo']==0)
		$mantenimiento='Correctivo';
	else
		$mantenimiento='Preventivo';
if ($_GET['fecha1'])
	$sql = "SELECT req.idrequerimiento as id FROM usuarios as usu, asignacion_analista as asig_ana, asignacionesderequerimientos as asig_req, requerimientos as req, solucionesderequerimientos as sol_req WHERE (usu.nombre||' '||usu.apellido)='".$_GET['nombre']."' AND usu.idusuario=asig_ana.idusuario AND asig_ana.idasignacion=asig_req.idasignacion AND req.idrequerimiento=asig_req.idrequerimiento AND req.estado='Cerrado' AND req.mantenimiento='".$mantenimiento."' AND sol_req.idasignacion=asig_req.idasignacion AND (sol_req.fechasolucion between '%".$_GET['fecha1']." 00:00:00.000000%' and  '%".$_GET['fecha2']." 23:59:59.999999%' );";
else
	$sql = "SELECT req.idrequerimiento as id FROM usuarios as usu, asignacion_analista as asig_ana, asignacionesderequerimientos as asig_req, requerimientos as req WHERE (usu.nombre||' '||usu.apellido)='".$_GET['nombre']."' AND usu.idusuario=asig_ana.idusuario AND asig_ana.idasignacion=asig_req.idasignacion AND req.idrequerimiento=asig_req.idrequerimiento AND req.estado='Cerrado' AND req.mantenimiento='".$mantenimiento."';";

$result = sql_query($con, $sql);




	?>
<table border="0" cellpadding="2" cellspacing="1" width="500px" class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="4">Reportes de Mantenimientos por Analistas</td>
	</tr>
	<tr class="header">
		<td align="center" colspan="4"><?echo $titulofecha?></td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="20%">Usuario</td>
		<td class="tabla-header" width="20%">Departamento</td>
		<td class="tabla-header" width="20%">Fecha</td>
		<td class="tabla-header" width="40%">Requerimiento</td>
	</tr>

<?

	
while($row = sql_fetch_array($result)){

$sql = "SELECT usu.nombre as nombre, usu.apellido as apellido, req.fechacreacion as fecha, dept.nombre as departamento, req.asunto as requerimiento FROM usuarios as usu, requerimientos as req, departamentos as dept WHERE req.idusuario=usu.idusuario AND dept.iddepartamento=usu.iddepartamento AND req.idrequerimiento='".$row['id']."'";
$resultado = sql_query($con, $sql);

$fila = sql_fetch_array($resultado);

	echo "<tr class=\"dark-row\" id=\"efecto\">";
	echo "<td class=\"tabla-text\">{$fila['nombre']} {$fila['apellido']}</td>";
	echo "<td class=\"tabla-text\" align='center'>{$fila['departamento']}</td>";
	echo "<td class=\"tabla-text\" align='center'>{$fila['fecha']}</td>";
	echo "<td class=\"tabla-text\" align='center'>".$fila['requerimiento']."</td>";
	echo "</tr>";
	
	


}
	
	
	
	
	
	
	
	
	
	
	
	
	
}


if(isset($_POST['auditar'])){
	if(!empty($_POST['tipo'])){
		$tipo = $_POST['tipo'];
	}
	
	if($tipo == "1"){
	
########################################################################################################################
	if(!empty($_POST['fecha2']) && !empty($_POST['fecha1'])){
		$fecha = " and (fechasolucion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
		$titulofecha = "de la fecha {$_POST['fecha2']} hasta la fecha {$_POST['fecha1']}";
	}
	elseif(!empty($_POST['fecha2'])){
		$fecha = " and (fechasolucion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha2']} 23:59:59.999999%' )";
		$titulofecha = "de la fecha {$_POST['fecha2']}";
	}
	elseif(!empty($_POST['fecha1'])){
		$fecha = " and (fechasolucion between '%{$_POST['fecha1']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
		$titulofecha = "de la fecha {$_POST['fecha1']}";
	}
	if(!empty($_POST['filtro'])){
		$multiple = strpos($_POST['filtro'], ",");
		
		if($multiple == true){
			
			if(substr_count($_POST['filtro'], ',') > 0){
				$tok =  strtok($_POST['filtro'], ',');
				$query =  "  (";
					$i =0;
					while ($tok !== false) {
						if($i > 0){
							$query .= " OR ";
						}
						$query .= " u.idusuario = ". trim($tok) ;
					    $tok = strtok(",");
					    $i++;
					}
					
				}
			
			$query .= " ) ";
		}
		else{
			$query = " u.idusuario = {$_POST['filtro']}";
		}
	}
	else {
		$query = "(u.idtipousuario = 1 OR u.idtipousuario = 6 OR u.idtipousuario = 7 OR u.idtipousuario = 11 OR u.idtipousuario = 2 OR u.idtipousuario = 8 OR u.idtipousuario = 9 OR u.idtipousuario = 12)";
	}

//$query = "AND (u.idtipousuario = 1 OR u.idtipousuario = 6 OR u.idtipousuario = 7 OR u.idtipousuario = 11)";

$sql = "SELECT DISTINCT u.idusuario,(u.nombre), apellido,"
."(SELECT COUNT(distinct(r2.idrequerimiento)) from solucionesderequerimientos as sr2, usuarios as u2, asignacionesderequerimientos ar2, requerimientos as r2, asignacion_analista as aa2 where ar2.idasignacion = aa2.idasignacion and r2.idrequerimiento = ar2.idrequerimiento and r2.idusuario = u2.idusuario and ar2.reasignada = 'f' and aa2.idusuario = u.idusuario  and r2.mantenimiento ilike 'Preventivo' and sr2.idasignacion = ar2.idasignacion $fecha) as preventivos,"
."(SELECT COUNT(distinct(r2.idrequerimiento)) from solucionesderequerimientos as sr2, usuarios as u2, asignacionesderequerimientos ar2, requerimientos as r2, asignacion_analista as aa2 where ar2.idasignacion = aa2.idasignacion and r2.idrequerimiento = ar2.idrequerimiento and r2.idusuario = u2.idusuario and ar2.reasignada = 'f' and aa2.idusuario = u.idusuario  and r2.mantenimiento ilike 'Correctivo' and sr2.idasignacion = ar2.idasignacion $fecha) as correctivos"
." FROM usuarios as u where $query"
 ." ORDER BY u.nombre ;";

$sql2 = "SELECT DISTINCT u.idusuario,(u.nombre), apellido,"
."(SELECT COUNT(distinct(r2.idrequerimiento)) from solucionesderequerimientos as sr2, usuarios as u2, asignacionesderequerimientos ar2, requerimientos as r2, asignacion_analista as aa2 where ar2.idasignacion = aa2.idasignacion and r2.idrequerimiento = ar2.idrequerimiento and r2.idusuario = u2.idusuario and ar2.reasignada = 'f' and aa2.idusuario = u.idusuario  and r2.mantenimiento ilike 'Preventivo' and sr2.idasignacion = ar2.idasignacion $fecha) as preventivos,"
."(SELECT COUNT(distinct(r2.idrequerimiento)) from solucionesderequerimientos as sr2, usuarios as u2, asignacionesderequerimientos ar2, requerimientos as r2, asignacion_analista as aa2 where ar2.idasignacion = aa2.idasignacion and r2.idrequerimiento = ar2.idrequerimiento and r2.idusuario = u2.idusuario and ar2.reasignada = 'f' and aa2.idusuario = u.idusuario  and r2.mantenimiento ilike 'Correctivo' and sr2.idasignacion = ar2.idasignacion $fecha) as correctivos"
.",(SELECT COUNT(distinct(r2.idrequerimiento)) from solucionesderequerimientos as sr2, usuarios as u2, asignacionesderequerimientos ar2, requerimientos as r2, asignacion_analista as aa2 where ar2.idasignacion = aa2.idasignacion and r2.idrequerimiento = ar2.idrequerimiento and r2.idusuario = u2.idusuario and ar2.reasignada = 'f' and aa2.idusuario = u.idusuario  and (r2.mantenimiento = 'Correctivo' or r2.mantenimiento = 'Preventivo' )  and sr2.idasignacion = ar2.idasignacion $fecha) as totales"
." FROM usuarios as u where $query"
 ." ORDER BY totales desc;";

$_SESSION['SQLM1']= $sql2;
$_SESSION['titulo_fecha']= $titulofecha;


?>


<?
if(empty($titulofecha)){
	$titulofecha = "de por vida";
}
?>
<table width="800px" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td align="left" >
			<a class="download" href='reportes/mantenimiento_analista.php' target="_black">Descargar reporte en pdf</a>
		</td>
		<td align="left" >
			<a class="download" href='graficos/grafico_mantenimiento_analista.php' target="_black">Ver Grafico</a>
		</td>
	</tr>
</table>
<table border="0" cellpadding="2" cellspacing="1" width="500px" class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="4">Reportes de Mantenimientos por Analistas</td>
	</tr>
	<tr class="header">
		<td align="center" colspan="4"><?echo $titulofecha?></td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="40%">Analista</td>
		<td class="tabla-header" width="20%">Preventivos</td>
		<td class="tabla-header" width="20%">Correctivos</td>
		<td class="tabla-header" width="20%">Totales</td>
	</tr>
<?
 
$result = sql_query($con, $sql2);

$preventivos_t = 0;
$correctivos_t = 0;
$totales = 0;
$i = 0;
while($row = sql_fetch_array($result)){
		echo "<tr class=\"dark-row\" id=\"efecto\">";
		$NOMBRES[$i] = $row['nombre']." ".$row['apellido'];
		$TOTALES[$i] = $row['preventivos']+$row['correctivos'];
		
		
		echo "<td class=\"tabla-text\">{$row['nombre']} {$row['apellido']}</td>";
		$preventivos_t += $row['preventivos'];
		$total_preventivo = $total_preventivo + $row['preventivos'];
		echo "<td class=\"tabla-text\" align='center'><a href='?modulo=administracion&accion=26&nombre=$NOMBRES[$i]&preventivo=1&fecha2=".$_POST['fecha1']."&fecha1=".$_POST['fecha2']."'>{$row['preventivos']}</a></td>";
		$correctivos_t += $row['correctivos'];
		$total_correctivo = $total_correctivo + $row['correctivos'];
		echo "<td class=\"tabla-text\" align='center'><a href='?modulo=administracion&accion=26&nombre=$NOMBRES[$i]&preventivo=0&fecha2=".$_POST['fecha1']."&fecha1=".$_POST['fecha2']."'>{$row['correctivos']}</a></td>";
		$totales += ($row['preventivos']+$row['correctivos']);
		$total = $total + ($row['preventivos']+$row['correctivos']);
		echo "<td class=\"tabla-text\" align='center'>".($row['preventivos']+$row['correctivos'])."</td>";
		echo "</tr>";
		echo "<input type=\"hidden\" name=\"nombre$i\" value='".$NOMBRES[$i]."'/>";
		$i++;
}
$_SESSION['NOMBRES'] = $NOMBRES;
$_SESSION['TOTALES'] = $TOTALES;
?>

</form>
<?
	}
########################################################################################################################
	elseif($tipo == "2"){
		if(!empty($_POST['fecha2']) && !empty($_POST['fecha1'])){
			$fecha = " and (fechacreacion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
			$titulofecha = "de la fecha {$_POST['fecha2']} hasta la fecha  {$_POST['fecha1']}";
		}
		elseif(!empty($_POST['fecha2'])){
			$fecha = " and (fechacreacion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha2']} 23:59:59.999999%' )";
			$titulofecha = "de la fecha {$_POST['fecha2']}";
		}
		elseif(!empty($_POST['fecha1'])){
			$fecha = " and (fechacreacion between '%{$_POST['fecha1']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
			$titulofecha = "de la fecha {$_POST['fecha1']}";
		}
		
		if(!empty($_POST['filtro'])){
		$multiple = strpos($_POST['filtro'], ",");
		
		if($multiple == true){
			
			if(substr_count($_POST['filtro'], ',') > 0){
				$tok =  strtok($_POST['filtro'], ',');
				$query =  " where  (";
					$i =0;
					while ($tok !== false) {
						if($i > 0){
							$query .= " OR ";
						}
						$query .= " idtiporequerimiento = ". trim($tok) ;
					    $tok = strtok(",");
					    $i++;
					}
					
				}
			
			$query .= " )";
		}
		else{
			$query = " where idtiporequerimiento = {$_POST['filtro']}";
		}
		}
	
		$sql = "select distinct tipoderequerimiento,"
		."(select count(*) from tiposderequerimientos as tr2,  requerimientos as r  where tr2.idtiporequerimiento = r.idtiporequerimiento and tr2.idtiporequerimiento = tr.idtiporequerimiento and  mantenimiento = 'Correctivo' $fecha) as correctivos ,"
		."(select count(*) from tiposderequerimientos as tr2,  requerimientos as r  where tr2.idtiporequerimiento = r.idtiporequerimiento and tr2.idtiporequerimiento = tr.idtiporequerimiento and  mantenimiento = 'Preventivo' $fecha) as preventivos ,"
		."(select count(*) from tiposderequerimientos as tr2,  requerimientos as r  where tr2.idtiporequerimiento = r.idtiporequerimiento and tr2.idtiporequerimiento = tr.idtiporequerimiento and  (mantenimiento = 'Correctivo' OR mantenimiento = 'Preventivo') $fecha) as totales "
		."from tiposderequerimientos tr $query order by totales desc";
		
	if(empty($titulofecha)){
		$titulofecha = "de por vida";
	}
	
	$_SESSION['SQLM1']= $sql;
	$_SESSION['titulo_fecha']= $titulofecha;
?>		
<table width="800px" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td align="left" >
			<a class="download" href='reportes/mantenimiento_coordinacion.php' target="_black">Descargar reporte en pdf</a>
		</td>
	</tr>
</table>
<table border="0" cellpadding="2" cellspacing="1" width="500px" class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="4">Reportes de Mantenimientos por Coordinaci&oacute;n</td>
	</tr>
	<tr class="header">
		<td align="center" colspan="4"><?echo $titulofecha?></td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="40%">Coordinaci&oacute;n</td>
		<td class="tabla-header" width="20%">Preventivos</td>
		<td class="tabla-header" width="20%">Correctivos</td>
		<td class="tabla-header" width="20%">Totales</td>
	</tr>
	
<?	
$result = sql_query($con, $sql);

$preventivos_t = 0;
$correctivos_t = 0;
$totales = 0;
while($row = sql_fetch_array($result)){
		echo "<tr class=\"dark-row\" id=\"efecto\">";
		echo "<td class=\"tabla-text\">{$row['tipoderequerimiento']}</td>";
		$preventivos_t += $row['preventivos'];
		$total_preventivo = $total_preventivo + $row['preventivos'];
		echo "<td class=\"tabla-text\" align='center'>{$row['preventivos']}</td>";
		$correctivos_t += $row['correctivos'];
		$total_correctivo = $total_correctivo + $row['correctivos'];
		echo "<td class=\"tabla-text\" align='center'>{$row['correctivos']}</td>";
		$totales += ($row['preventivos']+$row['correctivos']);
		$total = $total + ($row['preventivos']+$row['correctivos']);
		echo "<td class=\"tabla-text\" align='center'>".$row['totales']."</td>";
		echo "</tr>";
		
}
	//echo "</table>";
	}
########################################################################################################################
	elseif($tipo == "3"){
				
		if(!empty($_POST['fecha2']) && !empty($_POST['fecha1'])){
			$fecha = " and (fechacreacion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
			$titulofecha = "de la fecha {$_POST['fecha2']} hasta la fecha  {$_POST['fecha1']}";
		}
		elseif(!empty($_POST['fecha2'])){
			$fecha = " and (fechacreacion between '%{$_POST['fecha2']} 00:00:00.000000%' and  '%{$_POST['fecha2']} 23:59:59.999999%' )";
			$titulofecha = "de la fecha {$_POST['fecha2']}";
		}
		elseif(!empty($_POST['fecha1'])){
			$fecha = " and (fechacreacion between '%{$_POST['fecha1']} 00:00:00.000000%' and  '%{$_POST['fecha1']} 23:59:59.999999%' )";
			$titulofecha = "de la fecha {$_POST['fecha1']}";
		}
		
		if(!empty($_POST['filtro'])){
		$multiple = strpos($_POST['filtro'], ",");
		
		if($multiple == true){
			
			if(substr_count($_POST['filtro'], ',') > 0){
				$tok =  strtok($_POST['filtro'], ',');
				$query =  " where  (";
					$i =0;
					while ($tok !== false) {
						if($i > 0){
							$query .= " OR ";
						}
						$query .= " iddepartamento = ". trim($tok) ;
					    $tok = strtok(",");
					    $i++;
					}
					
				}
			
			$query .= " )";
		}
		else{
			$query = " where iddepartamento = {$_POST['filtro']}";
		}
	}
	else {
		$query = "";
	}
		
		
		
		$sql = "select distinct d.nombre,"
			." (select count(*) from requerimientos as r, departamentos as d2, usuarios as u where r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and d2.iddepartamento = d.iddepartamento and r.mantenimiento = 'Correctivo' $fecha) as correctivos,"
			." (select count(*) from requerimientos as r, departamentos as d2, usuarios as u where r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and d2.iddepartamento = d.iddepartamento and r.mantenimiento = 'Preventivo' $fecha) as preventivos,"
			." (select count(*) from requerimientos as r, departamentos as d2, usuarios as u where r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and d2.iddepartamento = d.iddepartamento and (r.mantenimiento = 'Preventivo' OR r.mantenimiento = 'Correctivo') $fecha) as totales"
			." from departamentos as d $query order by totales desc;";	
			
	//	echo $sql;
		if(empty($titulofecha)){
			$titulofecha = "de por vida";
		}
	
		$_SESSION['SQLM1']= $sql;
		$_SESSION['titulo_fecha']= $titulofecha;
		//echo $sql;
		$result = sql_query($con, $sql);
?>
<table width="800px" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td align="left" >
			<a class="download" href='reportes/mantenimiento_direccion.php' target="_black">Descargar reporte en pdf</a>
		</td>
	</tr>
</table>
<table border="0" cellpadding="2" cellspacing="1" width="700px" class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="4">Reportes de Mantenimientos por Direcciones</td>
	</tr>
	<tr class="header">
		<td align="center" colspan="4"><?echo $titulofecha?></td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="70%">Direcci&oacute;n</td>
		<td class="tabla-header" width="10%">Preventivos</td>
		<td class="tabla-header" width="10%">Correctivos</td>
		<td class="tabla-header" width="10%">Totales</td>
	</tr>
<?


while($row = sql_fetch_array($result)){
		echo "<tr class=\"dark-row\" id=\"efecto\">";
		echo "<td class=\"tabla-text\">{$row['nombre']}</td>";
		$preventivos_t += $row['preventivos'];
		$total_preventivo = $total_preventivo + $row['preventivos'];
		echo "<td class=\"tabla-text\" align='center'>{$row['preventivos']}</td>";
		$correctivos_t += $row['correctivos'];
		$total_correctivo = $total_correctivo + $row['correctivos'];
		echo "<td class=\"tabla-text\" align='center'>{$row['correctivos']}</td>";
		$totales += ($row['preventivos']+$row['correctivos']);
		$total = $total + ($row['preventivos']+$row['correctivos']);
		echo "<td class=\"tabla-text\" align='center'>".$row['totales']."</td>";
		echo "</tr>";
}
	//echo "</table>";
	}
}


	
sql_disconnect();
//echo microtime();
?>

<? if ($_REQUEST['buscar']){ ?>

<tr class="header">
		<td align="center">Totales</td>
		<td align="center"><? echo $total_preventivo; ?></td>
        <td align="center"><? echo $total_correctivo; ?></td>
        <td align="center"><? echo $total; ?></td>
</tr>
</table>

<? }?>
