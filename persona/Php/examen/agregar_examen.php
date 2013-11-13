<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}?><!DOCTYPE HTML>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />  
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  
    <link rel="stylesheet" type="text/css"  href="../../Css/PHPPaging.lib.css" /> 	
	<link rel="stylesheet" type="text/css"  href="../../JavaScript/jquery.alerts.css" />	 	
	<script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.8.2.min.js"></script>  
   	<script language="javascript" type="text/javascript" src="../../JavaScript/examen_jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/examen.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>    
</head> <script language="javascript" type="text/javascript" >
	  
	  $(document).ready(function(){

    	$('#nuevo').click(function(){
			limpiar_form();
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);
		
		$('#nombre').attr('disabled', false);
		$('#tipo').attr('disabled', false);
    });	
     $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);
		
		$('#nombre').attr('disabled', true);
		$('#tipo').attr('disabled', true);			
		}
    });
    });
function limpiar_form(ele) {
   $(ele).find('input').each(function() {
      switch(this.type) {
         case 'select':
         case 'textarea':
				 $(this).val('');
               	 break;
      }
   }); 			
 $(ele).find('select').each(function() {
       $("#"+this.id).val('0');
   });

   $(ele).find('textarea').each(function() {
       $("#"+this.id).val('');
   });
 
   }
</script>  
<style type="text/css">
.btn_act{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px;
  color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(../../Imagen_sistema/cancelar.jpg);
}.btn_nuevo_act_img{background-image: url(../../Imagen_sistema/nuevo.jpg);}.btn_cancelar_act_img{margin: auto; background-repeat: no-repeat; cursor:hand; cursor:pointer; height: 21px;	 width: 22px; border: 0px;
background-image: url(../../Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img{background-image: url(../../Imagen_sistema/guardar.jpg);}.btn_act:hover{height: 23px; 
  background-color: #f5f5f0; border-bottom: 1px solid #0F0; border-right:1px solid #0F0; border-top:0px; border-left:0px; font-size: 13px; color:black;
  padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}.btn_guardar_desact{
  height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999; border-right:1px solid #999; border-top:0px; border-left:0px; font-size: 13px;
  color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}/*.btn_guardar_desact_img{
  background-image: url(Imagen_sistema/guardar_desac.jpg);}*/.btn_guardar_desact:hover{ height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #333;
  border-right:1px solid #333; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; 
  cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}
  </style> 
<body>
<div id="cuerpo">
<form action="" method="post" id="form_examen" name="form_examen">
  <table width="696" height="25" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td width="686" height="37"><h1>Agregando Ex&aacute;men</h1></td>
   <td valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onclick="location.href='../../../html/blanco.html'" /></td>
   </tr>
  </table>
  <fieldset>  
  <legend></legend>
  <table width="681" height="81" cellpadding="0" cellspacing="0">
  <tbody>
  <tr>
  <td width="110" height="47"><input name="ope" type="hidden" id="ope" value="I" hidden="hidden" /></td>
  <td width="113">Nombre:</td>
  <td width="456" ><textarea name="nombre" cols="45" rows="2" disabled="disabled" id="nombre"></textarea></td>
  </tr>
  <tr>
  <td height="32">&nbsp;</td>
  <td>Tipo de Ex&aacute;men:</td>
  <td ><select name="tipo" id="tipo" disabled="disabled">
      <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
      <option value="Especiales">Especiales</option>
      <option value="Laboratorio">Laboratorio</option>
      <option value="Imágen">Im&aacute;gen</option>
    </select>
  </td>
</tr>
</tbody>
</table>
</fieldset>
<table  width="686" border="0">
  <tr>
   <td width="220" height="26">&nbsp;</td>
  <td width="95"><input name="nuevo" type="button" id="nuevo" value="  Nuevo" class='btn_act btn_nuevo_act_img'/></td>
  <td width="100"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Agregar" /></td>
  <td width="253">&nbsp;</td>
       </tr>
   </table>      
<hr />
  <div id="div_listar_examen"></div>         
</form>    
</div>
</body>
</html>
