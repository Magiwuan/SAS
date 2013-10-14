<?php
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_servicio.php");
	$servicio= new servicio();
	$paging = new PHPPaging;	
	$consulta=$servicio->sql_servicio();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina(6);
	$paging->div('div_listar_servicio');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="424">
  <thead>       
        <tr>
          <th width="392">Lista de Servicios</th>
            <th width="20">&nbsp;</th>           
        </tr>
    </thead>
    <tbody>
    <?php while ($result=$paging->fetchResultado()){?>
        <tr>
          <td><?php echo $result['nombre'];?></td>        
            <td><a href="javascript: fn_eliminar_servicio(<?php echo $result['id_servicio']; ?>);" title="Eliminar"><img src="../../Imagen_sistema/delete.png" /></a></td>            
        </tr>        
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
					<?php echo $paging->fetchNavegacion();?><br />					
					Mostrando <?php echo $paging->numRegistrosMostrados();?> registros, 
					de un total de <?php echo $paging->numTotalRegistros();?>                      
            </td>
        </tr>
    </tfoot>  

</table>