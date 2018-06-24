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

$con = sql_connect();
$opciones;
$sql = "select * from usuarios as u, menu_usuario as mu where u.idusuario = mu.idusuario and u.idusuario = $idusuario order by idprivilegio";
$sql = "select distinct(o.idopcion), nombreopcion from opciones as o, subopciones as so, privilegios as p where so.idsubopcion = p.idsubopcion and o.idopcion = so.idopcion and o.idsistema = 1 and p.idusuario = $idusuario ";


$result = @sql_query($con, $sql);
$j = 0;

while($row = @sql_fetch_array($result)){
	$opciones = $row['nombreopcion'];
	$arreglo[$j] = $opciones;
	$j++;
}
$_SESSION["PRIVILEGIOS"] = $arreglo;
if(count($arreglo) > 0){
?>
					<div id="menu">
						<ul>
						<?
						foreach ($arreglo as $a){
							if(strcasecmp(trim($a), trim("Nuevo Requerimiento")) == 0){
								echo "<li id=\"nav-A7\"><a href=\"?modulo=administracion&accion=7\" title=\"Realizar un nuevo requerimiento\">Nuevo Requerimiento</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Seguimiento")) == 0){
								echo "<li id=\"nav-A8\"><a href=\"?modulo=administracion&accion=8\" title=\"Hacer seguimiento a sus requerimientos abiertos\">Seguimiento</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Historial")) == 0){
								echo "<li id=\"nav-A9\"><a href=\"?modulo=administracion&accion=9\" title=\"Ver el Historial de sus requerimientos\">Historial</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Telefonico")) == 0){
								echo "<li id=\"nav-A13\"><a href=\"?modulo=administracion&accion=13\" title=\"Crear un requerimiento via telefonica\">Telef&oacute;nico</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Registrar Usuarios")) == 0){
								echo "<li id=\"nav-A22\"><a href=\"?modulo=administracion&accion=22\" title=\"Registrar Usuarios\">Registrar Usuarios</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Asignar")) == 0){
								echo "<li id=\"nav-A10\"><a href=\"?modulo=administracion&accion=10\" title=\"Asignar requerimientos nuevos\">Asignar</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Reasignar")) == 0){
								echo "<li id=\"nav-A11\"><a href=\"?modulo=administracion&accion=11\" title=\"Reasignar requerimientos pendientes\">Reasignar</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Desbloquear")) == 0){
								echo "<li id=\"nav-A12\"><a href=\"?modulo=administracion&accion=12\" title=\"Desbloquear requerimientos\">Desbloquear</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Busqueda")) == 0){
								echo "<li id=\"nav-A4\"><a href=\"?modulo=administracion&accion=4\" title=\"Hacer seguimientos a los analistas\">B&uacute;squeda</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Mis Nuevos")) == 0){
								echo "<li id=\"nav-A14\"><a href=\"?modulo=administracion&accion=14\" title=\"Mis requerimientos nuevos\">Mis Nuevos</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Mis Pendientes")) == 0){
								echo "<li id=\"nav-A15\"><a href=\"?modulo=administracion&accion=15\" title=\"Mis requerimientos pendientes\">Mis Pendientes</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Mi Historial")) == 0){
								echo "<li id=\"nav-A19\"><a href=\"?modulo=administracion&accion=19\" title=\"Mi Historial de requerimientos realizados\">Mi Historial</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Cuentas de Usuarios")) == 0){
								echo "<li id=\"nav-A21\"><a href=\"?modulo=administracion&accion=21\" title=\"Cuentas de Usuarios\">Cuentas de Usuarios</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Primer Login")) == 0){
								echo "<li id=\"nav-A27\"><a href=\"?modulo=administracion&accion=27\" title=\"Primer Login de los Analistas\">Primer Login</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Estadisticas")) == 0){
								echo "<li id=\"nav-A24\"><a href=\"?modulo=administracion&accion=24\" title=\"Estadisticas\">Estadisticas</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Reportes")) == 0){
								echo "<li id=\"nav-A26\"><a href=\"?modulo=administracion&accion=26\" title=\"\">Reportes</a></li>";
							}
							elseif(strcasecmp(trim($a), trim("Lista de Sugerecias")) == 0){
								echo "<li id=\"nav-A25\"><a href=\"?modulo=administracion&accion=25\" title=\"Lista de Sugerencias\">Lista de Sugerecias</a></li>";
							}
						}
						?>				

						</ul>
					</div>
					<?}?>