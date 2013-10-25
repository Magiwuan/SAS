// JavaScript Document
$(document).ready(function(){
	fn_listar_cargo();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
	function fn_agregar(){		
		var str = $("#form_cargo").serialize();
		$.ajax({
			url: '../../Controladores/controlador_cargo.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Este Cargo ya ha sido incluido al sistema.');
				}else{
					jAlert(data);
					fn_listar_cargo();
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

function fn_listar_cargo(){
	var str = $("#form_cargo").serialize();
	$.ajax({
		url: '../../Php/cargo/listar_cargo.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_cargo").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},	
		success: function(data){		
			$("#div_listar_cargo").html(data);				
		}
	});

}
function fn_cerrar(){
	$("#cuerpo").load("../../../blanco.html", function(){
	});
};
function fn_eliminar_cargo(id_cargo){
	jConfirm('Desea eliminar a este Cargo?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/cargo/eliminar_cargo.php',
			data: 'id_cargo='+id_cargo,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_cargo();
							}
					});
		}
					});
	
}
