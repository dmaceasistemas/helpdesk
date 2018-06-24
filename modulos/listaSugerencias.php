<?
$MAX_PAGE_SIZE = 15;
$PRIMERA_PAGINA = 0;
$pagina = 1;
$offset = 0;
$result = sql_query($con, "select count(*) from sugerencias");

$row = sql_fetch_array($result);
$totalregistros =  $row['0'];
$totalpaginas = ceil($totalregistros / $MAX_PAGE_SIZE);
$ULTIMA_PAGINA = ($totalpaginas * $MAX_PAGE_SIZE) - $MAX_PAGE_SIZE;
//if($totalregistros > 0){

if(!empty($_GET['pag'])){
	$pagina = $_GET['pag'];
}
if(!empty($_GET['action'])){
	$action = $_GET['action'];
	if($action == 'next'){
		if(!empty($_GET['offset'])){
			$offset = $_GET['offset'];
		}
	}
	elseif($action == 'back'){
		if(!empty($_GET['offset'])){
			$offset = $_GET['offset'];
		}
	}
	elseif($action == 'first'){
		$offset = $PRIMERA_PAGINA;
	}
	elseif($action == 'last'){
		$offset = $ULTIMA_PAGINA;
	}
}
$sql = "select * from sugerencias order by idsugerencia desc limit $MAX_PAGE_SIZE offset $offset ";

$result = sql_query($con, $sql);

if(!empty($_GET['action'])){
	$string = "&action=".$_GET['action'];
	if(!empty($_GET['offset'])){
		$string .= "&offset=".$_GET['offset']; 
	}
}
	
if(sql_num_rows($result) > 0){
?>
<table border="0" cellpadding="2" cellspacing="1" width="800px" class="tablas" align="center">
	<tr class="header">
		<td align="center" colspan="9">Lista de Reclamos &oacute; Sugerencias</td>
	</tr>
	<tr class="header">
		<td class="tabla-header" width="5%">N&ordm;</td>
		<td class="tabla-header" width="10%">Fecha</td>
		<td class="tabla-header" width="10%">Hora</td>
		<td class="tabla-header" width="15%">Usuario</td>
		<td class="tabla-header" width="*">Reclamo &oacute; Sugerencia</td>
	</tr>
	<?
	while ($row = sql_fetch_array($result)){
	echo "<tr class=\"dark-row\" id=\"efecto\">";
	echo "<td class=\"tabla-text\" align=\"center\">{$row['idsugerencia']}</td>";
		$fecha = $row['fecha'];
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
		
		echo "<td class=\"tabla-text\" align=\"center\">$tok1</td>";
		
		echo "<td class=\"tabla-text\" align=\"center\">$hora:$minuto $a</td>";
		echo "<td class=\"tabla-text\" align=\"center\">".$row['nombre']."</td>";
		echo "<td class=\"tabla-text\" align=\"center\">{$row['sugerencia']}</td>";
		echo "</tr>";
	}
	?>
	<?if($totalpaginas > 1){?>
	<tr class="header">
		<td colspan="9">
		<table width="100%" border="0">
			<tr>
				<td align="left" width="30%">&nbsp;
				<?if($offset != $PRIMERA_PAGINA){?>
					<a class="paginacion" href="?modulo=administracion&accion=25&action=back&offset=<?echo $offset-$MAX_PAGE_SIZE?>&pag=<?echo $pagina-1?>"><img src='styles/<?echo $_SESSION['tema']?>/atras.png' border=0 alt='[Atras]' title='Atras'></a>
					<a class="paginacion" href="?modulo=administracion&accion=25&action=first&pag=<?echo 1?>"><img src='styles/<?echo $_SESSION['tema']?>/primera.png' border=0 alt='[Primera]' title='Primera'></a>
				<?}?>
				</td>
				<td align="center" width="40%">
					<?
						if($totalpaginas > 5){
							$inicio = $pagina-2;
							$fin = $pagina+2;
							
							if($inicio < 1){
								if($inicio == 0 || $inicio == -1){
									$inicio = 1;
									$fin +=2;
								}
								else{
									$inicio = 2;
									$fin +=2;
								}
								
							}
							if($fin > $totalpaginas){
								$fin = $totalpaginas;
								$inicio -=2;
							}
							for($i = $inicio; $i <= $fin; $i++){
								if($pagina != $i){
									echo "&nbsp;<a class=\"paginacion\" href=\"?modulo=administracion&accion=25&action=next&offset=".(($MAX_PAGE_SIZE * $i)-$MAX_PAGE_SIZE)."&pag=$i\">$i</a>";
								}
								else{
									echo ("<font size=1 color='black'><b>&nbsp;$i</b></font>");
								}
							}
						}
						else{
							for($i =1; $i <= $totalpaginas; $i++){
								if($pagina != $i){
									echo "&nbsp;<a class=\"paginacion\" href=\"?modulo=administracion&accion=25&action=next&offset=".(($MAX_PAGE_SIZE * $i)-$MAX_PAGE_SIZE)."&pag=$i\">$i</a>";
								}
								else{
									echo("<font size=1 color='black'><b>&nbsp;$i</b></font>");
								}
							}
						}
						?>
					<font size="1">&nbsp;</font>
				</td>
				<td align="right"  width="30%">&nbsp;
					<?if($offset != $ULTIMA_PAGINA){?>
					<a class="paginacion" href="?modulo=administracion&accion=25&action=last&pag=<?echo $totalpaginas?>"><img src='styles/<?echo $_SESSION['tema']?>/ultima.png' border=0 alt='[&Uacute;ltima]' title='&Uacute;ltima'></a>
					<a class="paginacion" href="?modulo=administracion&accion=25&action=next&offset=<?echo $offset+$MAX_PAGE_SIZE?>&pag=<?echo $pagina+1?>"><img src='styles/<?echo $_SESSION['tema']?>/siguiente.png' border=0 alt='[Siguiente]' title='Siguiente'></a>
					<?}?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<?}?>
</table>
<?}
else{
	?>
<br>
<table width="300px" align="center" cellpadding="0" cellspacing="0"  class="tablas">
	<tr>
		<td width="10%" rowspan=2><font color='white' size='2'><img src='images/info.gif' height='25px'></td>
		<td><font size="2px"><b>No Hay Reclamos ni Sugerencias Registradas</b></td>
	</tr>
</table>
<br><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?}?>