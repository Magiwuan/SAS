<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
header("Location: persona/Php/usuario/denied.php");
}
include_once("persona/Clases/clase_vistas.php");
$vist=new vistas;
$vist->setlogin($_SESSION["login"]);
?><!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Menu Servicios:.</title>
<link href="estilos/css_portal.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="principal">
<table width="100%" bgcolor="#000" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="shadow_left">&nbsp;</td>
<td class="shadow_top" height="5px">&nbsp;</td> 
<td class="shadow_right"></td>
</tr>
<tr> 
<td class="shadow_left">&nbsp;</td>
<td>    
 <div id="capa">
   <ul id="menu">   
   <!-- Para las Secciones-->
<?php $vist->setidmodulo($_GET['id']);
$secciones=$vist->listasecciones();
for($j=0;$j<count($secciones);$j++)
{
$idsecc=$secciones[$j][1];
$descripsec=$secciones[$j][2];
if($descripsec=='Solicitudes Pendientes' || $descripsec=='Finalizar Solicitud'){
$vist->setnombvistas($descripsec);
$linkbenef=$vist->LinkBeneficiario();
for($h=0;$h<count($linkbenef);$h++)
{
$linkb=$linkbenef[$h][1];
}
}
?>   
<li><a href="<? if($descripsec=='Solicitudes Pendientes' || $descripsec=='Finalizar Solicitud'){echo $linkb;}else{ echo '#';}?>" <?php if($descripsec=='Solicitudes Pendientes' || $descripsec=='Finalizar Solicitud'){echo 'target="g"';}?>><?php echo $descripsec;?></a>
   <ul>
   <!-- Para las vistas-->
   <?php $vist->setseccion($idsecc);
$lista=$vist->listavistas();
for($k=0;$k<count($lista);$k++)
{
$descripser=$lista[$k][2];
$link=$lista[$k][3];
if($descripser!='Solicitudes Pendientes' && $descripsec!='Finalizar Solicitud'){
?> 
<li><a href="<? echo $link;?>" target="g" ><?php echo $descripser;}?></a></li>
<?php } ?>   
  </ul>
<?php } ?>
   </li> 
<li>
   <a href="menu.php">Menu Principal</a>
</li>            
  <li class="derecha">
 <a href="persona/Controladores/cerrarsesion.php">
 <img src="Imagenes/Exit.png" width="22" height="22" align="absmiddle" title="Cerrar Sesi�n"/></a>
 </li>
 </ul> 
  </div>
  <td class="shadow_right"></td>
   </td>    
</tr>
  <tr>
<td height="0" class="shadow_left"></td>   
   </tr>
<tr>
<td height="25" class="shadow_left">&nbsp;</td>
<div id="formu"><iframe name="g" src="html/blanco2.html"></iframe>	</div>  
<td class="middle_spacer"></td>
<td class="shadow_right">&nbsp;</td>
  </tr>	
</div>
</table>
</body>
</html>
