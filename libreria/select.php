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

$lines = file('/var/www/helpdesk/helpdesk.conf');
//$lines = file('C:\www\helpdesk\install\helpdesk.conf');
foreach ($lines as $line_num => $line) {
        $datos = explode("=", $line);
		$CONFIG[$datos[0]] =$datos[1];
}
	
$HOST = trim($CONFIG['host']);
$USER = trim($CONFIG['usuario']);
$PASSWORD = trim($CONFIG['clave']);
$DATABASE = trim($CONFIG['basedatos']);
$PORT = trim($CONFIG['puerto']);
$CREAR_CUENTA = trim($CONFIG['abrir_cuenta']);
$CERRAR_CUENTA = trim($CONFIG['cerrar_cuenta']);

if(isset($_GET['valor'])){
	$i =0;
	while($i > 100000){
		$i++;
	}
	echo $i;
}


function mensaje($titulo, $mensaje){
	echo "\t<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' " .
			"align='center' width='350px' cellpadding=0 cellspacing=0>\n";
	echo "\t\t<tr>\n";
	echo "\t\t\t<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>$titulo</font></center></td>\n";
	echo "\t\t</tr>\n";
	echo "\t\t</tr>\n";
    echo "\t\t\t<td>&nbsp;<img src='images/alerta.gif' /></td>\n";
    echo "\t\t\t<td align=center>$mensaje</td>\n";
    echo "\t\t</tr>\n";
	echo "\t</table>\n";
}

if(isset($_GET['buscarPendientes'])){
	$idusuario = $_GET['idusuario'];
	$sql = "select * from requerimientos where (estado = 'Nuevo' or estado = 'Pendiente') and idusuario = $idusuario;";
	$con = @pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
	pg_query( $con  , "SET search_path TO helpdesk;");
	$result = @pg_query($con, $sql);
	if(!$result){
		
	}
	else{
		$mensaje = "";
		$filas = @pg_num_rows($result);
		if($filas > 0) {
			$mensaje.= "Este usuario tiene $filas requerimientos abiertos<br>";
			/*while($row = @pg_fetch_array($result)){
				$mensaje.= $row['asunto']."<br>";
			}*/
			for($i = 0; $i < $filas;$i++){
				$asunto = pg_result($result, $i, 'asunto');
				$idrequerimiento = pg_result($result, $i, 'idrequerimiento');
				$mensaje .= " * $asunto N&uacute;mero $idrequerimiento<br>";
			}
			
		}
		@pg_free_result($result);
		if(!empty($mensaje)){
			@mensaje("Informaci&oacute;n", $mensaje);
		}
		
	}
//	echo "$mensaje";
	pg_close();
}

if(isset($_GET['buscarUsuario'])){
	$con = @pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
	pg_query( $con  , "SET search_path TO helpdesk;");
	$cedula = $_GET['cedula'];
	$nombre = $_GET['nombre'];
	$apellido = $_GET['apellido'];
	$actual = $_GET['actual'];
	
	//$sql = "select * from usuarios where cedula ilike '%$cedula%' and nombre ilike '%$nombre%' and apellido ilike '%$apellido%';";
	//$sql = "select idusuario, u.nombre, u.apellido, u.cedula, d.nombre as nombre2, d.iniciales from departamentos as d, usuarios as u where u.iddepartamento = d.iddepartamento and  cedula ilike '%$cedula%' and u.nombre ilike '%$nombre%' and u.apellido ilike '%$apellido%' order by u.cedula;";
	$sql = "select u.idusuario, u.nombre, u.apellido, u.cedula, d.nombre as nombre2, d.iniciales from helpdesk.departamentos as d, helpdesk.usuarios as u where u.iddepartamento = d.iddepartamento and TRIM(TO_CHAR(u.cedula, '99999999')) ILIKE '%%' and u.nombre ilike '%%' and u.apellido ilike '%%' order by u.cedula;";
	echo $sql;
	$result = @pg_query($con, $sql);
	$i = 0;
	echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" width=\"100%\"  align=\"center\">"
	."<tr class=\"header\">"
		. "<td class=\"tabla-header\" width=\"*\">C&eacute;dula</td>"
		. "<td class=\"tabla-header\" width=\"40%\">Nombre</td>"
		. "<td class=\"tabla-header\" width=\"40%\">Apellido</td>"
		. "<td class=\"tabla-header\" width=\"10%\">Departamento</td>"
	. "</tr>"
	. "<tr class=\"header\">"
		. "<td class=\"tabla-header\" width=\"*\"><input type=\"text\" name=\"cedula\" size=\"15\"></td>"
		. "<td class=\"tabla-header\" width=\"40%\"><input type=\"text\" name=\"nombre\" size=\"25\"></td>"
		. "<td class=\"tabla-header\" width=\"40%\"><input type=\"text\" name=\"apellido\" size=\"25\"></td>"
		. "<td class=\"tabla-header\" width=\"10%\">&nbsp;</td>"
	. "</tr>";
	
	
	
	while($row = pg_fetch_array($result)) {
		if($row['cedula'] != 11223344){
			
			if($actual == $row['idusuario']){
				echo "<tr class=\"dark-row2\" id=\"efecto\" onclick=\"marcarUsuario({$row['idusuario']},{$row['cedula']},'{$row['nombre']}','{$row['apellido']}')\">";
			}
			else{
				echo "<tr class=\"dark-row\" id=\"efecto\" onclick=\"marcarUsuario({$row['idusuario']},{$row['cedula']},'{$row['nombre']}','{$row['apellido']}')\">";
			}
			
			echo "<td class=\"tabla-text\" align=\"center\">{$row['cedula']}</td>";
			echo "<td class=\"tabla-text\" align=\"center\">{$row['nombre']}</td>";
			echo "<td class=\"tabla-text\" align=\"center\">{$row['apellido']}</td>";
			echo "<td class=\"tabla-text\" align=\"center\" title=\"{$row['nombre2']}\">{$row['iniciales']}</td>";
			echo "</tr>";
		}
		
		
	}
	echo "</table>";
		pg_close();
}

