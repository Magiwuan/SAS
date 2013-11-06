<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
if(empty($_POST['id_proveedor'])){
		echo "BOOM!! Error :(";
		exit();
	}
include_once("../../Clases/clase_proveedor.php");
	$proveedor= new proveedor();	
	$proveedor->setidProveedor($_POST['id_proveedor']);
	$consulta=$proveedor->buscar_id();
	for($i=0;$i<count($consulta);$i++)			
	{
		$rif				= $consulta[$i][2];
		$nombre				= $consulta[$i][3];
		$alias				= $consulta[$i][14];
		$persona_contacto	= $consulta[$i][4];
		$celular			= $consulta[$i][5];
		$telefono			= $consulta[$i][6];
		$fax				= $consulta[$i][7];
		$correo_elect		= $consulta[$i][8];
		$idCiudad			= $consulta[$i][9]; //Problema $ciudad es el objeto instanciando la clase...  CHOQUE DE VARIABLES dejar idCiudad
		$direccion_fis		= $consulta[$i][10];
		$fecha_ini			= $consulta[$i][11];
		$fecha_fi			= $consulta[$i][12];
		
		$elDia=substr($fecha_ini,8,2);
		$elMes=substr($fecha_ini,5,2);
		$elYear=substr($fecha_ini,0,4);
		$fecha_inicio=$elDia."-".$elMes."-".$elYear;
		$Dia=substr($fecha_fi,8,2);
		$Mes=substr($fecha_fi,5,2);
		$Year=substr($fecha_fi,0,4);
		$fecha_fin=$Dia."-".$Mes."-".$Year;		
	}	
//llamado a la clase de ciudad seleccionar el select de estado
include_once("../../Clases/clase_ciudad.php");
	$ciu= new ciudad();	
	$ciu->setidCiudad($idCiudad);
	$consult=$ciu->buscar_ciudad();
	for($i=0;$i<count($consulta);$i++)			
	{
		//$nombciud		= $consult[$i][2];
		$id_estado		= $consult[$i][3];
	}

?><!DOCTYPE HTML >
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />      
  	<link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />      
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  	
	<link rel="stylesheet" type="text/css" href="../../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../../Css/border-radius.css" />   
    <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	
    <script language="javascript" type="text/javascript" src="../../JavaScript/proveedor_jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/proveedor.js"></script>
    <script language="JavaScript" type="text/javascript" src="JavaScript/jquery.ui.js"></script>    
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script> 
	<script language="javascript" type="text/javascript" src="../../JavaScript/jscal2.js"></script>    
	<script language="javascript" type="text/javascript" src="../../JavaScript/es.js"></script>  	
    <script language="JavaScript" type="text/JavaScript">	
