<?php
	include_once("../Clases/clase_solicitud_medicina.php");
 $sMedicina= new sMedicina();
 $sMedicina->setidSolicitud($_POST['buscar']);
 $resp=$sMedicina->buscar_id_solicitud(); 
// Si la Consulta Retorna -1 Envia un mensaje de Error.
		if($resp=='-1'){			
		echo "No";
		}else{
			$r=$sMedicina->sig_tupla($resp);
			if($r["id_solicitud"]!='0'){
				echo "1";
			}else{
				echo "2";
			}
		}
?>