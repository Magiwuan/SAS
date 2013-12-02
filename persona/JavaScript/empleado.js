 Calendar.setup({
			inputField : "fecha_nac",
			dateFormat: "%d-%m-%Y",
			trigger    : "bt",
			onSelect   : function() { this.hide() },
		  });		  
 Calendar.setup({
			inputField : "fecha_ingr",
			dateFormat: "%d-%m-%Y",
			trigger    : "bt_fna",
			onSelect   : function() { this.hide() },
		  });
 function valida(){
	var n="no";
	for(var i=0;i<document.form_titular.nacionalidad.length;i++){
		if (document.form_titular.nacionalidad[i].checked){
		n="si";
		break;
		}
	}
	if(n=="no"){
		jAlert('Debe seleccionar una Nacionalidad','Dialogo de Alerta');
		return false;
	}
	if(document.form_titular.cedula.value=='') {
		jAlert('El campo "Cedula o Pasaporte" no puede estar vacio!','Dialogo de Alerta');
		document.form_titular.cedula.focus();
		return false;
	}
	valor0=document.form_titular.cedula.value;
	if(!/\d{8}$/.test(valor0) ) {
		document.form_titular.cedula.focus();
		jAlert('El campo "Cedula" no es valido! Ejemplo: 20643089, sin caracteres especiales y letras','Dialogo de Alerta');
		return false;
	}
	if(document.form_titular.nombre1.value.length < 1){
		jAlert('El campo  "Primer Nombre"  no puede estar vacio','Dialogo de Alerta');
		document.form_titular.nombre1.focus();
		return false;
	}
	if(document.form_titular.nombre1.value.length < 3){
  		jAlert('El campo "Primer Nombre" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
  		document.form_titular.nombre1.focus();
  		return false;
	}
	var checkOK="ABCDEFGHIJKLMN—OPQRSTUVWXYZ¡…Õ”⁄" + "abcdefghijklmnÒopqrstuvwxyz·ÈÌÛ˙' ";
	var checkStr=document.form_titular.nombre1.value;
	var allValid=true; 
	for(i=0;i<checkStr.length;i++){
		ch = checkStr.charAt(i); 
		for(j=0;j<checkOK.length;j++)
			if(ch==checkOK.charAt(j))
				break;
			if(j==checkOK.length){ 
  			allValid=false; 
  			break; 
			}
	}
	if(!allValid){ 
		jAlert('El campo "Primer Nombre" admite solo letras.','Dialogo de Alerta');
		document.form_titular.nombre1.value='';  
		document.form_titular.nombre1.focus(); 
		return false; 
	} 
	if(document.form_titular.nombre2.value.length>15){
		jAlert('El campo "Segundo Nombre" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		document.form_titular.nombre2.focus();
		return false;
	}
	var checkOK="ABCDEFGHIJKLMN—OPQRSTUVWXYZ¡…Õ”⁄" + "abcdefghijklmnÒopqrstuvwxyz·ÈÌÛ˙' ";
	var checkStr=document.form_titular.nombre2.value;
	var allValid=true; 
	for(i=0;i<checkStr.length;i++){
		ch=checkStr.charAt(i); 
		for(j=0;j<checkOK.length;j++)
  			if(ch==checkOK.charAt(j))
				break;
			if(j==checkOK.length){ 
  				allValid=false; 
  				break; 
			}
  	}
  	if(!allValid){ 
		jAlert('El campo "Segundo Nombre" admite solo letras.','Dialogo de Alerta');
		document.form_titular.nombre2.value='';  
		document.form_titular.nombre2.focus(); 
		return false; 
  	}   
	 if (document.form_titular.apellido1.value.length <1) 
		  {
			jAlert('El campo \"Primer Apellido\" no puede estar vacio','Dialogo de Alerta');
			document.form_titular.apellido1.focus();
			return false;
		  } 
		    if(document.form_titular.apellido1.value.length <3) {		
		  jAlert('El campo "Primer Apellido" no puede ser menor a 3 caracteres!','Dialogo de Alerta');
		  document.form_titular.apellido1.focus();
		  return false;
	      }
	var checkOK = "ABCDEFGHIJKLMN—OPQRSTUVWXYZ¡…Õ”⁄" + "abcdefghijklmnÒopqrstuvwxyz·ÈÌÛ˙ ";
	var checkStr = document.form_titular.apellido1.value;
	var allValid = true; 
	for(var i=0;i<checkStr.length;i++){
		var ch=checkStr.charAt(i); 
		for(var j=0;j<checkOK.length;j++)
  			if(ch=checkOK.charAt(j))
				break;
			if(j==checkOK.length){ 
				allValid=false; 
				break; 
			}
	}
	if(!allValid){ 
		jAlert('El campo \"Primer Apellido\" admite solamente letras','Dialogo de Alerta'); 
		document.form_titular.apellido1.focus(); 
		return false; 
	}
    if(document.form_titular.apellido2.value.length>20){
		jAlert('El campo \"Segundo Apellido" no puede ser mayor a 20 caracteres!','Dialogo de Alerta');
		document.form_titular.apellido2.focus();
		return false;
	}
	var checkOK = "ABCDEFGHIJKLMN—OPQRSTUVWXYZ¡…Õ”⁄" + "abcdefghijklmnÒopqrstuvwxyz·ÈÌÛ˙' ";
	var checkStr = document.form_titular.apellido2.value;
	var allValid = true; 
	for(var i=0;i<checkStr.length;i++){
		var ch=checkStr.charAt(i); 
		for(var j=0;j<checkOK.length;j++)
  			if(ch=checkOK.charAt(j))
				break;
			if(j==checkOK.length){ 
				allValid=false; 
				break; 
			}
	}
	if (!allValid) { 
	jAlert('El campo \"Segundo Apellido\" admite solamente letras','Dialogo de Alerta'); 
	document.form_titular.apellido2.focus(); 
	return false; 
	}  
	var s="no";
	for ( var j = 0; j < document.form_titular.sexo.length; j++ ){
		if ( document.form_titular.sexo[j].checked ){
		s= "si";
		break;
		}
	}
	if (s=="no"){
	jAlert("Debe seleccionar una Sexo");
	return false;
	}
	if(document.form_titular.fecha_nac.value==''){
		
		jAlert('El campo \"Fecha de Nacimiento" no puede estar vacio!','Dialogo de Alerta');
		document.form_titular.fecha_nac.focus();
		return false;	
	}
	var fecha=document.form_titular.fecha_nac.value;
	var fechaActual = new Date()
	var diaActual = fechaActual.getDate();
	var mmActual = fechaActual.getMonth() + 1;
	var yyyyActual = fechaActual.getFullYear();
	FechaNac = fecha.split("-");
	var diaCumple = FechaNac[0];
	var mmCumple = FechaNac[1];
	var yyyyCumple = FechaNac[2];
	//retiramos el primer cero de la izquierda
	if (mmCumple.substr(0,1) == 0) {
	mmCumple= mmCumple.substring(1, 2);
	}
	//retiramos el primer cero de la izquierda
	if (diaCumple.substr(0, 1) == 0) {
	diaCumple = diaCumple.substring(1, 2);
	}
	var edad = yyyyActual - yyyyCumple;	

	if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
	edad--;
	}
	 if(edad<18 || edad>80){		
			jAlert('Edad no valida.<br>No puede Registrarlo como trabajador, Edad: '+edad+' a&ntilde;os','Dialogo de Alerta');
			document.form_titular.fecha_nac.focus();
			return false;
	}
	if(document.form_titular.estado2.value=="0"){
		jAlert('Debe seleccionar estado de lugar de nacimiento !','Dialogo de Alerta');
		document.form_titular.estado2.focus();
		return false;
	}
	if(document.form_titular.ciudad2.value=="0"){
		jAlert('Debe seleccionar ciudad de lugar de nacimiento!','Dialogo de Alerta');
		document.form_titular.ciudad2.focus();
		return false;
	}
	if(document.form_titular.celular.value == ''){
		document.form_titular.celular.focus();
		jAlert('El campo \"Celular\" no puede estar vacio!','Dialogo de Alerta');
		return false;
	}
	valor1 = document.form_titular.celular.value;
		if(!/^\d{4}-\d{7}$/.test(valor1)) {
		document.form_titular.celular.focus();
		jAlert('El campo \"Celular\" no es valido! Ejemplo: 0416-2323455','Dialogo de Alerta');
		return false;
	}
	if(document.form_titular.telefono.value !='') {
	valor2 = document.form_titular.telefono.value;
	if(!/^\d{4}-\d{7}$/.test(valor2)) {
		document.form_titular.telefono.focus();
		jAlert('El campo \"Tel&eacute;fono\" no es valido! Ejemplo: 0233-2323455','Dialogo de Alerta');
		return false;
	}
	}
	if(document.form_titular.estado_civ.value=="0"){
		jAlert('Debe seleccionar el estado Civil!','Dialogo de Alerta');
		document.form_titular.estado_civ.focus();
		return false;
	}
	if(document.form_titular.estado.value=="0"){
		jAlert('Debe seleccionar el estado donde se encuentra ubicado!','Dialogo de Alerta');
		document.form_titular.estado.focus();
		return false;
	}
	if(document.form_titular.ciudad.value=="0"){
		jAlert('Debe seleccionar la ciudad donde se encuentra ubicado!','Dialogo de Alerta');
		document.form_titular.ciudad.focus();
		return false;
	}
	if(document.form_titular.correo.value.length>60){
		jAlert('El campo  \"Correo\"  no es valido','Dialogo de Alerta');
		document.form_titular.correo.focus();
		return false;
	}
	if(document.form_titular.correo.value.length!=''){
		if (!(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/.test(document.form_titular.correo.value))){
		jAlert('El correo no es valido! Ejemplo: usuario@servidor.dominio','Dialogo de Alerta');
		return false;
	}
	}
	
	if(document.form_titular.direccion.value == ''){
		document.form_titular.direccion.focus();
		jAlert('El campo \"Direcci&oacute;n Habitaci&oacute;n\" no puede estar vacio!','Dialogo de Alerta');
		return false;
	}
	var s="no";
	for ( var j = 0; j < document.form_titular.tipo_nomina.length; j++ ){
		if ( document.form_titular.tipo_nomina[j].checked ){
		s= "si";
		break;
		}
	}
	if (s=="no"){
	jAlert("Debe seleccionar un Tipo de Nomina");
	return false;
	}
	if(document.form_titular.fecha_ingr.value=='' ) {
		jAlert('El campo \"Fecha de Ingreso" no puede estar vacio!','Dialogo de Alerta');
		document.form_titular.fecha_ingr.focus();
		return false;
	}
	var fecha=document.form_titular.fecha_ingr.value;
	var fechaActual = new Date()
	var diaActual = fechaActual.getDate();
	var mmActual = fechaActual.getMonth() + 1;
	var yyyyActual = fechaActual.getFullYear();
	var f = fecha.split("-");
	var diaIngreso = f[0];
	var mmIngreso = f[1];
	var yyyyIngreso = f[2];	
	 if(yyyyIngreso < yyyyActual ){	
	 }else{
		if(yyyyIngreso == yyyyActual){
			if(mmIngreso < mmActual  ){				  	 	
			}else{
				if(mmActual == mmIngreso){
					if(diaIngreso <= diaActual){																						
					}else{	
						jAlert('Fecha ingreso no valida','Dialogo de Alerta');
						document.form_titular.fecha_ingr.focus();
						return false;							
					}
				}else{
					jAlert('Fecha ingreso no valida','Dialogo de Alerta');
					document.form_titular.fecha_ingr.focus();
					return false;				  		
			}
		}
		}else{
		jAlert('Fecha ingreso no valida','Dialogo de Alerta');
		document.form_titular.fecha_ingr.focus();
		return false;
		}
	 }	
if(document.form_titular.profesion.value=="0"){
		jAlert('Debe seleccionar al menos una Profesi&oacute;n!','Dialogo de Alerta');
		document.form_titular.profesion.focus();
		return false;
	}
	if(document.form_titular.cargo.value=="0"){
		jAlert('Debe seleccionar el Cargo!','Dialogo de Alerta');
		document.form_titular.cargo.focus();
		return false;
	}
	if(document.form_titular.departamento.value=="0"){ 
		jAlert('Debe seleccionar el Departamento donde Trabaja!','Dialogo de Alerta');
		document.form_titular.departamento.focus();
		return false;
	}
	if(document.form_titular.upsa.value=="0"){
		jAlert('Debe seleccionar la Sede donde Trabaja!','Dialogo de Alerta');
		document.form_titular.upsa.focus();
		return false;
	}
	var fechaNac=document.form_titular.fecha_nac.value;
	var fechaIng = document.form_titular.fecha_ingr.value;
	FechaIngreso = fechaIng.split("-");
	var diaIngreso = FechaIngreso[0];
	var mmIngreso = FechaIngreso[1];
	var yyyyIngreso = FechaIngreso[2];
	FechaNac = fechaNac.split("-");
	var diaCumple = FechaNac[0];
	var mmCumple = FechaNac[1];
	var yyyyCumple = FechaNac[2];
	//retiramos el primer cero de la izquierda
	if (mmCumple.substr(0,1) == 0) {
	mmCumple= mmCumple.substring(1, 2);
	}
	//retiramos el primer cero de la izquierda
	if (diaCumple.substr(0, 1) == 0) {
	diaCumple = diaCumple.substring(1, 2);
	}
	var edad = yyyyIngreso - yyyyCumple;	

	if ((mmIngreso < mmCumple) || (mmIngreso == mmCumple && diaIngreso < diaCumple)) {
	edad--;
	}
	 if(edad<18){		
			jAlert('Fecha Ingreso y Fecha nacimiento no valida.<br> El tiempo entre cada Fecha parece ser irregular Tiempo: '+edad+'a&ntilde;os','Dialogo de Alerta');
			document.form_titular.fecha_nac.focus();
			return false;
	}
	
return true;
}
$(document).ready(function(){
	$("select[multiple]").asmSelect({
	});
		
		$("#estado").change(function(event){
		$("#ciudad").load('Controladores/control_select_ciudad.php?select='+$("#estado option:selected").val());
		$("#cap1").css("display","none");
		$("#cap2").css("display","block"); 
	});
	$("#estado2").change(function(event){
		$("#ciudad2").load('Controladores/control_select_ciudad.php?select='+$("#estado2 option:selected").val());
		$("#cap5").css("display","none");
		$("#cap6").css("display","block"); 
	});	
	$("#upsa").change(function(event){
		$("#cap4").load('Controladores/control_caja_upsa.php?select='+$("#upsa option:selected").val());
		$("#cap3").css("display","none");
		$("#cap4").css("display","block"); 
	});	

});
