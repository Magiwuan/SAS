<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: usuario/denied.php");
}
?><!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script language="javascript" type="text/javascript" src="../JavaScript/jquery-1.4.2.min.js"></script>  
    <script language="JavaScript" type="text/JavaScript">
	   $(document).ready(function(){				
// Envia al Combo de Ciudad El id Del Estado seleccionado, 
// para realizar la buscqueda de Ciudades relacionadas con el Estados.
				$("#estado").change(function(event){
				if($("#estado").val()!=-1){
				var value = $("#estado option:selected").val();
				$("#ciudad").load('../Controladores/control_select_ciudad.php?select='+value);					
				$("#cap1").css("display","none");	
				$("#cap2").css("display","block"); 
				}
				});	
			$('#ciudad').click(function(){
				var value = $("#estado option:selected").val();
				if(value=='-1'){
					$("#cap").load('../ciudad/popu_ciudad.php');	
					$('#popup').fadeIn('slow');
				}
    		});
	$('#open').click(function(){
		$("#cap").load('../ciudad/popu_ciudad.php');	
        $('#popup').fadeIn('slow');
    });
    $('#close').click(function(){
        $('#popup').fadeOut('slow');
		$('#select_ciudad').load('../select_ciudad.php');
    });
	
				
		});	 
		    
</script>

<body>
<div id="cap1" style="color:#FF0000; display:block; width:"200" ">*Por favor elija un estado</div><div id="cap2" style="display: none; "><select name="ciudad" id="ciudad" >
       
      </select></div>

</body>
</html>
