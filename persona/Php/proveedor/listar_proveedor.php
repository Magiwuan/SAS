<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_proveedor.php");
	$proveedor = new proveedor();
	$paging = new PHPPaging;
	$proveedor->setNombre($_GET["ordenar_org"]);
	$proveedor->setOrden($_GET["ordenar_por"]);
	$pagina=6;
	$consulta=$proveedor->sql();
	$paging->agregarConsulta($consulta); 	
	if (isset($pagina))
		$paging->porPagina($pagina);
	$paging->div('div_listar_proveedor');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="668">
  <thead>
        <tr> 
         <th width="143"></th>
        <th width="172"></th>
        <th width="190"></th>
        <th width="88"></th>
        <th width="20"></th>
        <th width="23"></th>
        <th width="0"></th>
        </tr>       
        <tr>
       		<th>Alias</th>
            <th>Organizaci&oacute;n</th>
            <th>Rif</th>
            <th>Ciudad</th>
            <th></th>
            <th width="23"><a href="javascript: fn_agregar_proveedor();"><img src="../../Imagen_sistema/add.png"  width="18" height="18" title="Agregar Proveedor"></a></th>
        </tr>
    </thead>
    <tbody><?  while ($result = $paging->fetchResultado()){  ?>   <tr> 
   			<td><? echo $result['alias']; ?></td>  
            <td><? echo $result['nombre']; ?></td>
            <td><? echo $result['rif']?></td>
            <td><? echo $result['ciudad']?></td>
            <td align="center" valign="middle"><a href="javascript: fn_modificar(<? echo $result['id_proveedor']?>);"><img src="../../Imagen_sistema/page_edit.png" width="16" height="16"  align="center" title="Editar" /></a></td>
            <td align="center" valign="middle"><a href="javascript: fn_eliminar(<? echo $result['id_proveedor']?>);"><img src="../../Imagen_sistema/delete.png" width="16" height="16" align="center" title="Eliminar" /></a></td>
        </tr>        
    <? } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7">
					<? echo $paging->fetchNavegacion()?>	<br />				
					Mostrando: <? echo $paging->numRegistrosMostrados()?> registros, 
					de un total de: <? echo $paging->numTotalRegistros()?>
            </td>
        </tr>
    </tfoot>
</table>
