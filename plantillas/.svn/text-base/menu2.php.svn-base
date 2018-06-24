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
$con = @sql_connect();

$sql = "SELECT nombre,apellido,iddepartamento FROM Usuarios WHERE idusuario = ". $idusuario;
$result = @sql_query($con, $sql);
if($row = @sql_fetch_array($result)){
	$nombreusuario = $row['nombre'] . " " . $row['apellido'];
	$iddepartamento = $row['iddepartamento'];
}
$sql = "SELECT * FROM departamentos WHERE iddepartamento = ". $iddepartamento;
$result = @sql_query($con,$sql);

if($row = @sql_fetch_array($result)){
	$nombredepartamento = $row['nombre'];
}

sql_disconnect();
?>
									<div id="tabs">
									  <ul>
									    <li id="nav-A5"><a href="?modulo=administracion&accion=5" title="Cerrar Sesi&oacute;n"><span>Salir</span></a></li>
									    <!-- <li id="nav-A6"><a href="javascript:;" title="Preguntas Frecuentes" onclick="openPopUp('faq.php?','Demo','',600,500,'true');"><span>FAQ</span></a></li> -->
									    <li id="nav-A2"><a href="?modulo=administracion&accion=2" title="Ayuda"><span>Ayuda</span></a></li>
									    <li id="nav-A3"><a href="?modulo=administracion&accion=3" title="Preferencias"><span>Preferencias</span></a></li>
									    <li id="nav-A23"><a href="?modulo=administracion&accion=23" title="Reclamos y Sugerencias"><span>Sugerencias</span></a></li>
									    <li id="nav-A1"><a href="?modulo=administracion&accion=1" title="P&aacute;gina principal"><span>Principal</span></a></li>
									    
									  </ul>
									</div>
