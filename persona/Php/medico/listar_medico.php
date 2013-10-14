<?php
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_medico.php");
	$medico = new medico();
	$paging = new PHPPaging;
	$medico->setApellido($_GET["apellido"]);
	$medico->setOrden($_GET["ordenar_por"]);
	$consulta=$medico->sql();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina($_GET["paginas"]);
	$paging->div('div_listar_medico');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="673">
  <thead>
        <tr> 
        <th width="243"></th>
        <th width="176"></th>
        <th width="187"></th>
        <th width="20"></th>
        <th width="23"></th>
        </tr>       
        <tr>
      		<th width="243">Apellidos y Nombres</th>
            <th>Cedula</th>
            <th>Especialidad</th>
            <th>&nbsp;</th>            
          <th><a href="javascript: fn_agregar_medico();"><img src="../../Imagen_sistema/add.png"  width="18" height="18" title="Agregar Médico"/></a></th>

        </tr>
    </thead>
    <tbody><?php  while ($result = $paging->fetchResultado()){?> 
     <tr>        
            <td><?php echo $result['apellido']; ?>, <?php echo $result['nombre']; ?></td>
            <td><?php echo $result['cedula']?></td>
            <td><?php echo $result['especialidad']?></td>
            <td align="center" valign="middle"><a href="javascript: fn_modificar(<?php echo $result['id_medico']?>);"><img src="../../Imagen_sistema/page_edit.png" width="16" height="16"  align="center" title="Editar" /></a></td>
            <td align="center" valign="middle"><a href="javascript: fn_eliminar(<?php echo $result['id_medico']?>);"><img src="../../Imagen_sistema/delete.png" width="16" height="16" align="center" title="Eliminar"/></a></td>
     
        </tr>        
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7">
					<?php echo $paging->fetchNavegacion()?><br />				
					Mostrando <?php echo $paging->numRegistrosMostrados()?> registros, 
					de un total de <?php echo $paging->numTotalRegistros()?>
            </td>
        </tr>
    </tfoot>
</table>