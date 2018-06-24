/******************************************************************************
* Software: Sistema de Helpdesk                                                *
* Version:  1.0                                                                *
* Date:     17-03-2006                                                         *
* Author:   Jose Luis Estevez                                                  *
* License:                                                                     *
* Note:     Validaciones, Ajax, Otros                                          *
* Company:  Ministerio de Agriculura y Tierras                                 *
* Web:      www.mat.gob.ve                                                     *
*******************************************************************************/

var CREAR_CUENTA = 26;
var CERRAR_CUENTA = 27;

function objetus() {
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp
}

function buscarUsuarioAsincrono(cedula, nombre, apellido, actual){
	objeto = objetus();
	values_send = "buscarUsuario=true&cedula="+cedula+"&nombre="+nombre+"&apellido="+apellido+"&actual="+actual;
	target = "buscarUsuarios";
	URL = "libreria/select.php?";
	objeto.open("GET",URL+values_send,true);
    objeto.onreadystatechange=function() {
    	if(objeto.readyState==1){
    		//document.getElementById(target).innerHTML= "<img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font>";
    	}
		if (objeto.readyState==4){
			if(objeto.status==200){
				document.getElementById(target).innerHTML= objeto.responseText;
				buscarPendientes(actual);
			}
		}
	}
objeto.send(null);
}


function buscarPendientes(idusuario){
	objeto1 = objetus();
	values_send = "buscarPendientes=1&idusuario="+idusuario;
	target = "mensaje";
	URL = "libreria/select.php?";
	objeto1.open("GET",URL+values_send,true);
    objeto1.onreadystatechange=function() {
    	//if(objeto.readyState==1){
    		//opener.document.getElementById(target).innerHTML= "<img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font>";
    	//}
		if (objeto1.readyState==4){
			if(objeto1.status==200){
				opener.document.getElementById(target).innerHTML= objeto1.responseText;
				//alert(objeto1.responseText);
			}
		}
	}
objeto1.send(null);
}

function validarTelefonico(){
	var idusuario = document.telefonico.idusuario.value;
	var detallado = document.telefonico.tiposdetallados.value;
	var general = document.telefonico.tiposgenerales.value;
	var requerimiento = document.telefonico.requerimiento.value;
	var valido = false;
	var mensaje = "";
	
	
	if(idusuario == 0){
		mensaje += "Seleccione el usuario<br/>";
	}
	if(general == 0){
		mensaje += "Seleccione el tipo de requerimiento general<br/>";
	}
	if(detallado == 0){
		mensaje += "Seleccione el tipo de requerimiento detallado<br/>";
	}
	if(requerimiento.length == 0){
		mensaje += "Ingrese la descripci&oacute;n del requerimiento<br/>";
		document.telefonico.requerimiento.focus();
	}
	
	if(mensaje.length > 0){
		 imprimirMensaje(mensaje, "Faltan datos en el registro", "error");
	}
	else{
		valido = true;
	}
	
	return valido;
}

function marcarUsuario(idusuario,cedula, nombre, apellido){
	opener.document.telefonico.idusuario.value=idusuario;
	opener.document.getElementById("datosUsuario").innerHTML=" "+nombre+" "+apellido+" Cedula: "+cedula;
	buscarUsuarioAsincrono(cedula, nombre, apellido, idusuario);
}

function buscarUsuarios(valor){
	if(valor == 0){
		var cedula = document.buscarUsuarioForm.cedula.value;
		var nombre = document.buscarUsuarioForm.nombre.value;
		var apellido = document.buscarUsuarioForm.apellido.value;
		buscarUsuarioAsincrono(cedula, nombre, apellido);
		
	}
	else{
		buscarUsuarioAsincrono("", "", "");
	}
	
	
}


function filtrarBusqueda(){
	if(document.reporteForm.tipo.value == 1){
		openPopUp('filtrarAnalistas.php','Demo','',650,500,'true');
	}
	else if(document.reporteForm.tipo.value == 2){
		openPopUp('filtrarCoordinaciones.php','Demo','',250,180,'true');
	}
	else if(document.reporteForm.tipo.value == 3){
		openPopUp('filtrarDirecciones.php','Demo','',750,500,'true');
	}
	
}

