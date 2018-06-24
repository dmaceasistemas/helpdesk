<?php
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
$idusuario =  $_SESSION['usuario'];
?>

<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
		<link rel="shortcut icon" href="images/mat.gif">
		<?$tema = $_SESSION['tema'];?>
		<link rel="stylesheet" href="styles/<?echo $tema?>/estilo.css" />
		<link rel="stylesheet" href="styles/<?echo $tema?>/calendar.css" />
		<script type="text/javascript" src="javascript/src/utils.js"></script>
		<script type="text/javascript" src="javascript/src/calendar.js"></script>
		<script type="text/javascript" src="javascript/src/calendar-setup.js"></script>
		<script type="text/javascript" src="javascript/lang/calendar-sp.js"></script>
		<script type="text/javascript" src="javascript/javascript.js"></script>
		<script type="text/javascript" src="javascript/validaciones.js"></script>
		<title>FAQ-Sistema de Helpdesk</title>
	</head>
	<body bgcolor="black">
		<table border="0" cellpadding="2" cellspacing="0" width="100%"  class="tablas" align="center">
			<tr class="header">
				<td align="center" colspan="3">B&uacute;squeda de Preguntas Frecuentes (FAQ)</td>
			</tr>
			<tr class="dark-row">
				<td align="right" class="tabla-text" width="30%">
					<b><i>Tema:</i></b>
				</td>
				<td align="left" width="30%">
					<input type="text" name="tema" size="20">
				</td>
				<td align="left" width="40%">
					<input type="button" value="buscar">
				</td>
			</tr>
		</table>
		<br>
		<table border="0" cellpadding="1" cellspacing="0" width="100%"  class="tablas" align="center">
			<tr class="header" height="35px" >
				<td align="center" colspan="2">Preguntas Frecuentes (FAQ)</td>
			</tr>
			<tr class="dark-row">
				<td class="tabla-text">
					<a href="javascript:;"><b><i>1- ¿Como configurar el Correo Electronico? </i></b></a>
				</td>
			</tr>
			<tr bgcolor="white">
				<td class="tabla-text" colspan="2">
					<b><i>Soluci&oacute;n :</i></b>Se crea la cuenta del usuario .......................
				</td>
			</tr>
			<tr class="dark-row">
				<td class="tabla-text">
					<a href="javascript:;"><b><i>2- ¿Como configurar la impresora?</i></b></a>
				</td>
			</tr>
			<tr bgcolor="white">
				<td class="tabla-text" colspan="2">
					
				</td>
			</tr>
			<tr class="dark-row">
				<td class="tabla-text">
					<a href="javascript:;"><b><i>3- ¿Como estraer el pen driver? </i></b></a>
				</td>
			</tr>
			<tr bgcolor="white"> 
				<td class="tabla-text" colspan="2">
					
				</td>
			</tr>
			<tr class="header" >
				<td align="center" colspan="2">
				
				
				
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left" width="30%">&nbsp;
				<?//if($offset != $PRIMERA_PAGINA){?>
					<a class="paginacion" href="#"><img src='styles/<?echo $_SESSION['tema']?>/atras.png' border=0 alt='[Atras]' title='Atras'></a>
					<a class="paginacion" href="#"><img src='styles/<?echo $_SESSION['tema']?>/primera.png' border=0 alt='[Primera]' title='Primera'></a>
				<?//}?>
				</td>
					<font size="1">&nbsp;</font>
				</td>
				<td align="right"  width="30%">&nbsp;
					<?//if($offset != $ULTIMA_PAGINA){?>
					<a class="paginacion" href="#"><img src='styles/<?echo $_SESSION['tema']?>/ultima.png' border=0 alt='[&Uacute;ltima]' title='&Uacute;ltima'></a>
					<a class="paginacion" href="#"><img src='styles/<?echo $_SESSION['tema']?>/siguiente.png' border=0 alt='[Siguiente]' title='Siguiente'></a>
					<?//}?>
				</td>
			</tr>
		</table>
				
				</td>
			</tr>
		</table>
	
	</body>
</html>