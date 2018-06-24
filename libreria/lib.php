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

require_once('file.php');

$HOST = $DATA_SOURCE['host'];
// echo('host= '+ $HOST);
$USER = $DATA_SOURCE['usuario'];
// echo('usuario= '+ $USER);
$PASSWORD = $DATA_SOURCE['clave'];
// echo($PASSWORD );
$DATABASE = $DATA_SOURCE['basedatos'];
// echo($DATABASE);
$PORT = $DATA_SOURCE['puerto'];
// echo($PORT);
  
	/*Directorio raiz*/
$array = explode('/',$_SERVER['PHP_SELF']);

$URL = '';

$DIR_IMIR = $URL.$array[1].'/';

$DIR_MEDIA = '';

$DIR_LIBS ='./libreria/';

// include($DIR_LIBS.'GlobalFunctions.php/');

include('GlobalFunctions.php');
?>