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

 require_once ('./libreria/lib.php');
 
define('MODULO_DEFECTO', 'autenticacion');
define('LAYOUT_LOGIN', 'plantilla_login.php');
define('LAYOUT_DEFECTO', 'plantilla_helpdesk.php');
define('MODULO_PATH', realpath('./modulos/'));
define('LAYOUT_PATH', realpath('./plantillas/'));
$conf['administracion'] = array ('archivo' => 'administracion.php', 'layout' => LAYOUT_DEFECTO);
$conf['autenticacion'] = array ('archivo' => 'formulario_login.php', 'layout' => LAYOUT_LOGIN);

 	 require 'PHPMailer/PHPMailerAutoload.php';

function enviarRequerimiento ($general,$detalle,$requerimiento,$usuario) {
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = '10.1.9.6';
	$mail->Port = 25;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	//otiii
	$mail->Username = "helpdesk@CVAPEDROCAMEJO.GOB.VE";
	$mail->Password = "123456";

	$mail->setFrom('helpdesk@CVAPEDROCAMEJO.GOB.VE', $usuario);
	$mail->addAddress('oti@CVAPEDROCAMEJO.GOB.VE', 'TECNOLOGIA CENTRAL');
	$mail->Subject = 'Requerimientos ';

	$contenido  = '<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">'.
			'<center><h2>Nuevo Requerimiento</h2></center>'.
			'<div align="left">'.
			'<p><strong> GENERAL:       </strong>'.$general.'</p>'.
			'<p><strong> DETALLADO:     </strong>'.$detalle.'</p>'.
			'<p><strong> REQUERIMIENTO: </strong>'.$requerimiento.'</p>'.
// 			'<p><strong> Usuario: </strong>'.$usuario.'</p>'.
			'</div> </div>';

	$mail->msgHTML($contenido);
// 	$mail->AltBody = 'Aqui va la descripcion de los requerimientos';

	if (!$mail->send()) {
		echo "error al enviar email  a Oti " . $mail->ErrorInfo;
	} else {
		echo "Email enviado a Oti ";
	}
};



function enviarRequerimientoUsuario ($solucion,$email,$nivel) {
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = '10.1.9.6';
	$mail->Port = 25;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "HELPDESK@CVAPEDROCAMEJO.GOB.VE";
	$mail->Password = "123456";
	
	$mail->setFrom('helpdesk@CVAPEDROCAMEJO.GOB.VE', 'Sistema Helpdesk');
	$mail->addAddress($email, 'Usuario');
	$mail->Subject = 'Solucion del Requerimiento ';
		
	$contenido  = '<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">'.
			'<center><h2>Soluci&oacute;n del Requerimiento</h2></center>'.
			'<div align="left">'.
			'<p><strong> Descripcion de la Soluci&oacute;n:       </strong>'.$solucion.'</p>'.
			'<p><strong> Nivel de la Soluci&oacute;n:       	  </strong>'.$nivel.'</p>'.
			'</div> </div>';
			
			$mail->msgHTML($contenido);
			
	if (!$mail->send()) {
	echo "error al enviar email  a Oti " . $mail->ErrorInfo;
						} else {
	echo "Email enviado a Oti ";
}
};

?>
