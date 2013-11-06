<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
include_once("../../Clases/clase_titular.php");
	$titular= new titular();
	if(isset($_GET['id1'])){
		$p1=$_GET['id1'];	
		$titular->setNom1($p1);	
	}
	if(isset($_GET['id2'])){
		$p2=$_GET['id2'];	
		$titular->setApe1($p2);	
	}	
	$resp=$titular->bTitular();				
?>
<html> 
<head> 
<title>Cat&aacute;lago</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script> 
function ponPrefijo(ced){ 

    opener.document.frm_buscar.buscar.value = ced;

	if(opener.document.frm_buscar.buscar.value.length > 0)
	{
		opener.document.frm_buscar.submit();
	}    	
	window.close()	
} 
</script> 
<style type="text/css">
table.lista{margin: 0px auto 20px auto;	border-collapse: collapse;}
table.lista td, table.lista th{ padding: 6px; vertical-align: top;}
table.lista thead th{font-weight: normal;color: #6FA7D1; text-align: center; border-bottom: 1px solid #DDECF7;}
table.lista tbody tr{border-bottom: 1px solid #ddd;}
table.lista tfoot td{text-align: center; color: #6FA7D1; vertical-align: top;}
table.lista strong, table.formulario strong{color: #6FA7D1;font-weight: normal;}
table.contenedor{margin: 0px 0px 20px 0px;border-collapse: collapse;}
table.contenedor>td, table.contenedor>th{padding: 0px;margin: 0px;}
table.contenedor td{vertical-align: top;}a{color: #369;text-decoration: none;color: #000;}
a:hover{color: #E17919;}
#cuerpoListado{width:482px;height:40%;padding:0px;}
form{position:absolute;padding:5px;margin-top: 2px;	margin-left: 3px;margin-bottom:2px;background:#FFF;display:block;box-shadow: 2px 2px 2px 2px #121212;border-radius: 3px;}
</style>
</head>
<body> 
<div id="cuerpoListado">
<form id="fprefijos" name="fprefijos">
<table width="495" height="75" border="0" align="left" cellspacing="0" class="lista">
 <thead>
  <tr>
    <th height="14" colspan="4" bgcolor="#06C"><span style=" color: #FFFFFF; font-weight: bold; text-align:center;">Seleccione su opci&oacute;n</span></th>
    </tr>    
     <tr>
            <th>Nacionalidad</th>
            <th>Cedula</th>
            <th>Apellido(s)</th>
            <th>Nombre(s)</th>
        </tr>
</thead>
  <tr >
    		<?php
            if($resp=="-1")				
				{	
				?>
				<script> 
					alert("No se han encontrado resultados en la busqueda.");					
				</script> 
				<script languaje='javascript' type='text/javascript'>window.close();</script>;
				<?php 
				}
	 			else
				{
	   				for($i=0;$i<count($resp);$i++)
	     			{				   			 	
						$idTitular  	= $resp[$i][1];
						if($resp[$i][2]=='V'){
							$nacio 	= 'Venezolano';
						}else{
							$nacio 	= 'Extranjero';
						}
						$ced  			= $resp[$i][3];
						$nomb1			= $resp[$i][4];
						$nomb2  		= $resp[$i][5];
						$apel1   		= $resp[$i][6];
						$apel2 			= $resp[$i][7];
			?>
     <td width="82" height="27"><a href="#"  onClick="ponPrefijo('<? echo $ced;?>')"><?php echo $nacio?></a></td>
     <td width="72" height="27"><a href="#"  onClick="ponPrefijo('<? echo $ced;?>')"><?php echo $ced?></a></td>
    <td align="center"><a href="#"  onClick="ponPrefijo('<? echo $ced;?>')"><?php echo $apel1?> <?php echo $apel2?></a></td>
     <td align="center" ><a href="#"  onClick="ponPrefijo('<? echo $ced;?>')"><?php echo $nomb1?> <?php echo $nomb2?></a></td>
   </tr>
  <?php }
	}?>
</table>
</form> 
</div>
</body> 
</html> 

