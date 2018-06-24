<?
if(!isset($_GET['alerta']) && $_GET['accion'] != 5){
?>
<marquee>
<table width="1000px" cellpadding="0" cellspacing="0" border="0">
	<tr>
<?
$opciones;
$sql = "select * from usuarios as u, menu_usuario as mu where u.idusuario = mu.idusuario and u.idusuario = $idusuario";
$result = @sql_query($con, $sql);
if($row = @sql_fetch_array($result)){
	$opciones = $row['opciones'];
}

#########################################################################################################################
#Nuevos
#########################################################################################################################
if((strpos($opciones, "I")) !== false){
$sql = "select count(*) from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and aa.idusuario = $idusuario and r.estado ilike 'Nuevo' and ar.reasignada = 'f'";
$result = @sql_query($con, $sql);
$row = sql_fetch_array($result);
$nuevos =  $row['0'];
}?>
<?

if($nuevos > 0){
	?>
		<td class="info">Tiene <?echo $nuevos?> requerimientos nuevos!!!</td>
		<script>
		var a = openPopUp('alerta.php?tipo=nuevo&cantidad=<?echo $nuevos?>','Demo','',250,150,'true');
		</script>
<?}
	
#########################################################################################################################
#Pendientes
#########################################################################################################################
if((strpos($opciones, "J")) !== false){
$result = sql_query($con, "select count(*) from usuarios as u, departamentos as d, asignacionesderequerimientos ar, requerimientos as r, asignacion_analista as aa where ar.idasignacion = aa.idasignacion and r.idrequerimiento = ar.idrequerimiento and r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and aa.idusuario = $idusuario and r.estado ilike 'Pendiente' and ar.reasignada = 'f'");
$row = sql_fetch_array($result);
$pendientes =  $row['0'];
	if($pendientes > 0){
	?>
		<td class="info">Tiene <?echo $pendientes?> requerimientos pendientes!!!</td>
		<script>
		var a = openPopUp('alerta.php?tipo=pendiente&cantidad=<?echo $pendientes?>','Demo','',250,150,'true');
		</script>
	<?
	}
}?>
<?
#########################################################################################################################
#Asignar 
#########################################################################################################################
$tipo1 = "";
$tipo2 = "";
$tipo3 = "";

//Soporte
if($idtipousuario == 1 || $idtipousuario == 2 || $idtipousuario == 4 ){
	$tipo3 = "and (tr.tipoderequerimiento ilike '%SOPORTE%' OR tr.tipoderequerimiento ilike '%GENERAL%')";
}
//Redes
elseif($idtipousuario == 6 || $idtipousuario == 8){
	$tipo3 = "and tr.tipoderequerimiento ilike '%REDES%'";
}
//Telefonia
elseif($idtipousuario == 11 || $idtipousuario == 12){
	$tipo3 = "and tr.tipoderequerimiento ilike '%TELECOMUNICACIONES%'";
}
//Desarrollo
elseif($idtipousuario == 7 || $idtipousuario == 9){
	$tipo3 = "and tr.tipoderequerimiento ilike '%DESARROLLO%'";
}
//Administrador
elseif($idtipousuario == 10){
	$tipo3 = "";
}
else{
	$tipo3 = "and tr.tipoderequerimiento = '???'";
}

if((strpos($opciones, "E")) !== false){
$result = sql_query($con, "select count(*) from departamentos as d, requerimientos as r, tiposderequerimientos as tr, usuarios as u where r.idusuario = u.idusuario  and u.iddepartamento = d.iddepartamento and tr.idtiporequerimiento = r.idtiporequerimiento and r.asignado = 'f' and r.estado ilike 'Nuevo' $tipo3;");

$row = sql_fetch_array($result);
$asignar =  $row['0'];
if($asignar > 0){
	?>
		<td class="info">Tiene <?echo $asignar?> requerimientos por asignar!!!</td>
		<script>
		var a = openPopUp('alerta.php?tipo=asignar&cantidad=<?echo $asignar?>','Demo','',250,150,'true');
		self.setTimeout('a.close()', 100);
		</script>
	<?
	}
	?>
<?}?>
</tr>
</table>
</marquee>
<?}?>