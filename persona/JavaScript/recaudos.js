// JavaScript Document
	 function valida(){
		if(document.form_recaudos.nombre.value.length < 1){
		document.form_recaudos.nombre.focus();
		jAlert('El campo "Nombre Recaudo" no puede estar vacio!','Dialogo de Alerta');
		return false;
		}
		  if(document.form_recaudos.nombre.value.length < 3){		
		  jAlert('El campo "Nombre Recaudo" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		  document.form_recaudos.nombre.focus();
		  return false;
	      }
		  //valida que se ingresen solo letras al campo nombre
		  var checkOK='ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ ' + 'abcdefghijklmnñopqrstuvwxyzáéíóú ';
		  var checkStr=document.form_recaudos.nombre.value;
		   var allValid=true; 
		  for(var i=0;i<checkStr.length;i++){
			ch=checkStr.charAt(i); 
			for(var j=0;j<checkOK.length;j++)
			  	if(ch==checkOK.charAt(j))
				break;
				if(j==checkOK.length) { 
			  		allValid = false; 
			  		break; 
				}
		  }
		  if (!allValid){ 
			jAlert('El campo "Nombre Recaudo" admite solo letras.','Dialogo de Alerta');
			document.form_recaudos.nombre.value='';  
			document.form_recaudos.nombre.focus(); 
			return false; 
		  }
		  if(document.form_recaudos.tipo.value=="0"){
		jAlert('Debe seleccionar el Tipo Recaudo!','Dialogo de Alerta');
		document.form_recaudos.tipo.focus();
		return false;
	}   
	return true;
}
