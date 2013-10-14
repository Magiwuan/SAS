// JavaScript Document
// JavaScript Document
function valida(){
	if(document.from_solicitud_reembolso.cedTitular.value=='') {
		jAlert('El campo \"Cédula o Pasaporte\" no puede estar vacio!','Dialogo de Alerta');
		document.from_solicitud_reembolso.cedTitular.focus();
		return false;
	}
	valor1=document.from_solicitud_reembolso.cedTitular.value;
	if(!/\d[0-9]$/.test(valor1) ) {//4
		document.from_solicitud_reembolso.cedTitular.focus();
		jAlert('El campo \"Cédula\" no es valido! Ejemplo: 123456789, sin caracteres especiales y letras','Dialogo de Alerta');
		return false;
	}
	if(document.from_solicitud_reembolso.beneficiario.value=="0"){
		jAlert('Debe seleccionar el beneficiario!','Dialogo de Alerta');
		document.from_solicitud_reembolso.beneficiario.focus();
		return false;
	}
	if(document.from_solicitud_reembolso.Tipo.value=="0"){
		jAlert('Debe seleccionar el Tipo de Orden!','Dialogo de Alerta');
		document.from_solicitud_reembolso.Tipo.focus();
		return false;
	}
	if(document.from_solicitud_reembolso.diagnostico.value=="0"){
		jAlert('Debe seleccionar el Tipo de Orden!','Dialogo de Alerta');
		document.from_solicitud_reembolso.diagnostico.focus();
		return false;
	}
	return true;
}
