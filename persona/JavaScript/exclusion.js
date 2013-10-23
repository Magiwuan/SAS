	
	function valida() {
	if(document.form_exclusion.motivo.value=="0"){//6
		jAlert("Debe seleccionar el motivo de la exclusión!");
		document.form_exclusion.motivo.focus();
		return false;
	}
		var n="no";
	for(var i=0;i<document.form_exclusion.recaudos.length;i++){
		if (document.form_exclusion.recaudos[i].checkbox){
		n="si";
		break;
		}
	}
	if(n=="no"){
		jAlert('Debe seleccionar una Nacionalidad','Dialogo de Alerta');
		return false;
	}
	return true;
	}
	


