// JavaScript Document
function valida(){
	if(document.form_orden_solicitud.organizacion.value=="0"){
		jAlert('Debe seleccionar el organización!','Dialogo de Alerta');
		document.form_orden_solicitud.organizacion.focus();
		return false;
	}
	if(document.form_orden_solicitud.medico.value=="0"){
		jAlert('Debe seleccionar el médico!','Dialogo de Alerta');
		document.form_orden_solicitud.medico.focus();
		return false;
	}
	if(document.form_orden_solicitud.medico.value=="-1"){
		jAlert('No hay médicos registrados por esta organización.\n Seleccione otra organización o registre previamente el médico','Dialogo de Alerta');
		document.form_orden_solicitud.medico.focus();
		return false;
	}
	if(document.form_orden_solicitud.cedTitular.value=='') {
		jAlert('El campo \"Cédula o Pasaporte\" no puede estar vacio!','Dialogo de Alerta');
		document.form_orden_solicitud.cedTitular.focus();
		return false;
	}
	valor1=document.form_orden_solicitud.cedTitular.value;
	if(!/\d[0-9]$/.test(valor1) ) {//4
		document.form_orden_solicitud.cedTitular.focus();
		jAlert('El campo \"Cédula\" no es valido! Ejemplo: 123456789, sin caracteres especiales y letras','Dialogo de Alerta');
		return false;
	}
	if(document.form_orden_solicitud.beneficiario.value=="0"){
		jAlert('Debe seleccionar el beneficiario!','Dialogo de Alerta');
		document.form_orden_solicitud.beneficiario.focus();
		return false;
	}
	if(document.form_orden_solicitud.patologia.value=="0"){
		jAlert('Debe seleccionar el patología!','Dialogo de Alerta');
		document.form_orden_solicitud.patologia.focus();
		return false;
	}
	if(document.form_orden_solicitud.Tipo.value=="0"){
		jAlert('Debe seleccionar el Tipo de Orden!','Dialogo de Alerta');
		document.form_orden_solicitud.Tipo.focus();
		return false;
	}
	return true;
}