<?php session_start(); //Función que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: usuario/denegar.php");
}
include_once("persona/Clases/clase_vistas.php");
$vist=new vistas;
$vist->setlogin($_SESSION["login"]);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:Menu Configuracion:.</title>
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
			?>
            <?php } ?>
               <li><a href="#"><?php echo $descripsec;?></a>	
                   <ul>
                   <!-- Para los Servicios-->
               <?php $vist->setseccion($idsecc);
				$lista=$vist->listavistas();
				for($k=0;$k<count($lista);$k++)	
				{
					$descripser=$lista[$k][2];
					$link=$lista[$k][3];
			?> 
             		<li><a href="<? echo $link;?>" target="g" ><?php echo $descripser;?></a></li>
                    <?php } ?>                
                </ul>			
	 		   </li> 
                <li>
				   <a href="menu.php">Menú Principal</a>	
                   </br>				
			    </li>            
			  <li class="derecha">
				   <a href="html/blanco.html">Cerrar Sesión<img src="Imagenes/Exit.png" width="20" height="20" align="absmiddle"/></a>					
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
