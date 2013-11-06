<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}?><html>
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
      <select name="proveedor[]" id="proveedor" multiple="multiple" title="Seleccionar">        
          <?php include_once("../../Clases/clase_proveedor.php");
				$proveedor=new proveedor();
				$lista_proveedor=$proveedor->lista_proveedor();
				for($i=0;$i<count($lista_proveedor);$i++)
				{
				?><option value="<?php echo $lista_proveedor[$i][1];?>"><?php echo $lista_proveedor[$i][2];?></option>
        <?php }?>
        </select>
</div>
</body>
</html>
