<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_reportes.php");
	$reporte = new reporte();
	$paging = new PHPPaging();
	if(isset($_GET["buscar"]))
	$reporte->setCed($_GET["buscar"]);
	if(isset($_GET["ordenar_por"]))
	$reporte->setOrden($_GET["ordenar_por"]);	
	$consulta=$reporte->sql();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina($_GET["paginas"]);
	$paging->div('div_listar');
	$paging->verPost(true);
	$paging->ejecutar();
?>
<table id="grilla" class="lista" width="624">
  <thead>
        <tr> 
        <th width="281"></th>
        <th width="108"></th>
        <th width="110"></th>
        <th width="27"></th>
        </tr>       
        <tr>
            <th>Apellido(s) y Nombre(s)</th>
            <th>Cedula</th>
            <th>Teléfono</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
  <tbody>
    <?php while ($result = $paging->fetchResultado()){?>
        <tr>        
            <td><?php echo $result['apellido1']; ?> <?php echo $result['apellido2']; ?>, <?php echo $result['nombre1']; ?> <?php echo $result['nombre2']; ?></td>
            <td> <?php echo  $result['nacionalidad'].'-'.$result['cedula'];?></td>
            <td><?php 	echo $result['telefono'].'    -'.$result['id_titular'];?></td>
         <td align="center" valign="middle"><a href="javascript: fn_verPerfil(<?php echo $result['id_titular']; ?>);" title="Ver Perfil"><img src="../../Imagen_sistema/ver.png" width="16" height="16" align="center" /></a></td>
    
        </tr>
        
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9">
					<?php echo $paging->fetchNavegacion()?>	<br />					
					Mostrando <?php echo $paging->numRegistrosMostrados()?> registros, 
					de un total de <?php echo $paging->numTotalRegistros()?>
            </td>
        </tr>
    </tfoot>
</table>