function primerLogin(fecha){
	objeto = objetus();
	values_send = "primerLogin="+fecha;
	target = "primerLogin";
	URL = "libreria/select.php?";
	objeto.open("GET",URL+"&"+values_send,true);
    objeto.onreadystatechange=function() {
    	if(objeto.readyState==1){
    		document.getElementById(target).innerHTML= "<img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font>";
    	}
		if (objeto.readyState==4){
			if(objeto.status==200){
				document.getElementById(target).innerHTML= objeto.responseText;
			}
		}
	}
objeto.send(null);
}

function listaAnalista(id){
	objeto = objetus();
	values_send = "listaAnalista="+id;
	target = "listaAnalista";
	URL = "libreria/select.php?";
	objeto.open("GET",URL+"&"+values_send,true);
    objeto.onreadystatechange=function() {
    	if(objeto.readyState==1){
    		document.getElementById(target).innerHTML= "<img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font>";
    	}
		if (objeto.readyState==4){
			if(objeto.status==200){
				document.getElementById(target).innerHTML= objeto.responseText;
			}
		}
	}
objeto.send(null);
}

function listaDireccion(id){
	objeto = objetus();
	values_send = "listaDireccion="+id;
	target = "listaDireccion";
	URL = "libreria/select.php?";
	objeto.open("GET",URL+"&"+values_send,true);
    objeto.onreadystatechange=function() {
    	if(objeto.readyState==1){
    		document.getElementById(target).innerHTML= "<img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font>";
    	}
		if (objeto.readyState==4){
			if(objeto.status==200){
				document.getElementById(target).innerHTML= objeto.responseText;
			}
		}
	}
objeto.send(null);
}

/*
function registrarCambiosCHKAnalista(){
	var cadena = "";
	for(var j = 0; j < document.lista.idanalista.length ; j++){
		if(document.lista.idanalista[j].checked == true){
			document.lista.idanalista[j].checked = false;
			cadena+=document.lista.idanalista[j].value;
		}
	}
	alert(cadena);
	//opener.document.reporteForm.analistas.value = "";
}

function seleccionarTodosCHKAnalista(){
	registrarCambiosCHKAnalista();
	for(var j = 0; j < document.lista.idanalista.length ; j++){
	//	if(document.lista.idanalista[j].checked == true){
	//		document.lista.idanalista[j].checked = false;
		//}
		//else{
			document.lista.idanalista[j].checked = true;
		//}
	}
	
}
*/

function marcarCHKCoordinacion(i,id){
	if(document.lista.idcoordinacion[i].checked == true){
		document.lista.idcoordinacion[i].checked = false;
	}
	else{
		document.lista.idcoordinacion[i].checked = true;
	}
	opener.document.reporteForm.filtro.value = "";
	for(var j = 0; j < document.lista.idcoordinacion.length ; j++){
		if(document.lista.idcoordinacion[j].checked == true){
			if(opener.document.reporteForm.filtro.value.length > 0){
				opener.document.reporteForm.filtro.value += ",";
			}
			opener.document.reporteForm.filtro.value += document.lista.idcoordinacion[j].value;
		}
	}
}

function marcarCHKCoordinacion2(i,id){
	opener.document.reporteForm.filtro.value = "";
	for(var j = 0; j < document.lista.idcoordinacion.length ; j++){
		if(document.lista.idcoordinacion[j].checked == true){
			if(opener.document.reporteForm.filtro.value.length > 0){
				opener.document.reporteForm.filtro.value += ",";
			}
			opener.document.reporteForm.filtro.value += document.lista.idcoordinacion[j].value;
		}
	}
}


function marcarCHKDireccion(i,id){
	if(document.lista.iddepartamento[i].checked == true){
		document.lista.iddepartamento[i].checked = false;
	}
	else{
		document.lista.iddepartamento[i].checked = true;
	}
	opener.document.reporteForm.filtro.value = "";
	for(var j = 0; j < document.lista.iddepartamento.length ; j++){
		if(document.lista.iddepartamento[j].checked == true){
			if(opener.document.reporteForm.filtro.value.length > 0){
				opener.document.reporteForm.filtro.value += ",";
			}
			opener.document.reporteForm.filtro.value += document.lista.iddepartamento[j].value;
		}
	}
}

