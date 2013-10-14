$(document).ready(function(){
	fn_buscar();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
	
});
function fn_paginar(var_div, url){
	var div = $("#" + var_div);
	$(div).load(url);
}
function fn_eliminar(id_solicitud){
			jPrompt('Motivo de la eliminacion:','', 'Dialogo de Alerta', function(e){	
				if(e=="" || e.length<3){
					jAlert('No puede enviar un Motivo en blanco o Menor a 3 Caracteres','Dialogo Alerta');
				}
				if(e.length>3){
					$.ajax({
					url: 'eliminar_solicitud.php',
					data: 'id_solicitud='+id_solicitud+'&e='+e,
					type: 'post',
					success: function(data){
						if(data!="")
							jAlert(data, 'Resultado de la confirmación');
							fn_buscar()
						}
					});
				}			
			});			
}

function fn_aprobar(cod_hoja){
	
	jConfirm('Esta seguro?', 'Mensaje Confirmación', function(r) {
		if(r==true){
			$.ajax({
				url: 'aceptar_solicitud.php',
				data: 'cod_hoja='+cod_hoja,
				type: 'post',
				success: function(data){
					if(data!="")
					jAlert(data, 'Resultado de la confirmación');
					fn_buscar()
				}
			});		
		}
	});		
}
function fn_cerrar_popup(){
	$.unblockUI({ 
		onUnblock: function(){
			$("#div_oculto").html("");
		}
	}); 
};
function fn_buscar(){	
	var str = $("#frm_buscar").serialize();
	$.ajax({
		url: 'listar_solicitud.php',
		type: 'get',
		data: str,		
		success: function(data){			
				$("#div_listar").html(data);				 		
		}
	});
}

