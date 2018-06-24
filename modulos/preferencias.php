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

$sql = "SELECT d.iddepartamento, u.piso, u.email, u.cedula,u.nombre as nombre1, u.apellido,u.extension, u.password, d.nombre as nombre2, p.theme, p.maxfile FROM usuarios as u, departamentos as d, preferencias as p WHERE u.idusuario = p.idusuario and d.iddepartamento = u.iddepartamento and  u.idusuario = $idusuario;";
$result = @sql_query($con, $sql);
if($row = @sql_fetch_array($result)){
	$cedula = $row['cedula'];
	$nombre = $row['nombre1'];
	$apellido = $row['apellido'];
	$extension = $row['extension'];
	$password = $row['password'];
	$nombredepartamento = $row['nombre2'];
	$iddepartamento = $row['iddepartamento'];
	//$idtipoUsuario = $row['idtipousuario'];
	$tema = $row['theme'];
	$email = $row['email'];
	$piso = $row['piso'];
	$_SESSION['tema'] = $row['theme'];
	$registro = $row['maxfile'];
}

if(isset($_POST)){
	$formulario = $_POST['formulario'];
	if($formulario == "1"){
		
		$cedula = $_POST['cedula'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$extension = $_POST['extension'];
		$iddepartamento = $_POST['departamento'];
		//$idtipoUsuario = $_POST['tipoUsuario'];
		$email = $_POST['email'];
		$piso = $_POST['piso'];
		
		$mensaje = "";
		if(empty($nombre)){
			$mensaje .= "No puede dejar su nombre en blanco<br/>";
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
		if(empty($iddepartamento)){
			$mensaje .= "Debe selecciona la direcci&oacute;n<br/>";
		}
		/*
		if(empty($email)){
			$mensaje .= "debe indicar su correo electronico<br/>";
		}*/
		if($password1 != $password2){
			$mensaje .= "Los password son diferentes<br/>";
		}
		
		
		if(!empty($mensaje)){
			mensaje("No se pudo cambiar el perfil",$mensaje);
		}
		else{
			$sql ="update usuarios set piso = '$piso', nombre = '$nombre', apellido = '$apellido', password = '$password1', extension = '$extension', email = '$email', iddepartamento = $iddepartamento where cedula = $cedula";
			@sql_query($con, $sql);
			echo "<script>location.href='?modulo=administracion&accion=3'</script>";
		}
		
	}
	else if($formulario == "2"){
		$tema = $_POST['tema'];
		//$registro = $_POST['registros'];
		$mensaje = "";
		/*if(empty($registro)){
			$mensaje = "No puede dejar la cantidad de registros a mostrar vacio<br/>";
		}
		elseif (intval($registro) == 0) {
			$mensaje = "La cantidad debe ser escrita en n&uacute;mero";
		}
		*/
		if(!empty($mensaje)){
			mensaje("No se pudo guardar las preferencias", $mensaje);
		}
		else{
			$sql = "update preferencias set theme = '$tema', maxfile = $registro where idusuario = $idusuario";
			@sql_query($con, $sql);
			echo "<script>location.href='?modulo=administracion&accion=3'</script>";
		}
	}
}

?>
<table width="90%" align="center">
	<tr>
		<td valign="top" align="center" width="90%">
			<form action="" method="post">
	<input type="hidden" name="formulario" value="1">
	<table border="0" cellpadding="2" cellspacing="1" width="500px" align="center" class="tablas">
		<tr class='header'>
			<td colspan="2">Modificar perfil de usuario</td>
		</tr>
		<tr class='dark-row'>
			<td colspan="2" align="center"><font color='red' size='1'>&nbsp; * Datos Obligatorios&nbsp;</font></td>
		</tr>
		<tr class='dark-row'>
			<td align="right" width="45%"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>C&eacute;dula:</i></b></td>
			<td width="55%">
				<input type="hidden" name="cedula" value="<?echo $cedula?>">
				<font size="2"><?echo $cedula?></font>
			</td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Nombre:</i></b></td>
			<td><input type="text" name="nombre" size="40" maxlength="40" value="<?echo $nombre?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Apellido:</i></b></td>
			<td><input type="text" name="apellido" size="40" maxlength="40" value="<?echo $apellido?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><b><i>Extensi&oacute;n:</i></b></td>
			<td><input type="text" name="extension" size="40" maxlength="40" value="<?echo $extension?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><b><i>Piso:</i></b></td>
			<td><input type="text" name="piso" size="40" maxlength="40" value="<?echo $piso?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><b><i>Correo:</i></b></td>
			<td><input type="text" name="email" size="40" maxlength="40" value="<?echo $email?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Password:</i></b></td>
			<td><input type="password" name="password1" size="40" maxlength="40" value="<?echo $password?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Confirmar Password:</i></b></td>
			<td><input type="password" name="password2" size="40" maxlength="40" value="<?echo $password?>"></td>
		</tr>
		<tr class='dark-row'>
			<td align="right"><b><i>Departamento:</i></b></td>
			<td>
				<font size="2"><?//echo $nombredepartamento?></font>
				<?
				$con =  sql_connect();
				echo "<select name='departamento'>";
				$a = sql_query($con, "SELECT * FROM departamentos order by nombre");
				if (sql_num_rows($a) == 0) {
					echo "<option value=0>No hay direcciones</option>";
				} else {
					echo "<option value=0>Seleccione una direcci&oacute;n</option>";
					while ($b = sql_fetch_array($a)) {
						echo "<option value=".$b['iddepartamento']." ". (($b['iddepartamento'] == $iddepartamento) ? "selected" : "").">".htmlspecialchars($b['nombre'])."</option>";
					}
					echo "</select>";
				}
				?>
			</td>
		</tr>
		<!--<tr class='dark-row'>
			<td align="right"><b><i>Tipo de Usuario:</i></b></td>
			<td align="left">
				<font size="2">
				<?/*

				
				echo "<select name='tipoUsuario'>";
	$a = sql_query($con, "SELECT * FROM tiposdeusuarios order by tipodeusuario");
	if (sql_num_rows($a) == 0) {
		echo "<option value=0>No hay tipos definidos</option>";
	} else {
		echo "<option value=0>Seleccione un tipo de usuario</option>";
		while ($b = sql_fetch_array($a)) {
			echo "<option value=".$b['idtipousuario']." ". (($b['idtipousuario'] == $idtipoUsuario) ? "selected" : "").">".htmlspecialchars($b['tipodeusuario'])."</option>";
		}
		echo "</select>";
	}
				*/?></font>
			</td>
		</tr>-->
		<tr class='header'>
		<td colspan="2" align="center">
			<input type="submit" value="Guardar">
		</td>
	</tr>
	</table>
</form>
			
		</td>
		<td valign="top" align="center" width="*">
			<form action="" method="post">
	<input type="hidden" name="formulario" value="2">
	<table border="0" cellpadding="2" cellspacing="1" width="200px" align="center" class="tablas">
		<tr class='header'>
			<td colspan="2">Preferencias</td>
		</tr>
		<tr class='dark-row'>
			<td class="tabla-text" align="right"><b><i>Tema:</i></b></td>
			<td>
			<?
			
			
			/*
			$temas = array("Amarillo","Azul","Gris");
			 
			echo "<select name='tema'>";
			#echo "<option value='0'>...</option>";
			foreach ($temas as $actual){
				if($tema == $actual){
					echo "<option selected>".$actual."</option>";
				}
				else{
					echo "<option>".$actual."</option>";
				}
			}
			echo "</select>";
		*/
	echo "<select name='tema'>";
	$handle = opendir('styles/');
	while ($file = readdir($handle)){
	   if(is_dir($file) && $file != "." && $file != "..")
	      $sdirs[] = $file;
	      elseif(is_file($file) && $file != basename($PHP_SELF))
	      $sfiles[] = $file;
	      
	      if(strpos($file,".") === false){
	      	if($tema == $file){
				echo "<option selected>".$file."</option>";
			}
			else{
				echo "<option>".$file."</option>";	
			}
	      	
	      }
	      
		  
	}
	echo "</select>";
	?>
			
			</td>
		</tr>
		<!--
		<tr class='dark-row'>
			<td class="tabla-text"align="right"><b><i>Registros:</i></b></td>
			<td>
				<input type="text" name="registros" value="<?echo $registro?>" size="5" maxlength="2">
			</td>
		</tr>
		-->
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
