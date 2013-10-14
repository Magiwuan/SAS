<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  
    <link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" /> 
	<script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.4.2.min.js"></script>            
   	<script language="javascript" type="text/javascript" src="../../JavaScript/ciudad_jquery.js"></script>
	<script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script> 
    </head>
    <body>
        <div id="cuerpo">  
          <form action="javascript: fn_agregar();" method="post" id="form_ciudad_agregar" name="form_ciudad_agregar">
            <table width="693" height="25" border="0" cellpadding="0" cellspacing="0">
   				 <tr>
      				<td width="693"> <h1> Agregando Ciudad </h1></td>
    			 </tr>
  			</table>
              <fieldset>  
    				<legend align="left"> </legend>
    					<table width="355" height="73" class="formulario">
                    		<tbody>
                        		<tr>
                                    <td width="9" height="35"><input name="ope" type="hidden" id="ope" value="I" hidden="hidden" /></td>
                                    <td width="79">Nombre:</td>
                                    <td width="341" ><label for="textarea">
                                      <input name="nombre" type="text" id="nombre" size="30" class="required" />
                                    </label>
                                    </td>
                                </tr>
                        		<tr>
                          <td height="32">&nbsp;</td>
                          <td>Estado:</td>
                          <td ><select name="estado" id="estado">
                            <option value="0" selected="selected" disabled="disabled">Seleccionar</option>
                            <?php include_once("../../Clases/clase_estado.php");
								$estado=new estado();
								$lista_estado=$estado->lista_estado();
								for($i=0;$i<count($lista);$i++)
								{
								?>
                            <option value="<?php echo $lista_estado[$i][1];?>"><?php echo $lista_estado[$i][2];?></option>
                            <?php }?>
                          </select></td>
                        </tr>
                    
                           </tbody>
                        </table>
                
                   </fieldset>
           			   <table  width="694" border="0">
                           <tr>
                           <td width="327">&nbsp;</td>
                           <td width="81"><input name="agregar" type="submit" id="agregar" value="Agregar" class="button" onclick="if(!valida()){return false;}" />
                           </td>
                           <td width="272">&nbsp;</td>
                           </tr>
                       </table>
          <hr />
           <div id="div_listar_ciudad"></div>                   
          </form>    
        </div>
 <script language="javascript" type="text/javascript">

	function fn_agregar(){		
		var str = $("#form_ciudad_agregar").serialize();
		$.ajax({
			url: '../../Controladores/controlador_ciudad.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Esta Ciudad ya ha Sido incluido al Sistema.','Dialogo de Alerta');
				}else{
					jAlert(data);
					fn_listar_ciudad();

				}				
			}
		});
	};
	 function valida() {
 //Valida Todo el campo segundo nombre del ciudad
          //Valida que el Ciudad no este vacia
		if(document.form_ciudad_agregar.nombre.value == '') {
		document.form_ciudad_agregar.nombre.focus();
		jAlert('El campo \"Nombre\" no puede estar vacio!','Dialogo de Alerta');
		return false;
		}
		  if(document.form_ciudad_agregar.nombre.value.length <3 ) {		
		  jAlert('El campo \"Nombre" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		  document.form_ciudad_agregar.nombre.focus();
		  return false;
	      }
		  //valida que se ingresen solo letras al campo nombre
		  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú ";
		  var checkStr = document.form_ciudad_agregar.nombre.value;
		  var allValid = true; 
		  for (i = 0; i < checkStr.length; i++) {
			ch = checkStr.charAt(i); 
			for (j = 0; j < checkOK.length; j++)
			  if (ch == checkOK.charAt(j))
				break;
			if (j == checkOK.length) { 
			  allValid = false; 
			  break; 
			}
		  }
		  if (!allValid) { 
			jAlert('El campo \"Nombre\" admite solo letras.','Dialogo de Alerta');
			document.form_ciudad_agregar.nombre.value='';  
			document.form_ciudad_agregar.nombre.focus(); 
			return false; 
		  }
		  if(document.form_ciudad_agregar.estado.value=="0"){//6
		jAlert('Debe seleccionar el Estado!','Dialogo de Alerta');
		document.form_ciudad_agregar.estado.focus();
		return false;
	}   
	return true;
}	
</script>
</body>
</html>