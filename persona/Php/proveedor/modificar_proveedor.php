<?PHP

if(empty($_POST['id_proveedor'])){
		echo "BOOM!! Error :(";
		exit;
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

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />      
  	<link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />      
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  	
	<link rel="stylesheet" type="text/css" href="../../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../../Css/border-radius.css" />
    <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" /> 
    <link rel="stylesheet" href="../../Css/validationEngine.jquery.css" type="text/css"/>
	<script src="../../JavaScript/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
	<script src="../../JavaScript/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>	
	<script src="../../JavaScript/jscal2.js"></script>    
    <script src="../../JavaScript/es.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/proveedor_jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/proveedor.js"></script>
	<script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>  
	<script language="JavaScript" type="text/JavaScript">
	   $(document).ready(function(){

			$('#nuevo').click(function(){
			$("#cap_dis").load('select_servicio.php');
			$('#agregar').removeClass('btn_guardar_desact').addClass('btn_act');
			$('#agregar').attr('disabled', false);
			$('#nuevo').removeClass('btn_act').addClass('btn_guardar_desact');
			$('#nuevo').attr('disabled', true);
					
			$('#boton_fec_ini').attr('disabled', false);
			$('#boton_fec_fin').attr('disabled', false);
			$('#nombre').attr('disabled', false);
			$('#alias').attr('disabled', false);
			$('#persona_cont').attr('disabled', false);
			$('#rif').attr('disabled', false);
			$('#correo').attr('disabled',false);
			$('#celular').attr('disabled', false);
			$('#estado').attr('disabled', false);
			$('#telefono').attr('disabled', false);
			$('#fax').attr('disabled', false);
			$('#direccion').attr('disabled', false);
			$('#fecha_inicio').attr('disabled', false);
			$('#fecha_fin').attr('disabled', false);
			$('#servicios').attr('disabled', false);
			
    	});	
     $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_guardar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_guardar_desact');
		$('#agregar').attr('disabled', true);
			
			$('#boton_fec_ini').attr('disabled', true);
			$('#boton_fec_fin').attr('disabled', true);
			$('#nombre').attr('disabled', true);
			$('#alias').attr('disabled', true);
			$('#persona_cont').attr('disabled', true);
			$('#rif').attr('disabled', true);
			$('#correo').attr('disabled', true);
			$('#celular').attr('disabled', true);
			$('#estado').attr('disabled', true);
			$('#telefono').attr('disabled', true);
			$('#fax').attr('disabled', true);
			$('#direccion').attr('disabled', true);
			$('#fecha_inicio').attr('disabled', true);
			$('#fecha_fin').attr('disabled', true);
			$('#servicios').attr('disabled', true);		
		}
    });
	});
	jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#form_proveedor").validationEngine();
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
	  background-image: url(../../Imagen_sistema/nuevo.jpg);
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
#popup {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}
.content-popup {
	 margin:0px;
    padding:10px;
    width:732px;
    min-height:250px;
    border-radius:4px;
    background-color:#FFFFFF;
    box-shadow: 0 2px 5px #666666;
}
.close {
 position:relative;
 left:700px;}
