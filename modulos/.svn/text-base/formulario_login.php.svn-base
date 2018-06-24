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
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
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
<body>
<?
if(!empty ($_POST)) {
	$valido = true;
	$username = $_POST['cedula'];
	$password = $_POST['password'];
	$mensaje = "";
	echo  "prueba";
	if (!empty ($username) AND !empty ($password)) {
		echo  "prueba222";
		echo @sql_connect();
		$con = @sql_connect();
		echo  $con;
		echo  @sql_connect();
		$sql = "SELECT * FROM usuarios WHERE cedula='$username' AND password='$password'";
		$result = @sql_query($con, $sql);
		$count = @sql_num_rows($result);
		if ($count <= 0) {
			$mensaje = "Nombre de usuario o contrase&ntilde;a no v&aacute;lidos";
			//mensaje("Error de login",$mensaje);
			//echo "<br/>";
			$valido = false;
		} else {
			if($row = sql_fetch_array($result)){
				$idusuario = $row['idusuario'];
				$_SESSION['usuario'] = $idusuario;
				$_SESSION['ultimologin'] = $row['ultimologin'];
				$idtipousuario = $row['idtipousuario'];
				
				if($row['activo'] == 'f'){
					$valido = false;
					$mensaje.="Usuario bloqueado.<br> Por favor cominiquese con el administrador.";
				}
				else{
					//Guardo la fecha y hora del primer login
					if($idtipousuario == 3 || $idtipousuario == 5 || $idtipousuario == 10){
						
					}
					else{ //($idtipousuario == 1 || $idtipousuario == 2 || $idtipousuario == 6 || $idtipousuario == 7 || $idtipousuario == 8 || $idtipousuario == 9 || $idtipousuario == 11 || $idtipousuario == 12)
						sql_query($con, "BEGIN");
						$sql_1 = "SELECT COUNT(*) FROM primerlogin WHERE idusuario = $idusuario AND fechalogin BETWEEN '".date("Y-m-d")." 0:00:00.000' AND '".date("Y-m-d")." 23:59:59.999999';";
						$rs1 = sql_query($con, $sql_1);
						$row1 = sql_fetch_array($rs1);
						
						if($row1['0'] == 0){
							$sql_2 ="INSERT INTO primerlogin (idusuario,fechalogin,ipmaquina) VALUES ($idusuario,CURRENT_TIMESTAMP,'{$_SERVER['REMOTE_ADDR']}');";
							$rs2 = sql_query($con, $sql_2);
						}
						
						sql_query($con, "COMMIT");
					}
					
					$sql_3 = "update usuarios set ultimologin = CURRENT_TIMESTAMP where idusuario = $idusuario;";
					$rs3 = sql_query($con, $sql_3);
					
					//Datos de preferencias de Usuario
					$sql = "select * from preferencias where idusuario = $idusuario";
					$result = sql_query($con,$sql);
					if($row = sql_fetch_array($result)){
						$_SESSION['tema'] = $row['theme'];
					}
					echo "<script>location.href='?modulo=administracion'</script>";
				}
			}
		}
	} else {
		if (empty ($username)){
			$mensaje .= "Debe indicar un nombre de usuario<br />";
		}
		if (empty ($password)){
			$mensaje .= "Debe indicar una contrase&ntilde;a<br />";
		}
		
		$valido = false;
	}
}
if (!$valido) {
?>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="728px"  bgcolor="white" id="login" background="images/fondo_PC.png">
			<tr>
				<td>
					<img src="images/banner_nuevo.png">
				</td>
			</tr>
			<tr>
				<td align="right" id="texto">
					<br><br>
						Bienvenido al sistema de HelpDesk, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
						ingrese su c&eacute;dula y contrase&ntilde;a. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<br><br><br/>
				</td>
			</tr>
			 <tr>
                <td align="center" valign="middle" colspan="2">
                <?
                if(!empty($mensaje)){
                	mensaje("Error de login", $mensaje);
                	echo "<br>";
                }
                ?>
                <form action="?modulo=autenticacion" method='POST' autocomplete=off name="loginform">
                <input type="hidden" name="SOLICITUD" value="login">
                    <table cellpadding="3">
                        <tr>
                            <td align="right" id="texto">C&eacute;dula:</td>
                            <td><input id="input_text" type="text" name="cedula" size="15" maxlength="10" value="<? echo $username?>"></td>
                        </tr>
                        <tr>
                            <td align="right" id="texto">Contrase&ntilde;a:</td>
                            <td><input id="input_text" type="password" name="password" size="15" maxlength="20" value="<? echo $password?>" ></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right"><input id="boton" type='submit' value="Entrar" id="miboton"></td>
                        </tr>
                    </table>
                </form>
                </td>
            </tr>
            <tr>
				<td>
					<br><br><br><br><br><br><br>
				</td>
			</tr>
             <tr>
				<td>
					<img src="images/dti_PC.png">
				</td>
			</tr>
        </table>
<?
}
sql_disconnect();
?>
<script>
	document.loginform.cedula.focus();
</script>
</body>
</html>
