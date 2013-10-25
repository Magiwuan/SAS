// JavaScript Document
	function fn_agregar(){	
		var str = $("#form_medico").serialize();
		$.ajax({
			url: '../../Controladores/controlador_medico.php?',
			data: str,
			type: 'post',
			success: function(data){
				if(data== "No"){				
					jAlert('Este Usuario ya ha Sido incluido al Sistema.','Mensaje de Alerta');
				}else{
					jAlert(data);
				}				
			}
		});
	};
	  function fn_modificar(){
            var str = $("#form_medico").serialize();
            $.ajax({
                url: '../../Controladores/controlador_medico.php?',
                data: str,
                type: 'post',
                success: function(data){
                    jAlert(data);					
                }
            });
        };
$(document).ready(function(){
	fn_listar_medico();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});

function fn_cerrar(){
	$("#cuerpo").load("../../Php/medico/index_medico.php", function(){
	});
};

function fn_agregar_medico(){
	$("#cuerpo").load("../../Php/medico/agregar_medico.php", function(){
	});
};

function fn_modificar(id_medico){
	$("#cuerpo").load("../../Php/medico/modificar_medico.php", {id_medico: id_medico}, function(){
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

function fn_eliminar(id_medico){
	jConfirm('Desea eliminar este Médico?', 'Mensaje Confirmación', function(r) {
		if(r==true){
		$.ajax({
			url: '../../Php/medico/eliminar_medico.php',
			data: 'id_medico='+id_medico,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_listar_medico();
							}
					});
		}
					});
	
}

function fn_listar_medico(){
	var str = $("#frm_buscar_medico").serialize();
	$.ajax({
		url: '../../Php/medico/listar_medico.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_medico").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},
		success: function(data){		
			$("#div_listar_medico").html(data);		
			
		}
	});

}