if(isset($_GET['primerLogin'])){
	$con = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
	pg_query( $con  , "SET search_path TO helpdesk;");
	$sql = "select * from tiposdeusuarios as tu, usuarios as u,  primerlogin as pl where u.idtipousuario = tu.idtipousuario and u.idusuario = pl.idusuario and fechalogin between '%{$_GET['primerLogin']} 00:00:00.000000%' and  '{$_GET['primerLogin']} 23:59:59.999999%' AND (u.idtipousuario = 1 OR u.idtipousuario = 2 OR u.idtipousuario = 6 OR u.idtipousuario = 7 OR u.idtipousuario = 8 OR u.idtipousuario = 9 OR u.idtipousuario = 11) order by u.nombre;";
	$result = pg_query($con, $sql);
	$i = 0;
	echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" width=\"800px\"  align=\"center\">";
	
	echo "<tr class=\"header\">";
	echo "<td class=\"tabla-header\" width=\"15%\">Fecha</td>";
	echo "<td class=\"tabla-header\" width=\"10%\">Hora</td>";
	echo "<td class=\"tabla-header\" width=\"15%\">Nombre</td>";
	echo "<td class=\"tabla-header\" width=\"15%\">Apellido</td>";
	echo "<td class=\"tabla-header\" width=\"30%\">Cargo</td>";
	echo "<td class=\"tabla-header\" width=\"15%\">IP</td>";
	echo "</tr>";
	
	
		while($row = pg_fetch_array($result)) {
			$fecha = $row['fechalogin'];
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
			echo "<tr class=\"dark-row\" id=\"efecto\">";
			echo "<td class=\"tabla-text\" align=\"center\">$tok1</td>";
			echo "<td class=\"tabla-text\" align=\"center\">$hora:$minuto $a</td>";
			echo "<td class=\"tabla-text\" align=\"center\">{$row['nombre']}</td>";
			echo "<td class=\"tabla-text\" align=\"center\">{$row['apellido']}</td>";
			echo "<td class=\"tabla-text\" align=\"center\">{$row['tipodeusuario']}</td>";
			echo "<td class=\"tabla-text\" align=\"center\">{$row['ipmaquina']}</td>";
			echo "</tr>";
			$i++;
		}
		echo "</table>";
		pg_close();
}


if(isset($_GET['listaDireccion'])){
	$id = $_GET['listaDireccion'];
	if($id > 0){
		$query = " and td.idtipodepartamento = $id ";
	}
	$sql = "select * from departamentos as d, tiposdepartamentos as td where td.idtipodepartamento = d.idtipodepartamento $query order by nombre ";
	
	$con = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
	pg_query( $con  , "SET search_path TO helpdesk;");
	$result = pg_query($con, $sql);
	$i = 0;
	echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" width=\"100%\"  align=\"center\">";
		while($row = pg_fetch_array($result)) {
			echo "<tr class=\"dark-row\" id=\"efecto\">";
			echo "<td width=\"5%\" class=\"tabla-text\" align=\"center\"><input type=\"checkbox\" onchange=\"marcarCHKDireccion2($i,{$row['iddepartamento']})\" name=\"iddepartamento\" value=\"{$row['iddepartamento']}\"></td>";
			echo "<td width=\"*\" class=\"tabla-text\" align=\"center\" onclick=\"marcarCHKDireccion($i,{$row['iddepartamento']})\">{$row['nombre']}</td>";
			echo "<td width=\"10%\" class=\"tabla-text\" align=\"center\" onclick=\"marcarCHKDireccion($i,{$row['iddepartamento']})\">{$row['iniciales']}</td>";
			echo "<td width=\"40%\" class=\"tabla-text\" align=\"center\" onclick=\"marcarCHKDireccion($i,{$row['iddepartamento']})\">{$row['tipo']}</td>";
			echo "</tr>";
			$i++;
		}
	echo "</table>";
	pg_close();
}

