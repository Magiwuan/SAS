// JavaScript Document
	function fn_agregar(){		
		var str = $("#form_especialidad").serialize();
		$.ajax({
			url: '../../Controladores/controlador_especialidad.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Esta especialidad ya ha Sido incluido al Sistema.','Dialogo de Alerta');
				}else{
					jAlert(data);
					fn_listar_especialidad();
				}				
			}
		});
	};
$(document).ready(function(){
	fn_listar_especialidad();
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

function fn_listar_especialidad(){
	var str = $("#form_especialidad_agregar").serialize();
	$.ajax({
		url: '../../Php/especialidad/listar_especialidad.php',
		type: 'get',
		data: str,
		success: function(data){		
			$("#div_listar_especialidad").html(data);				
		}
	});

}
function fn_eliminar_especialidad(id_especialidad){
	jConfirm('Desea eliminar esta Especialidad?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/especialidad/eliminar_especialidad.php',
			data: 'id_especialidad='+id_especialidad,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_especialidad();
							}
					});
		}
					});
	
}