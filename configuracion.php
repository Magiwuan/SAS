<?php session_start(); //Funci�n que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: usuario/denegar.php");
}
include_once("persona/Clases/clase_vistas.php");
$vist=new vistas;
$vist->setlogin($_SESSION["login"]);

?><!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Menu Configuración:.</title>
<link href="estilos/css_portal.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="principal">
<table width="100%" height="auto" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td class="shadow_left">&nbsp;</td>
    <td class="shadow_top" height="5px">&nbsp;</td> 
    <td class="shadow_right"></td>
    <td>  
  </tr>
  <tr> 
    <td class="shadow_left">&nbsp;</td>
    <td>    
        <table width="100%" border="0" cellspacing="0" cellpadding="0">          
        </table>
       <div id="capa">
           <ul id="menu" >
           
           <!-- Para las Secciones-->
			<?php $vist->setidmodulo($_GET['id']);
				$secciones=$vist->listasecciones();
				for($j=0;$j<count($secciones);$j++)	
				{
					$idsecc=$secciones[$j][1];
					$descripsec=$secciones[$j][2];
				if($descripsec=='Beneficiario'){
				$vist->setnombvistas($descripsec);
				$linkbenef=$vist->LinkBeneficiario();
				for($h=0;$h<count($linkbenef);$h++)	
				{
					$linkb=$linkbenef[$h][1];
				}
				}
		?>
           
        <li><a href="<? if($descripsec=='Beneficiario'){echo $linkb;}else{ echo '#';}?>" <?php if($descripsec=='Beneficiario'){echo 'target="g"';}?>><?php echo $descripsec;?></a>	
                   <ul>
                   <!-- Para las vistas-->
               <?php $vist->setseccion($idsecc);
				$lista=$vist->listavistas();
				for($k=0;$k<count($lista);$k++)	
				{
					$descripser=$lista[$k][2];
					$link=$lista[$k][3];						
					if($descripser!='Beneficiario'){
			?> 
             		<li><a href="<?php echo $link;?>" target="g" ><?php echo $descripser;}?></a></li>
					<?php } ?>                

              </ul>	
                         <?php } ?>
		
	 		   </li> 
                <li>
				   <a href="menu.php">Menu Principal</a>	
                   </br>				
			    </li>            
			  <li class="derecha">
			   <a href="	persona/Controladores/cerrarsesion.php">Cerrar Sesión<img src="Imagenes/Exit.png" width="20" height="20" align="absmiddle"/></a>					
			   </br> </li>
		 </ul>
 		     
      </div>
          <td class="shadow_right"></td>
       </td>    
    </tr>
      <tr>
        <td height="0" class="shadow_left">
        </td>
   
   </tr>
    <tr>
    <td height="25" class="shadow_left">&nbsp;</td>
    <div id="formu">       
    <iframe name="g"  src="html/blanco.html"></iframe>       
   </div>
    <td class="middle_spacer"></td>
    <td class="shadow_right">&nbsp;</td>
  </tr>     
</table>

</body>
</html>
