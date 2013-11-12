<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: usuario/denied.php");
}

if(empty($_POST['id_titular'])){
		echo "BOOM!! Error :(";
		exit();
	}
include_once("../Clases/clase_titular.php");
	$titular= new titular();	
	$titular->setidTitular($_POST['id_titular']);
	$consulta=$titular->buscar_id();
	for($i=0;$i<count($consulta);$i++)			
	{
		$nacionalidad	= $consulta[$i][2];
		$cedula			= $consulta[$i][3];
		$nombre1		= $consulta[$i][4];
		$nombre2		= $consulta[$i][5];
		$apellido1		= $consulta[$i][6];
		$apellido2		= $consulta[$i][7];
		$sexo			= $consulta[$i][8];
		$fecha_n		= $consulta[$i][9];
		$estado_civ		= $consulta[$i][10];
		$celular		= $consulta[$i][11];
		$telefono		= $consulta[$i][12];
		$correo_elect	= $consulta[$i][13];
		$fecha_i		= $consulta[$i][14];
		$direccion_hab	= $consulta[$i][15];
		$idCargo		= $consulta[$i][16]; 
		$idCiudad		= $consulta[$i][17];
		$idDepartamento	= $consulta[$i][18];
		$idUpsa			= $consulta[$i][19];
		$tipo			= $consulta[$i][21];
		$idCiudadnac	= $consulta[$i][22];	
		$Correo			= $consulta[$i][23];
		$Observ			= $consulta[$i][24];
		$idProfesion	= $consulta[$i][26];
		$elDia=substr($fecha_n,8,2);
		$elMes=substr($fecha_n,5,2);
		$elYear=substr($fecha_n,0,4);
		$fecha_nac=$elDia."-".$elMes."-".$elYear;		
	}
//llamado a la clase de ciudad seleccionar el select de estado
include_once("../Clases/clase_ciudad.php");
	$ciu= new ciudad();	
	$ciu->setidCiudad($idCiudad);
	$consult=$ciu->buscar_ciudad();
	for($i=0;$i<count($consult);$i++)			
	{
		$id_estado		= $consult[$i][3];
	}
	$ciu->setidCiudad($idCiudadnac);
	$consult=$ciu->buscar_ciudad();
	for($i=0;$i<count($consulta);$i++)			
	{
		$id_estado2		= $consult[$i][3];
	}
