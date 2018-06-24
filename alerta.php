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
if(isset($_GET['tipo'])){ //isset($_GET['cantidad']) && 
	$cantidad = $_GET['cantidad'];
	$tipo = $_GET['tipo'];
?>
<html>
<head>
<script>
	function revisarRequerimiento(tipo){
		if(tipo == "asignar"){
			//alert(1);
			opener.location.href="/helpdesk/index.php?modulo=administracion&accion=10&alerta=false";
			opener.blur();
			window.opener.focus() 
		}
		else if(tipo == "nuevo"){
			//alert(2);
			opener.location.href="/helpdesk/index.php?modulo=administracion&accion=14&alerta=false";
			opener.blur();
			window.opener.focus() 
		}
		else if(tipo == "pendiente"){
			//alert(3);
			opener.location.href="/helpdesk/index.php?modulo=administracion&accion=15&alerta=false";
			opener.blur();
			window.opener.focus() 
		}
		//
		//window.setTimeout(window.close(),10)
		setTimeout('self.close();',1);
	}
</script>
<title>Sistema de Helpdesk</title>
<?$tema = $_SESSION['tema'];?>
<link rel="stylesheet" href="styles/<?echo $tema?>/estilo.css" />
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">
	<!-- <embed src="audio/1.wav" hidden="true"></embed> -->
	<table  align='center' height="100%" width='100%' cellpadding=0 cellspacing=0 >
		<tr>
			<td>
			<table align='center' width='100%' cellpadding=0 cellspacing=0 height="100%">
				<tr class="header">
					<td colspan='2' align="center">Sistema Helpdesk</td>
				</tr>
				<tr class="dark-row">
					<td>
						<img src='images/alert.gif' title=''/>
					</td>
					<?
					if($tipo == 'nuevo'){
						$a = "Nuevos";
					}
					elseif($tipo == 'pendiente'){
						$a = "Pendiente";
					}
					elseif($tipo == 'asignar'){
						$a = "por asignar";
					}
						?>
					<td>
						<b><i>Tiene <?echo $cantidad?> requerimientos <?echo $a?></i></b>
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>
				<table align='center' width='100%' cellpadding=0 cellspacing=0 height="100%">
					<tr class="header">
						<td align="center">
							<input type="button" value="Revisar" id="boton" onClick="revisarRequerimiento('<?echo $tipo?>')">
						</td>
						<td align="center">
							<input type="button" value="Cerrar" id="boton" onClick="window.close()">
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html><?
sql_disconnect();
}?>