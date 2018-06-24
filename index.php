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
include('configuracion.php');
if(!empty($_GET['modulo']))
	$modulo = $_GET['modulo'];
else 
	$modulo = MODULO_DEFECTO;

if(empty($conf[$modulo]))
	$modulo = MODULO_DEFECTO;

$path_layout = LAYOUT_PATH.'/'.$conf[$modulo]['layout'];
$path_modulo = MODULO_PATH.'/'.$conf[$modulo]['archivo'];

if (file_exists($path_layout))
	include( $path_layout );
else
	if (file_exists( $path_modulo ))
    	include( $path_modulo );
	else
    	die('Error al cargar el modulo <b>'.$modulo.'</b>. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
?>