?><!DOCTYPE HTML>
<html lang="es">
  <head>
    <title>.:Modificar Titular:.</title>        
  	<link rel="stylesheet" type="text/css" href="Css/estilo2.css" />  
     <link rel="stylesheet" type="text/css" href="Css/estilo.css" />  
	<link rel="stylesheet" type="text/css" href="Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="Css/border-radius.css" />
    <link href="JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />
    <script src="JavaScript/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="JavaScript/jscal2.js"></script>    
    <script src="JavaScript/es.js"></script>    
	<script language="JavaScript" type="text/javascript" src="JavaScript/jquery.ui.js"></script>
	<script language="JavaScript" type="text/javascript" src="JavaScript/jquery.asmselect.js"></script> 
    <script language="javascript" type="text/javascript" src="JavaScript/jquery.alerts.js"></script>  
    <script language="javascript" type="text/javascript" src="JavaScript/empleado.js"></script>
     <script language="javascript" type="text/javascript" >	  
	  $(document).ready(function(){		
	    $('#nuevo').click(function(){	
		$("#cap_dis").load('Php/select_discapacidad.php #disc_capa');
		$("#cap_prof").load('Php/select_profesion.php');
		$('#agregar').removeClass('btn_agregar_desact').addClass('btn_act');
		$('#agregar').attr('disabled', false);
		$('#nuevo').removeClass('btn_act').addClass('btn_agregar_desact');
		$('#nuevo').attr('disabled', true);
		
		$('#bt').attr('disabled', false);
		$('#bt_fna').attr('disabled', false);
		$('#nacionalidad1').attr('disabled', false);
		$('#nacionalidad2').attr('disabled', false);
		$('#cedula').attr('disabled', false);
		$('#nombre1').attr('disabled', false);
		$('#nombre2').attr('disabled', false);
		$('#apellido1').attr('disabled', false);
		$('#apellido2').attr('disabled', false);
		$('#sexo1').attr('disabled', false);
		$('#sexo2').attr('disabled', false);
		$('#estado2').attr('disabled', false);
		$('#ciudad2').attr('disabled', false);
		$('#celular').attr('disabled', false);
		$('#telefono').attr('disabled', false);
		$('#estado_civ').attr('disabled', false);
		$('#discapacidad').attr('disabled', false);
		$('#estado').attr('disabled', false);
		$('#ciudad').attr('disabled', false);
		$('#correo').attr('disabled', false);
		$('#direccion').attr('disabled', false);
		$('#tipo_nomina1').attr('disabled', false);
		$('#tipo_nomina2').attr('disabled', false);
		$('#tipo_nomina3').attr('disabled', false);
		$('#tipo_nomina4').attr('disabled', false);
		$('#profesion').attr('disabled', false);
		$('#cargo').attr('disabled', false);
		$('#departamento').attr('disabled', false);
		$('#upsa').attr('disabled', false);
		$('#correo2').attr('disabled', false);
		$('#observacion').attr('disabled', false);
		$('input[name="recaudos[]"]').attr('disabled', false);
				
    });	
     $('#agregar').click(function(){
		if(valida()){	
		fn_agregar();			
		$('#nuevo').removeClass('btn_agregar_desact').addClass('btn_act');
		$('#nuevo').attr('disabled', false);
		$('#agregar').removeClass('btn_act').addClass('btn_agregar_desact');
		$('#agregar').attr('disabled', true);	
		
		$('#bt').attr('disabled', true);
		$('#bt_fna').attr('disabled', true);
		$('#nacionalidad1').attr('disabled', true);
		$('#nacionalidad2').attr('disabled', true);
		$('#cedula').attr('disabled', true);
		$('#nombre1').attr('disabled', true);
		$('#nombre2').attr('disabled', true);
		$('#apellido1').attr('disabled', true);
		$('#apellido2').attr('disabled', true);
		$('#sexo1').attr('disabled', true);
		$('#sexo2').attr('disabled', true);
		$('#ciudad2').attr('disabled', true);
		$('#ciudad2').attr('disabled', true);
		$('#celular').attr('disabled', true);
		$('#telefono').attr('disabled', true);
		$('#estado_civ').attr('disabled', true);
		$('#discapacidad').attr('disabled', true);
		$('#estado').attr('disabled', true);
		$('#ciudad').attr('disabled', true);
		$('#correo').attr('disabled', true);
		$('#direccion').attr('disabled', true);
		$('#tipo_nomina1').attr('disabled', true);
		$('#tipo_nomina2').attr('disabled', true);
		$('#tipo_nomina3').attr('disabled', true);
		$('#tipo_nomina4').attr('disabled', true);
		$('#profesion').attr('disabled', true);
		$('#cargo').attr('disabled', true);
		$('#departamento').attr('disabled', true);
		$('#upsa').attr('disabled', true);
		$('#correo2').attr('disabled', true);
		$('#observacion').attr('disabled', true);
		$('input[name="recaudos[]"]').attr('disabled', true);
				
		}
    });
    });
