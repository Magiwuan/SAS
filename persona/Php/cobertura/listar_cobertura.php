<?php
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_cobertura.php");
	$cobertura= new cobertura();
	$paging = new PHPPaging;	
	$pagina=6;
	$consulta=$cobertura->sql_cobertura();
	$paging->agregarConsulta($consulta); 	
	if (isset($pagina))
		$paging->porPagina($pagina);
	$paging->div('div_listar_cobertura');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="513">
  <thead>       
        <tr>
            <th width="285">Lista de Corbertura</th>
            <th width="99">Tipo </th> 
            <th width="81">Monto Bs.</th>  
            <th width="28">&nbsp;</th>         
        </tr>
    </thead>
    <tbody>
    <?
        while ($result = $paging->fetchResultado()){
	?>
        <tr>        
            <td><? echo $result['descripcion']; ?></td>  
            <td><? echo $result['tipo']; ?></td> 
            <td><? echo $result['monto']; ?></td>          
            <td width="28"><a href="javascript: fn_eliminar_cobertura(<? echo $result['id_cobertura']; ?>);" title="Eliminar"><img src="../../imagen_sistema/delete.png" /></a></td>
        </tr>        
    <? } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
					<? echo $paging->fetchNavegacion(); ?><br />					
					Mostrando: <? echo $paging->numRegistrosMostrados(); ?> registros, 
					de un total de: <? echo $paging->numTotalRegistros(); ?>                      
            </td>
        </tr>
    </tfoot>  

</table>