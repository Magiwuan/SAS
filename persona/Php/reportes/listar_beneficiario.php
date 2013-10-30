<?php session_start();
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_beneficiario.php");
	$beneficiario = new beneficiario();
	$paging = new PHPPaging;		
	$pagina=6;
	$beneficiario->setidTitular(1);
	$consulta=$beneficiario->listar_beneficiario();	
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina($pagina);
	$paging->div('div_listar_beneficiario');
	$paging->verPost(true);
	$paging->ejecutar();		
?>
<hr />
<table id="grilla" class="lista" width="700">
  <thead> 
  		<tr>        	
        	<th width="110"></th>
			<th width="210"></th>
			<th width="90"></th>
			<th width="100"></th>
			<th width="170"></th>
			<th width="110"></th>
			<th width="110"></th>
        </tr>       
        <tr>        	
        	<h1>Historial Grupo del Familiar</h1>
        </tr>       
        <tr>       	
            <th>Cedula</th>
            <th>Nombre y Apellido</th>
            <th>Parentesco</th>
            <th>Disponible</th>
			<th>Ultimo Movimiento</th>
			<th>Movimientos</th>
			<th>Ver detalle</th>
        </tr>
    </thead>
    <tbody>
    <?php while($result=$paging->fetchResultado()){?>
        <tr>        
            <td> <?php echo $result['nacionalidad'].'-'.$result['cedula'];?></td>
            <td><?php echo $result['apellido1'];?> <?php echo $result['nombre1'];?></td>
            <td><?php echo $result['parentesco'];?></td>
           <td></td>
			<td></td>
			<td></td>
			<td></td>
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
