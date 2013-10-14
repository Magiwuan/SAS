<?php
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_cargo.php");
	$cargo= new cargo();
	$paging = new PHPPaging;	
	$consulta=$cargo->sql_cargo();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina(6);
	$paging->div('div_listar_cargo');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="424">
  <thead>       
        <tr>
            <th width="392">Lista de Cargos</th>
            <th width="20">&nbsp;</th>           
        </tr>
    </thead>
    <tbody>
    <?php while($result=$paging->fetchResultado()){?>
        <tr>        
        <td><?php echo $result['nombre'];?></td>           
        <td><a href="javascript: fn_eliminar_cargo(<?php echo $result['id_cargo'];?>);" title="Eliminar"><img src="../../Imagen_sistema/delete.png" /></a></td>
        </tr>        
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">
					<?php echo $paging->fetchNavegacion();?><br />					
					Mostrando <?php echo $paging->numRegistrosMostrados();?> registros, 
					de un total de <?php echo $paging->numTotalRegistros();?>                      
            </td>
        </tr>
    </tfoot>  

</table>