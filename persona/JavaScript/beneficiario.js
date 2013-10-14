// JavaScript Document
	Calendar.setup({
        inputField : "fecha_nac",
		dateFormat: "%d-%m-%Y",
        trigger    : "bt",
        onSelect   : function() { this.hide() },
      	});
	function valida() {
	var n="no";
	for ( var i=0; i<document.form_beneficiario.nacionalidad.length;i++)	{
		if ( document.form_beneficiario.nacionalidad[i].checked ){
			n= "si";
			break;
		}
	}
	if (n=="no"){
	jAlert('Debe seleccionar una Nacionalidad','Dialogo de Alerta') ;
		return false;
	}
		   if (document.form_beneficiario.nombre1.value.length <1) 
		  {
			jAlert('El campo  \"Primer Nombre\"  no puede estar vacio','Dialogo de Alerta');
			document.form_beneficiario.nombre1.focus();
			return false;
		  }
		  if(document.form_beneficiario.nombre1.value.length <3 ) {		
		  jAlert('El campo \"Nombres" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		  document.form_beneficiario.nombre1.focus();
		  return false;
	      }
		  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú ";
		  var checkStr = document.form_beneficiario.nombre1.value;
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
			jAlert('El campo \"Primer Nombre\" admite solo letras.','Dialogo de Alerta');
			document.form_beneficiario.nombre1.value='';  
			document.form_beneficiario.nombre1.focus(); 
			return false; 
		  } 
		  if(document.form_beneficiario.nombre2.value.length >15 ) {		
		  jAlert('El campo \"Segundo Nombre" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		  document.form_beneficiario.nombre2.focus();
		  return false;
	      }
		  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú ";
		  var checkStr = document.form_beneficiario.nombre2.value;
		  var allValid = true; 
		  for (i = 0; i < checkStr.length;i++) {
			ch = checkStr.charAt(i); 
			for (j = 0; j < checkOK.length;j++)
			  if (ch == checkOK.charAt(j))
				break;
			if (j == checkOK.length) { 
			  allValid = false; 
			  break; 
			}
		  }
		  if (!allValid) { 
			jAlert('El campo \"Segundo Nombre\" admite solo letras.','Dialogo de Alerta');
			document.form_beneficiario.nombre2.value='';  
			document.form_beneficiario.nombre2.focus(); 
			return false; 
		  }   
		   if (document.form_beneficiario.apellido1.value.length <1) 
		  {
			jAlert('El campo \"Primer Apellido\" no puede estar vacio','Dialogo de Alerta');
			document.form_beneficiario.apellido1.focus();
			return false;
		  } 
		    if(document.form_beneficiario.apellido1.value.length <3) {		
		  jAlert('El campo \"Primer Apellido" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		  document.form_beneficiario.apellido1.focus();
		  return false;
	      }
		  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú ";
		  var checkStr = document.form_beneficiario.apellido1.value;
		  var allValid = true; 
		  for (i = 0; i < checkStr.length;i++) {
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
			jAlert('El campo \"Primer Apellido\" admite solamente letras','Dialogo de Alerta'); 
			document.form_beneficiario.apellido1.value=''; 
			document.form_beneficiario.apellido1.focus(); 
			return false; 
		  }
		    if(document.form_beneficiario.apellido2.value.length >15) {		
		jAlert('El campo \"Segundo Apellido" no puede ser mayor a 15 caracteres!','Dialogo de Alerta');
		  document.form_beneficiario.apellido2.focus();
		  return false;
	      }
		  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú ";
		  var checkStr = document.form_beneficiario.apellido2.value;
		  var allValid = true; 
		  for (i = 0; i < checkStr.length;i++) {
			ch = checkStr.charAt(i); 
			for (j = 0; j < checkOK.length;j++)
			  if (ch == checkOK.charAt(j))
				break;
			if (j == checkOK.length) { 
			  allValid = false; 
			  break; 
			}
		  }
		  if (!allValid) { 
			jAlert('El campo \"Segundo Apellido\" admite solamente letras','Dialogo de Alerta'); 
			document.form_beneficiario.apellido2.value=''; 
			document.form_beneficiario.apellido2.focus(); 
			return false; 
		  }
	 var s="no";
	for (var j = 0; j < document.form_beneficiario.sexo.length; j++)	{
		if (document.form_beneficiario.sexo[j].checked){
			s= "si";
			break;
		}
	}
	if ( s == "no" ){
	jAlert("Debe seleccionar una Sexo") ;
		return false;
	}
	if(document.form_beneficiario.fecha_nac.value=='' ) {		
		  jAlert('El campo \"Fecha de Nacimiento" no puede estar vacio!','Dialogo de Alerta');
		  document.form_beneficiario.fecha_nac.focus();
		  return false;
	      }
	if(document.form_beneficiario.celular.value == '') {
		document.form_beneficiario.celular.focus();
		jAlert('El campo \"Celular\" no puede estar vacio!','Dialogo de Alerta');
		return false;
	}	
	valor1 = document.form_beneficiario.celular.value;
	if(!/^\d{4}-\d{7}$/.test(valor1)) {
		document.form_beneficiario.celular.focus();
		jAlert('El campo \"Celular\" no es valido! Ejemplo: 0416-2323455','Dialogo de Alerta');
		return false;
	}	
	if(document.form_beneficiario.telefono.value == '') {//4
		document.form_beneficiario.telefono.focus();
		jAlert('El campo \"Teléfono\" no puede estar vacio!','Dialogo de Alerta');
		return false;
	}
	valor2 = document.form_beneficiario.telefono.value;
	if(!/^\d{4}-\d{7}$/.test(valor2)) {//4
		document.form_beneficiario.telefono.focus();
		jAlert('El campo \"Teléfono\" no es valido! Ejemplo: 0233-2323455','Dialogo de Alerta');
		return false;
	}	
	if(document.form_beneficiario.parentesco.value=="0"){//6
		jAlert("Debe seleccionar el parentesco!");
		document.form_beneficiario.parentesco.focus();
		return false;
	}
	if(document.form_beneficiario.participacion.value == '') {//8
		jAlert('El campo \"% de Participación\" no puede estar vacio!','Dialogo de Alerta');
		document.form_beneficiario.participacion.focus();
		return false;	
	}	
	valor4 = document.form_beneficiario.participacion.value;
	if(!/^\d{2}%\d{0}$/.test(valor4) ) {
		document.form_beneficiario.participacion.focus();
		jAlert('El campo \"Participación\" no es valido! Ejemplo: 20%, sin otros caracteres especiales y letras','Dialogo de Alerta');
		return false;
	}
	if(document.form_beneficiario.estado_civ.value=="0"){//6
		jAlert("Debe seleccionar el estado Civil!");
		document.form_beneficiario.estado_civ.focus();
		return false;
	}
	return true;
}
 $(document).ready(function(){
		   $("select[multiple]").asmSelect({			
			});	
		$('#open').click(function(){
		$("#cap").load('php/recaudos/popu_recaudos.php');	
        $('#popup').fadeIn('slow');
    });
    $('#close').click(function(){
        $('#popup').fadeOut('slow');
		$('#recaudos').load('php/recaudos/recaudo.php');		
    });
	});	