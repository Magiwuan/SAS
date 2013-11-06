<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_estado.php");
	$estado= new estado();
	$paging = new PHPPaging;	
	$pagina=6;
	$consulta=$estado->sql_estado();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina($pagina);
	$paging->div('div_listar_estado');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="424">
  <thead>       
        <tr>
          <th width="178">Lista de Estado</th>
            <th width="210">País</th>
            <th width="20">&nbsp;</th>           
        </tr>
    </thead>
    <tbody>
    <?php while ($result = $paging->fetchResultado()){?>
        <tr>
          <td><?php echo $result['nombre'];?></td>        
          <td><?php echo $result['pais'];?></td>
          <td><a href="javascript: fn_eliminar_estado(<?php echo $result['id_estado'];?>);"><img src="../../Imagen_sistema/delete.png" title="Eliminar"/></a></td>            
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
