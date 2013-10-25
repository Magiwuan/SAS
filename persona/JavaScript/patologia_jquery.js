// JavaScript Document
$(document).ready(function(){
	fn_listar_patologia();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
	function fn_agregar(){		
		var str = $("#form_patologia").serialize();
		$.ajax({
			url: '../../Controladores/controlador_patologia.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Esta patología ya ha sido incluida al Sistema.');
				}else{
					jAlert(data);
					fn_listar_patologia();
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

function fn_listar_patologia(){
	var str = $("#form_patologia").serialize();
	$.ajax({
		url: '../../Php/patologia/listar_patologia.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_patologia").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},
		success: function(data){		
			$("#div_listar_patologia").html(data);				
		}
	});

}
function fn_cerrar(){
	$("#cuerpo").load("../../configuracion.html", function(){
	});
};
function fn_eliminar_patologia(id_patologia){
	jConfirm('Desea eliminar esta Patología?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/patologia/eliminar_patologia.php',
			data: 'id_patologia='+id_patologia,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_patologia();
							}
					});
		}
					});
	
}
