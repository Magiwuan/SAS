<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
include_once("../../Clases/clase_beneficiario.php");
	$beneficiario= new beneficiario();	
	$beneficiario->setidTitular($_SESSION["id_titular"]);
	$consulta=$beneficiario->buscar_Beneficiario();
	for($i=0;$i<count($consulta);$i++)			
	{
		$part		= $consulta[$i][14];
		$total+=str_replace("%","",$part);
	}
	$p=100-$total;
?>
<!DOCTYPE html>
<html lang="es">
<head>
</head>
<body>
<input name="escondido" type="text" id="escondido" value="<?php echo $p; ?>%" size="12"/>
</div>
</body>
</html>
