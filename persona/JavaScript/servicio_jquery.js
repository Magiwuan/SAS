// JavaScript Document
	function fn_agregar(){		
		var str = $("#form_servicio").serialize();
		$.ajax({
			url: '../../Controladores/controlador_servicio.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data=="No"){				
					jAlert('Este Servicio de Proveedor ya ha sido incluido al Sistema.','Mensaje de Alerta');
				}else{
					jAlert(data);
					fn_listar_servicio();
				}				
			}
		});
	};
$(document).ready(function(){
	fn_listar_servicio();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
function fn_paginar(var_div, url){
	var div = $("#" + var_div);
	$(div).load(url);
	/*
	div.fadeOut("fast", function(){
		$(div).load(url, function(){
			$(div).fadeIn("fast");
		});
	});
	*/
}
function fn_listar_servicio(){
	var str = $("#form_servicio").serialize();
	$.ajax({
		url: '../../Php/servicios_proveedor/listar_servicio.php',
		type: 'get',
		data: str,
		success: function(data){		
			$("#div_listar_servicio").html(data);				
		}
	});

}

function fn_eliminar_servicio(id_servicio){
	jConfirm('Desea eliminar este Servicio?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/servicios_proveedor/eliminar_servicio.php',
			data: 'id_servicio='+id_servicio,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_servicio();
							}
					});
		}
					});
	
}