<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../../usuario/denied.php");
}
?><!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="../jquery/themes/base/jquery.ui.theme.css" />
    <link type="text/css" rel="stylesheet" href="../jquery/themes/base/jquery.ui.autocomplete.css" />	
    <script type="text/javascript" src="../jquery/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="../jquery/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" src="../jquery/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="../jquery/ui/jquery.ui.position.js"></script>
    <script type="text/javascript" src="../jquery/ui/jquery.ui.autocomplete.js"></script>
    <script language="JavaScript" type="text/JavaScript">	 
	$(function() {       
        $("#campo").autocomplete({
            source: "completar_examen_l.php"
        });
    }); 

icremento =1;
function crear(obj) {
	if(icremento>5){
		$("#capa_datos").css({			     	   
			   	"margin": "auto",
				"text-align":"justify",
				"width": "auto",
				"height": "124px",		
				"padding": "2px",
				"border-radius": "4px",
				"overflow": "auto"
			})
	}		
	var campo = document.getElementById('campo').value;    
//para validar que no repita el medicamento en el arreglo.
	for(var i=0;i<document.getElementsByName('campo[]').length;i++)
	{			 					
		if (document.getElementsByName('campo[]')[i].value==campo){
			alert('Estas intentando Enviar un exámen de mismas Caracteristicas.\nVerifica los datos!');
			return false;
		}				  
	}			
	if($('#campo').val().length < 1 || $('#campo').val()=='Buscar'){
		jAlert('El campo  "Exámen"  no puede estar vacio','Dialogo de Alerta');
		$('#campo').focus();
		return false;	
	}
	if($('#descripcion').val().length < 1){
		jAlert('El campo  "Descripción"  no puede estar vacio','Dialogo de Alerta');
		$('#descripcion').focus();
		return false;	
	}
  field = document.getElementById('capa_datos'); 
  contenedor = document.createElement('div'); 
  contenedor.id = 'div'+icremento; 
  field.appendChild(contenedor); 
//Medicamento nombre
  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'campo'+'[]';
  boton.vAlign= "middle";
  boton.id ='camp';
  boton.value =  document.getElementById('campo').value;    
  boton.readOnly = true;
  boton.size='30';
  contenedor.appendChild(boton); 
//cantidad Campo de texto
  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'descripcion'+'[]';
  boton.id = 'descrip';
  boton.vAlign= "middle";
  boton.value =  document.getElementById('descripcion').value;
  boton.readOnly = true;
  boton.size='60';
  contenedor.appendChild(boton); 
//Boton de borrado 
  boton = document.createElement('input');
  boton.vAlign= "middle";
  boton.type = 'image'; 
  boton.width= '15';
  boton.height= '15';
  boton.src = "../../../Imagen_sistema/delete.png";
  boton.name = 'div'+icremento;   
  boton.onclick = function () {borrar(this.name)} 
  contenedor.appendChild(boton); 
  icremento++;    
$("#ocultar").css("display", "block");			
return true;	
}
//funcion para borrar los objetos creados.
function borrar(obj) {	
  field = document.getElementById('capa_datos'); 
  field.removeChild(document.getElementById(obj));
  icremento--;    
   if(icremento==1){
	  $("#ocultar").css("display", "none");			

  }  
  return true;
}
</script>
</head>

<body>
<table width="686" border="0">
  <tr>
    <td width="1">&nbsp;</td>
    <td width="62">Examen:</td>
    <td width="201"><input style="color:#909090" name="campo" id="campo" size="30"  type="text" value="Buscar" onfocus = "if(this.value=='Buscar') {this.value=''; this.style.color='#000'}" onblur="if(this.value==''){this.value='Buscar'; this.style.color='#909090'}" onclick="if(this.value!=''){this.value=''; this.style.color='#000'}"/></td>
    <td width="75">Descripcion:</td>
    <td width="360">
      <input name="descripcion" type="text" id="descripcion" size="45"  /></td>
    <td width="1">&nbsp;</td>
  </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td colspan="4"><div id="ocultar" style="display:none; margin:auto;">
      
    <div id="capa_datos" style="margin:auto; text-align:justify; padding:2px;"><input id="marco" type="text" size="30" value=" Nombre del Examen " style=" background:#E1F0FF; text-align:center;" readonly/><input name="marco" id="marco" type="text" size="60" value=" Descripcion " style=" background:#E1F0FF; text-align:center;" readonly/></div>
  </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
