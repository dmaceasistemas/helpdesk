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


if (isset ($_GET['accion'])) {
	$accion = $_GET['accion'];
	if($accion == 4  OR $accion == 17){
		//
	}
	else{
		$_SESSION['SQL1'] = null;
		$_SESSION['SQL2'] = null;
	}
	if($accion == 26){
		//
	}
	else{
		$_SESSION['SQLM1']= null;
		$_SESSION['titulo_fecha'] = null;
	}
	
	
	
	switch ($accion) {
		case 1 :
			include ('home.php');
			break;
		case 2 :
			include ('ayuda.php');
			break;
		case 3 :
			include ('preferencias.php');
			break;
		case 4 :
			if(autorizado("Busqueda")){
				include ('listaAnalista.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 5 :
			include ('cerrarSession.php');
			break;
		#####################################################################################
		#####################################################################################
		#	OPCION NO HABILITADA
		#####################################################################################
		#####################################################################################
		#case 6 :
			#include ('requerimientosResueltos.php');
			#break;
		case 7 :
			if(autorizado("Nuevo Requerimiento")){
				include ('ingresarRequerimiento.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 8 :
			if(autorizado("Seguimiento")){
				include ('seguimientoRequerimiento.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 9 :
			if(autorizado("Historial")){
				include ('historialRequerimiento.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 10 :
			if(autorizado("Asignar")){
				include ('asignarRequerimiento.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 11 :
			if(autorizado("Reasignar")){
				include ('reasignarRequerimiento.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 12 :
			if(autorizado("Desbloquear")){
				include ('desbloquearRequerimiento.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 13 :
			if(autorizado("Telefonico")){
				include ('nuevoRequerimientoTelefonico.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 14 :
			if(autorizado("Mis Nuevos")){
				include ('misNuevos.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 15 :
			if(autorizado("Mis Pendientes")){
				include ('misPendientes.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		#####################################################################################
		#####################################################################################
		#	REVISAR COMO OTORGAR PERMISOS PARA ABRIR
		#####################################################################################
		#####################################################################################
		case 17 :
			include ('detallesRequerimiento.php');
			break;
		#####################################################################################
		#####################################################################################
		#	OPCION NO HABILITADA
		#####################################################################################
		#####################################################################################
		#case 18 :
		#	include ('solucionarRequerimiento.php');
		#	break;
		case 19 :
			if(autorizado("Mi Historial")){
				include ('historialAnalista.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 20 :
			include ('mensaje.php');
			break;
		#####################################################################################
		#####################################################################################
		#	OPCION NO HABILITADA
		#####################################################################################
		#####################################################################################
		#case 21 :
		#	include ('usuarios.php');
		#	break;
		case 22 :
			if(autorizado("Registrar Usuarios")){
				include ('registrarUsuario.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 23 :
			include ('sugerencias.php');
			break;
		case 24 :
			include ('estadisticas.php');
			break;
		case 25 :
			include ('listaSugerencias.php');
			break;
		case 26 :
			if(autorizado("Reportes")){
				include ('reportes.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		case 27 :
			include ('primerlogin.php');
			break;
		case 28 :
			if(autorizado("Registrar Tipo de Usuario")){
				include ('registrarTipoUsuario.php');
			}
			else{
				include ('noAutorizado.php');
			}
			break;
		default :
			include ('home.php');
			break;
	}
}
else if(isset($_GET['modulo'])){
	if(isset($_GET['modulo']) == "administracion"){
		include ('home.php');
	}
}


function autorizado($opcion){
	$arreglo = $_SESSION["PRIVILEGIOS"];
	$encontrado = false;
	foreach ($arreglo as $a){
		if(strcasecmp(trim($a), trim($opcion)) == 0){
			$encontrado = true;
		}
	}
	return $encontrado;
}

?>