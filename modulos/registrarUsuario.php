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

if(isset($_POST['registrarUsuario'])){
echo $_POST['registrarUsuario'];
		$cedula = $_POST['cedula'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$extension = $_POST['extension'];
		$departamento = $_POST['departamento'];
		$tipoUsuario = $_POST['tipoUsuario'];
		$email = $_POST['email'];
		$piso = $_POST['piso'];
		$mensaje = "";
		if(empty($nombre)){
			$mensaje .= "No puede dejar su nombre en blanco<br/>";
		}
		if(empty($cedula)){
			$mensaje .= "No puede dejar su c&eacute;dula en blanco<br/>";
		}
		else if (intval($cedula) == 0) {
			$mensaje .= "La c&eacute;dula debe ser n&uacute;merica<br/>";
		}
		if(empty($apellido)){
			$mensaje .= "No puede dejar su apellido en blanco<br/>";
		}
		if(empty($password1)){
			$mensaje .= "No puede dejar el password en blanco<br/>";
		}
		if(empty($password2)){
			$mensaje .= "Debe confirmar el password<br/>";
		}
		if(empty($departamento)){
			$mensaje .= "Seleccione la direcci&oacute;n del usuario<br/>";
		}
		if(empty($tipoUsuario)){
			$mensaje .= "Seleccione el tipo del usuario<br/>";
		}
		/*if(empty($email)){
			$mensaje .= "debe indicar su correo electronico<br/>";
		}*/
		if($password1 != $password2){
			$mensaje .= "Los password son diferentes<br/>";
		}
		if(!empty($mensaje)){
			mensaje("No se pudo cambiar el perfil",$mensaje);
		}
		else{
			$sql ="INSERT INTO Usuarios (activo,nombre,apellido,idcargousuario,cedula,iddepartamento,password,ultimologin,idtipousuario,extension, email, piso) VALUES ('t','$nombre', '$apellido',9,$cedula,$departamento,'$password1',NULL,$tipoUsuario,'$extension', '$email', '$piso');";
			@sql_query($con, $sql);
			echo "<script>location.href='?modulo=administracion&accion=20&msg=4'</script>";
		}

}

?>
<div id="mensaje"></div>
<table width="90%" align="center">
<tr>
<td valign="top" align="center" width="90%">
<form action="?modulo=administracion&accion=22" method="post">
<input type="hidden" name="registrarUsuario" value="1">
	<table border="0" cellpadding="2" cellspacing="1" width="600px" align="center" class="tablas">
		<tr class='header'>
			<td colspan="2">Registrar Usuario</td>
		</tr>
		<tr class='dark-row'>
			<td colspan="2" align="center"><font color='red' size='1'>&nbsp; * Datos Obligatorios&nbsp;</font></td>
		</tr>
		<tr class='dark-row'>
			<td align="right" width="45%"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>C&eacute;dula:</i></b></td>
			<td width="55%" align="left">
				<input type="text" name="cedula" size="40" maxlength="40" value="<?echo $cedula?>" onblur="validarCedula(this.value)">
			</td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Nombre:</i></b></td>
			<td align="left"><input type="text" name="nombre" size="40" maxlength="40" value="<?echo $nombre?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Apellido:</i></b></td>
			<td align="left"><input type="text" name="apellido" size="40" maxlength="40" value="<?echo $apellido?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><b><i>Extensi&oacute;n:</i></b></td>
			<td align="left"><input type="text" name="extension" size="40" maxlength="40" value="<?echo $extension?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><b><i>Piso:</i></b></td>
			<td align="left"><input type="text" name="piso" size="40" maxlength="40" value="<?echo $piso?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><b><i>Correo:</i></b></td>
			<td align="left"><input type="text" name="email" size="40" maxlength="40" value="<?echo $email?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Password:</i></b></td>
			<td align="left"><input type="password" name="password1" size="40" maxlength="40" value="<?echo ($password == "" ? "123456" : $password) ?>">&nbsp;<font size='1'><b><i>(123456)</b></i></font></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Confirmar Password:</i></b></td>
			<td align="left"><input type="password" name="password2" size="40" maxlength="40" value= <?echo $password =="" ?"123456":$password ?>>&nbsp;<font size='1'><b><i>(123456)</b></i></font></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><b><i>Departamento:</i></b></td>
			<td align="left">
				<font size="2">
				<?
				echo "<select name='departamento'>";
	$a = sql_query($con, "SELECT * FROM departamentos order by nombre");
	if (sql_num_rows($a) == 0) {
		echo "<option value=0>No hay direcciones</option>";
	} else {
		echo "<option value=0>Seleccione una direcci&oacute;n</option>";
		while ($b = sql_fetch_array($a)) {
			echo "<option value=".$b['iddepartamento']." ". (($b['iddepartamento'] == $departamento) ? "selected" : "").">".htmlspecialchars($b['nombre'])."</option>";
		}
		echo "</select>";
	}
				?></font>
			</td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><b><i>Tipo de Usuario:</i></b></td>
			<td align="left">
				<font size="2">
				<?
				echo "<select name='tipoUsuario'>";
	$a = sql_query($con, "SELECT * FROM tiposdeusuarios order by tipodeusuario");
	if (sql_num_rows($a) == 0) {
		echo "<option value=0>No hay tipos definidos</option>";
	} else {
		echo "<option value=0>Seleccione un tipo de usuario</option>";
		while ($b = sql_fetch_array($a)) {
			echo "<option value=".$b['idtipousuario']." ". (($b['idtipousuario'] == $tipoUsuario) ? "selected" : "").">".htmlspecialchars($b['tipodeusuario'])."</option>";
		}
		echo "</select>";
	}
				?></font>
			</td>
		</tr>
		<tr class='header'>
		<td colspan="2" align="center">
			<input type="submit" value="Guardar">
		</td>
	</tr>
	</table>
</form>
			
		</td>
	</tr>
</table>
<?
sql_disconnect();
?>