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
$idusuario =  $_SESSION['usuario'];
$con = @sql_connect();


/*
{
			$sql ="INSERT INTO Usuarios (activo,nombre,apellido,idcargousuario,cedula,iddepartamento,password,ultimologin,idtipousuario,extension, email, piso) VALUES ('t','$nombre', '$apellido',9,$cedula,$departamento,'$password1',NULL,$tipoUsuario,'$extension', '$email', '$piso');";
			@sql_query($con, $sql);
			echo "<script>location.href='?modulo=administracion&accion=28&msg=4'</script>";
		}
elseif {
	if ($_REQUEST['nuevo']){
		?>
        <script language="javascript" type="text/javascript">
			document.guardar.disabled = false;
			document.modificar.disabled = false;
		</script>
        <?
	
	}
	elseif {
	
	
	}


}
*/
?>
<div id="mensaje"></div>
<table width="90%" align="center">
<tr>
<td valign="top" align="center" width="90%">
<form name="formulario" action="?modulo=administracion&accion=28" method="post">
  <table border="0" cellpadding="2" cellspacing="1" width="600px" align="center" class="tablas">
	  <!--DWLayoutTable-->
		<tr class='header'>
			<td colspan="2">Registrar Tipo de Usuario</td>
		</tr>
		<tr class='dark-row'>
			<td colspan="2" align="center"><font color='red' size='1'>&nbsp; * Datos Obligatorios&nbsp;</font></td>
		</tr>
        
		<tr class='dark-row'>
			<td align="right" width="264"><font color='red' size='1'>&nbsp; * &nbsp;</font><b><i>Nombre:</i></b></td>
			<td width="325" align="left"><select name="cmbnombre" id="cmbnombre" style="visibility:hidden" > </select>
            <input type="text" disabled="disabled" name="nombre" style="visibility:visible" id="nombre" size="40" maxlength="40">			</td>
		</tr>
		<tr class='dark-row'>
			<td height="26" valign="top">			  <div align="right">
			  <span style="font-weight: bold; font-style: italic">Nuevo Requerimiento			  </span>
			  <input type="checkbox" disabled="disabled" name="nuevo_requerimiento" id="nuevo_requerimiento" value="checkbox" />			
		    </div></td>
			<td valign="top"><label>
			  <input type="checkbox" disabled="disabled" name="seguimiento" id="seguimiento" value="checkbox" />
			  <span style="font-weight: bold; font-style: italic">Seguimiento</span></label></td>
		</tr>
		<tr class='dark-row'>
		  <td height="26" valign="top" style="text-align:right"><label>
		    <span style="font-weight: bold; font-style: italic">Historial</span>
	          <input type="checkbox" disabled="disabled" name="historial" id="historial" value="checkbox" />	          </label>	        </td>
		  <td valign="top"><label>
		    <input type="checkbox" disabled="disabled" name="mis_pendientes" id="mis_pendientes" value="checkbox" />
		    <span style="font-weight: bold; font-style: italic">Mis Pendientes </span></label></td>
		  </tr>
		<tr class='dark-row'>
		  <td height="26" valign="top"><div align="right">
		    <label>
		    <span style="font-weight: bold; font-style: italic">Telef&oacute;nico		    </span>
		    <input type="checkbox" disabled="disabled" name="telefonico" id="telefonico" value="checkbox" />
		    </label>
		  </div></td>
		  <td valign="top"><label>
		    <input type="checkbox" disabled="disabled" name="mi_historial" id="mi_historial" value="checkbox" />
		    <span style="font-weight: bold; font-style: italic">Mi Historial		    </span></label></td>
		  </tr>
		<tr class='dark-row'>
		  <td height="26" valign="top"><div align="right">
		    <label>
		    <span style="font-weight: bold; font-style: italic">Registrar Usuarios</span>
		    <input type="checkbox" disabled="disabled" name="registrar_usuarios" id="registrar_usuarios" value="checkbox" />
		    </label>
		  </div></td>
		  <td valign="top"><label>
		    <input type="checkbox" disabled="disabled" name="cuentas_de_usuario" id="cuentas_de_usuario" value="checkbox" />
		    <span style="font-weight: bold; font-style: italic">Cuentas de Usuario</span> </label></td>
		  </tr>
		<tr class='dark-row'>
		  <td height="26" valign="top"><div align="right">
		    <label>
		    <span style="font-weight: bold; font-style: italic">Asignar</span>
		    <input type="checkbox" disabled="disabled" name="asignar" id="asignar" value="checkbox" />
		    </label>
		  </div></td>
		  <td valign="top"><label>
		    <input type="checkbox" disabled="disabled" name="primer_login" id="primer_login" value="checkbox" />
		    <span style="font-weight: bold; font-style: italic">		  Primer Login </span></label></td>
		  </tr>
		<tr class='dark-row'>
		  <td height="26" valign="top"><div align="right">
		    <label>
		    <span style="font-weight: bold; font-style: italic">Reasignar		    </span>
		    <input type="checkbox" disabled="disabled" name="reasignar" id="reasignar" value="checkbox" />
		    </label>
		  </div></td>
		  <td valign="top"><label>
		    <input type="checkbox" disabled="disabled" name="estadisticas" id="estadisticas" value="checkbox" />
		    <span style="font-weight: bold; font-style: italic">		  Estad&iacute;sticas</span></label></td>
		  </tr>
		<tr class='dark-row'>
		  <td height="26" valign="top"><div align="right">
		    <label>
		    <span style="font-weight: bold; font-style: italic">Desbloquear</span>
		    <input type="checkbox" disabled="disabled" name="desbloquear" id="desbloquear" value="checkbox" />
		    </label>
		  </div></td>
		  <td valign="top"><label>
		    <input type="checkbox" disabled="disabled" name="reportes" id="reportes" value="checkbox" />
		    <span style="font-weight: bold; font-style: italic">Reportes</span></label></td>
		  </tr>
		<tr class='dark-row'>
		  <td height="26" valign="top"><div align="right">
		    <label>
		    <span style="font-weight: bold; font-style: italic">Busqueda		    </span>
		    <input type="checkbox" disabled="disabled" name="busqueda" id="busqueda" value="checkbox" />
		    </label>
		  </div></td>
		  <td valign="top"><label>
		    <input type="checkbox" disabled="disabled" name="lista_de_sugerencias" id="lista_de_sugerencias" value="checkbox" />
		    <span style="font-weight: bold; font-style: italic">Lista de Sugerencias </span></label></td>
		  </tr>
		<tr class='dark-row'>
		  <td height="26" valign="top"><div align="right">
		    <label>
		    <span style="font-weight: bold; font-style: italic">Mis Nuevos		    </span>
		    <input type="checkbox" disabled="disabled" name="mis_nuevos" id="mis_nuevos" value="checkbox" />
		    </label>
		  </div></td>
		  <td valign="top"><label>
		    <input type="checkbox" disabled="disabled" name="registrar_tipo_de_usuario" id="registrar_tipo_de_usuario" value="checkbox" />
		    <span style="font-style: italic; font-weight: bold">Registrar Tipo de Usuario</span> </label></td>
		  </tr>
		<tr class='dark-row'>
		  <td height="20" colspan="2" align="center" valign="top">
            <input type="submit" name="nuevo" id="nuevo" value="Nuevo">
            <input type="submit" name="modificar" id="modificar" value="Modificar">
			<input type="submit" name="guardar" id="guardar" disabled="disabled" value="Guardar">		</td>
	</tr>
	</table>
</form>
			
		</td>
	</tr>
</table>
<?
if($_REQUEST['nuevo'] )
{
?>
<script type="text/javascript" language="javascript">
	document.getElementById('nuevo').disabled = true;
	document.getElementById('modificar').disabled = true;
	document.getElementById('guardar').disabled = false;
	document.getElementById('nombre').disabled = false;
	for (var i=2;i<=19;i++)
					document.formulario.elements[i].disabled=false;
</script>
<?
}
else{
		if ($_REQUEST['modificar']){
			?>
			<script type="text/javascript" language="javascript">
				document.getElementById('nuevo').disabled = true;
				document.getElementById('modificar').disabled = true;
				document.getElementById('guardar').disabled = false;
				document.getElementById('nombre').type = "hidden";
				for (var i=2;i<=19;i++)
					document.formulario.elements[i].disabled=false;
				document.getElementById('cmbnombre').style = "visibility:visible";
			</script>
			<?
		}
	}
	
	
sql_disconnect();
?>