<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
include_once("../../Clases/clase_titular.php");
	$titular= new titular();	
	$idTitular=$_POST["id_titular"];
	$titular->setidTitular($idTitular);
	$consulta=$titular->buscar_id();
	for($i=0;$i<count($consulta);$i++)			
	{
		$nacio			= $consulta[$i][2];
		$cedula			= $consulta[$i][3];
		$nombre1		= $consulta[$i][4];
		$apellido1		= $consulta[$i][6];
		$nombre2		= $consulta[$i][5];
		$apellido2		= $consulta[$i][7];
		$celular		= $consulta[$i][11];
		$telefono		= $consulta[$i][12];	
	}
include_once("../../Clases/clase_cobertura.php");
$cobertura= new cobertura();
$cobertura->setidTitular($idTitular);
$resp=$cobertura->bDetalle_cobertura();
$mov=$cobertura->cant_movientos();
$numFilas=$cobertura->getNTupla($mov)-1;
	if($resp){ 
		$resp=$cobertura->sig_tupla($resp);		
		$montoDisponible=$resp["monto_disponible"];
		$fecha=$resp["fecha"];
		$elDia=substr($fecha,8,2);
		$elMes=substr($fecha,5,2);
		$elYear=substr($fecha,0,4);
		$fecha=$elDia."-".$elMes."-".$elYear;	
		
	}
?><!DOCTYPE HTML>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>.:Agregar Beneficiario:.</title>          
	<link rel="stylesheet" type="text/css" href="../../Css/PHPPaging.lib.css"/>
      <link href="../../Css/estilo2.css" rel="stylesheet" type="text/css" />   
        <link href="../../Css/estilo.css" rel="stylesheet" type="text/css" />
 	<link href="JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />  
	<script src="JavaScript/jscal2.js"></script>    
    <script src="JavaScript/es.js"></script> 
    <script language="javascript" type="text/javascript" src="../../JavaScript/jquery.alerts.js"></script> 
    
    <script language="javascript" type="text/javascript" >
	  $(document).ready(function(){  
		fn_listar_benef();
    });
	function limpiar_form(ele) {
   $(ele).find('input').each(function() {
      switch(this.type) {
         case 'password':
         case 'select':
         case 'textarea':
				 $(this).val('');
               	 break;
		case 'text':
		if($('input[name="cedula"]')){}else {$(this).val('');}
		break;
         case 'checkbox':
         case 'radio':
         	this.checked = false;
			   break;
      }
   }); 			
   $(ele).find('select').each(function() {
       $("#"+this.id + " option[value=0]").attr("selected",true);
   });
 	 $(ele).find('select').each(function() {
       $("#"+this.id).val('0');
   });
   } 
</script>
</head>	
<body> 
<div id="cuerpo">
<form action=""  method="POST" id="from_perfil" name="from_perfil">
	<h1>Historial del Titular</h1>

<table id="grilla" class="lista" width="700">
  <thead>
        <tr> 
        <th width="100"></th>
        <th width="220"></th>
        <th width="108"></th>
        <th width="120"></th>
        <th width="27"></th>
         <th width="80"></th>
        </tr>       
        <tr>
			<th>C&eacute;dula</th>
          	<th>Nombre y Apellido</th>
			<th>Disponible</th>
			<th>Ultimo Movimiento</th>
			<th>Movimientos</th>
			<th>Ver detalle</th>
        </tr>
    </thead>
  <tbody>
   <tr>
		<td><?php echo $nacio.'-'.$cedula; ?></td>
		<td><?php echo $nombre1.' '.$apellido1; ?></td>
		<td><?php echo $montoDisponible." Bs."; ?></td>
		<td><?php echo $fecha; ?></td>
		<td><?php echo $numFilas; ?></td>
		<td align="center" valign="middle">
		<a href="javascript: fn_verHistorial('<?php echo $idTitular; ?>','<?php echo $nombre1; ?>','<?php echo $apellido1; ?>');" title="Ver Perfil">
		<img src="../../Imagen_sistema/ver.png" width="16" height="16" align="center" />
		</a>
		</td>
    </tr>	
    </tbody>
 
</table>
<?php $_SESSION['idTitular']=$idTitular; ?>
  <div id="div_listar_beneficiario"></div>
</form>
 </div> 
</body>
</html>
