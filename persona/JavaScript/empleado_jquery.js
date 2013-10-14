$(document).ready(function(){
	fn_buscar();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
	
});
function fn_modificar(){
            var str = $("#form_titular").serialize();
            $.ajax({
                url: 'Controladores/controlador_titular.php',
                data: str,
                type: 'post',
                success: function(data){
                    if(data != "")
                    jAlert(data);
                }
            });
        };	
function fn_agregar(){		
		var str=$("#form_titular").serialize();
		$.ajax({
			url:'Controladores/controlador_titular.php?',
			data:str,
			type:'post',
			success:function(data){
				jAlert(data,'Dialogo de Alerta');								
			}
		});
	};
function fn_cerrar(){	
 $.ajax({
	beforeSend: function(){                         
    $("#cuerpo").html('<div  style="margin-left:300px;"><img src="Imagen_sistema/loading.gif"/></div>');
  	},
	success: function(){
		$("#cuerpo").load("index_empleado.php");	
	}
	});		
};
function fn_mostrar_frm_agregar(){	
 $.ajax({
	beforeSend: function(){                         
    $("#cuerpo").html('<div  style="margin-left:300px;"><img src="Imagen_sistema/loading.gif"/></div>');
  	},
	success: function(){
		$("#cuerpo").load("Php/agregar_empleado.php");		
	}
	});		
};
function fn_mostrar_frm_modificar(id_titular){
	 $.ajax({
	beforeSend: function(){                         
    $("#cuerpo").html('<div  style="margin-left:300px;"><img src="Imagen_sistema/loading.gif"/></div>');
  	},
	success: function(){
		$("#cuerpo").load("Php/modificar_empleado.php", {id_titular: id_titular});
	}
	});			
};
function fn_mostrar_agregar_grupo(id_titular,nombre1,apellido1){
	 $.ajax({
	beforeSend: function(){                         
    $("#cuerpo").html('<div  style="margin-left:300px;"><img src="Imagen_sistema/loading.gif"/></div>');
  	},
	success: function(){
		$("#cuerpo").load("Php/beneficiario/agregar_beneficiario.php",{id_titular: id_titular, nombre1: nombre1, apellido1: apellido1});	
	}
	});		
};
function fn_paginar(var_div, url){
	var div = $("#" + var_div);
	$(div).load(url);
}
function fn_eliminar(id_titular){
	jConfirm('Desea eliminar este Trabajador?', 'Mensaje Confirmación', function(r) {
		if(r==true){
			
		$.ajax({
			
			url: 'Php/eliminar_empleado.php',
			data: 'id_titular='+id_titular,
			type: 'post',
			success: function(data){
				if(data!="")
						jAlert(data, 'Resultado de la confirmación');
						fn_buscar()
							}
					});
			}
			});	
}
function fn_buscar(){	
	var str = $("#frm_buscar").serialize();
	$.ajax({
		url: 'Php/listar_empleado.php',
		type: 'get',
		data: str,		
		success: function(data){			
				$("#div_listar").html(data);				 		
		}
	});
}

