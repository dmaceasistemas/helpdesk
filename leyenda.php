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
?>
<html>
<head>
<title>Sistema de Helpdesk</title>
		<link rel="shortcut icon" href="images/mat.gif">
		<?
		$tema = $_SESSION['tema'];
		?>
		<link rel="stylesheet" href="styles/<?echo $tema?>/estilo.css" />
	</head>
</head>
<body bgcolor="black">
<table border="0" cellpadding="2" cellspacing="1" width="100%"
	class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="2">Leyenda</td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="15%">Logo</td>
		<td class="tabla-header" width="*">Significado</td>
	</tr>
	<tr class="dark-row" id="efecto">
		<td class="tabla-text">
			<center><img src='images/verde.png' alt='V'></center>
		</td>
		<td class="tabla-text">
			Requerimiento Nuevo o Pendiente
		</td>
	</tr>
	<tr class="dark-row" id="efecto">
		<td class="tabla-text">
			<center><img src='images/amarillo.png' alt='A'></center>
		</td>
		<td class="tabla-text">
			Requerimiento Nuevo o Pendiente con m&aacute;s de 2 dias sin solucionar
		</td>
	</tr>
	<tr class="dark-row" id="efecto">
		<td class="tabla-text">
			<center><img src='images/rojo.png' alt='R'></center>
		</td>
		<td class="tabla-text">
			Requerimiento Nuevo o Pendiente con m&aacute;s de 3 dias sin solucionar
		</td>
	</tr>
	<tr class="dark-row" id="efecto">
		<td class="tabla-text">
			<center><img src='images/Estrella.png' alt='S'></center>
		</td>
		<td class="tabla-text">
			Requerimiento solucionado o cerrado
		</td>
	</tr>
	<tr class="dark-row" id="efecto">
		<td class="tabla-text">
			<center><img src='images/azul.png' alt='A'></center>
		</td>
		<td class="tabla-text">
			Requermiento anulado por el usuario antes de ser asignado
		</td>
	</tr>
	<tr class="dark-row" id="efecto">
		<td class="tabla-text">
			<center><img src='images/close.png' alt='A' height='22px'></center>
		</td>
		<td class="tabla-text">
			Requerimiento bloqueado por el analista
		</td>
	</tr>
</tabla>
</body>
</html>