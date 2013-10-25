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
<meta http-equiv="Content-Type" content="text/html; charset='utf-8'" />
<title>.:Menu Principal:.</title>
<link href="estilos/css_portal.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <div id="principal">
<table width="100%" height="auto" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="shadow_left">&nbsp;</td>
    <td>    
        <table width="100%" border="0" cellspacing="0" cellpadding="0">   
          <tr> 
            <td><img src="Imagenes/banner.jpg" width="850" height="140" /></td>       
          </tr>
          
        </table>
    <td class="shadow_right"></td>
     </td>    
  </tr>
  <tr>
    <td height="0" class="shadow_left">
</td>   
   </tr>
  <tr>
    <td height="450" class="shadow_left"></td>
    <td bgcolor="#F0F8E7">
         <div id="franja">			
            <div id="usuario" class="texto">
               <img src="Imagenes/Icono3.gif" width="25" height="25" align="absmiddle"/>Usuario: <?php echo $_SESSION["login"]?>
            </div>
            <!-- <div id="clave" class="texto">
      			<img src="Imagenes/modificar.png" width="20" height="20" align="absmiddle"/>Cambiar Mi Clave
             </div>!-->
           <div id="fecha" class="texto">
            <img src="Imagenes/calendario.png" width="25" height="25" align="absmiddle"/><?php date_default_timezone_set('America/Caracas');   echo " ".date('d / m  / Y') ?> 
            </div>                
         </div>
     <div id="capa-index">
        <div id="sombra">
        <fieldset>
            <legend style="color: #B0001B; font-weight: bold; text-align: center;">Menú Principal</legend>
            <div id="menu-principal"> 
            <div id="cuadro"> 
             <ul><?php
             	$modulos=$vist->listamodulo();
				for($i=0;$i<count($modulos);$i++)	
				{
					$idm=$modulos[$i][1];		
					$ico=$modulos[$i][2];
					$descrip=$modulos[$i][3];
					$url=$modulos[$i][4];
							
				?>
		<li><a href="<? echo $url;?>"><center><? echo $descrip;?></center><img src="<? echo $ico;?>" width="196" height="130" /></a></li>
        <?php }?>
		<li><a href="persona/Controladores/cerrarsesion.php"><center>Salir</center><img src="Imagenes/salir.jpg" width="196" height="130" /></a></li>
        </ul>
            </div>
            </div>
        </fieldset>
        </div>  
        </div>
   
    </td>
    <td class="shadow_right">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" class="shadow_left">&nbsp;</td>
    <td class="middle_spacer"></td>
    <td class="shadow_right">&nbsp;</td>
  </tr>
</table>
</div>
<script language="javascript" type="text/javascript">
function confirmar(){
	if(jConfirm('Esta seguro?','Dialogo Confirmacion')){
	}
}
</script>
</body>
</html>
