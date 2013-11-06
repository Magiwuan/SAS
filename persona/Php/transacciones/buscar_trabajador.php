<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
?><html> 
<head> 
    <title>Cat&aacute;logo</title> 
<script> 
//creamos la variable ventana_secundaria que contendra una referencia al popup que vamos a abrir 
//la creamos como variable global para poder acceder a ella desde las distintas funciones 
var ventana_secundaria 
function cerrarVentana(){ 
//la referencia de la ventana es el objeto window del popup. Lo utilizo para acceder al m�todo close 
window.close("buscar_trabajador.php") 
} 
</script> 
<script type="text/javascript">
function validar() 
{
	if((document.formulario.checkbox.checked==false)&&(document.formulario.checkbox2.checked==false))
	{
		alert("Seleccione un criterio de busqueda");
		return false;
	}
	
	if(document.formulario.checkbox.checked)
	{
		document.formulario.ape.value='';
		  if (document.formulario.nomb.value.length < 1) 
		  {
			alert("Ingrese la primera letra del nombre a buscar");
			document.formulario.nomb.focus();
			return (false);
		  }
	}
	if(document.formulario.checkbox2.checked)
	{
		document.formulario.nomb.value='';
		if (document.formulario.ape.value.length < 1) 
		{
			alert("Ingrese la primera letra del apellido a buscar");
			document.formulario.ape.focus();
			return (false);
		}
	}	
}
function desactivar(id) 
{
	document.getElementById('nomb').disabled=true;
	document.getElementById('ape').disabled=true;
	document.getElementById('checkbox').disabled=true;
	document.getElementById('checkbox2').disabled=true;
}
function desactivar2(id) 
{
	document.getElementById('nomb').disabled=false;
	document.getElementById('ape').disabled=true;
	document.getElementById('checkbox').disabled=true;
	document.getElementById('checkbox2').disabled=true;
}
function desactivar3(id) 
{
	document.getElementById('nomb').disabled=true;
	document.getElementById('ape').disabled=false;
	document.getElementById('checkbox').disabled=true;
	document.getElementById('checkbox2').disabled=true;
}

function activar(id) 
{
	document.getElementById('nomb').disabled=true;
	document.getElementById('ape').disabled=true;
	document.getElementById('checkbox').disabled=false;
	document.getElementById('checkbox2').disabled=false;
}
		  
</script>

<style type="text/css">
<!--
.Estilo36 {color: #000080; font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo99 {color: #FF0000}
body {
	margin-top: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo112 {
	color: #FFFFFF;
	font-weight: bold;
}

.Estilo113 {color: #003399; font-weight: bold; font-size: 10px; }
.Estilo114 {color: #FFFFFF}
-->
#BuscaTrabajador{
	width:282px;
	height:40%;
	padding:0px;
	
}
form{
	position:absolute;
	left:100px;
	padding:5px;
	margin-top: 2px;
	margin-left: 3px;
	margin-bottom:2px;
	background:#FFF;
	display:block; 
	box-shadow: 2px 2px 2px 2px #121212;
	border-radius: 3px;
}
</style>
<body> 
<div id="BuscaTrabajador">
<form action="control_catalago.php" method="post" name="formulario" id="formulario">
  <table width="272" height="114" border="0" align="center" cellspacing="0"> 
    <tr>
      <td width="311" height="14" colspan="2"  bgcolor="#06C" class="Estilo99"><div align="center" class="Estilo112 Estilo114">Consultar Titular </div></td>
    </tr>    
    <tr >
      <td height="21" colspan="2" bgcolor="#FFFFFF" class="Estilo36" ><table width="267" border="0" align="center" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="6">&nbsp;</td>
          <td width="69"><div align="center" class="Estilo113">Nombre</div></td>
          <td width="146"><input name="nomb" type="text" disabled id="nomb"></td>
          <td width="70"><div align="center">
            <input type="checkbox" name="checkbox" value="checkbox" onClick="desactivar2(this)" id="checkbox">
          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><div align="center" class="Estilo113">Apellido</div></td>
          <td><input name="ape" type="text" disabled id="ape"></td>
          <td><div align="center">
            <input type="checkbox" name="checkbox2" value="checkbox" onClick="desactivar3(this)" id="checkbox2">
          </div></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4"><div align="center">
            <input type="submit" name="submit" value="  Buscar  ">
            <input type="reset" name="submit2" value="Limpiar" onClick="activar(this)">
            <input name="button" type="button" onClick="cerrarVentana()" value="  Cerrar   ">
          </div></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</div>
</body> 
</html> 

