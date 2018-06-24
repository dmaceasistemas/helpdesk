<?
#######################################################################################################
## Me traigo los datos de la conexión de un archivo plano
#######################################################################################################
//$lines = file('C:\www\helpdesk\install\helpdesk.conf');
$lines = file('/var/www/helpdesk/helpdesk.conf');
//print_r($lines);

foreach ($lines as $line_num => $line) {
	if(strpos($line,"#") === 0){
	//echo("Comentario....."."<br>");
	}
	elseif (strlen(trim($line)) == 0){
	echo "Linea vacia";
	}
	else{
		$datos = explode("=", $line);
		$DATA_SOURCE[$datos[0]] =$datos[1];
	}
        
}
//echo "<br>";
//print_r($DATA_SOURCE);
?>
