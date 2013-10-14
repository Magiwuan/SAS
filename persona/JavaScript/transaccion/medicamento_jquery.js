// JavaScript Document
$(document).ready(function(){
	fn_listar_medicamento();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
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
function fn_cerrar(){
	$("#cuerpo").load("../../../../configuracion.html", function(){
		$.blockUI({
			message: $('#cuerpo'),
			css:{
				padding: '2px',
				top: '0%',
				left: '0%',
				width: '100%',
				height: '750px',
				background:'#F0F8E7',
				display: 'absolute',	
				
			}
		}); 
	});
};

function fn_listar_medicamento(){
	var str = $("#form_medicamento_agregar").serialize();
	$.ajax({
		url: '../../Php/transacciones/solicitud_medicinas/listar_medicamento.php',
		type: 'get',
		data: str,
		success: function(data){		
			$("#div_listar_medicamento").html(data);				
		}
	});

}

function fn_eliminar_medicamento(id_medicamento){
	var respuesta = confirm("Desea eliminar a este Medicamento?");
	if (respuesta){
		$.ajax({
			url: '../../Php/medicamento/eliminar_medicamento.php',
			data: 'id_medicamento='+id_medicamento,
			type: 'post',
			success: function(data){
				if(data!="")
				alert(data);
				fn_listar_medicamento();
			}
		});
	}
}