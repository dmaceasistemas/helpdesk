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
<br/>
<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' align='center' width='350px' cellpadding=0 cellspacing=0>
	<tr>
		<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>Mensaje</font></center></td>
	</tr>
	<tr>
		<?
		if(!empty($_GET['error'])){
			$imagen = 'images/error.gif';
		}
		else{
			$imagen = 'images/info.gif';
		}
		?>
		<td>&nbsp;<img src=<?echo $imagen?> height='30' title=''/></td>
		<td align=center>
			<?
		if (isset ($_GET['msg'])) {
			$mensaje = $_GET['msg'];
			switch ($mensaje) {
				case 1 :
					echo "El requerimento ha sido registrado";
					break;
				case 2 :
					echo "Su solicitud de crear cuenta de usuarios ha sido registrada, para su confirmaci&oacute;n envie un memo a la Direcci&oacute;n de Tecnolog&iacute;a de la Informaci&oacute;n";
					break;
				case 3 :
					echo "Error: La c&eacute;dula se encuentra registrada en el sistema";
					break;
				case 4 :
					echo "Usuario registrado con &eacute;xito";
					break;
				case 5 :
					echo "Gracias por su sugerencia";
					break;
				default :
				"Sistema de Helpdesk";
				break;
			}
		}
		?>
		</td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>