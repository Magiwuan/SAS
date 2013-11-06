<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_pais.php");
	$pais= new pais();
	$paging = new PHPPaging;	
	$consulta=$pais->sql_pais();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina(6);
	$paging->div('div_listar_pais');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="424">
  <thead>       
        <tr>
            <th width="392">Lista de Países</th>
            <th width="20">&nbsp;</th>           
        </tr>
    </thead>
    <tbody>
    <?php while ($result = $paging->fetchResultado()){?>
        <tr>        
            <td><?php echo $result['nombre']; ?></td>           
            <td><a href="javascript: fn_eliminar_pais(<?php echo $result['id_pais'];?>);" title="Eliminar"><img src="../../Imagen_sistema/delete.png" /></a></td>
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
