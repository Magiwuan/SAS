// JavaScript Document

function valida(){
	if(document.form_solicitud_medicina.cedTitular.value=='') {
		jAlert('El campo \"Cedula o Pasaporte\" no puede estar vacio!','Dialogo de Alerta');
		document.form_solicitud_medicina.cedTitular.focus();
		return false;
	}
	valor1=document.form_solicitud_medicina.cedTitular.value;
	if(!/\d[0-9]$/.test(valor1) ) {//4
		document.form_solicitud_medicina.cedTitular.focus();
		jAlert('El campo \"Cedula\" no es valido! Ejemplo: 123456789, sin caracteres especiales y letras','Dialogo de Alerta');
		return false;
	}
		if(document.form_solicitud_medicina.beneficiario.value=="0"){
		jAlert("Debe seleccionar el beneficiario!");
		document.form_solicitud_medicina.beneficiario.focus();
		return false;
	}
	if(document.form_solicitud_medicina.nombAutorizado.value.length >1){
		
		var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú ";
		var checkStr = document.form_solicitud_medicina.nombAutorizado.value;
		var allValid = true; 
		for(var i=0;i<checkStr.length;i++){
			ch=checkStr.charAt(i); 
			for(var j=0;j<checkOK.length;j++)
				if(ch=checkOK.charAt(j))
					break;
				if(j==checkOK.length){ 
					allValid=false; 
					break; 
				}			
		}	
		if (!allValid) { 
			jAlert('El campo \"Nombre de Autorizado\" admite solamente letras','Dialogo de Alerta'); 
			document.form_solicitud_medicina.nombAutorizado.value=''; 
			document.form_solicitud_medicina.nombAutorizado.focus(); 
			return false; 
		} 
		if(document.form_solicitud_medicina.cedAutorizado.value=='') {
			jAlert('El campo \"Nro. Cedula\" no puede estar vacio!','Dialogo de Alerta');
			document.form_solicitud_medicina.cedAutorizado.focus();
			return false;
		} 
	
		valor5=document.form_solicitud_medicina.cedAutorizado.value;
		if(!/\d{8}$/.test(valor5) ) {//4		
			jAlert('El campo \"Nro. Cedula\" no es valido! Ejemplo: 123456789, sin caracteres especiales y letras','Dialogo de Alerta');
			document.form_solicitud_medicina.cedAutorizado.focus();
			return false;
		}
	}
		
	if(document.form_solicitud_medicina.organizacion.value=="0"){
		jAlert('Debe seleccionar el organización!','Dialogo de Alerta');
		document.form_solicitud_medicina.organizacion.focus();
		return false;
	}
	var s="no";
	for ( var j = 0; j < document.form_solicitud_medicina.tratamiento.length; j++ ){
		if ( document.form_solicitud_medicina.tratamiento[j].checked ){
		s= "si";
		break;
		}
	}
	if (s=="no"){
	jAlert("Debe seleccionar un tratamiento");
	return false;
	}
	if(document.form_solicitud_medicina.patologia.value=="0"){
		jAlert('Debe seleccionar el patología!','Dialogo de Alerta');
		document.form_solicitud_medicina.patologia.focus();
		return false;
	}
	return true;
}