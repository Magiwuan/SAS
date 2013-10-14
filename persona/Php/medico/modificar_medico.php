<?php

if(empty($_POST['id_medico'])){
		echo "BOOM!! Error :(...";
		exit;
	}
include_once("../../Clases/clase_medico.php");
	$medico= new medico();	
	$medico->setidMedico($_POST['id_medico']);
	$consulta=$medico->buscar_id();
	for($i=0;$i<count($consulta);$i++)			
	{
		$naci				= $consulta[$i][2];
		$nomb				= $consulta[$i][3];
		$apell				= $consulta[$i][4];
		$cedula				= $consulta[$i][5];
		$id_especialidad	= $consulta[$i][6];
		
	}	

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />  
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  
	<link rel="stylesheet" type="text/css" href="../../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../../Css/border-radius.css" /> 
    <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	 
	<script src="../../JavaScript/jscal2.js"></script>    
    <script src="../../JavaScript/es.js"></script>    
	<script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.ui.js"></script>    
    <script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.asmselect.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../JavaScript/medico_jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../JavaScript/medico.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script> 
</head><script language="javascript" type="text/javascript" >
	  $(document).ready(function(){
    	$('#nuevo').click(function(){
		$("#cap_dis").load('select_medico.php');
		$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#nuevo').attr('disabled', true);
		
		$('#ced2').attr('disabled', false);
		$('#nacionalidad1').attr('disabled', false);
		$('#nacionalidad2').attr('disabled', false);
		$('#cedula').attr('disabled', false);
		$('#nombre').attr('disabled', false);
		$('#apellido').attr('disabled', false);
		$('#especialidad').attr('disabled', false);
    });	
     $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);	
		
		$('#ced2').attr('disabled', true);
		$('#nacionalidad1').attr('disabled', true);
		$('#nacionalidad2').attr('disabled', true);
		$('#cedula').attr('disabled', true);
		$('#nombre').attr('disabled', true);
		$('#apellido').attr('disabled', true);
		$('#especialidad').attr('disabled', true);		
		}
    });
    }); 
</script>
  <style>
.btn_act{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #09F;
  border-right:1px solid #09F; 
  border-top:0px; 
  border-left:0px; 
  font-size: 13px;
  color:black; 
  padding-left: 20px; 
  background-repeat: no-repeat; 
  cursor:hand; cursor:pointer;
  margin-left:5px; 
  margin-right:5px; 
  outline-width:0px;
  background-image: url(../../Imagen_sistema/cancelar.jpg);
}
.btn_nuevo_act_img{
	  background-image: url(../../Imagen_sistema/page_edit.png);
}
.btn_cancelar_act_img{
	 margin: auto;
	 background-repeat: no-repeat; 
	 cursor:hand; cursor:pointer;
	 height: 21px;
	 width: 22px;
	 border: 0px;
	 background-image: url(../../Imagen_sistema/cancelar.jpg);
}
.btn_guardar_act_img{
	  background-image: url(../../Imagen_sistema/guardar.jpg);
}
.btn_act:hover{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #0F0;
  border-right:1px solid #0F0; 
  border-top:0px; 
  border-left:0px;
  font-size: 13px; 
  color:black;
  padding-left: 20px; 
  background-repeat: no-repeat;
  cursor:hand; 
  cursor:pointer; 
  margin-left:5px; 
  margin-right:5px;
  outline-width:0px;
}

.btn_guardar_desact{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #999;
  border-right:1px solid #999; 
  border-top:0px; 
  border-left:0px; 
  font-size: 13px;
  color:#CCC;
  padding-left: 20px; 
  background-repeat: no-repeat; 
  cursor:hand; cursor:pointer;
  margin-left:5px; 
  margin-right:5px; 
  outline-width:0px;
}
/*.btn_guardar_desact_img{
  background-image: url(Imagen_sistema/guardar_desac.jpg);

}*/
.btn_guardar_desact:hover{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #333;
  border-right:1px solid #333; 
  border-top:0px; 
  border-left:0px;
  font-size: 13px; 
  color:#CCC;
  padding-left: 20px; 
  background-repeat: no-repeat;
  cursor:hand; 
  cursor:pointer; 
  margin-left:5px; 
  margin-right:5px;
  outline-width:0px;
}
</style> 
<body> 
<div id="cuerpo">
<form action="javascript: fn_modificar();" method="POST" id="form_medico" name="form_medico">

