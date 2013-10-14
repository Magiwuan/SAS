<?php
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_patologia.php");
	$patologia= new patologia();
	$paging = new PHPPaging;	
	$consulta=$patologia->sql_patologia();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina(6);
	$paging->div('div_listar_patologia');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="424">
  <thead>       
        <tr>
            <th width="336">Lista de Patologías</th>
            <th width="36">&nbsp;</th>           
        </tr>
    </thead>
    <tbody>
    <?php while($result=$paging->fetchResultado()){?>
        <tr>        
        <td><?php echo $result['nombre'];?></td>           
        <td><a href="javascript: fn_eliminar_patologia(<?php echo $result['id_patologia'];?>);"><img src="../../Imagen_sistema/delete.png" title="Eliminar" /></a></td>
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