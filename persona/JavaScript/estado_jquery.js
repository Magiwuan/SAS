// JavaScript Document
$(document).ready(function(){
	fn_listar_estado();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
function fn_agregar(){		
		var str = $("#form_estado").serialize();
		$.ajax({
			url: '../../Controladores/controlador_estado.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data=="No"){				
					jAlert('Este Estado ya ha sido incluido al sistema.','Mensaje de Alerta');
				}else{
					jAlert(data);
					fn_listar_estado();
				}				
			}
		});
	};
function limpiar(){		
			$('#nombre').val("");
			$('#pais').val('0');		
		}	

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

function fn_listar_estado(){
	var str = $("#form_estado").serialize();
	$.ajax({
		url: '../../Php/estado/listar_estado.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_estado").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},
		success: function(data){		
			$("#div_listar_estado").html(data);				
		}
	});

}

function fn_eliminar_estado(id_estado){
	jConfirm('Desea eliminar este Estado?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/estado/eliminar_estado.php',
			data: 'id_estado='+id_estado,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_estado();
							}
					});
		}
					});
	
}
