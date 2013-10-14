<html>
<head>
 <link rel="stylesheet" type="text/css" href="../Css/jquery.asmselect.css" />	 
        <script language="javascript" type="text/javascript" src="../JavaScript/jquery.js"></script> 
        <script language="JavaScript" type="text/javascript" src="../JavaScript/jquery.asmselect.js"></script>  
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
<select name="profesion[]" multiple="multiple" disabled="disabled" id="profesion" title="Seleccionar">
  <?php include_once("../Clases/clase_profesion.php");
			$profesion=new profesion();
			$lista_profesion=$profesion->lista_profesion();
			for($i=0;$i<count($lista_profesion);$i++)
			{
			?>
  <option value="<?php echo $lista_profesion[$i][1];?>"><?php echo $lista_profesion[$i][2];?></option>
  <?php }?>
</select>
</body>
</html>