<?php session_start();

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script>
var miPopup=0;
function abreVentana(ancho,alto)
{ 
	var posicion_x; 
	var posicion_y; 
	posicion_x=(screen.width/2)-(ancho/2); 
	posicion_y=(screen.height/2)-(alto/4); 
    miPopup = window.open("../../../Controladores/controlador_solicitud_medicina_PDF.php?cedTitular","miwin","width=800px,height=800px,scrollbars=yes,resizable=yes,left="+posicion_x+",top="+posicion_y+""); 
    miPopup.focus();
} 

</script>
</head>
<body onload="abreVentana();" >
<?php $_SESSION['cedTitular']=$_GET['cedTitular']; ?>
</body>
</html>