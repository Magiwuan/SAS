// JavaScript Document
$(document).ready(function(){
	fn_listar_profesion();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
function fn_agregar(){		
		var str = $("#form_profesion").serialize();
		$.ajax({
			url: '../../Controladores/controlador_profesion.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Esta Profesión ya ha sido incluido al Sistema.','Mensaje de Alerta');
				}else{
					jAlert(data);
					fn_listar_profesion();
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

function fn_listar_profesion(){
	var str = $("#form_profesion").serialize();
	$.ajax({
		url: '../../Php/profesion/listar_profesion.php',
		type: 'get',
		data: str,
		success: function(data){		
			$("#div_listar_profesion").html(data);				
		}
	});

}

function fn_eliminar_profesion(id_profesion){
	jConfirm('Desea eliminar a esta Profesión?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/profesion/eliminar_profesion.php',
			data: 'id_profesion='+id_profesion,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_profesion();
							}
					});
		}
					});
	
}