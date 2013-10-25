// JavaScript Document
	function fn_agregar(){		
		var str = $("#form_examen").serialize();
		$.ajax({
			url: '../../Controladores/controlador_examen.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Este Examen ya ha Sido incluido al Sistema.','Mensaje de Alerta');
				}else{
					jAlert(data);
					fn_listar_examen();
				}				
			}
		});
	};
$(document).ready(function(){
	fn_listar_examen();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
function limpiar(){		
			$('#nombre').val("");	
			$('#tipo').val('0');	
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

function fn_listar_examen(){
	var str = $("#form_examen").serialize();
	$.ajax({
		url: '../../Php/examen/listar_examen.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_examen").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},
		success: function(data){		
			$("#div_listar_examen").html(data);				
		}
	});

}

function fn_eliminar_examen(id_examen){
	jConfirm('Desea eliminar este Exámen?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/examen/eliminar_examen.php',
			data: 'id_examen='+id_examen,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_examen();
							}
					});
		}
					});
	
}