function marcarCHKDireccion2(i,id){
	opener.document.reporteForm.filtro.value = "";
	for(var j = 0; j < document.lista.iddepartamento.length ; j++){
		if(document.lista.iddepartamento[j].checked == true){
			if(opener.document.reporteForm.filtro.value.length > 0){
				opener.document.reporteForm.filtro.value += ",";
			}
			opener.document.reporteForm.filtro.value += document.lista.iddepartamento[j].value;
		}
	}
}


function marcarCHKAnalista(i,id){
	
	//alert("ID:"+id+"\n NUM:"+i);
	if(document.lista.idanalista[i].checked == true){
		document.lista.idanalista[i].checked = false;
	}
	else{
		document.lista.idanalista[i].checked = true;
	}
	opener.document.reporteForm.filtro.value = "";
	for(var j = 0; j < document.lista.idanalista.length ; j++){
		if(document.lista.idanalista[j].checked == true){
			if(opener.document.reporteForm.filtro.value.length > 0){
				opener.document.reporteForm.filtro.value += ",";
			}
			opener.document.reporteForm.filtro.value += document.lista.idanalista[j].value;
		}
	}
	
	
	//registrarCambiosCHKAnalista();
	//alert(document.lista.idanalista.length);
}

function marcarCHKAnalista2(i,id){
	opener.document.reporteForm.filtro.value = "";
	for(var j = 0; j < document.lista.idanalista.length ; j++){
		if(document.lista.idanalista[j].checked == true){
			if(opener.document.reporteForm.filtro.value.length > 0){
				opener.document.reporteForm.filtro.value += ",";
			}
			opener.document.reporteForm.filtro.value += document.lista.idanalista[j].value;
		}
	}
	
	
	//registrarCambiosCHKAnalista();
	//alert(document.lista.idanalista.length);
}








function validarNotaDeSeguimiento(){
	var nota = document.seguimiento.nota.value;
	var valido = true;
	if(nota.length == 0){
		imprimirMensaje("Debe agregar una nota de seguimiento", "Error", "error");
		document.seguimiento.nota.focus();
		valido = false;
	}
	
	return valido;
}

function validarAnular(){
	var valido = true;
	if(document.anular.notadecancelar.value.length == 0){
		valido = false;
		imprimirMensaje2("Debe indicar porque desea anular este requerimiento","Error", "error");
		document.anular.notadecancelar.focus();
	}
	else{
		valido = confirm('Por favor confirme que desea anular el requerimiento');
	}
	
	return valido;
}

function imprimirMensaje(mensaje, titulo, tipo){
	document.getElementById('mensaje').innerHTML= "\t<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' "
		+ "align='center' width='350px' cellpadding=0 cellspacing=0>\n"
		+ "\t\t<tr>\n"
		+ "\t\t\t<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>"+titulo+"</font></center></td>\n"
		+ "\t\t</tr>\n"
		+ "\t\t</tr>\n"
	    + "\t\t\t<td>&nbsp;<img src='images/"+tipo+".gif' title=''/></td>\n"
	    + "\t\t\t<td align=center>"+mensaje+"</td>\n"
	    + "\t\t</tr>\n"
		+ "\t</table>\n";
	valido = false;
}


function imprimirMensaje2(mensaje, titulo, tipo){
	document.getElementById('mensaje2').innerHTML= "\t<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' "
		+ "align='center' width='350px' cellpadding=0 cellspacing=0>\n"
		+ "\t\t<tr>\n"
		+ "\t\t\t<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>"+titulo+"</font></center></td>\n"
		+ "\t\t</tr>\n"
		+ "\t\t</tr>\n"
	    + "\t\t\t<td>&nbsp;<img src='images/"+tipo+".gif' title=''/></td>\n"
	    + "\t\t\t<td align=center>"+mensaje+"</td>\n"
	    + "\t\t</tr>\n"
		+ "\t</table>\n";
	valido = false;
}