</style>
</head>
<body> 
<div id="cuerpo">
<form action="javascript: fn_modificar();" method="POST" id="form_proveedor" name="form_proveedor">

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
      <td class="formulario">&nbsp;</td>
      <td width="55" class="formulario">&nbsp;</td>
      <td width="89" class="formulario">&nbsp;</td>
      <td width="75" class="formulario">&nbsp;</td>
      <td class="formulario">&nbsp;</td>
      <td colspan="3" class="formulario"><input name="ope" type="hidden" id="ope" value="M" hidden="hidden" />
        <input type="hidden" name="rif" id="cedula2" value="<?php echo $rif;?>">
        <input type="hidden" name="id_proveedor" id="id_proveedor" value="<?php echo $_POST['id_proveedor'];?>"></td>
    </tr>
    <tr>
      <td width="141" class="formulario">Organización:</td>
      <td colspan="3" class="formulario"><input name="nombre" type="text" disabled id="nombre" value="<?php echo $nombre;?>" size="40" title="Nombre de la Organización" /></td>
      <td width="54" class="formulario">Alias:</td>
      <td colspan="3" class="formulario"><input name="alias" type="text" disabled id="alias" value="<?php echo $alias;?>" size="30"  title="Nombre de la Franquicia"/></td>
      </tr>
    <tr>
      <td class="formulario">Persona Contacto:</td>
      <td colspan="3" valign="top"><span class="formulario">
        <input name="persona_cont" type="text" disabled id="persona_cont" value="<?php echo $persona_contacto;?>" size="40" title="Persona con quien se reliza el convenio"/>
      </span></td>
      <td><span class="formulario">R.I.F:</span></td>
      <td width="98"><span class="formulario">
        <input name="rif2" type="text" disabled id="cedula" value="<?php echo $rif;?>" size="16" title="Registro de Información Fiscal del Proveedor" />
      </span></td>
      <td width="145"><a href="#" onclick="jQuery('#test').validationEngine('showPrompt', 'Ejemplo: 20643089, Si la C.I es menor a ocho (8) dígitos complete con ceros (0) a la izquierda Ejemplo: 08042667', 'pass')" title="Ayuda">
			      <div id="test" class="test" style="width:30px;"><img src="../../../Imagenes/ayuda.png" width="15" height="15"/></div>
			    </a></td>
      </tr>
    <tr>
      <td class="formulario">Correo eléctronico:</td>
      <td colspan="3" class="formulario"><input name="correo" type="text" disabled id="correo" value="<?php echo $correo_elect;?>" size="40" title="Correo del Proveedor o Persona contacto"/></td>
      <td>:<span class="formulario">Celular:</span></td>
      <td colspan="2"><span class="formulario">
        <input name="celular" type="text" disabled id="celular" value="<?php echo $celular;?>" size="15" maxlength="12" title="Celular de la persona contacto"/>
      </span></td>
      </tr>
    <tr>
      <td class="formulario">Estado:</td>
      <td colspan="3" class="formulario"><select name="estado" id="estado" disabled="disabled" title="Estado donde esta ubicado">
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
      <td colspan="3"><span class="formulario">
        <input name="telefono" type="text" disabled id="telefono" value="<?php echo $telefono;?>" size="15" maxlength="12"  title="Teléfono del proveedor"/>
      </span></td>
      </tr>
    <tr>
      <td><span class="formulario">Ciudad:</span></td>
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
      <td colspan="2"><span class="formulario">
        <input name="fax" type="text" disabled id="fax" value="<?php echo $fax;?>" size="15" maxlength="12" title="Fax del Proveedor campo opcional"/>
      </span></td>
      </tr>
        <tr>
          <td>Dirección:</td>
          <td colspan="7"><label for="direccion">
            <textarea name="direccion" cols="45" rows="2" disabled id="direccion"  title="Dirección donde esta ubicado el proveedor"><?php echo $direccion_fis;?></textarea>
          </label></td>
        </tr>
        <tr>
          <td>Fecha Convenio:</td>
          <td align="right">Inicio:</td>
          <td align="right"><span class="formulario">
            <input name="fecha_inicio" type="text" id="fecha_inicio" value="<?php echo $fecha_ini;?>" size="12"  title="Fecha desde" maxlength="10" readonly />
          </span></td>
          <td align="left"><button name="boton_fec_ini" id="boton_fec_ini" class="button" disabled="disabled"><img src="../../Imagen_sistema/calend.png" width="20" height="20" title="Calendario para selecionar la fecha"/></button></td>
          <td class="formulario">Servicio:</td>
          <td colspan="2" rowspan="3" valign="top"><select name="servicio[]" id="servicio" multiple="multiple" title="Seleccionar">
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
      <td height="28">&nbsp;</td>
      <td align="right">Fin:</td>
      <td align="right"><input name="fecha_fin" type="text" id="fecha_fin" value="<?php echo $fecha_fi;?>" size="12" maxlength="10" title="Fecha hasta" readonly /></td>
      <td align="left"><button name="boton_fec_fin" id="boton_fec_fin" class="button" disabled="disabled"><img src="../../Imagen_sistema/calend.png" width="20" height="20" title="Calendario para selecionar la fecha"/></button></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td height="18">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
 
    </table>
    </fieldset>
     <table  width="849" border="0">
          <tr>
            <td width="219">&nbsp;</td>
            <td width="114"><input name="nuevo" type="button" id="nuevo" value="  Modificar" class='btn_act btn_nuevo_act_img' title="Pulsar para activar campos" /></td>
          <td width="100"><input name="agregar" type="submit"  class='btn_guardar_desact btn_guardar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Guardar" title="Guardar" /></td>
          <td width="398">&nbsp;</td>
          </tr>
      </table> 
    </form>    
</div>
</body>
</html>