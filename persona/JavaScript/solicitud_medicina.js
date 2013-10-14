// JavaScript Document
function fn_buscar(){	
	var str = $("#frm_buscar").serialize();
	var resp = false;
	$.ajax({
		url: 'Php/transacciones/solicitud_medicinas/vista_lista_sol.php',
		type: 'get',
		data: str,		
		success: function(data){			
				$("#div_listar").html(data);				 		
		}
	});
function valida(){
	 if(document.form_solicitud_medicina.medicamento.value.length<1 || document.form_solicitud_medicina.medicamento.value=='Buscar Medicinas') {		
		  jAlert('El campo \"Medicamento" no puede estar vacio','Dialogo de Alerta');
		  document.form_solicitud_medicina.medicamento.focus();
		  return false;
	      }
		  var valor0=document.form_solicitud_medicina.cantidad.value;
		  if(!/^[1-9]$/.test(valor0) ) {//4
		document.form_solicitud_medicina.cantidad.focus();
		jAlert('El campo \"Cantidad\" no es valido! sin caracteres especiales y letras','Dialogo de Alerta');
		return false;
	}
	if(document.form_solicitud_medicina.cedTitular.value=='') {
		jAlert('El campo \"Cedula o Pasaporte\" no puede estar vacio!','Dialogo de Alerta');
		document.form_solicitud_medicina.cedTitular.focus();
		return false;
	}
	valor1=document.form_solicitud_medicina.cedTitular.value;
	if(!/\d{8}$/.test(valor1) ) {//4
		document.form_solicitud_medicina.cedTitular.focus();
		jAlert('El campo \"Cedula\" no es valido! Ejemplo: 20643089, sin caracteres especiales y letras','Dialogo de Alerta');
		return false;
	}
	
	
	return true;
}

}