function validarSugerencia(){
	var valido = true;
	var sugerencia = document.sugerenciaform.sugerencia.value;
	if(sugerencia.length == 0){
		imprimirMensaje("Ingrese el reclamo o la sugerencia", "Sugerencia vacia", "error");
		valido = false;
	}
	return valido;
}


function validarBusqueda(){
	valido = true;
	idrequerimiento = document.busquedaForm.idrequerimiento.value;
	if(idrequerimiento.length > 0){
		if(isNaN(idrequerimiento)){
			alert("El n?mero de orden no es valido !!!,\n verifique el n?mero ingresado.");
			valido = false;
		}
	}
	return valido;
}

function validarCedula(cedula, formulario){
	var mensaje = "";
	if(cedula.length <= 0){
		//mensaje += "Ingrese la c&eacute;dula del usuario<br/>";
	}
	else{
		if(isNaN(cedula)){
			//mensaje += "La c&eacute;dula debe ser n&uacute;merica<br/>";
		}
		else{
			objeto = objetus();
			values_send = "validar=cedula&cedula="+cedula;
			target = "mensaje";
			URL = "libreria/validar.php?";
			objeto.open("GET",URL+"&"+values_send,true);
		    objeto.onreadystatechange=function() {
		    	if(objeto.readyState==1){
		    		document.getElementById(target).innerHTML= "<center><img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font></center>";
		    	}
				if (objeto.readyState==4){
					if(objeto.status==200){
						if(objeto.responseText.length > 0){
							mensaje = objeto.responseText;

								document.getElementById(target).innerHTML = "\t<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' "
								+ "align='center' width='350px' cellpadding=0 cellspacing=0>\n"
								+ "\t\t<tr>\n"
								+ "\t\t\t<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>"+"C&eacute;dula no valida"+"</font></center></td>\n"
								+ "\t\t</tr>\n"
								+ "\t\t</tr>\n"
							    + "\t\t\t<td>&nbsp;<img src='images/error.gif' height='30' title=''/></td>\n"
							    + "\t\t\t<td align=center>"+ mensaje+"</td>\n"
							    + "\t\t</tr>\n"
								+ "\t</table>\n";	
						}
						else{
							document.getElementById(target).innerHTML = "";
						}
					}
				}
				
			}
			objeto.send(null);
			return mensaje;
		}
	}
}

function usuarios(id){
	objeto = objetus();
	values_send = "select=usuarios&id="+id;
	target = "usuarios";
	URL = "libreria/select.php?";
	objeto.open("GET",URL+"&"+values_send,true);
    objeto.onreadystatechange=function() {
    	if(objeto.readyState==1){
    		document.getElementById(target).innerHTML= "<img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font>";
    	}
		if (objeto.readyState==4){
			if(objeto.status==200){
				document.getElementById(target).innerHTML= objeto.responseText;
			}
		}
	}
objeto.send(null);
}

function departamentos(id){
	objeto = objetus();
	values_send = "select=departamentos&id="+id;
	target = "departamentos";
	URL = "libreria/select.php?";
	objeto.open("GET",URL+"&"+values_send,true);
    objeto.onreadystatechange=function() {
    	if(objeto.readyState==1){
    		document.getElementById(target).innerHTML= "<img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font>";
    	}
		if (objeto.readyState==4){
			if(objeto.status==200){
				document.getElementById(target).innerHTML= objeto.responseText;
			}
		}
	}
objeto.send(null);
}