</script>  
</script>  
<style>
.btn_act{ height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #09F; border-right:1px solid #09F; border-top:0px; border-left:0px; font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px; background-image: url(../../Imagen_sistema/cancelar.jpg);}.btn_nuevo_act_img{background-image: url(../../Imagen_sistema/nuevo.jpg);}.btn_cancelar_act_img{margin: auto; background-repeat: no-repeat; cursor:hand; cursor:pointer; height: 21px; width: 22px; border: 0px; background-image: url(../../Imagen_sistema/cancelar.jpg);}.btn_guardar_act_img{background-image: url(../../Imagen_sistema/guardar.jpg);}.btn_act:hover{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #0F0; border-right:1px solid #0F0; border-top:0px; border-left:0px;font-size: 13px; color:black; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}.btn_guardar_desact{height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #999; border-right:1px solid #999; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer;  margin-left:5px; margin-right:5px;  outline-width:0px;}/*.btn_guardar_desact_img{background-image: url(Imagen_sistema/guardar_desac.jpg);}*/.btn_guardar_desact:hover{ height: 23px; background-color: #f5f5f0; border-bottom: 1px solid #333; border-right:1px solid #333; border-top:0px; border-left:0px; font-size: 13px; color:#CCC; padding-left: 20px; background-repeat: no-repeat; cursor:hand; cursor:pointer; margin-left:5px; margin-right:5px; outline-width:0px;}#popup {left: 0; position: absolute; top: 0; width: 100%; z-index: 1001;}.content-popup {margin:0px;  padding:10px;  width:732px;   min-height:250px; border-radius:4px; background-color:#FFFFFF; box-shadow: 0 2px 5px #666666;}.close {position:relative; left:700px;}
</style>
</head> 
<body> 
    <form action="javascript: fn_nuevo();" method="POST" id="form_titular" name="form_titular">    
    <table width="700px" height="36" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="666" height="36"><h1>Modificar Datos del Titular</h1></td> 
          <td width="34" valign="top"><input name="cancelar" type="button" id="cancelar" class='btn_cancelar_act_img' onClick="fn_cerrar();" title="Salir" /></td>   
        </tr>
      </table>
      <fieldset>
      <legend align="left">Datos Personales</legend>
        <table width="701" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="115" >Nacionalidad:</td>
          <td width="185" >
            <input name="nacionalidad" type="radio" id="nacionalidad1" value="V" disabled="disabled" <?php if($nacionalidad=='V') echo "checked=\"checked\""?> >Venezolano 
            <input type="radio" name="nacionalidad" id="nacionalidad2" value="E" disabled="disabled" <?php if($nacionalidad=='E') echo "checked=\"checked\""?> > Extranjero
           </td>
          <td width="136" >Nro. C.I o Pasaporte:</td>
          <td colspan="2" ><input name="ced" type="text" disabled="disabled" id="ced" value="<?php echo $cedula;?>" size="20" maxlength="16"/></td>
          <td><div id="test" style="cursor: pointer;" title="Ejemplo: 20643089, Si la C.I es menor a ocho (8) dígitos complete con ceros (0) a la izquierda Ejemplo: 08042667" class="test" style="width:30px;"><img src="../Imagenes/ayuda.png" width="15" height="15"/></div></td>
          </tr>
        <tr>
          <td>Primer Nombre:</td>
          <td><input name="nombre1" type="text" disabled id="nombre1" value="<?php echo $nombre1;?>" size="28" /></td>
          <td>Segundo Nombre:</td>
          <td colspan="3">
            <input name="nombre2" type="text" disabled id="nombre2" value="<?php echo $nombre2;?>" size="28"  />
          </td>
          </tr>
        <tr>
          <td>Primer Apellido:</td>
          <td><input name="apellido1" type="text" disabled id="apellido1" value="<?php echo $apellido1;?>" size="28" /></td>
          <td>Segundo Apellido:</td>
          <td colspan="3">     <input name="apellido2" type="text" disabled id="apellido2" value="<?php echo $apellido2;?>" size="28" />
          </td>
          </tr>
        <tr>
          <td>Sexo:</td>
          <td><input type="radio" name="sexo" id="sexo1" value="F" <?php if($sexo=='F') echo "Checked=\"checked\""?> disabled="disabled"/> Femenino        
              <input type="radio" name="sexo" id="sexo2" value="M" <?php if($sexo=='M') echo "Checked=\"checked\""?> disabled="disabled"/> Masculino
           </td>
          <td>Fecha de Nacimiento:</td>
          <td width="72"> <input name="fecha_nac" type="text" id="fecha_nac" value="<?php echo $fecha_nac;?>" size="12" maxlength="10" readonly /></td>
          <td width="43"><button name="bt" id="bt" class="button" disabled="disabled" title="Calendario para buscar fecha"><img src="Imagen_sistema/calend.png" width="20" height="20"/></button></td>
          <td width="131">
          </td>
        </tr>
            <tr>
              <td>Lugar Nacimiento:</td>
              <td><select name="estado2" disabled="disabled" id="estado2">
                <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
                <?php include_once("../Clases/clase_estado.php");
                  $estado=new estado();
                  $lista_estado=$estado->lista_estado();
                  for($i=0;$i<count($lista_estado);$i++){
                ?><option value="<?php echo $lista_estado[$i][1];?>"<?php if($lista_estado[$i][1]==$id_estado2){ echo "selected=\"selected\"";}?>><?php echo $lista_estado[$i][2];?></option>
                <?php }?>
              </select></td>
              <td>Ciudad:</td>
              <td colspan="3">
                <select name="ciudad2" disabled="disabled" id="ciudad2">
                  <div id="cap1" style="display:block;">
                  <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
                  <?php include_once("../Clases/clase_ciudad.php");
                     $city=new ciudad();
                     $city->setidEstado($id_estado2);
                     $lista_city=$city->lista_ciudad();
                     for($i=0;$i<count($lista_city);$i++){
                  ?><option value="<?php echo $lista_city[$i][1];?>"<?php if($lista_city[$i][1]==$idCiudadnac){ echo "selected=\"selected\"";} ?>><?php echo $lista_city[$i][2];?></option>
                  <?php }?>
                  </div>
                  <div id="cap2" style="display:none">
                  </div>
                </select></td>
            </tr>
            <tr>
          <td>Celular:</td>
          <td>
            <input name="celular" type="text" disabled id="celular" value="<?php echo $celular;?>" size="15" maxlength="12" />
          </td>
          <td >Teléfono:</td>
          <td colspan="3" ><input name="telefono" type="text" disabled id="telefono" value="<?php echo $telefono;?>" size="15" maxlength="12"  /></td>
          </tr>
        <tr>
          <td>Estado Civil:</td>
          <td><select name="estado_civ" disabled="disabled" id="estado_civ">
           <option value="0" selected> Seleccionar</option>
            <option value="SOLTERO" <?php if($estado_civ=='SOLTERO') echo "Selected=\"Selected\""; ?>>Soltero</option>
            <option value="CASADO" <?php if($estado_civ=='CASADO') echo "Selected=\"Selected\""; ?>>Casado</option>
             <option value="CONCUBINATO" <?php if($estado_civ=='CONCUBINATO') echo "Selected=\"Selected\""; ?>>Concubinato</option>
            <option value="DIVORCIADO" <?php if($estado_civ=='DIVORCIADO') echo "Selected=\"Selected\""; ?>>Divorciado</option>
            <option value="VIUDO" <?php if($estado_civ=='VIUDO') echo "Selected=\"Selected\""; ?>>Viudo</option>
          </select></td>
          <td>Discapacidad:</td>
          <td colspan="3" rowspan="2" valign="top">
            <select name="discapacidad[]" id="discapacidad" multiple="multiple" title="Seleccionar" >        
              <?php	include_once("../Clases/clase_discapacidad.php");
                    include_once("../Clases/clase_detalle_discapacidad.php");
                    $discapacidad=new discapacidad();
                    $detalle_disc= new detalle_disc();
                    $detalle_disc->setidTitular($_POST['id_titular']);
                    $buscar_discapacidades=$detalle_disc->buscar_discapacidades();
                    $lista_discapacidad=$discapacidad->lista_discapacidad();
                    for($i=0;$i<count($lista_discapacidad);$i++)
                    {                
					?><option value="<?php echo $lista_discapacidad[$i][1];?>"<?php for($x=0;$x<count($buscar_discapacidades);$x++){
                                        if($lista_discapacidad[$i][1]==$buscar_discapacidades[$x][3]){echo "Selected=\"Selected\"";}
                                    	}?>><?php echo $lista_discapacidad[$i][2];?></option>
            					<?php }?>
            </select>
          </td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="hidden" name="id_titular" id="id_titular" value="<?php echo $_POST['id_titular'];?>">
            <input type="hidden" name="cedula" id="cedula" value="<?php echo $cedula;?>">
          <input name="ope" type="hidden" id="ope" value="M" hidden="hidden" /></td>
          <td>&nbsp;</td>     
        </tr>
        </table>    
        </fieldset>
         <fieldset> 
          <legend align="left">Dirección de Habitación</legend>   
         <table width="700" border="0">   
        <tr>
          <td width="123">Estado:</td>
          <td width="197"><select name="estado" disabled="disabled" id="estado">
            <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
            <?php include_once("../Clases/clase_estado.php");
              $estado=new estado();
              $lista_estado=$estado->lista_estado();
              for($i=0;$i<count($lista_estado);$i++){
            ?><option value="<?php echo $lista_estado[$i][1];?>" <?php if($lista_estado[$i][1]==$id_estado){ echo "selected=\"selected\"";}?>><?php echo $lista_estado[$i][2];?></option>
            <?php }?>
          </select></td>
          <td width="61">Ciudad:</td>
          <td width="292"><select name="ciudad" id="ciudad" disabled="disabled">
            <div id="cap1" style="display:block;">
            <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
            <?php include_once("../Clases/clase_ciudad.php");
                $city=new ciudad();
                $city->setidEstado($id_estado);
                $lista_city=$city->lista_ciudad();
               for($i=0;$i<count($lista_city);$i++){
           ?><option value="<?php echo $lista_city[$i][1];?>" <?php if($lista_city[$i][1]==$idCiudad){ echo "selected=\"selected\"";} ?>><?php echo $lista_city[$i][2];?></option>
            <?php }?>
            </div>
            <div id="cap2" style="display:none">
            </div>
          </select></td>
          <td width="5">&nbsp;</td>
        </tr>    
         <tr>
           <td >Correo Electronico:</td>
           <td colspan="4" ><input name="correo" type="text" disabled id="correo" value="<?php echo $correo_elect;?>" size="50"/></td>
        </tr>
        <tr>
          <td height="42">Direccion de Hab.:</td>
          <td colspan="4">
            <label for="direccion"></label>
            <textarea name="direccion" cols="45" rows="2" disabled id="direccion"><?php echo $direccion_hab;?></textarea>
          </td>
        </tr>
      </table>
      </fieldset>
      <fieldset>  
        <legend align="left">Datos del Trabajado</legend>   
        <table width="697" border="0">  
          <tr>
            <td height="28">Tipo Nómina:</td>
            <td><input type="radio" name="tipo_nomina" id="tipo_nomina1" value="P" <?php if($tipo=='P') echo "Checked=\"checked\""?>disabled="disabled">
              Presidente</td>
            <td><input type="radio" name="tipo_nomina" id="tipo_nomina2" value="D" <?php if($tipo=='D') echo "Checked=\"checked\""?>disabled="disabled">
              Directivo</td>
            <td ><input type="radio" name="tipo_nomina" id="tipo_nomina3" value="E" <?php if($tipo=='E') echo "Checked=\"checked\""?>disabled="disabled">
              Empleado</td>
            <td width="82"><input type="radio" name="tipo_nomina" id="tipo_nomina4" value="C" <?php if($tipo=='C') echo "Checked=\"checked\""?>disabled="disabled">
            Contrato</td>
            <td width="188"><input type="radio" name="tipo_nomina" id="tipo_nomina5" value="O" <?php if($tipo=='O') echo "Checked=\"checked\""?>disabled="disabled">
Obrero</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
          <td width="128" height="28">Fecha de ingreso:</td>
          <td width="88"><input name="fecha_ingr" type="text" id="fecha_ingr" value="<?php $elDia=substr($fecha_i,8,2);
            $elMes=substr($fecha_i,5,2);
            $elYear=substr($fecha_i,0,4);
            $fecha_ingr=$elDia."-".$elMes."-".$elYear;		echo $fecha_ingr;?>" size="12" maxlength="10" readonly /></td>
          <td width="81"><button name="bt_fna" id="bt_fna" class="button" disabled="disabled" title="Calendario para buscar fecha"><img src="Imagen_sistema/calend.png" width="20" height="20" /></button></td>
          <td width="87" >Profesión:</td>
          <td colspan="3" rowspan="2" valign="top">    <select name="profesion" id="profesion" disabled="disabled" >
              <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
              <?php include_once("../Clases/clase_profesion.php");
                    $profesion=new profesion();
                    $lista_profesion=$profesion->lista_profesion();
                    for($i=0;$i<count($lista_profesion);$i++){
             ?><option value="<?php echo $lista_profesion[$i][1];?>" <?php if($lista_profesion[$i][2]==$idProfesion){echo "selected=\"selected\"";}?>><?php echo $lista_profesion[$i][2];?></option>
              <?php }?>
          </select></td>
          </tr>
        <tr>
          <td height="24">Cargo:</td>
          <td colspan="2">
            <select name="cargo" id="cargo" disabled="disabled" >
              <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
              <?php include_once("../Clases/clase_cargo.php");
                    $cargo=new cargo();
                    $lista_cargo=$cargo->lista_cargo();
                    for($i=0;$i<count($lista_cargo);$i++){
             ?><option value="<?php echo $lista_cargo[$i][1];?>" <?php if($lista_cargo[$i][1]==$idCargo){echo "selected=\"selected\"";}?>><?php echo $lista_cargo[$i][2];?></option>
              <?php }?>
          </select>
          </td>
          <td >&nbsp;</td>
          </tr>
        <tr>
          <td height="24">Departamento:</td>
          <td colspan="2">
            <select name="departamento" id="departamento" disabled="disabled">
              <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
              <?php include_once("../Clases/clase_departamento.php");
                $departamento=new departamento();
                $lista_departamento=$departamento->lista_departamento();
                for($i=0;$i<count($lista_departamento);$i++){
            ?><option value="<?php echo $lista_departamento[$i][1];?>" <?php if($lista_departamento[$i][1]==$idDepartamento){ echo "selected=\"selected\"";}?>><?php echo $lista_departamento[$i][2];?></option>
              <?php }?>
            </select>
          </td>
          <td>UPSA:</td>
          <td colspan="3">
            <select name="upsa" id="upsa" disabled="disabled" title="Sede o Planta">
              <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
              <?php include_once("../Clases/clase_upsa.php");
                $upsa=new upsa();
                $lista_upsa=$upsa->lista_upsa();
                for($i=0;$i<count($lista_upsa);$i++){
          ?><option value="<?php echo $lista_upsa[$i][1];?>" <?php if($lista_upsa[$i][1]==$idUpsa){$direccion2= $lista_upsa[$i][3]; echo "selected=\"selected\"";}?>><?php echo $lista_upsa[$i][2];?></option>
              <?php }?>
            </select>
          </td>
          </tr>
          <tr>
          <td height="37">Dirección:</td>
          <td colspan="5">
            <div id="cap4" style="display:block"><textarea name="direccion2" cols="45" rows="2" readonly id="direccion2"><?php echo $direccion2; ?></textarea></div>
          </td>        
          <td width="13">&nbsp;</td>
        </tr>
          <tr>
            <td height="24">Correo Corporativo:</td>
            <td colspan="5"><input name="correo2" type="text" disabled id="correo2" value="<?php echo $Correo;?>" size="50"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="24">Observaciones:</td>
            <td colspan="5"><textarea name="observacion" cols="45" rows="2" disabled id="observacion"><?php echo $Observ;?></textarea></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="23" rowspan="2">Recaudos:</td><td height="23" colspan="5"> 
            <?php 	include_once("../Clases/clase_recaudo.php");
                include_once("../Clases/clase_detalle_recaudos.php");
                $recaudo= new recaudos();		
                $detalle_rec= new detalle_rec();
                $detalle_rec->setidTitular($_POST["id_titular"]);
                $recaudo->setTiporecaudo('AFILIACIÓN - TITULAR');
                $buscar_recaudos=$detalle_rec->buscar_recaudos();
                $lista_recaudo=$recaudo->lista_recaudo();
                for($i=0;$i<count($lista_recaudo);$i++){
                  if($lista_recaudo[$i][3]=='AFILIACIÓN - TITULAR'){								
            ?><input type="checkbox" disabled="disabled" name="recaudos[]" id="checkbox" value="<?php echo $lista_recaudo[$i][1];?>" 
                                <?php 
                                for($x=0;$x<count($buscar_recaudos);$x++){	                              
                                 if ($lista_recaudo[$i][1]==$buscar_recaudos[$x][3]){echo "checked=\"checked\"";}
                                }?>/><?php echo $lista_recaudo[$i][2]; ?>          
                 <?php		
		}else { echo "<div id='color_error' style='color:#F00'> Alerta: No se han asignado recaudos por Titular</div>";}			
		}?>
           </td>         
          <td>&nbsp;</td>
          </tr>
        </table>
       </fieldset>
       <table  width="700px" border="0">
          <tr>
            <td width="220">&nbsp;</td>
            <td width="76"><input name="nuevo" type="button" id="nuevo" value=" Modificar" class='btn_act btn_nuevo_act_img' title="Pulse para activar campos"/></td>
          <td width="78"><input name="agregar" type="submit"  class='btn_agregar_desact btn_agregar_act_img' disabled="disabled" id="agregar" onClick="if(!valida()){return false};" value=" Guardar" /></td>
          <td width="308">&nbsp;</td>
          </tr>
      </table> 
      </form>
</body>
</html>
