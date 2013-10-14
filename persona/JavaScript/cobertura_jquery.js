// JavaScript Document
function fn_agregar(){		
		var str = $("#form_cobertura").serialize();
		$.ajax({
			url: '../../Controladores/controlador_cobertura.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Esta cobertura ya ha sido incluido al Sistema.','Dialogo de Alerta');
				}else{
					jAlert(data);
					fn_listar_cobertura();

				}				
			}
		});
	};
$(document).ready(function(){
	fn_listar_cobertura();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
	function fn_agregar(){		
		var str = $("#form_cobertura").serialize();
		$.ajax({
			url: '../../Controladores/controlador_cobertura.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Esta cobertura ya ha sido incluido al Sistema.','Mensaje de Alerta');
				}else{
					jAlert(data);
					fn_listar_cobertura();
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
function fn_listar_cobertura(){
	var str = $("#form_cobertura").serialize();
	$.ajax({
		url: '../../Php/cobertura/listar_cobertura.php',
		type: 'get',
		data: str,
		success: function(data){		
			$("#div_listar_cobertura").html(data);				
		}
	});

}

function fn_eliminar_cobertura(id_cobertura){
	jConfirm('Desea eliminar a esta Cobertura?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/cobertura/eliminar_cobertura.php',
			data: 'id_cobertura='+id_cobertura,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_cobertura();
							}
					});
		}
					});
	
}