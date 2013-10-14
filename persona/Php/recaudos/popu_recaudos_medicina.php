<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
     <link rel="stylesheet" type="text/css" href="../../Css/estilo2.css" />  
    <link rel="stylesheet" type="text/css" href="../../Css/estilo.css" />  
	<link rel="stylesheet" type="text/css" href="../../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../../Css/border-radius.css" /> 
    <link href="../../Css/PHPPaging.lib.css" rel="stylesheet" type="text/css" /> 	
	<link href="../../JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />     	
	<script language="javascript" type="text/javascript" src="../../JavaScript/jquery-1.4.2.min.js"></script>            
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.blockUI.js"></script>   
   	<script language="javascript" type="text/javascript" src="../../JavaScript/recaudos_jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script>  
    <body>
        <div id="cuerpo">
          <form action="javascript: fn_agregar();" method="post" id="form_recaudos_agregar" name="form_recaudos_agregar">
            <table width="706" height="25" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="706"> <h1> Agregando Recaudos</h1></td>
                </tr>
  		    </table>
              <fieldset>  
    				<legend align="left"> </legend>
    					<table width="386" height="103" class="formulario"><br />
                    		<tbody>
                                <tr>
                                    <td width="9" height="63"><input name="ope" type="hidden" id="ope" value="I" hidden="hidden" /></td>
                                    <td width="79">Nombre:</td>
                                    <td width="341" ><textarea name="nombre" id="textarea2" cols="45" rows="2"></textarea></td>
                                </tr>
                                <tr>
                                  <td height="32">&nbsp;</td>
                                  <td>Tipo:</td>
                                  <td ><select name="tipo" id="tipo">
                                   <option value="0"> Seleccionar</option>
                                    <option value="Afiliación - Titular"> Afiliación - Titular</option>
                                    <option value="Afiliación - Beneficiario"> Afiliación - Beneficiario</option>
                                    <option value="Exclusión - Titular"> Exclusión - Titular</option>
                                    <option value="Exclusión - Beneficiario"> Exclusión - Beneficiario</option>
                                    <option value="Reembolsos"> Reembolsos</option>
                                    <option value="Solicitud de Médicinas"> Solicitud de Médicinas</option>
                                    <option value="Orden Médica"> Orden Médica</option>
                                    <option value="Otros"> Otros</option>
                                  </select></td>
                              </tr>
                    
                          </tbody>
                        </table>
                
                     </fieldset>
        
                      <table  width="708" border="0">
                           <tr>
                           <td width="327">&nbsp;</td>
                           <td width="63"><input name="agregar" type="submit" id="agregar" value="Agregar" class="button" onclick="if(!valida()){return false;}"/>
                           </td>
                           <td width="304">&nbsp;</td>
                           </tr>
                       </table>
      
          <hr />
            <div id="div_listar_recaudos"></div>                   
          </form>    
        </div>
 <script language="javascript" type="text/javascript">

	function fn_agregar(){		
		var str = $("#form_recaudos_agregar").serialize();
		$.ajax({
			url: '../../Controladores/controlador_recaudos.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Este Recaudo ya ha Sido incluido al Sistema.','Dialogo de Alerta');
				}else{
					jAlert(data);
					fn_listar_recaudos();

				}				
			}
		});
	};
	 function valida() {
 //Valida Todo el campo segundo nombre del recaudos
          //Valida que el recaudos no este vacia
		if(document.form_recaudos_agregar.nombre.value == '') {
		document.form_recaudos_agregar.nombre.focus();
		
		jAlert('El campo \"Nombre\" no puede estar vacio!','Dialogo de Alerta');
		return false;
		}
		  if(document.form_recaudos_agregar.nombre.value.length <3 ) {		
		  jAlert('El campo \"Nombre" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		  document.form_recaudos_agregar.nombre.focus();
		  return false;
	      }
		  //valida que se ingresen solo letras al campo nombre
		  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú ";
		  var checkStr = document.form_recaudos_agregar.nombre.value;
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
			document.form_recaudos_agregar.nombre.value='';  
			document.form_recaudos_agregar.nombre.focus(); 
			return false; 
		  }
		  if(document.form_recaudos_agregar.tipo.value=="0"){//6
		jAlert('Debe seleccionar el Tipo!','Dialogo de Alerta');
		document.form_recaudos_agregar.tipo.focus();
		return false;
	}   
	return true;
}	
</script>
</body>
</html>