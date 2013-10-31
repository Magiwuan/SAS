<?php session_start();
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_beneficiario.php");
	include_once("../../Clases/clase_cobertura.php");
	$cobertura= new cobertura();
	$beneficiario = new beneficiario();
	$paging = new PHPPaging;		
	$pagina=10;
	$beneficiario->setidTitular($_SESSION['idTitular']);
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
    <?php while($result=$paging->fetchResultado()){	
		
	$cobertura->setidBeneficiario($result['id_beneficiario']);
	$resp=$cobertura->bDetalle_coberturaBenef();
	$numFilas=1-$cobertura->getNTupla($resp);
		if($resp){ 
		$resp=$cobertura->sig_tupla($resp);		
			$montoDisponible=$resp["monto_disponible"];
			$fecha=$resp["fecha"];
			$elDia=substr($fecha,8,2);	
			$elMes=substr($fecha,5,2);
			$elYear=substr($fecha,0,4);
			$fecha=$elDia."-".$elMes."-".$elYear;		
		}		
		?>
        <tr>        
            <td> <?php echo $result['nacionalidad'].'-'.$result['cedula'];?></td>
            <td><?php echo $result['apellido1'];?> <?php echo $result['nombre1'];?></td>
            <td><?php echo $result['parentesco'];?></td>
			<td><?php echo $montoDisponible." Bs.	";?></td>
			<td><?php echo $fecha;?></td>
			<td><?php echo $numFilas;?></td>
			<td align="center" valign="middle">
		<a href="javascript: fn_verHistorial('<?php echo $result['id_beneficiario']; ?>','<?php echo $result['nombre1']; ?>','<?php echo $result['apellido1']; ?>');" title="Ver Perfil">
		<img src="../../Imagen_sistema/ver.png" width="16" height="16" align="center" />
		</a>
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
<?php
session_unset($_SESSION['idTitular']);
?>