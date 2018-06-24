<?php
	$con = sql_connect();
	$tipodeusuario;
	$sql = "select * from usuarios as u, tiposdeusuarios as t where t.idtipousuario = u.idtipousuario and u.idusuario = $idusuario";
	$result = @sql_query($con, $sql);
	if($row = @sql_fetch_array($result)){
		$tipodeusuario = $row['tipodeusuario'];
	}
?>
					<div id="menu">
						<ul>
							<li><a href="?modulo=administracion&accion=7" title="Realizar un nuevo requerimiento">Nuevo Requerimiento</a></li>
							<li><a href="?modulo=administracion&accion=8" title="Hacer seguimiento a sus requerimientos abiertos">Seguimiento</a></li>
							<li><a href="?modulo=administracion&accion=9" title="Ver el Historial de sus requerimientos">Historial</a></li>
							<?if($tipodeusuario == "Secretaria"){?>
							<li><a href="?modulo=administracion&accion=13" title="Crear un requerimiento via telefonica">T&eacute;lefonico</a></li>
							<li><a href="?modulo=administracion&accion=10" title="Asignar requerimientos nuevos">Asignar</a></li>
							<?}?>
							<li>
							<?if($tipodeusuario == "AnalistaJefe"){?>
								<!-- <li><a href="?modulo=administracion&accion=21" title="Cuentas de Usuarios">Cuentas de Usuarios</a></li> -->
								<li><a href="?modulo=administracion&accion=10" title="Asignar requerimientos nuevos">Asignar</a></li>
								<li><a href="?modulo=administracion&accion=11" title="Reasignar requerimientos pendientes">Reasignar</a></li>
								<li><a href="?modulo=administracion&accion=12" title="Desbloquear requerimientos">Desbloquear</a></li>
								<li><a href="?modulo=administracion&accion=4" title="Hacer seguimientos a los analistas">B&uacute;squeda</a></li>
							<?}?>
							<?if($tipodeusuario == "Analista"){?>
								<li><a href="?modulo=administracion&accion=14" title="Mis requerimientos nuevos">Mis Nuevos</a></li>
								<li><a href="?modulo=administracion&accion=15" title="Mis requerimientos pendientes">Mis Pendientes</a></li>
								<li><a href="?modulo=administracion&accion=19" title="Mi Historial de requerimientos realizados">Mi Historial</a></li>
							<?}?>
						</ul>
					</div>
