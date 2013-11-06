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
			$('#estado').click(function(){
				var value = $("#estado option:selected").val();
				if(value=='-1'){
					$("#cap").load('estado/popu_estado.php');	
					$('#popup').fadeIn('slow');
				}
    		});
	$('#open').click(function(){
		$("#cap").load('estado/popu_estado.php');	
        $('#popup').fadeIn('slow');
    });
    $('#close').click(function(){
       	$('#popup').fadeOut('slow');
		$('#select_estado').load('select_estado.php');
		$('#select_ciuad').load('select_ciudad.php');
		$("#cap1").css("display","block");	
		$("#cap2").css("display","none");  
		
    });			
		});	 	    
</script>
</head>
<body>
<select name="estado" id="estado">
  <option value="0" selected="selected" disabled="disabled">Seleccionar </option>
  <?php include_once("../Clases/Clase_estado.php");
$estado=new estado();
$lista=$estado->lista_estado();
for($i=0;$i<count($lista);$i++)
{
	$idEstado	=	$lista[$i][1];
	$NombEstado	=	$lista[$i][2];
?>
  <option value="<?php echo $idEstado;?>"><?php echo $NombEstado;?></option>
  <?php }?>
<option value="-1"><div id="open">Agregar Estado</div></option>
</select>
</body>
</html>
