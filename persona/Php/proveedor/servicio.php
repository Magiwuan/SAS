<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
   <link href="../../Css/PHPPaging.lib.css" rel="stylesheet" type="text/css" /> 	
        <link rel="stylesheet" type="text/css" href="../../Css/jquery.asmselect.css" />	 
        <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.js"></script> <!--Js Para el listado de los combos de Discapacidad,Profesion -->
                 <script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.asmselect.js"></script>  
        
 <script language="JavaScript" type="text/JavaScript">
	   $(document).ready(function(){
		   $("select[multiple]").asmSelect({					
			});	
			});		
			</script>  
</head>

<body>
<select name="servicio[]" id="servicio" multiple="multiple" title="Seleccionar">
  <!-- <option value="0" selected="selected" disabled="disabled">Seleccionar </option>-->
  <?php include_once("../../Clases/clase_servicio.php");
$servicio=new servicio();
$lista=$servicio->lista_servicio();
for($i=0;$i<count($lista);$i++)
{
	$idServicio		=	$lista[$i][1];
	$NombServicio	=	$lista[$i][2];
?>
  <option value="<?php echo $idServicio;?>"><?php echo $NombServicio;?></option>
  <?php }?>
</select>
</body>
</html>