$(document).ready(function(){		
	$('#nuevo').click(function(){
			$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
			$('#agregar').attr('disabled', false);
			$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
			$('#nuevo').attr('disabled', true);					
		
			$('#nombre').attr('disabled', false);
			$('#alias').attr('disabled', false);
			$('#persona_cont').attr('disabled', false);
			$('#rif').attr('disabled', false);
			$('#correo').attr('disabled',false);
			$('#celular').attr('disabled', false);
			$('#estado').attr('disabled', false);
			$('#ciudad').attr('disabled', false);
			$('#telefono').attr('disabled', false);
			$('#fax').attr('disabled', false);
			$('#direccion').attr('disabled', false);
			$('#bt_i').attr('disabled', false);
			$('#bt_f').attr('disabled', false);
	});	
    $('#agregar').click(function(){
		fn_agregar();
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);
					
		$('#nombre').attr('disabled', true);
		$('#alias').attr('disabled', true);
		$('#persona_cont').attr('disabled', true);
		$('#rif').attr('disabled', true);
		$('#correo').attr('disabled', true);
		$('#celular').attr('disabled', true);
		$('#estado').attr('disabled', true);
		$('#ciudad').attr('disabled', true);
		$('#telefono').attr('disabled', true);
		$('#fax').attr('disabled', true);
		$('#direccion').attr('disabled', true);  
		$('#bt_i').attr('disabled', true);
		$('#bt_f').attr('disabled', true);  
	});
});
</script> 		    
<style>
.btn_act{ height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(../../Imagen_sistema/cancelar.jpg);}.btn_nuevo_act_img{background-image: url(../../Imagen_sistema/nuevo.jpg);}.btn_cancelar_act_img{margin: auto; background-repeat: no-repeat; cursor:hand; cursor:pointer; height: 21px; width: 22px; border: 0px; background-image: url(../../Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img{background-image: url(../../Imagen_sistema/guardar.jpg);}.btn_act:hover{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #0F0; border-right:1px solid #0F0; border-top:0px; border-left:0px;font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}.btn_guardar_desact{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999; border-right:1px solid #999; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer;  margin-left:5px; margin-right:5px;  outline-width:0px;}/*.btn_guardar_desact_img{background-image: url(Imagen_sistema/guardar_desac.jpg);}*/.btn_guardar_desact:hover{ height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #333; border-right:1px solid #333; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}#popup {left: 0; position: absolute; top: 0; width: 100%; z-index: 1001;}.content-popup {margin:0px;  padding:10px;  width:732px;   min-height:250px; border-radius:4px; background-color:#FFFFFF; box-shadow: 0 2px 5px #666666;}.close {position:relative; left:700px;}
</style>
</head>
<body> 
<div id="cuerpo">
<form action="" method="POST" id="form_proveedor" name="form_proveedor">
<table width="688" height="25" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="667"> <h1> Modificar Proveedor de Salud</h1></td>
      <td width="21" valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onClick="fn_cerrar();" /></td>
    </tr>
  </table>
  <fieldset>
  <legend align="left"> Datos de la Organización </legend>
  <table width="679" height="277" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="141">Organización:</td>
      <td colspan="3"><input name="nombre" type="text" disabled id="nombre" value="<?php echo $nombre;?>" size="40" title="Nombre de la Organización" /></td>
      <td width="54">Alias:</td>
      <td colspan="3"><input name="alias" type="text" disabled id="alias" value="<?php echo $alias;?>" size="30"  title="Nombre de la Franquicia"/></td>
      </tr>
    <tr>
      <td>Persona Contacto:</td>
      <td colspan="3" valign="top">
        <input name="persona_cont" type="text" disabled id="persona_cont" value="<?php echo $persona_contacto;?>" size="40" title="Persona con quien se reliza el convenio"/></td>
      <td>R.I.F:</td>
      <td width="98"><input name="rif2" type="text" disabled id="cedula" value="<?php echo $rif;?>" size="16" title="Registro de Información Fiscal del Proveedor" />
      </td>
      <td width="149"><div id="test" title="Ejemplo: j-1234567-8 " class="test" style="width:30px; cursor: pointer;">
					  <img src="../../../Imagenes/ayuda.png" width="15" height="15"/></div>
			   </td>
      </tr>
    <tr>
      <td>Correo eléctronico:</td>
      <td colspan="3"><input name="correo" type="text" disabled id="correo" value="<?php echo $correo_elect;?>" size="40" title="Correo del Proveedor o Persona contacto"/></td>
      <td>Celular:</td>
      <td colspan="2">
        <input name="celular" type="text" disabled id="celular" value="<?php echo $celular;?>" size="15" maxlength="12" title="Celular de la persona contacto"/>
     </td>
      </tr>
    <tr>
      <td>Estado:</td>
      <td colspan="3"><select name="estado" id="estado" disabled="disabled" title="Estado donde esta ubicado">
        <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
        <? include_once("../../Clases/clase_estado.php");
                        $estado=new estado();
                        $lista=$estado->lista_estado();
                        for($i=0;$i<count($lista);$i++)
                        {
                            $idEstado	=	$lista[$i][1];
                            $NombEstado	=	$lista[$i][2];
             ?>
        <option value="<? echo $idEstado;?>" <? if($id_estado==$idEstado){ echo "selected=\"selected\"";}?>
              ><? echo $NombEstado;?></option>
        <? }?>
      </select></td>
      <td>Teléfono:</td>
      <td colspan="3">
        <input name="telefono" type="text" disabled id="telefono" value="<?php echo $telefono;?>" size="15" maxlength="12"  title="Teléfono del proveedor"/>
     </td>
      </tr>
    <tr>
      <td>Ciudad:</td>
      <td colspan="3"><select name="ciudad" id="ciudad" disabled="disabled">
                              <div id="cap1" style="display:block;">
                                <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
                                <? include_once("../../Clases/clase_ciudad.php");
                                    $city=new ciudad();
                                    $city->setidEstado($id_estado);
                                    $lista=$city->lista_ciudad();
                                    for($i=0;$i<count($lista);$i++)
                                    {
                                        $idCity	=	$lista[$i][1];
                                        $NombCity	=	$lista[$i][2];
                                    ?>
                                  <option value="<? echo $idCity;?>" <? if($idCity==$idCiudad){ echo "selected=\"selected\"";} ?>
                                  ><? echo $NombCity;?></option>
                                  <? }?>
                               </div>
                                <div id="cap2" style="display:none"> </div>
                        </select></td>
      <td>Fax:</td>
      <td colspan="2">
        <input name="fax" type="text" disabled id="fax" value="<?php echo $fax;?>" size="15" maxlength="12" title="Fax del Proveedor campo opcional"/>
      </td>
      </tr>
        <tr>
          <td>Dirección:</td>
          <td colspan="7"><textarea name="direccion" cols="45" rows="2" disabled id="direccion"  title="Dirección donde esta ubicado el proveedor"><?php echo $direccion_fis;?></textarea>
          </td>
        </tr>
        <tr>
          <td>Fecha de Inicio:</td>
      <td width="74"><input name="fecha_ini" type="text" id="fecha_ini" value="<?php echo $fecha_inicio ?>" size="12" maxlength="10" readonly /></td>
      <td width="43"><button name="bt_i" id="bt_i" class="button"><img src="../../Imagen_sistema/calend.png" width="20" height="20" title="Calendario para buscar fecha"/></button></td>
          <td align="right">Servicio:</td>
          <td colspan="3" rowspan="4" valign="top"><select name="servicio[]" id="servicio" multiple="multiple" title="Seleccionar">
            <!-- <option value="0" selected="selected" disabled="disabled">Seleccionar </option>-->
            <?	include_once("../../Clases/clase_servicio.php"); // se llama esta clase para hacr el listado en el combo normal
            include_once("../../Clases/clase_detalle_servicio.php"); //se llama esta clase para hacer la consulta de las profesiones por titular y selccionarlas todas
            $detalle_serv		= new detalle_serv();
            $servicio			= new servicio();
            
            $detalle_serv->setIdProveedor($_POST['id_proveedor']);
            $servicios = $detalle_serv->buscar_servicios();
            
            $lista=$servicio->lista_servicio();
            for($i=0;$i<count($lista);$i++)
            {
                $idServicio		=	$lista[$i][1];
                $NombServicio	=	$lista[$i][2];
            ?>
            <option value="<? echo $idServicio;?>"
                            <?php	
                                    for($x=0;$x<count($servicios);$x++)
                                    { 
                                        if($idServicio==$servicios[$x][2])
                                        {					
                                            echo "Selected=\"Selected\"";
                                        }
                                    }
                            ?>       
                    ><? echo $NombServicio;?></option>
            <? }?>
          </select></td>
        </tr>
       <tr>      
     
      <td>Fecha de Fin:</td>
      <td align="right"><input name="fecha_fin" type="text" value="<?php echo $fecha_fin ?>" id="fecha_fin" size="12" title="Fecha Hasta" maxlength="10" readonly /></td>
      <td align="left"><button name="bt_f" id="bt_f" class="button" disabled="disabled"><img src="../../Imagen_sistema/calend.png" width="20" height="20" title="Calendario para buscar fecha"/></button></td>
      <td> <script language="JavaScript" type="text/JavaScript">	 
		 Calendar.setup({
			inputField : "fecha_ini",
			dateFormat: "%d-%m-%Y",
			trigger    : "bt_i",
			onSelect   : function() { this.hide() },
		  });
      Calendar.setup({
        inputField : "fecha_fin",
		dateFormat: "%d-%m-%Y",
        trigger    : "bt_f",
        onSelect   : function() { this.hide() },
      });  
      </script> </td>
      </tr> 
    </table>
    </fieldset>
     <table  width="849" border="0">
          <tr>
            <td width="219"><input name="ope" type="hidden" id="ope" value="M" hidden="hidden" /></td>
            <td width="114"><input name="nuevo" type="button" id="nuevo" value="  Modificar" class='btn_act btn_nuevo_act_img' title="Pulsar para activar campos" /></td>
          <td width="100"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Guardar" title="Guardar" /></td>
          <td width="398"><input type="hidden" name="rif" id="cedula2" value="<?php echo $rif;?>">
        <input type="hidden" name="id_proveedor" id="id_proveedor" value="<?php echo $_POST['id_proveedor'];?>"></td>
          </tr>
      </table> 
    </form>    
</div>
</body>
</html>
