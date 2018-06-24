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
<font class="texto3">
Bienvenido al sistema de Helpdesk :<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Con este sistema usted podr&aacute; realizar de una manera sencilla y r&aacute;pida, los  distintos requerimientos a la Direcci&oacute;n de Tecnolog&iacute;a e Inform&aacute;tica, como reportar aver&iacute;as de software &oacute; de hardware en su equipo. 
</font><br><br>
<?
$fecha = $_SESSION['ultimologin'];
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
			
			
?>
<font size="1">Su &uacute;ltimo acceso fue el dia <?echo $tok1;?>  al las <?echo " ".$hora.":".$minuto." ".$a?></font>
<br><br><br><br><br><br><br><br><br><br><br><br>
<table width="80%">
	<tbody>
		<tr>
			<td width="300px" align="left">
				<font class="texto1">Direcci&oacute;n de</font><br/>
				<font class="texto2">Tecnolog&iacute;a e Inform&aacute;tica</font>
			</td>
			<!--<td width="300px" align="left">
				<font class="texto1">Direcci&oacute;n de </font><br/>
				<font class="texto2">Tecnolog&iacute;a de la Informaci&oacute;n</font>
			</td>
			<td width="300px" align="left">
				<font class="texto1">Coordinaci&oacute;n de</font><br/>
				<font class="texto2">Desarrollo de Sistemas</font>
			</td>-->
		</tr>
	</tbody>
</table>