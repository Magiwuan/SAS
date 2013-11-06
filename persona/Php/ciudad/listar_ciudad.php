<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_ciudad.php");
	$ciudad= new ciudad();
	$paging = new PHPPaging;	
	$pagina=6;
	$consulta=$ciudad->sql_ciudad();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina($pagina);
	$paging->div('div_listar_ciudad');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="424">
  <thead>       
        <tr>
          <th width="190">Lista de Ciudad</th>
           <th width="198">Estado</th>
           <th width="20">&nbsp;</th>           
        </tr>
    </thead>
    <tbody>
    <?php while($result=$paging->fetchResultado()){?>
        <tr>
          <td><?php echo $result['nombre'];?></td>        
          <td><?php echo $result['estado'];?></td>
          <td><a href="javascript: fn_eliminar_ciudad(<?php echo $result['id_ciudad']; ?>);"><img src="../../Imagen_sistema/delete.png" title="Eliminar" /></a></td>            
        </tr>        
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
					<?php echo $paging->fetchNavegacion(); ?><br />					
					Mostrando <?php echo $paging->numRegistrosMostrados(); ?> registros, 
					de un total de <?php echo $paging->numTotalRegistros(); ?>                      
            </td>
        </tr>
    </tfoot>  

</table>
