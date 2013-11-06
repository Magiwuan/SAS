<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_examen.php");
	$examen= new examen();
	$paging = new PHPPaging;	
	$consulta=$examen->sql_examen();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina(6);
	$paging->div('div_listar_examen');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="424">
  <thead>       
        <tr>
          <th width="336">Lista de Examen</th>
            <th width="336">Tipo</th>
            <th width="36">&nbsp;</th>           
        </tr>
    </thead>
    <tbody>
    <?php while ($result = $paging->fetchResultado()){?>
        <tr>
          <td><?php echo $result['descripcion'];?></td>        
            <td><?php echo $result['tipo'];?></td>
            <td>&nbsp;</td>            
            <td><a href="javascript: fn_eliminar_examen(<?php echo $result['id_examen'];?>);"><img src="../../Imagen_sistema/delete.png" /></a></td>
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
