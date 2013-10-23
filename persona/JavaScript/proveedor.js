      
    $(document).ready(function(){
		$("select[multiple]").asmSelect({					
		});					
		$("#estado").change(function(event){
			if($("#estado").val()!=-1){
			$("#ciudad").load('../../Controladores/control_select_ciudad.php?select='+$("#estado option:selected").val());					
				$("#cap1").css("display","none");	
				$("#cap2").css("display","block"); 
				}
			});				
		$('#estado').click(function(){
			if($("#estado option:selected").val()=='-1'){
				$("#cap").load('../estado/popu_estado.php');	
				$('#popup').fadeIn('slow');
			}
    	});
	$('#open').click(function(){
		$("#cap").load('../estado/popu_estado.php');	
        $('#popup').fadeIn('slow');
    });
    $('#close').click(function(){
        $('#popup').fadeOut('slow');
		$('#select_estado').load('../select_estado.php');
		$('#select_ciuad').load('select_ciudad.php');
		$("#cap1").css("display","block");	
		$("#cap2").css("display","none"); 
    });	
	 Calendar.setup({
        inputField : "fecha_inicio",
		dateFormat: "%d-%m-%Y",
        trigger    : "boton_fec_ini",
        onSelect   : function() { this.hide() },
      });
      Calendar.setup({
        inputField : "fecha_fin",
		dateFormat: "%d-%m-%Y",
        trigger    : "boton_fec_fin",
        onSelect   : function() { this.hide() },
      });  	
});	 		    
function valida() {
		   if (document.form_proveedor.nombre.value.length <1) 
		  {
			jAlert('El campo  \"Organización\"  no puede estar vacio','Mensaje  de Alerta');
			document.form_proveedor.nombre.focus();
			return false;
		  }
		  if(document.form_proveedor.nombre.value.length <3) {		
		  jAlert('El campo \"Organización" no puede ser menor a 3 caracteres!','Mensaje  de Alerta');
		  document.form_proveedor.nombre.focus();
		  return false;
	      }
		  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú "+".";
		  var checkStr = document.form_proveedor.nombre.value;
		  var allValid = true; 
		  for (i=0;i<checkStr.length;i++) {
			ch = checkStr.charAt(i); 
			for (j=0;j<checkOK.length;j++)
			  if (ch==checkOK.charAt(j))
				break;
			if (j == checkOK.length) { 
			  allValid = false; 
			  break; 
			}
		  }
		  if (!allValid) { 
			jAlert('El campo \"Organización\" admite solo letras.','Mensaje  de Alerta');
			document.form_proveedor.nombre.value='';  
			document.form_proveedor.nombre.focus(); 
			return false; 
		  }
	 if (document.form_proveedor.alias.value.length < 1) 
		  {
			jAlert('El campo  \"Alias\"  no puede estar vacio','Mensaje  de Alerta');
			document.form_proveedor.alias.focus();
			return false;
		  }
		  if(document.form_proveedor.alias.value.length <3 ) {		
		  jAlert('El campo \"Alias" no puede ser menor a 3 caracteres!','Mensaje  de Alerta');
		  document.form_proveedor.alias.focus();
		  return false;
	      }re
		  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú "+".";
		  var checkStr = document.form_proveedor.alias.value;
		  var allValid=true; 
		  for(var i=0;i<checkStr.length;i++){
			ch=checkStr.charAt(i); 
			for (var j=0;j<checkOK.length;j++)
			  	if(ch==checkOK.charAt(j))
				break;
				if(j==checkOK.length) { 
			  		allValid = false; 
			  		break; 
				}
		  }
		  if (!allValid) { 
			jAlert('El campo \"Alias\" admite solo letras.','Mensaje  de Alerta');
			document.form_proveedor.alias.value='';  
			document.form_proveedor.alias.focus(); 
			return false; 
		  }
		   if (document.form_proveedor.persona_cont.value.length <1) 
		  {
			jAlert('El campo  \"Persona Contacto\"  no puede estar vacio','Mensaje  de Alerta');
			document.form_proveedor.persona_cont.focus();
			return false;
		  }

		  if(document.form_proveedor.persona_cont.value.length <3) {		
		  jAlert('El campo \"Persona Contacto" no puede ser menor a 3 caracteres!','Mensaje  de Alerta');
		  document.form_proveedor.persona_cont.focus();
		  return false;
	      }
		  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ "+"abcdefghijklmnñopqrstuvwxyzáéíóú ";
		  var checkStr = document.form_proveedor.persona_cont.value;
		  var allValid = true; 
		  for (i=0;i<checkStr.length;i++) {
			ch = checkStr.charAt(i); 
			for (j=0;j< checkOK.length;j++)
			  if (ch==checkOK.charAt(j))
				break;
			if (j==checkOK.length) { 
			  allValid = false; 
			  break; 
			}
		  }
		  if (!allValid) { 
			jAlert('El campo \"Persona Contacto\" admite solo letras.','Mensaje  de Alerta');
			document.form_proveedor.persona_cont.value='';  
			document.form_proveedor.persona_cont.focus(); 
			return false; 
		  }
	if(document.form_proveedor.rif.value == '') {
		jAlert('El campo \"R.I.F\" no puede estar vacio!','Mensaje  de Alerta');
		document.form_proveedor.rif.focus();
		return false;	
	}
	valor0 = document.form_proveedor.rif.value;
	if(!/([VEJG][-]\d{8}[-][0-9])$/.test(valor0) ) {
		document.form_proveedor.rif.focus();
		jAlert('El campo \"R.I.F\" no es valido! Ejemplo: J-35025036-0','Mensaje  de Alerta');
		return false;
	}	
	if (document.form_proveedor.correo.value.length <1) 
		  {
			jAlert('El campo  \"Correo\"  no puede estar vacio','Mensaje  de Alerta');
			document.form_proveedor.correo.focus();
			return false;
		  }
	if (!(/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/.test(document.form_proveedor.correo.value))) {//9
		alert('El correo es invalido! Ejemplo: usuario@servidor.dominio');
		return false;
	}   
	if(document.form_proveedor.celular.value=='') {
		document.form_proveedor.celular.focus();
		jAlert('El campo \"Celular\" no puede estar vacio!','Mensaje  de Alerta');
		return false;
	}	
	valor1 = document.form_proveedor.celular.value;
	if(!/^\d{4}-\d{7}$/.test(valor1)) {
		document.form_proveedor.celular.focus();
		jAlert('El campo \"Celular\" no es valido! Ejemplo: 0416-2323455','Mensaje  de Alerta');
		return false;
	}
	if(document.form_proveedor.telefono.value == '') {
		document.form_proveedor.telefono.focus();
		jAlert('El campo \"Teléfono\" no puede estar vacio!','Mensaje  de Alerta');
		return false;
	}
	valor2 = document.form_proveedor.telefono.value;
	if(!/^\d{4}-\d{7}$/.test(valor2)) {
		document.form_proveedor.telefono.focus();
		jAlert('El campo \"Teléfono\" no es valido! Ejemplo: 0233-2323455','Mensaje  de Alerta');
		return false;
	}
	if(document.form_proveedor.estado.value=="0"){
		jAlert('Debe seleccionar el estado donde se encuentra ubicado!','Mensaje  de Alerta');
		document.form_proveedor.estado.focus();
		return false;
	}
	if(document.form_proveedor.ciudad.value=="0"){
		jAlert('Debe seleccionar la ciudad donde se encuentra ubicado!','Mensaje  de Alerta');
		document.form_proveedor.ciudad.focus();
		return false;
	}
    if (document.form_proveedor.fax.value.length>12) 
		  {
			document.form_proveedor.correo.focus();
			return false;
		  }
	if(document.form_proveedor.fax.value!=''){
	valor2 = document.form_proveedor.fax.value;
	if(!/^\d{4}-\d{7}$/.test(valor2)) {
		document.form_proveedor.fax.focus();
		jAlert('El campo \"FAX\" no es valido! Ejemplo: 0233-2323455','Mensaje  de Alerta');
		return false;
	   }
	}
	if(document.form_proveedor.direccion.value == '') {
		document.form_proveedor.direccion.focus();
		jAlert('El campo \"Dirección\" no puede estar vacio!','Mensaje  de Alerta');
		return false;
	}
	if(document.form_proveedor.fecha_inicio.value=='' ) {		
		  jAlert('El campo \"Fecha Inicio" no puede estar vacio!','Mensaje  de Alerta');
		  document.form_proveedor.fecha_inicio.focus();
		  return false;
	      }
	if(document.form_proveedor.fecha_fin.value=='' ) {		
		  jAlert('El campo \"Fecha Fin" no puede estar vacio!','Mensaje  de Alerta');
		  document.form_proveedor.fecha_fin.focus();
		  return false;
	      }
	if(document.form_proveedor.servicio.value=="0"){
		jAlert('Debe seleccionar al menos un Servicio!','Mensaje  de Alerta');
		document.form_proveedor.servicio.focus();
		return false;
	}
	return true;
}	