<html>
<head>
 <link rel="stylesheet" type="text/css" href="../../Css/jquery.asmselect.css" />	 
        <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.js"></script> 
        <script language="JavaScript" type="text/javascript" src="../../JavaScript/jquery.asmselect.js"></script>  
		<script language="JavaScript" type="text/JavaScript">
		   $(document).ready(function(){
			   $("select[multiple]").asmSelect({					
					addItemTarget: 'bottom',
					animate: true,
					highlight: true,
				});	
				});		
		</script> 
        </head>
<body>
 <div id="servi_capa"> 
  <select name="servicio[]" id="servicio" multiple="multiple" title="Seleccionar">
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
</div>
</body>
</html>
