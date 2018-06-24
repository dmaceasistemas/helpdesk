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
require_once ('./libreria/lib.php');
$idusuario = $_SESSION['usuario'];
if(isset($_GET['id'])){
	$con = sql_connect();
	$REQUERIMIENTO_ACTUAL =  $_GET['id'];
	$sql = "select u.nombre as nombre1, u.apellido, d.nombre as nombre2, d.piso, r.asunto,r.estado, r.mantenimiento, r.fechacreacion from requerimientos as r, usuarios as u, departamentos as d where u.idusuario = r.idusuario and d.iddepartamento = u.iddepartamento and r.idrequerimiento = $REQUERIMIENTO_ACTUAL";
	$result = sql_query($con, $sql);
	if($rs = sql_fetch_array($result)){
?>
<html>
	<head>
		<style>
			.texto{
				font-size: 8pt;
				font-stretch: normal;
				font-weight: bold;
			}
			.texto2{
				font-size: 16pt;
				font-weight: bold;
				font-variant: small-caps;
			}
			#contenido {
				background-color: #feffff;
				border: solid;
				border-color: green;
				/*border-width: 1px;*/
			}
		</style>
	</head><!--  -->
	<body onload="javascript:window.print()">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" id="contenido">
			<tr>
				<td width="15%">
					<img src="images/mat.bmp" height="50px">
				</td>
				<td align="left" valign="top">
					<table border="0" cellpadding="0" cellspacing="0" width="100%" align="left">
						<tr>
							<td class="texto">Ministerio de Agricultura y Tierras</td>
						</tr>
						<tr>
							<td class="texto">Oficina de Administraci&oacute;n y servicios</td>
						</tr>
						<tr>
							<td class="texto">Direcci&oacute;n de tecnolog&iacute;a de la informaci&oacute;n</td>
						</tr>
					</table>
				</td>
				<td width="25%">
					<table cellpadding="0" cellspacing="0" border="1" width="100%">
						<tr>
							<td width="30%" class="texto" align="center">1.N&uacute;mero</td>
							<td width="40%" class="texto" colspan="3" align="center">2.Fecha</td>
							<td width="30%" class="texto" align="center">3.Hora</td>
						</tr>
						<tr>
							<td align='center' class='texto'><?echo $REQUERIMIENTO_ACTUAL?></td>
							<?
							$fecha = $rs['fechacreacion'];
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
							$d = strtok($tok1,"-");
							$b = strtok("-");
							$c = strtok("-");
							?>
							<td align='center' class='texto'><?echo $c ?></td>
							<td align='center' class='texto'><?echo $b?></td>
							<td align='center' class='texto'><?echo $d?></td>
							<td align='center' class='texto'><?echo $hora.":".$minuto.$a?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="center" class="texto2">Solicitud de Requerimiento</td>
			</tr>
			<tr>
				<?
				$sql = "SELECT nombre,apellido,iddepartamento FROM Usuarios WHERE idusuario = ". $idusuario;
				$result = @sql_query($con, $sql);
				if($row = @sql_fetch_array($result)){
					$nombreusuario = $row['nombre'] . " " . $row['apellido'];
					$iddepartamento = $row['iddepartamento'];
				}
				?>
				<td colspan="3" class="texto">4.Analista: <?echo $nombreusuario?></td>
			</tr>
			<tr>
				<td colspan="3">
					<table cellpadding="0" cellspacing="0" border="1" width="100%">
						<tr>
							<td width="20%" align="center" class="texto">5.Usuario</td>
							<td width="20%" align="center" class="texto">6.Unidad</td>
							<td width="10%" align="center" class="texto">7.Piso</td>
							<td width="50%" align="center" class="texto">8.Breve descripci&oacute;n del prerequerimiento</td>
						</tr>
						<tr>
							<td align='center' class='texto' width="20%"><?echo $rs['nombre1']." ".$rs['apellido']?></td>
							<td align='center' class='texto' width="20%"><?echo $rs['nombre2'] ?></td>
							<td align='center' class='texto' width="10%"><?echo $rs['piso'] ?></td>
							<td align='center' class='texto' width="50%"><?echo $rs['asunto']?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" bgcolor="green"></td>
			</tr>
			<tr>
				<td colspan="3" bgcolor="green"></td>
			</tr>
			<tr>
				<td colspan="3" bgcolor="green"></td>
			</tr>
			 <tr>
			 	<td colspan="3">
			 		<table width="100%" cellpadding="0" cellspacing="0" border="1">
			 			<tr>
						 	<td width="40%" align="center" class="texto">9.Datos del solicitante</td>
						 	<td width="20%" align="center" class="texto">9.3.Sello de la unidad solicitante</td>
						 	<td width="20%" align="center" class="texto">10.Nombre y firma del analista</td>
						 	<td width="20%" align="center" class="texto" rowspan="3">11.Fecha de la revisi&oacute;n
						 		<table width="100%" align="center">
						 			<tr>
						 				<td>
						 					<table cellpadding="0" cellspacing="0" border="1" width="100%">
						 						<tr>
						 							<td>&nbsp;</td>
						 							<td>&nbsp;</td>
						 							<td>&nbsp;</td>
						 						</tr>
						 					</table>
						 				</td>
						 			</tr>
						 			<tr>
						 				<td align="center" class="texto">11.1.Hora</td>
						 			</tr>
						 			<tr>
						 				<td align="left">
							 				<table cellpadding="0" cellspacing="0" border="1" width="70%" align="center">
						 						<tr>
						 							<td>&nbsp;</td>
						 							<td>&nbsp;</td>
						 						</tr>
						 					</table>
						 				</td>
						 			</tr>
						 		</table>
						 	</td>
						 </tr>
						 <tr>
						 	<td class="texto">9.1.Nombre</td>
						 	<td rowspan="2">&nbsp;</td>
						 	<td rowspan="2">&nbsp;</td>
						 </tr>
						 <tr>
						 	<td class="texto">9.2.Firma</td>
						 </tr>
			 		</table>
			 	</td>
			 </tr>
			<tr>
				<td colspan="3" bgcolor="green"></td>
			</tr>
			<tr>
				<td colspan="3" bgcolor="green"></td>
			</tr>
			<tr>
				<td colspan="3" bgcolor="green"></td>
			</tr>
			<tr>
				<td colspan="3">
					<table width="100%" cellpadding="0" cellspacing="0" border="1">
					<tr>
					 	<td width="30%" align="center" class="texto">13.Tipo de Mantenimiento</td>
					 	<td width="30%" align="center" class="texto">14.Estatus de la solicitud</td>
					 	<td width="40%" align="center" class="texto">15.Observaciones</td>
					 </tr>
					 <tr>
					 	<td class="texto">
					 	<?
					 	$mantenimiento = $rs['mantenimiento'];
					 	if($mantenimiento == "Correctivo"){
					 		echo "<input type=\"checkbox\" checked=checked>Correctivo<br>";
					 		echo "<input type=\"checkbox\">Preventivo<br>";
					 	}
					 	else{
					 		echo "<input type=\"checkbox\">Correctivo<br>";
					 		echo "<input type=\"checkbox\" checked=checked>Preventivo<br>";
					 	}
					 	?>
					 		
					 	</td>
					 	<td class="texto">
					 		<input type="checkbox">Pendiente<br>
						 	<input type="checkbox">Cerrado<br>
						 	<input type="checkbox">Bloqueado<br>
					 	</td>
					 	<td>&nbsp;</td>
					 </tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
<?
	}
}
sql_disconnect();
?>