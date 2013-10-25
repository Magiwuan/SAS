// JavaScript Document
$(document).ready(function(){
	fn_listar_ciudad();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
	function fn_agregar(){		
		var str = $("#form_ciudad").serialize();
		$.ajax({
			url: '../../Controladores/controlador_ciudad.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Esta Ciudad ya ha Sido incluido al Sistema.','Mensaje de Alerta');
				}else{
					jAlert(data);
					fn_listar_ciudad();

				}				
			}
		});
	};
   $(document).ready(function(){
		$("#estado").change(function(event){
		$("#ciudad").load('../../Controladores/control_select_ciudad.php?select='+$("#estado option:selected").val());					
		$("#cap1").css("display","none");	
		$("#cap2").css("display","block"); 
		});	
		});	
		
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

function fn_listar_ciudad(){
	var str = $("#form_ciudad").serialize();
	$.ajax({
		url: '../../Php/ciudad/listar_ciudad.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_ciudad").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},
		success: function(data){		
			$("#div_listar_ciudad").html(data);				
		}
	});

}

function fn_eliminar_ciudad(id_ciudad){
	jConfirm('Desea eliminar a este Ciudad?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/ciudad/eliminar_ciudad.php',
			data: 'id_ciudad='+id_ciudad,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_ciudad();
							}
					});
		}
					});
	
}
