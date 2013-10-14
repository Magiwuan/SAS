<?php
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_medicamento.php");
	$medicamento= new medicamento();
	$paging = new PHPPaging;	
	$consulta=$medicamento->sql_medicamento();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina(6);
	$paging->div('div_listar_medicamento');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="424">
  <thead>       
        <tr>
            <th>Lista de Medicamentos</th>
            <th >Presentación</th>
            <th >&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    <?php  while($result=$paging->fetchResultado()){?>
        <tr>        
            <td width="212"><?php echo $result['descripcion']; ?></td>
            <td width="176"><?php echo $result['presentacion']; ?></td>
            <td width="20"><a href="javascript: fn_eliminar_medicamento(<?php echo $result['id_medicamento']; ?>);"><img src="../../Imagen_sistema/delete.png" /></a></td>        
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