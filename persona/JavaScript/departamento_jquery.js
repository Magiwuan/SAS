// JavaScript Document
$(document).ready(function(){
	fn_listar_departamento();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
	function fn_agregar(){
	 var str = $("#form_departamento").serialize();
	 $.ajax({
	 url: '../../Controladores/controlador_departamento.php',
	 data: str,
	 type: 'post',
	 success: function(data){
		if(data=="No"){
			jAlert('Este Departamento ya ha Sido incluido al Sistema.','Mensaje de Alerta');
		}else{
			jAlert(data);
			fn_listar_departamento();		
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

function fn_listar_departamento(){
	var str = $("#form_departamento").serialize();
	$.ajax({
		url: '../../Php/departamento/listar_departamento.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_departamento").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},
		success: function(data){		
			$("#div_listar_departamento").html(data);				
		}
	});

}

function fn_eliminar_departamento(id_departamento){
	jConfirm('Desea eliminar este Departamento?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/departamento/eliminar_departamento.php',
			data: 'id_departamento='+id_departamento,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_departamento();
							}
					});
		}
					});
	
}