if(isset($_GET['listaAnalista'])){
	$id = $_GET['listaAnalista'];
	$query = "";
	if($id == 1){
		$query = " and ( u.idtipousuario = 1 OR u.idtipousuario = 2)";
	}
	elseif($id == 6){
		$query = " and ( u.idtipousuario = 6 OR u.idtipousuario = 8)";
	}
	elseif($id == 7){
		$query = " and ( u.idtipousuario = 7 OR u.idtipousuario = 9)";
	}
	elseif($id == 11){
		$query = " and ( u.idtipousuario = 11 OR u.idtipousuario = 12)";
	}
	else{
		$query =  " and (u.idtipousuario = 1 OR u.idtipousuario = 6 OR u.idtipousuario = 7 OR u.idtipousuario = 11)";
	}
	$sql_1 = "select idusuario, nombre, apellido, tipodeusuario from tiposdeusuarios as tu, usuarios as u  where u.idtipousuario = tu.idtipousuario $query order by nombre;";
	$con = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
	pg_query( $con  , "SET search_path TO helpdesk;");
	$result = pg_query($con, $sql_1);
	$i = 0;
	echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" width=\"100%\"  align=\"center\">";
		while($row = pg_fetch_array($result)) {
			echo "<tr class=\"dark-row\" id=\"efecto\">";
			echo "<td width=\"10%\" class=\"tabla-text\" align=\"center\"><input type=\"checkbox\" onchange=\"marcarCHKAnalista2($i,{$row['idusuario']})\" name=\"idanalista\" value=\"{$row['idusuario']}\"></td>";
			echo "<td width=\"20%\" class=\"tabla-text\" align=\"center\" onclick=\"marcarCHKAnalista($i,{$row['idusuario']})\">{$row['nombre']}</td>";
			echo "<td width=\"20%\" class=\"tabla-text\" align=\"center\" onclick=\"marcarCHKAnalista($i,{$row['idusuario']})\">{$row['apellido']}</td>";
			echo "<td width=\"55%\" class=\"tabla-text\" align=\"center\" onclick=\"marcarCHKAnalista($i,{$row['idusuario']})\">{$row['tipodeusuario']}</td>";
			echo "</tr>";
			$i++;
		}
	echo "</table>";
	pg_close();
}


if(isset($_GET['select'])){
	$select = $_GET['select'];
	$id = $_GET['id'];
	if($select == "detallado"){
		$con = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
		pg_query( $con  , "SET search_path TO helpdesk;");
		echo "<select name='tiposdetallados' onchange='formDinamico(this.value);mostrarEjemplos(this.value)'>";
		$a = pg_query($con, "SELECT * FROM tiposdetallados where idtiposgenerales = $id");
		if (pg_num_rows($a) == 0) {
			echo "<option value=0>----------------------------------------Seleccione-----------------------------------------</option>";
		} else {
			echo "<option value=0>----------------------------------------Seleccione-----------------------------------------</option>";
			while ($b = pg_fetch_array($a)) {
				echo "<option value=".$b['idtiposdetallados']." ". (($b['idtiposdetallados'] == $tiporequerimiento) ? "selected" : "").">".htmlspecialchars($b['tiposdetallados'])."</option>";
			}
			echo "</select>";
		}
		pg_close();
	}
	elseif($select == "usuarios"){
		$con = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
		pg_query( $con  , "SET search_path TO helpdesk;");
		$sql = "SELECT * FROM usuarios where iddepartamento = $id order by cedula";
		$a = pg_query($con, $sql);
		echo "<select name='usuario'>";
		if (pg_num_rows($a) == 0) {
			echo "<option value=0>----------------------------------------Seleccione-----------------------------------------</option>";
		} else {
			echo "<option value=0>----------------------------------------Seleccione-----------------------------------------</option>";
			while ($b = pg_fetch_array($a)) {
				echo "<option value=".$b['idusuario']." ". (($b['idusuario'] == $usuario) ? "selected" : "").">".htmlspecialchars($b['cedula']) ." ".htmlspecialchars($b['nombre']) ." " .htmlspecialchars($b['apellido']) ."</option>";

			}
			echo "</select>";
		}
		pg_close();
	}
	elseif($select == "departamentos"){
		$con = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
	pg_query( $con  , "SET search_path TO helpdesk;");
			echo "<select name='departamento' onchange=\"usuarios(this.value)\">";
			$a = pg_query($con, "SELECT * FROM departamentos where idtipodepartamento = $id order by nombre");
			if (pg_num_rows($a) == 0) {
				echo "<option value=0>----------------------------------------Seleccione-----------------------------------------</option>";
			} else {
				echo "<option value=0>----------------------------------------Seleccione-----------------------------------------</option>";
				while ($b = pg_fetch_array($a)) {
					echo "<option value=".$b['iddepartamento']." ". (($b['iddepartamento'] == $departamento) ? "selected" : "").">".htmlspecialchars($b['nombre'])."</option>";
				}
				echo "</select>";
			}
	}
}

