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
 <div id="disc_capa"> 
<select name="discapacidad[]" multiple="multiple"  id="discapacidad" title="Seleccionar">
  <?php include_once("../../Clases/clase_discapacidad.php");
			$discapacidad=new discapacidad();
			$lista_discapacidad=$discapacidad->lista_discapacidad();
			for($i=0;$i<count($lista_discapacidad);$i++)
			{			
			?>
  <option value="<?php echo $$lista_discapacidad[$i][1];?>" 
		  	<?php if($lista_discapacidad[$i][2]=='N/A')
				{
					echo "Selected=\"Selected\"";
				}
				?>> <?php echo $lista_discapacidad[$i][2];?></option>
  <?php }?>
</select>
</div>
</body>
</html>