<table width="688" height="25" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="670"> <h1> Modificar Médico</h1></td>
      <td width="18"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onClick="fn_cerrar();" /></td>
    </tr>
  </table>
  <fieldset>
  <legend align="left"> Datos de Personales </legend>
  <table width="678" border="0" cellpadding="1" cellspacing="1">
   					   <tr>
                             <td class="formulario">&nbsp;</td>
                             <td class="formulario">&nbsp;</td>
                             <td class="formulario">&nbsp;</td>
                             <td class="formulario">&nbsp;</td>
                             <td width="250" colspan="2" class="formulario">&nbsp;</td>
   					   </tr>
				       <tr>
                         <td width="7" class="formulario">&nbsp;</td>
                         <td width="82" class="formulario">Nacionalidad:</td>
                         <td width="188" class="formulario">
                             <input name="nacionalidad" type="radio" id="nacionalidad1" value="V" disabled="disabled" <?php if($naci=='V') echo "checked=\"checked\""?> >Venezolano 
                           <input type="radio" name="nacionalidad" id="nacionalidad2" value="E" disabled="disabled" <?php if($naci=='E') echo "checked=\"checked\""?> > Extranjero
                         </td>
                         <td width="135" class="formulario">Nro. C.I o Pasaporte:</td>
                         <td colspan="2" class="formulario"><input name="ced2" type="text" disabled id="ced2" value="<?php echo $cedula;?>" size="16" />
                           <input name="ope" type="hidden" id="ope" value="M" hidden="hidden" />
                         <input type="hidden" name="id_medico" id="id_medico" value="<?php echo $_POST['id_medico'];?>">
                         <input type="hidden" name="ced" id="cedula2" value="<?php echo $cedula;?>"></td>
                       </tr>
                       <tr>
                         <td class="formulario">&nbsp;</td>
                         <td class="formulario">Nombres:</td>
                         <td class="formulario"><input name="nombre" type="text" disabled id="nombre" value="<?php echo $nomb;?>" size="30"  /></td>
                         <td>Apellidos:</td>
                         <td colspan="2"><span class="formulario">
                           <input name="apellido" type="text" disabled id="apellido" value="<?php echo $apell;?>" size="30"  />
                         </span></td>
                         </tr>
                       <tr>
                         <td class="formulario">&nbsp;</td>
                         <td><span class="formulario">Especialidad:</span></td>
             <td><select name="especialidad" id="especialidad" disabled="disabled">
              <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
                 <?php include_once("../../Clases/clase_especialidad.php");
                 $especialidad=new especialidad();
                 $lista=$especialidad->lista_especialidad();
                 for($i=0;$i<count($lista);$i++)
                  {
              ?><option value="<?php echo $lista[$i][1];?>" <?php if($lista[$i][1]==$id_especialidad){ echo "selected=\"selected\"";}?>
              ><?php echo $lista[$i][2];?></option>
              <?php }?>
              </select></td>
          <td>Organización:</td>
         <td colspan="2" rowspan="2" valign="top"><select name="proveedor[]" id="proveedor" multiple="multiple" title="Seleccionar">
                                 <?php	include_once("../../Clases/clase_proveedor.php"); // se llama esta clase para hacr el listado en el combo normal
            include_once("../../Clases/clase_detalle_proveedor.php"); //se llama esta clase para hacer la consulta de las profesiones por titular y selccionarlas todas
            $detalle_pro		= new detalle_pro();
            $proveedor			= new proveedor();
            
            $detalle_pro->setidMedico($_POST['id_medico']);
            $proveedors = $detalle_pro->buscar_proveedores();
            
            $lista=$proveedor->lista_proveedor();
            for($i=0;$i<count($lista);$i++)
            {
            ?><option value="<?php echo $lista[$i][1];?>"<?php	
                                    for($x=0;$x<count($proveedors);$x++)
                                    { 
                                        if($lista[$i][1]==$proveedors[$x][3])
                                        {					
                                            echo "Selected=\"Selected\"";
                                        }
                                    }
                            ?>       
                    ><?php echo $lista[$i][2];?></option>
                                 <?php }?>
                               </select></td>
                         </tr>
                       <tr>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                       </tr>
                   </table>    
    </fieldset>
     <table  width="689" border="0">
          <tr>
            <td width="248">&nbsp;</td>
            <td width="77"><input name="nuevo" type="button" id="nuevo" value="Modificar" class='btn_act btn_nuevo_act_img' /></td>
          <td width="80"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value="Guardar" /></td>
          <td width="266">&nbsp;</td>
          </tr>
      </table> 
       
    </form>    
</div>
</body>
</html>