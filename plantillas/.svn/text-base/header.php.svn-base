<?php
session_start();
$idusuario =  $_SESSION['usuario'];

$con = @sql_connect();

$sql = "SELECT nombre,apellido,iddepartamento,ultimologin FROM Usuarios WHERE idusuario = ". $idusuario;
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

sql_disconnect();
?>
<table width="100%">
	<tr>
		<td align="left" width="30%"><font size="1"><b>Usuario: <? echo $nombreusuario ?></b></font></td>
		<td align="center" width="50%"><font size="1"><b>Dependencia: <? echo $nombredepartamento ?></b></font></td>
		<td align="right" width="20%"><font size="1"><b> <?php setlocale(LC_TIME, 'es_ES'); echo strftime("%B, %d %Y");?></b></font></td>
	</tr>
</table>