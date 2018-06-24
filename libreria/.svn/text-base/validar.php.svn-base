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

$lines = file('/var/www/helpdesk/helpdesk.conf');
foreach ($lines as $line_num => $line) {
        $datos = explode("=", $line);
		$DATA_SOURCE[$datos[0]] =$datos[1];
}
	
$HOST = $DATA_SOURCE['host'];
$USER = $DATA_SOURCE['usuario'];
$PASSWORD = $DATA_SOURCE['clave'];
$DATABASE = $DATA_SOURCE['basedatos'];
$PORT = $DATA_SOURCE['puerto'];

if(isset($_GET['validar'])){
	$validar = $_GET['validar'];
	if($validar == "cedula"){
		$cedula = $_GET['cedula'];
		$con = pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
		pg_query( $con  , "SET search_path TO helpdesk;");
		$result = pg_query($con, "select u.nombre, u.apellido, d.nombre as nombre1 from usuarios as u, departamentos as d where u.iddepartamento = d.iddepartamento and cedula = $cedula ;");
		if(pg_num_rows($result) > 0){
			echo "La c&eacute;dula se encuentra registrada en el sistema. ";
			if ($row = pg_fetch_array($result)) {
				echo "Esta c&eacute;dula pertenece a : {$row['nombre']} {$row['apellido']}  de {$row['nombre1']}";
			}
		}
		pg_close($con);
	}
}
	
?>
