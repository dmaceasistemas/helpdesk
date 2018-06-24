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
$sql = " select count(*) from usuarios as u, departamentos as d, requerimientos as r where r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and r.estado ilike 'Cuenta'";

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
$sql = "select r.idrequerimiento,r.idusuario, u.nombre as nombre1, u.apellido, r.asunto, d.nombre as nombre2, r.fechacreacion from usuarios as u, departamentos as d, requerimientos as r where r.idusuario = u.idusuario and u.iddepartamento = d.iddepartamento and r.estado ilike 'Cuenta' order by r.idrequerimiento desc limit $MAX_PAGE_SIZE offset $offset;";
$result = sql_query($con, $sql);
if(sql_num_rows($result) > 0){
?>
<table border="0" cellpadding="2" cellspacing="1" width="810px"
	class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="6">Cuentas de Usuarios</td>
	</tr>
	<tr class="header">
		<td class="tabla-header">N&uacute;mero</td>
		<td class="tabla-header">Fecha</td>
		<td class="tabla-header">Hora</td>
		<td class="tabla-header">Usuario</td>
		<td class="tabla-header">Direcci&oacute;n</td>
		<td class="tabla-header">Requerimiento</td>
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
			echo "<tr class=\"dark-row2\"id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=21&idrequerimiento={$row['idrequerimiento']}$string';\">";
		}
		else{
			echo "<tr class=\"dark-row\" id=\"efecto\" onclick=\"javascript:location.href='?modulo=administracion&accion=21&idrequerimiento={$row['idrequerimiento']}$string';\">";
		}
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">{$row['idrequerimiento']}</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok($row['fechacreacion'], " ")."</td>";
		echo "<td class=\"tabla-text\" width=\"10%\" align=\"center\">".strtok(substr($row['fechacreacion'], 10),".")."</td>";
		echo "<td class=\"tabla-text\" width=\"15%\" align=\"center\">".$row['nombre1']." ". $row['apellido']."</td>";
		echo "<td class=\"tabla-text\" width=\"25%\" align=\"center\">{$row['nombre2']}</td>";
		echo "<td class=\"tabla-text\" width=\"30%\" align=\"center\">{$row['asunto']}</td>";
		echo "</tr>";
		$i++;
	}
		if($totalpaginas > 1){
		?>
	<tr class="header">
		<td colspan="6">
		<table width="100%" border="0">
			<tr>
				<td align="left" width="30%"><font size="1">&nbsp;
				<?if($offset != $PRIMERA_PAGINA){?>
					<a href="?modulo=administracion&accion=21&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>">[Atras]</a>
					<a href="?modulo=administracion&accion=21&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=first">[Primera]</a>
				<?}?>
				</font></td>
				<td align="center" width="40%">
					<font size="1">&nbsp;</font>
				</td>
				<td align="right"  width="30%"><font size="1">&nbsp;
					<?if($offset != $ULTIMA_PAGINA){?>
					<a href="?modulo=administracion&accion=21&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=last">[&Uacute;ltima]</a>
					<a href="?modulo=administracion&accion=21&idrequerimiento=<?echo $REQUERIMIENTO_ACTUAL?>&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>">[Siguiente]</a>
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
</table>
<?}else{?>
<br/>
<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/alert.gif' height='25px'></td>
		<td><font size="2px"><b>No hay requerimientos de cuentas</b></td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?}
sql_disconnect(); 
?>