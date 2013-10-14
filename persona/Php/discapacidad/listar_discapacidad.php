<?php
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_discapacidad.php");
	$discapacidad= new discapacidad();
	$paging = new PHPPaging;	
	$consulta=$discapacidad->sql_discapacidad();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina(6);
	$paging->div('div_listar_discapacidad');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="424">
  <thead>       
        <tr>
            <th width="336">Lista de Discapacidad</th>
            <th width="36">&nbsp;</th>           
        </tr>
    </thead>
    <tbody>
    <?php
        while($result=$paging->fetchResultado()){?> 
         <tr>        
            <td><?php echo $result['nombre'];?></td>           
            <td><a href="javascript: fn_eliminar_discapacidad(<?php echo $result['id_discapacidad'];?>);"><img src="../../Imagen_sistema/delete.png" title="Eliminar" /></a></td>
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