function detallados(id){
	objeto = objetus();
	values_send = "select=detallado&id="+id;
	target = "detallado";
	URL = "libreria/select.php?";
	objeto.open("GET",URL+"&"+values_send,true);
    objeto.onreadystatechange=function() {
    	if(objeto.readyState==1){
    		document.getElementById(target).innerHTML= "<img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font>";
    	}
		if (objeto.readyState==4){
			if(objeto.status==200){
				document.getElementById(target).innerHTML= objeto.responseText;
			}
		}
	}
objeto.send(null);
}
/*
 *Formulario dinamico para cambiar crear cuenta de usuario
*/
/*
function formDinamico(tipo){
	objeto = objetus();
	values_send = "formdinamico=detallado&tipo="+tipo;
	target = "formdinamico";
	URL = "libreria/select.php?";
	objeto.open("GET",URL+"&"+values_send,true);
    objeto.onreadystatechange=function() {
    	if(objeto.readyState==1){
    		document.getElementById(target).innerHTML= "<img src='images/indicator.gif'>&nbsp;<font size='2'><b>cargando</b></font>";
    	}
		if (objeto.readyState==4){
			if(objeto.status==200){
				document.getElementById(target).innerHTML= objeto.responseText;
			}
		}
	}
objeto.send(null);
}
*/
function mostrarEjemplos(valor){
	var url = "historialSoluciones.php?id="+valor;
	/*if(valor > 0 ){
		if(valor == CREAR_CUENTA || valor == CERRAR_CUENTA){
			//Aqui se puede mostrar una ayuda para el usuario
		}
		else{
			//Muestro las soluciones a requerimientos anteriores
			openPopUp(url ,'Demo','',400,200,"true");
		}
	}*/
}

function nuevoRequerimiento(){
	var valido = true;
	var tipo1 = document.nuevo.tiposgenerales.value;
	var tipo2 = document.nuevo.tiposdetallados.value;
	//Variables del formulario de requerimiento
	var requerimiento = "";
	//Variables del formulario de usuarios
	var cedula = "";
	var nombre = "";
	var apellido = "";
	var direccion = 0;
	var extension = "";
	var piso = "";
	
	var mensaje = "";
		
	if(tipo1 <= 0){
		mensaje += "Seleccione el tipo general de requerimiento<br/>";
	}
	if(tipo2 <= 0){
		mensaje += "Seleccione el tipo detallado de requerimiento<br/>";
	}

	if(tipo2 == CREAR_CUENTA){
		//Formulario de Nuevo Usuario
		cedula = document.nuevo.cedula.value;
		nombre = document.nuevo.nombre.value;
		apellido = document.nuevo.apellido.value;
		direccion = document.nuevo.departamento.value;
		extension = document.nuevo.extension.value;
		piso = document.nuevo.piso.value;
		if(cedula.length <= 0){
			mensaje += "Ingrese la c&eacute;dula del usuario<br/>";
		}
		else{
			if(isNaN(cedula)){
				mensaje += "La c&eacute;dula debe ser n&uacute;merica<br/>";
			}
			else{
				//mensaje += validarCedula(cedula, false);
				
			}
		}
		if(nombre.length <= 0){
			mensaje += "Ingrese el nombre del usuario<br/>";
		}
		if(apellido.length <= 0){
			mensaje += "Ingrese el apellido del usuario<br/>";
		}
		if(direccion == 0){
			mensaje += "Ingrese la direcci&oacute;n del usuario<br/>";
		}
		if(extension.length <= 0){
			mensaje += "Ingrese la extensi&oacute;n del usuario<br/>";
		}
		if(piso.length <= 0){
			mensaje += "Ingrese el piso<br/>";
		}
	}
	else if(tipo2 == CERRAR_CUENTA){
		//Formulario de cerrar cuenta de Usuario
		cedula = document.nuevo.cedula.value;
		nombre = document.nuevo.nombre.value;
		direccion = document.nuevo.departamento.value;
		
		if(cedula.length <= 0){
			mensaje += "Ingrese la c&eacute;dula del usuario<br/>";
		}
		else{
			if(isNaN(cedula)){
				mensaje += "La c&eacute;dula debe ser n&uacute;merica<br/>";
			} 
		}
		if(nombre.length <= 0){
			mensaje += "Ingrese en nombre del usuario<br/>";
		}
		if(direccion == 0){
			mensaje += "Ingrese la direcci&oacute;n del usuario<br/>";
		}
	}
	else{
		requerimiento = document.nuevo.requerimiento.value;
		if(requerimiento.length <= 0){
			mensaje += "Ingrese la descripci&oacute;n del requerimiento<br/>";
		}
		else if(requerimiento.length > 2040){
			mensaje += "La descripci&oacute;n del requerimiento es muy grande<br/>";
		}
	}
	
	if(mensaje.length > 0){
		document.getElementById("mensaje").innerHTML = "\t<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' "
			+ "align='center' width='350px' cellpadding=0 cellspacing=0>\n"
			+ "\t\t<tr>\n"
			+ "\t\t\t<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>"+"No se pudo crear el requerimiento"+"</font></center></td>\n"
			+ "\t\t</tr>\n"
			+ "\t\t</tr>\n"
		    + "\t\t\t<td>&nbsp;<img src='images/error.gif' height='30' title=''/></td>\n"
		    + "\t\t\t<td align=center>"+mensaje+"</td>\n"
		    + "\t\t</tr>\n"
			+ "\t</table>\n";
		valido = false;
	}
	
	return valido;
}


