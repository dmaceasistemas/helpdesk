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
$con = sql_connect();
$idusuario =  $_SESSION['usuario'];
$sql = "SELECT idtipousuario FROM Usuarios WHERE idusuario = ". $idusuario;
$result = @sql_query($con, $sql);
if($row = @sql_fetch_array($result)){
	$idtipousuario = $row['idtipousuario'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
		<meta http-equiv="refresh" content="600">
		<link rel="shortcut icon" href="images/logo_pequeño.png">
		<?$tema = $_SESSION['tema'];?>
		<link rel="stylesheet" href="styles/<?echo $tema?>/estilo.css" />
		<link rel="stylesheet" href="styles/plantilla.css" />
		<link rel="stylesheet" href="styles/<?echo $tema?>/calendar.css" />
		<link rel="stylesheet" href="styles/themes/layouts/big.css" />
		<script type="text/javascript" src="javascript/src/utils.js"></script>
		<script type="text/javascript" src="javascript/src/calendar.js"></script>
		<script type="text/javascript" src="javascript/src/calendar-setup.js"></script>
		<script type="text/javascript" src="javascript/lang/calendar-sp.js"></script>
		<script type="text/javascript" src="javascript/javascript.js"></script>
		<title>Sistema de Helpdesk</title>
	</head>
	<?
	if(isset($_GET['accion'])){
		$accion = $_GET['accion'];
	}// onLoad=window.setTimeout("location.href=''",600000)
	?>
	<body id="<?echo "A".$accion?>">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" id="contenido">
			<tbody>
				<tr>
					<td colspan="2">
						<!-- Cabecera Gobierno Bolivariano -->
						<table border="0" width="100%" cellpadding="1" cellspacing="0">
							<tbody>
								<tr>
									<td width="55px" align="left" valign="top">
										<img src="images/ocho_estrellas.png" alt="bandera">
									</td>
									<td width="140px" align="left" valign="middle">
										<font class="texto11">Gobierno</font>
										<font class="texto21">Bolivariano</font><br/>
										<font class="texto11">de Venezuela</font>
									</td>
									<td width="15px" align="left" valign="bottom">
										<img src="images/barraVertical.gif" alt="">
									</td>
									<td  width="150px" align="left" valign="middle">
										<font class="texto1">Ministerio del Poder Popular</font><br />
										<font class="texto2">Para la Agricultura y Tierras</font>
									</td>
									<td width="15px" align="left" valign="bottom">
										<img src="images/barraVertical.gif" alt="">
									</td>
									<td  width="200px" align="left" valign="middle">
										<font class="texto1">Empresa Socialista <br />Pedro Camejo</font>
									</td>
									<td width="*">&nbsp;</td>
									<td width="83px" valign="bottom">
										<img src="images/todos.png" alt="todos" width="80px" heigth="50">
									</td>
								</tr>
								<tr>
									<td colspan="8" background="images/barraHorizontal.png"></td>
								</tr>
							</tbody>
						</table>
						<!-- Fin de Cabecera Gobierno -->
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<!-- Cabecera MAT -->
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td align="left">
										<img src="images/banner_PC.png" alt="bannerMAT" width="640" height="40"> 
									</td>
									<td background="images/banner_MAT1.png" width="100%">
										
									</td>
								</tr>
							</tbody>
						</table>
						<!-- Fin Cabecera MAT -->
					</td>
				</tr>
				<tr>
					<td width="15%" valign="top" align="left" class="plan">
						<!-- Menu MAT -->
						<? include("menu_reloaded.php"); ?>
						<!-- Fin de Menu MAT -->
					</td>
					<td width="*" valign="top">
						<!-- Menu de opciones generales -->
						<table width="100%" cellpadding="0" cellspacing="0" border="0" >
							<tbody>
								<tr>
									<td width="25%" class="plan">
									<?
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
									
									?>
									
									<font class="texto2">Bienvenido:</font>&nbsp;&nbsp;<font class="texto1"><? echo $nombreusuario ?></font>
									</td>
									<td width="20%" class="plan" align="center">
									<font class="texto2">
									<?
									switch ($accion) {
									case 1 :
										echo "Principal";
										break;
									case 2 :
										echo "Ayuda";
										break;
									case 3 :
										echo "Preferencias";
										break;
									case 4 :
										echo "B&uacute;squeda General";
										break;
									case 6 :
										echo "Requerimientos Resueltos";
										break;
									case 7 :
										echo "Nuevo Requerimiento";
										break;
									case 8 :
										echo "Seguimiento";
										break;
									case 9 :
										echo "Historial";
										break;
									case 10 :
										echo "Asignar Requerimiento";
										break;
									case 11 :
										echo "Reasignar Requerimiento";
										break;
									case 12 :
										echo "Desbloquear Requerimiento";
										break;
									case 13 :
										echo "Requerimiento T&eacute;lefonico";
										break;
									case 14 :
										echo "Mis Nuevos";
										break;
									case 15 :
										echo "Mis Pendientes";
										break;
									case 16 :
										echo "";
										break;
									case 17 :
										echo "Detalles del Requerimiento";
										break;
									case 18 :
										echo "";
										break;
									case 19 :
										echo "Mi Historial";
										break;
									case 20 :
										echo "Mensajes de Helpdesk";
										break;
									case 21 :
										echo "Cuentas de Usuario";
										break;
									case 22 :
										echo "Registro de Usuario";
										break;
									case 23 :
										echo "Sugerencias";
										break;
									case 24 :
										echo "Estadisticas";
										break;
									case 25 :
										echo "Lista de Sugerencias";
										break;
									case 26 :
										echo "Reportes";
										break;
									case 27 :
										echo "Primer Login";
										break;
									default :
										echo "Principal";
										break;
								}
									
									?>
									</font>
									</td>
									<td width="55%">
									<?include("menu2.php")?>
									</td>
								</tr>
								</tbody>
							</table>
							<!-- Fin de Menu de opciones generales -->
							<table width="100%" cellpadding="0" cellspacing="0" border="0" align="left">
							<tbody>
								<tr>
									<td align="left">
									<?include_once("modulos/mostrarAlerta.php")?>
									<!-- Contenido Dinamico -->
									
									<?
									if(empty($_SESSION['usuario'])){
										echo "<script>location.href='index.php'</script>";
									}
									if (file_exists($path_modulo))
										@include ($path_modulo);
									else
										echo ('Error al cargar el m&oacute;dulo <b>'.$modulo.'</b>. No
						    			existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
									?>
									<br>
										
										
									</td>
								</tr>
							</tbody>
						</table>
						
					</td>
				</tr>
				<tr>
					<td colspan="2" class="plan">
						<div id="version">
							HelpDesk V1.5
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
<?sql_disconnect() ?>
