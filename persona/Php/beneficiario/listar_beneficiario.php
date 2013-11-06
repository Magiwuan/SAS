<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: ../usuario/denied.php");
}
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_beneficiario.php");
	$beneficiario = new beneficiario();
	$paging = new PHPPaging;		
	$pagina=6;
	$beneficiario->setidTitular($_SESSION["id_titular"]);
	$consulta=$beneficiario->listar_beneficiario();	
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina($pagina);
	$paging->div('div_listar_beneficiario');
	$paging->verPost(true);
	$paging->ejecutar();		
?>
<table id="grilla" class="lista" width="624">
  <thead>
  		<tr>        	
        	<th></th>
        	<th></th> 
            <th></th>
            <th></th>
            <th></th>
        </tr>       
        <tr>        	
        	<th colspan="7"  style=" text-align:center; ">Lista de beneficiario por titular</th> 
        </tr>       
        <tr>       	
            <th width="101">Cedula</th>
            <th width="214">Apellidos y nombres</th>
            <th width="33">Sexo</th>
            <th width="74">Parentesco</th>
            <th width="96">%  Participacion</th>
            <th width="36"></th>
            <th width="38"></th>
        </tr>
    </thead>
    <tbody>
    <?php while($result=$paging->fetchResultado()){?>
        <tr>        
            <td> <?php echo $result['nacionalidad'].'-'.$result['cedula'];?></td>
            <td><?php echo $result['apellido1'];?> <?php echo $result['apellido2'];?>, <?php echo $result['nombre1'];?> <?php echo $result['nombre2']; ?></td>
            <td> <?php echo $result['sexo'];?></td>
            <td><?php echo $result['parentesco'];?></td>
            <td><?php echo $result['participacion'];?></td>
            <td><a href="javascript: fn_mostrar_modificar_beneficiario(<?php echo $result['id_beneficiario'];?>);" title="Editar"><img src="Imagen_sistema/page_edit.png"  align="top"/></a></td>
            <td><a href="javascript: fn_eliminar_beneficiario(<?php echo $result['id_beneficiario']; ?>);" title="Excluir Beneficiario"><img src="Imagen_sistema/delete.png" /></a></td>
        </tr>        
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
          <td colspan="8">
			<?php echo $paging->fetchNavegacion();?><br />					
			Mostrando <?php echo $paging->numRegistrosMostrados();?> registros, 
			de un total de <?php echo $paging->numTotalRegistros();?>           
            </td>
        </tr>
    </tfoot>  
</table>
