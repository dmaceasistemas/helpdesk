<br>
<script>
function detectarflash(){
//********cambiar los siguientes datos*************
flashpage = "flash.htm"
upgradepage = "plugin-flash.htm"
nonflashpage = "html.htm"
cantdetectpage = "no-se-pudo-detectar-plugin.html"
//**************************************************
noautoinstall = ""
if(navigator.appName == "Microsoft Internet Explorer" &&
(navigator.appVersion.indexOf("Mac") != -1 ||
navigator.appVersion.indexOf("3.1") != -1)){
noautoinstall = "true";
}
if (navigator.appName == "Microsoft Internet Explorer" &&
noautoinstall != "true"){
//window.location=flashpage;
return true;
}
else if(navigator.plugins){
if(navigator.plugins["Shockwave Flash"]){
//window.location=flashpage;
return true;
}
else if(navigator.plugins["Shockwave Flash 2.0"]){
//window.location=upgradepage;
return false;
}
else{
//window.location=nonflashpage;
return false;
}
}
else {
//window.location=cantdetectpage;
return false;
}
}
function cargarGrafico2(){
	if(detectarflash()){
		openPopUp('graficos/grafico2_flash.php','1','',400,300,'true');
	}
	else{
		openPopUp('graficos/grafico2.php','1','',370,250,'true');
	}

	
}
</script>
<table border="0" align="center" cellpadding="1" cellspacing="1" width="350px">
	<tr>
		<!--<td width="175px">
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="cargarGrafico2();"><img src="images/requerimietos.png" width="150px"></a></center>
		</td>-->
		<td width="175px">
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php','Demo','',750,550,'true');"><img src="images/analistas1.png" width="150px"></a></center>
		</td>
		<td width="175px">
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=11','Demo','',750,550,'true');"><img src="images/analistas1.png" width="150px"></a></center>
		</td>
	</tr>
	<tr>
		<!--<td>
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico2.php','Demo','',370,250,'true');">Graficos de Requerimientos</a><br></center>
		</td>-->
		<td>
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=1','Demo','',750,550,'true');">Analistas de Soporte</a><br></center>
		</td>
		<td>
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=11','Demo','',750,550,'true');">Analistas de Telecomunicaciones</a><br></center>
		</td>
	</tr>
	<tr>
		<td>
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=6','Demo','',750,550,'true');"><img src="images/analistas1.png" width="150px"></a></center>
		</td>
		<td>
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=7','Demo','',750,550,'true');"><img src="images/analistas1.png" width="150px"></a></center>
		</td>
	</tr>
	<tr>
		<td>
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=6','Demo','',750,550,'true');">Analistas de Redes</a><br></center>
		</td>
		<td>
			<center><a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=7','Demo','',750,550,'true');">Analistas de Desarrollo</a><br></center>
		</td>
	</tr>
</table>
<!--
<a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico2.php','Demo','',370,250,'true');">Graficos de Requerimientos</a><br>
<a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=1','Demo','',750,550,'true');">Analistas de Soporte</a><br>
<a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=6','Demo','',750,550,'true');">Analistas de Redes, Telefonia y Telecomunicaciones</a><br>
<a class="download" href="javascript:;" title="Ver estadisticas de requerimientos" onclick="openPopUp('graficos/grafico1.php?tipo=7','Demo','',750,550,'true');">Analistas de Desarrollo</a><br>-->