function pendienteForm(estado){
	//alert(estado);
	if(document.pendiente.estado.value == "Bloqueado"){
		document.getElementById("titulo").innerHTML = "<font color='red' size='1'>&nbsp; * &nbsp;</font><b>Nota de Bloqueo:</b>";
		document.getElementById("campo").innerHTML = "<textarea name='nota' rows='3' cols='30'></textarea>";
		document.getElementById("titulo2").innerHTML = "";
		document.getElementById("campo2").innerHTML = "";
	}
	else if(document.pendiente.estado.value == "Cerrado"){
		document.getElementById("titulo").innerHTML = "<font color='red' size='1'>&nbsp; * &nbsp;</font><b>Soluci&oacute;n:</b>";
		document.getElementById("campo").innerHTML = "<textarea name='solucion' rows='3' cols='30'></textarea>";
		document.getElementById("titulo2").innerHTML = "<font color='red' size='1'>&nbsp; * &nbsp;</font><b>Nivel de Soluci&oacute;n:</b>";
		document.getElementById("campo2").innerHTML = "<select name='nivel'><option value='0'>--asignar--</option><option>Usuario</option><option>Analista</option></select>";
	}
	else{
		document.getElementById("titulo").innerHTML = "";
		document.getElementById("campo").innerHTML = "";
		document.getElementById("titulo2").innerHTML = "";
		document.getElementById("campo2").innerHTML = "";
	}

}