if(isset($_GET['formdinamico'])){
	$valor = $_GET['tipo'];
	if($valor == $CREAR_CUENTA){
		echo "<b>Crear cuenta de usuario:</b>";
		echo "<table>\n".
		"<tr>\n<td align='right'><b><i>C&eacute;dula:</i></b></td>\n" .
		"<td><input type='text' name='cedula' size='60' onblur=\"validarCedula(this.value, true)\"></td>\n</tr>\n".
		"<tr>\n<td align='right'><b><i>Nombre:</i></b></td>\n" .
		"<td><input type='text' name='nombre' size='60'></td></tr>".
		"<tr>\n<td align='right'><b><i>Apellido:</i></b></td>\n" .
		"<td><input type='text' name='apellido' size='60'></td></tr>".
		"<tr>\n<td align='right'><b><i>Direcci&oacute;n:</i></b></td>\n<td>";
		################################################################################################
		# Select de Departamentos
		$con =  pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
		pg_query( $con  , "SET search_path TO helpdesk;");

		echo "<select name='departamento'>";
		$a = pg_query($con, "SELECT * FROM departamentos order by nombre");
		if (pg_num_rows($a) == 0) {
			echo "<option value=0>No hay direcciones</option>";
		} else {
			echo "<option value=0>Seleccione una direcci&oacute;n</option>";
			while ($b = pg_fetch_array($a)) {
				echo "<option value=".$b['iddepartamento']." ". (($b['iddepartamento'] == $departamento) ? "selected" : "").">".htmlspecialchars($b['nombre'])."</option>";
			}
			echo "</select>";
		}
		pg_close();
		################################################################################################
		echo "</td></tr>".
		"<tr>\n<td align='right'><b><i>Piso:</b></i></td>\n" .
		"<td><input type='text' name='piso' size='60'></td></tr>".
		"<tr>\n<td align='right'><b><i>Extensi&oacute;n:</b></i></td>\n" .
		"<td><input type='text' name='extension' size='60'></td></tr>".
		"</tbody></table>";
	}
	elseif($valor == $CERRAR_CUENTA){
		echo "<b>Cerrar cuenta de usuario:</b>";
		echo "<table>\n".
		"<tr>\n<td align='right'><b><i>C&eacute;dula:</i></b></td>\n" .
		"<td><input type='text' name='cedula' size='60'></td>\n</tr>\n".
		"<tr>\n<td align='right'><b><i>Nombre:</i></b></td>\n" .
		"<td><input type='text' name='nombre'  size='60'></td></tr>".
		"<tr>\n<td align='right'><b><i>Direcci&oacute;n:</i></b></td>\n<td>";
		################################################################################################
		# Select de Departamentos
		$con =  pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
		pg_query( $con  , "SET search_path TO helpdesk;");
		echo "<select name='departamento'>";
		$a = pg_query($con, "SELECT * FROM departamentos order by nombre");
		if (pg_num_rows($a) == 0) {
			echo "<option value=0>No hay direcciones</option>";
		} else {
			echo "<option value=0>Seleccione una direcci&oacute;n</option>";
			while ($b = pg_fetch_array($a)) {
				echo "<option value=".$b['iddepartamento']." ". (($b['iddepartamento'] == $departamento) ? "selected" : "").">".htmlspecialchars($b['nombre'])."</option>";
			}
			echo "</select>";
		}
		pg_close();
		################################################################################################
		echo "</td></tr>".
		"</tbody></table>";
	}
	else{
		//$url = "historialSoluciones.php?id=".$valor;
		//if($valor > 0 ){openPopUp('$url' ,'Demo','',400,500,'true');
		//	echo "<script>alert('Hola')</script>";
		//}
		echo "<b><i>Requerimiento:</i></b><textarea name=\"requerimiento\" cols=\"65\" rows=\"12\"></textarea>";
	}
}

?>
