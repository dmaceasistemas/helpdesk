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
require_once ('./libreria/lib.php');
$MAX_PAGE_SIZE = 1;
$con = @sql_connect();
if(isset($_GET['id'])){
	$tipo = $_GET['id'];
	//echo $tipo;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
		<title>Sistema de Helpdesk</title>
		<link rel="shortcut icon" href="images/mat.gif">
		<?
		$tema = $_SESSION['tema'];
		?>
		<link rel="stylesheet" href="styles/<?echo $tema?>/estilo.css" />
		<link rel="stylesheet" href="styles/<?echo $tema?>/calendar.css" />
		
		<link rel="stylesheet" href="styles/themes/layouts/big.css" />
		<script type="text/javascript" src="javascript/src/utils.js"></script>
		<script type="text/javascript" src="javascript/src/calendar.js"></script>
		<script type="text/javascript" src="javascript/src/calendar-setup.js"></script>
		<script type="text/javascript" src="javascript/lang/calendar-sp.js"></script>
		<script type="text/javascript" src="javascript/javascript.js"></script>
		<script type="text/javascript" src="javascript/validaciones.js"></script>
	</head>
	<body bgcolor="black">
	<?
	if(!empty($tipo)){
	$offset = 0;
	$PRIMERA_PAGINA = 0;
	$result = sql_query($con, "select count(*) from tiposdetallados as t,solucionesderequerimientos as s, requerimientos  as r, asignacionesderequerimientos as a where r.idtiposdetallados = $tipo and s.nivel ilike 'Usuario'  and r.estado = 'Cerrado' and r.idrequerimiento = a.idrequerimiento and a.idasignacion = s.idasignacion and t.idtiposdetallados = r.idtiposdetallados;");
	$row = sql_fetch_array($result);
	$totalregistros =  $row['0'];
	$totalpaginas = ceil($totalregistros / $MAX_PAGE_SIZE);
	$ULTIMA_PAGINA = ($totalpaginas * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;
	if($totalregistros > 0){
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
	echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" width=\"100%\"  class=\"tablas\" align=\"center\">";
		$sql = "select t.tiposdetallados,r.asunto, r.diagnostico, s.solucion from tiposdetallados as t,solucionesderequerimientos as s, requerimientos  as r, asignacionesderequerimientos as a where r.idtiposdetallados = $tipo and s.nivel ilike 'Usuario' and r.estado = 'Cerrado' and r.idrequerimiento = a.idrequerimiento and a.idasignacion = s.idasignacion and t.idtiposdetallados = r.idtiposdetallados limit $MAX_PAGE_SIZE offset $offset;";
		$result = sql_query($con, $sql);
		if($row = sql_fetch_array($result)){
			echo "<tr class=\"header\"><td class=\"tabla-header\" align=\"center\">{$row['tiposdetallados']}</td></tr>";
			echo "<tr class=\"dark-row\" id=\"efecto\">";
			echo "<td class=\"tabla-text\" align=\"center\">{$row['asunto']}</td>";
			echo "</tr>";
			echo "<tr class=\"header\"><td class=\"tabla-header\">Diagnostico</td></tr>";
			echo "<tr class=\"dark-row\" id=\"efecto\">";
			echo "<td class=\"tabla-text\" align=\"center\">{$row['diagnostico']}</td>";
			echo "</tr>";
			echo "<tr class=\"header\"><td class=\"tabla-header\">Soluciones posibles</td></tr>";
			echo "<tr class=\"dark-row\" id=\"efecto\">";
			echo "<td class=\"tabla-text\" align=\"center\">{$row['solucion']}</td>";
			echo "</tr>";
		}
	?>
	<tr class="header">
		<td class="tabla-text">
			<table width="100%" border="0">
				<tr>
					<td align="left" width="30%"><font size="1">&nbsp;
						<?if($offset != $PRIMERA_PAGINA){?>
							<a href="?id=<?echo $tipo?>&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>">[Atras]</a>
							<a href="?id=<?echo $tipo?>&action=first">[Primera]</a>
						<?}?>
					</font></td>
					<td align="center" width="40%">
						<font size="1">&nbsp;</font>
					</td>
					<td align="right"  width="30%"><font size="1">&nbsp;
						<?if($offset != $ULTIMA_PAGINA){?>
						<a href="?id=<?echo $tipo?>&action=last">[&Uacute;ltima]</a>
						<a href="?id=<?echo $tipo?>&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>">[Siguiente]</a>
						<?}?>
					</font></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?
	}
}
?>
</body>
</html>
<?
sql_disconnect();
?>