function validarPendiente(){
	var estado = document.pendiente.estado.value;
	var mantenimiento = document.pendiente.mantenimiento.value;
	var diagnostico = document.pendiente.diagnostico.value;
	var observacion = document.pendiente.observacion.value;
	var valido = true;
	var mensaje = "";
	
	if(estado == "Cerrado"){
		var solucion = document.pendiente.solucion.value;
		var nivel = document.pendiente.nivel.value;
		
		if(mantenimiento == 0){
			valido = false;
			mensaje += "No se puede guardar sin establecer el tipo de mantenimiento<br/>";
		}
		if(solucion.length <= 0){
			valido = false;
			mensaje += "Ingrese la soluci&oacute;n para cerrar el requerimiento<br/>";
		}
		if(nivel == 0){
			valido = false;
			mensaje += "Ingrese el nivel de la soluci&oacute;n<br/>";
		}
		if(diagnostico.length == 0){
			valido = false;
			mensaje += "Ingrese el diagnostico<br/>";
		}
		
		if(mensaje.length > 0){
			document.getElementById("mensaje").innerHTML = "\t<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' "
				+ "align='center' width='350px' cellpadding=0 cellspacing=0>\n"
				+ "\t\t<tr>\n"
				+ "\t\t\t<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>"+"No se pudo cerrar el requerimiento"+"</font></center></td>\n"
				+ "\t\t</tr>\n"
				+ "\t\t</tr>\n"
			    + "\t\t\t<td>&nbsp;<img src='images/error.gif' height='30' title=''/></td>\n"
			    + "\t\t\t<td align=center>"+mensaje+"</td>\n"
			    + "\t\t</tr>\n"
				+ "\t</table>\n";
		}
		
	}
	else if(estado == "Bloqueado"){
		var nota = document.pendiente.nota.value;
		if(mantenimiento == 0){
			valido = false;
			mensaje += "No se puede guardar sin establecer el tipo de mantenimiento<br/>";
		}
		if(nota.length <= 0){
			valido = false;
			mensaje += "Ingrese la nota de bloqueo<br/>";
		}
		if(diagnostico.length == 0){
			valido = false;
			mensaje += "Ingrese el diagnostico<br/>";
		}
		if(mensaje.length > 0){
			document.getElementById("mensaje").innerHTML = "\t<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' "
				+ "align='center' width='350px' cellpadding=0 cellspacing=0>\n"
				+ "\t\t<tr>\n"
				+ "\t\t\t<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>"+"No se pudo bloquear el requerimiento"+"</font></center></td>\n"
				+ "\t\t</tr>\n"
				+ "\t\t</tr>\n"
			    + "\t\t\t<td>&nbsp;<img src='images/error.gif' height='30' title=''/></td>\n"
			    + "\t\t\t<td align=center>"+mensaje+"</td>\n"
			    + "\t\t</tr>\n"
				+ "\t</table>\n";
		}
	}
	else{
		if(mantenimiento == 0){
			valido = false;
			mensaje += "No se puede guardar sin establecer el tipo de mantenimiento<br/>";
		}
		if(estado == 0){
			valido = false;
			mensaje += "Ingrese el estado del requerimiento<br/>";
		}
		if(diagnostico.length == 0){
			valido = false;
			mensaje += "Ingrese el diagnostico<br/>";
		}
		if(mensaje.length > 0){
			document.getElementById("mensaje").innerHTML = "\t<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' "
				+ "align='center' width='350px' cellpadding=0 cellspacing=0>\n"
				+ "\t\t<tr>\n"
				+ "\t\t\t<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>"+"No se pudo guardar el requerimiento"+"</font></center></td>\n"
				+ "\t\t</tr>\n"
				+ "\t\t</tr>\n"
			    + "\t\t\t<td>&nbsp;<img src='images/error.gif' height='30' title=''/></td>\n"
			    + "\t\t\t<td align=center>"+mensaje+"</td>\n"
			    + "\t\t</tr>\n"
				+ "\t</table>\n";
		}
	}
	return valido;
}




function marcar(nombre, id){
	if(document.tabla.analistas.value.length == 0){
		document.tabla.analistas.value="";
		document.tabla.analistas.value=nombre;
		document.tabla.analistasid.value="";
		document.tabla.analistasid.value=id;
	}
	else{
		
		nombreAnalista = document.tabla.analistas.value;
		idAnalista = document.tabla.analistasid.value;
		
		var array = nombreAnalista.split(", ");
		
		if(nombreAnalista.indexOf(nombre) != -1){
			//deseleccionar
		}
		else{
			document.tabla.analistas.value+= ", "+nombre;
			document.tabla.analistasid.value+=", "+id;
		}
		//alert(nombreAnalista.substr(0,nombre.length+2));
		/*for(var i = 0; i < array.length; i++){
			//alert(array[i]);
		}
		var array2 = idAnalista.split(", ");
		for(var i = 0; i < array2.length; i++){
			//alert(array2[i]);			
		}
		*/
		
	}
}

function mostrarSimilares(){
	
	var a = "<table width='100%' border='0'><tr><td>Problemas similares</td></tr><tr><td>"+
		"<a href='javascript:;'>un problema similar</a></td></tr><tr><td align='center'><font size='1'>"+
		"&lt;&lt;anterior&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;siguiente&gt;&gt;</font></td>"+
		"</tr></table>";
		document.getElementById('similares').innerHTML = a;
	//alert("ok");
}

function openPopUp(theURL,winName,features, myWidth, myHeight, isCenter) {
	if(window.screen)if(isCenter)if(isCenter=="true"){
		var myLeft = (screen.width-myWidth)/2;
		var myTop = (screen.height-myHeight)/2;
		features+=(features!='')?',':'';
		features+=',left='+myLeft+',top='+myTop;
	}
	return window.open(theURL,winName,features+((features!='')?',':'')+'resizable=no, scrollbars=yes, width='+myWidth+',height='+myHeight);
}

