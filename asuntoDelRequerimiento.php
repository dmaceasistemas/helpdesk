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
$con = @sql_connect();
if(isset($_GET['id'])){
	$REQUERIMIENTO_ACTUAL = $_GET['id'];
}
//echo $REQUERIMIENTO_ACTUAL;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
		<title>Sistema de Helpdesk</title>
		<!--[if IE]>
		<style type="text/css" media="screen">
			table,tr{
			behavior: url(styles/csshover2.htc);
			}
			body, table {
			behavior: url(styles/csshover1_3.htc);
			font-size: 100%;
			}
		</style>
		<![endif]-->
		<link rel="shortcut icon" href="images/mat.gif">
		
		<?$tema = $_SESSION['tema'];?>
		
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
	<table border="0" cellpadding="2" cellspacing="1" width="100%"  class="tablas" align="center">
	<tr class="header">
		<td align="center">Requerimiento</td>
	</tr>
	<tr class="dark-row">
		<td align='center'>
			<?
			$con = sql_connect();
			$sql = "select asunto from requerimientos where idrequerimiento = $REQUERIMIENTO_ACTUAL";
			$result = sql_query($con, $sql);
			if($row = sql_fetch_array($result)){
				$asunto = $row['asunto'];
			}
			echo $asunto;
			sql_disconnect();
			?>
		</td>
	</tr>
	<tr class="header">
		<td class="tabla-header" align="center">
			<a class="paginacion" href="javascript:window.close();">cerrar</a>
		</td>
	</tr>
	</body>
</html>