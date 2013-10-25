// JavaScript Document
$(document).ready(function(){
	fn_listar_discapacidad();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
	function fn_agregar(){		
		var str = $("#form_discapacidad").serialize();
		$.ajax({
			url: '../../Controladores/controlador_discapacidad.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Esta Discapacidad ya ha sido incluido al sistema.','Mensaje de Alerta');
				}else{
					jAlert(data);
					fn_listar_discapacidad();
				}				
			}
		});
	};
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

function fn_listar_discapacidad(){
	var str = $("#form_discapacidad").serialize();
	$.ajax({
		url: '../../Php/discapacidad/listar_discapacidad.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_discapacidad").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},
		success: function(data){		
			$("#div_listar_discapacidad").html(data);				
		}
	});

}

function fn_eliminar_discapacidad(id_discapacidad){
	jConfirm('Desea eliminar a esta discapacidad?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/discapacidad/eliminar_discapacidad.php',
			data: 'id_discapacidad='+id_discapacidad,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_discapacidad();
							}
					});
		}
					});
	
}
