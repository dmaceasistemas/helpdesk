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

require_once('lib.php');

function sql_connect() {
	/*global $HOST, $USER, $PASSWORD, $DATABASE, $PORT;
	echo $HOST; 
	echo $USER; 
	echo $PASSWORD; 
	echo $DATABASE; 
	echo $PORT;
	*/
	//	$connection = @pg_connect("host=$HOST port=$PORT dbname=$DATABASE user=$USER password=$PASSWORD");
	try {
		$connection = @pg_connect("host=localhost port=5432 dbname=helpdesk user=postgres password=123456");
	} catch (Exception $e) {
// 		echo $e->getMessage();
	}
	
	pg_query( $connection  , "SET search_path TO helpdesk;");
	return $connection;
}








function sql_fetch_array($query) {
	return pg_fetch_array($query);
}

function sql_num_rows($rs) {
	$result = pg_num_rows($rs);
	return $result;
}

function sql_query($connection,$query) {
	$result = @pg_query($connection, $query);
	return $result;
}

function sql_disconnect() {
	@ pg_close();
}

function mensaje($titulo, $mensaje){
	echo "\t<table style='text-align: center;border-style: solid;border-color: black;border-width: 1px 1px 1px 1px;font-family: verdana;font-size : 12px;font-weight:bold;background:#ffffad;' " .
			"align='center' width='350px' cellpadding=0 cellspacing=0>\n";
	echo "\t\t<tr>\n";
	echo "\t\t\t<td colspan='2' bgcolor=#000000><center><font color='white' size='2'>$titulo</font></center></td>\n";
	echo "\t\t</tr>\n";
	echo "\t\t</tr>\n";
    echo "\t\t\t<td>&nbsp;<img src='images/error.gif' height='30' title=''/></td>\n";
    echo "\t\t\t<td align=center>$mensaje</td>\n";
    echo "\t\t</tr>\n";
	echo "\t</table>\n";
}

function startUpError($msg, $title) {
	echo "<div id=\"errMsg\" align=\"center\">
				<table>
					<tr>
						<td align=\"center\" bgcolor=\"#CC999\">
							$title
						</td>
					</tr>
					<tr>
						<td bgcolor=\"#CCCCCC\">
							$msg
						</td>
					</tr>
				</div>";
}

function sendMail($mail, $subject, $message, $headers) {
	if (toValidateMail($mail)) {
		mail($mail, $subject, $message, $headers);
	}
}
?>