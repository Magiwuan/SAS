	// JavaScript Document

function valida(){
	if(document.form_orden_solicitud.organizacion.value=="0"){
		jAlert("Debe seleccionar el organización!");
		document.form_orden_solicitud.organizacion.focus();
		return false;
	}
	if(document.form_orden_solicitud.medico.value=="0"){
		jAlert("Debe seleccionar el Médico tratante!");
		document.form_orden_solicitud.medico.focus();
		return false;
	}
	if(document.form_orden_solicitud.cedTitular.value=='') {
		jAlert('El campo \"Cedula o Pasaporte\" no puede estar vacio!','Dialogo de Alerta');
		document.form_orden_solicitud.cedTitular.focus();
		return false;
	}
	valor1=document.form_orden_solicitud.cedTitular.value;
	if(!/\d{8}$/.test(valor1) ) {//4
		document.form_orden_solicitud.cedTitular.focus();
		jAlert('El campo \"Cedula\" no es valido! Ejemplo: 20643089, sin caracteres especiales y letras','Dialogo de Alerta');
		return false;
	}
		if(document.form_orden_solicitud.beneficiario.value=="0"){
		jAlert("Debe seleccionar el beneficiario!");
		document.form_orden_solicitud.beneficiario.focus();
		return false;
	}
			if(document.form_orden_solicitud.patologia.value=="0"){
		jAlert("Debe seleccionar el patología!");
		document.form_orden_solicitud.patologia.focus();
		return false;
	}
			if(document.form_orden_solicitud.Tipo.value=="0"){
		jAlert("Debe seleccionar el Tipo de Servicio!");
		document.form_orden_solicitud.Tipo.focus();
		return false;
			}
			valor0=document.form_orden_solicitud.Tipo.value;
			if(valor0.value=='L'){
				alert (valor0);
			if(document.form_orden_solicitud.campo.value.length < 1){
		jAlert('Los campos  \"Exámen y descripción\"  no puede estar vacio','Dialogo de Alerta');
		document.form_orden_solicitud.campo.focus();
		
	}return false;
	}
				
				/*if(document.form_orden_solicitud.campo.value.length < 1 && document.form_orden_solicitud.descripcion.value.length < 1){
		jAlert('Los campos  \"Exámen y descripción\"  no puede estar vacio','Dialogo de Alerta');
		document.form_orden_solicitud.campo.focus();
		return false;
	}
	}*/
		
				/*
				if(document.form_orden_solicitud.campo.value.length < 1 && document.form_orden_solicitud.descripcion.value.length < 1){
		jAlert('Los campos  \"Exámen y descripción\"  no puede estar vacio','Dialogo de Alerta');
		document.form_orden_solicitud.campo.focus();
		return false;
	}*/

	/*if(document.form_orden_solicitud.Tipo.value=='E'){
				
				if(document.form_orden_solicitud.campo.value.length < 1 && document.form_orden_solicitud.descripcion.value.length < 1){
		jAlert('Los campos  \"Exámen y descripción\"  no puede estar vacio','Dialogo de Alerta');
		document.form_orden_solicitud.campo.focus();
		return false;
	}
	}
	if(document.form_orden_solicitud.Tipo.value=='C'){
				
				if(document.form_orden_solicitud.motivo.value.length < 1 && document.form_orden_solicitud.diagnostico.value.length < 1){
		jAlert('Los campos  \"Motivo y Diagnostico\"  no puede estar vacio','Dialogo de Alerta');
		document.form_orden_solicitud.motivo.focus();
		return false;
	}
	}¨*/
	return true;
}
