<?php
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_upsa.php");
	$upsa= new upsa();
	$paging = new PHPPaging;	
	$pagina=6;
	$consulta=$upsa->sql_upsa();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina($pagina);
	$paging->div('div_listar_upsa');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="526">
  <thead>       
        <tr>
          <th width="133">Lista de Sedes</th>
            <th width="203">Dirección</th>
            <th width="150">Ciudad</th>
            <th width="20">&nbsp;</th>           
        </tr>
    </thead>
    <tbody>
    <?php while ($result = $paging->fetchResultado()){?>
        <tr>
          <td><?php echo $result['nombre'];?></td>        
            <td><?php echo $result['direccion'];?></td>
            <td><?php echo $result['ciudad'];?></td>
            <td><a href="javascript: fn_eliminar_upsa(<?php echo $result['id_upsa'];?>);"><img src="../../Imagen_sistema/delete.png" alt="" title="Eliminar" /></a></td>            
        </tr>        
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
					<?php echo $paging->fetchNavegacion();?><br />					
					Mostrando <?php echo $paging->numRegistrosMostrados();?> registros, 
					de un total de <?php echo $paging->numTotalRegistros();?>                      
            </td>
        </tr>
    </tfoot>  

</table>