// JavaScript Document
$(document).ready(function(){
	fn_listar_pais();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
	function fn_agregar(){		
		var str = $("#form_pais").serialize();
		$.ajax({
			url:'../../Controladores/controlador_pais.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert("Este País ya ha sido incluido al sistema.");
				}else{
					jAlert(data);
					fn_listar_pais();
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

function fn_listar_pais(){
	var str = $("#form_pais").serialize();
	$.ajax({
		url: '../../Php/pais/listar_pais.php',
		type: 'get',
		data: str,
		success: function(data){		
			$("#div_listar_pais").html(data);				
		}
	});

}

function fn_eliminar_pais(id_pais){
	jConfirm('Desea eliminar este País?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/pais/eliminar_pais.php',
			data: 'id_pais='+id_pais,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_pais();
							}
					});
		}
					});
	
}