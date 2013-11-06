// JavaScript Document
$(document).ready(function(){
	fn_listar_medicamento();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});

	function fn_agregar(){	
	
		var str = $("#form_medicamento").serialize();
		$.ajax({
			url: '../../Controladores/controlador_medicamento.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){	
					jAlert('Este Medicamento ya ha Sido incluido al Sistema.','Mensaje de Alerta');
				}else{
					jAlert(data);
					fn_listar_medicamento();
				}	
			}
		});
	};
	
function limpiar(){		
			$('#nombre').val("");		
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


function fn_listar_medicamento(){
	var str = $("#form_medicamento").serialize();
	$.ajax({
		url: '../../Php/medicamento/listar_medicamento.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_medicamento").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},	
		success: function(data){		
			$("#div_listar_medicamento").html(data);				
		}
	});

}
function fn_eliminar_medicamento(id_medicamento){
	jConfirm('Desea eliminar este Medicamento?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/medicamento/eliminar_medicamento.php',
			data: 'id_medicamento='+id_medicamento,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_medicamento();
							}
					});
		}
					});
	
}
