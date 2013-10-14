// JavaScript Document
	   $(document).ready(function(){
		   $("select[multiple]").asmSelect({		
			});	
		});
function valida(){
	var n="no";
	for (var i=0;i<document.form_medico.nacionalidad.length;i++){
		if (document.form_medico.nacionalidad[i].checked){
			n="si";
			break;
		}
	}
	if (n=="no"){
	jAlert('Debe seleccionar una Nacionalidad','Dialogo de Alerta');
		return false;
	}
	if(document.form_medico.ced2.value==''){
		jAlert('El campo \"Cedula o Pasaporte\" no puede estar vacio!','Dialogo de Alerta');
		document.form_medico.ced2.focus();
		return false;	
	}	
	valor0=document.form_medico.ced2.value;
	if(!/\d{8}$/.test(valor0)){
		document.form_medico.ced2.focus();
		jAlert('El campo \"Cedula\" no es valido! Ejemplo: 20643089, sin caracteres especiales','Dialogo de Alerta');
		return false;
	}
	if (document.form_medico.nombre.value.length<1){
		jAlert('El campo  \"Nombre\"  no puede estar vacio','Dialogo de Alerta');
		document.form_medico.nombre.focus();
		return false;
	}
	if(document.form_medico.nombre.value.length<3){		
		jAlert('El campo \"Nombres" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		document.form_medico.nombre.focus();
		return false;
	}
	var checkOK="ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú ";
	var checkStr=document.form_medico.nombre.value;
	var allValid=true; 
	for (var i=0;i<checkStr.length;i++){
	ch = checkStr.charAt(i); 
	for(var j=0;j<checkOK.length;j++)
		if(ch==checkOK.charAt(j))
		break;
		if(j==checkOK.length){ 
			 allValid = false; 
			 break; 
		}
	}
	if(!allValid){ 
		jAlert('El campo \"Nombre\" admite solo letras.','Dialogo de Alerta');
		document.form_medico.nombre.value='';  
		document.form_medico.nombre.focus(); 
		return false; 
	} 
	if(document.form_medico.apellido.value.length<1){
		jAlert('El campo \"Apellido\" no puede estar vacio','Dialogo de Alerta');
		document.form_medico.apellido.focus();
		return false;
	} 
	if(document.form_medico.apellido.value.length<3){		
		jAlert('El campo \"Apellido" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		document.form_medico.apellido.focus();
		return false;
	}
	var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú ";
	var checkStr = document.form_medico.apellido.value;
	var allValid = true; 
	for (var i=0;i<checkStr.length;i++){
		ch = checkStr.charAt(i); 
		for(var j=0;j<checkOK.length;j++)
			if(ch==checkOK.charAt(j))
			break;
			if (j==checkOK.length){ 
			  allValid = false; 
			  break; 
			}
	}
	if (!allValid) { 
		jAlert('El campo \"Apellido\" admite solamente letras','Dialogo de Alerta'); 
		document.form_medico.apellido.value=''; 
		document.form_medico.apellido.focus(); 
		return false; 
	}
	if(document.form_medico.especialidad.value=="0"){//6
		jAlert('Debe seleccionar la Especialidad','Dialogo de Alerta');
		document.form_medico.especialidad.focus();
		return false;
	}
	return true;
}