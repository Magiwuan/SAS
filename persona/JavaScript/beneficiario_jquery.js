// JavaScript Document
$(document).ready(function(){
	fn_listar_beneficiario();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});
   
	function fn_agregar(){	
		
		var str = $("#form_beneficiario").serialize();
		$.ajax({
			url: 'Controladores/controlador_beneficiario.php',
			data: str,
			type: 'post',
			success: function(data){			
					jAlert(data);
					fn_listar_beneficiario();								
			}
		});
	};
	function fn_modificar(){		
		var str = $("#form_beneficiario").serialize();
		$.ajax({
			url: 'Controladores/controlador_beneficiario.php',
			data: str,
			type: 'post',
			success: function(data){
					jAlert(data);						
			}
		});
	};
function fn_cerrar_vista_agregar(){	
	$("#cuerpo").load("index_empleado.php", function(){
	});
	
};

function fn_cerrar_vista_modificar(id_titular){
	$("#cuerpo").load("Php/beneficiario/agregar_beneficiario.php?",{id_titular: id_titular}, function(){
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

function fn_listar_beneficiario(){
	var str = $("#form_beneficiario_agregar").serialize();
	$.ajax({
		url: 'Php/beneficiario/listar_beneficiario.php',
		type: 'get',
		data: str,
		beforeSend: function(){ 
		$("#div_listar_beneficiario").html('<div  style="margin-left:300px;"><img src="../../Imagen_sistema/loading.gif"/></div>');		
		},	
		success: function(data){		
			$("#div_listar_beneficiario").html(data);				
		}
	});

}

function fn_mostrar_modificar_beneficiario(id_beneficiario){	
	$("#cuerpo").load("Php/beneficiario/modificar_beneficiario.php", {id_beneficiario: id_beneficiario}, function(){

	});	
};

function fn_eliminar_beneficiario(id_beneficiario){
jConfirm('Desea excluir este Beneficiario?', 'Mensaje Confirmación', function(r) {
	if(r==true){		
		$("#cuerpo").load("Php/beneficiario/exclusion_beneficiario.php", {id_beneficiario: id_beneficiario});		
	}
	});	
}

function fn_enviar_eliminar(){		
		var str = $("#form_exclusion").serialize();
		$.ajax({
			url: 'Controladores/controlador_beneficiario.php',
			data: str,
			type: 'post',
			success: function(data){				
					abreVentana();
			}
		});
	};
var miPopup=0;
function abreVentana(ancho,alto){ 
	var posicion_x; 
	var posicion_y; 
	posicion_x=(screen.width/2)-(ancho/2); 
	posicion_y=(screen.height/2)-(alto/4); 
    miPopup = window.open("Controladores/controlador_exclusion_beneficiario_PDF.php?id="+$("#idBeneficiario").val()+'&id2='+$("#idTitular").val(),"miwin","width=800px,height=800px,scrollbars=yes,resizable=yes,left="+posicion_x+",top="+posicion_y+""); 
    miPopup.focus();
}
