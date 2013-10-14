<?php
	include_once("../../Clases/PHPPaging.lib.php");
	include_once("../../Clases/clase_solicitud_medicina.php");
	$sMedicina= new sMedicina();
	$paging = new PHPPaging();
	
	if(isset($_POST['ordenar_por']))
	$sMedicina->setOrden($_GET['ordenar_por']);	
	else
	$sMedicina->setOrden('0');
	$sMedicina->setidTitular($_GET['buscar']);	
	$sql=$sMedicina->sql();
	if($sql=='-1'){
		echo "No hay registros.";
		exit();
	}
	$paging->agregarConsulta($sql); 
	$paging->div('div_listar');
	$paging->porPagina($_GET["paginas"]);
	$paging->verPost(true);
	$paging->ejecutar();
?>
<table id="grilla" class="lista" width="777" cellpadding="0" cellspacing="0">
  <thead>       
        <tr>
            <th colspan="8">Lista de Solicitudes</th>
            
        </tr>   
         <tr>
            	<th width="149">Nombre y Apellido</th>    
         <th width="101">Cedula</th>      
          <th width="94">Fecha Emisi&oacute;n</th>      
           <th width="214">Beneficiario</th>
           <th width="157">Servicio</th>      
               
	    <th width="20"></th>     
             <th width="20"></th>   
                          <th width="20"></th>  
        </tr>       
    </thead>
    <tbody>
       
        
            
    <?php while($result=$paging->fetchResultado()){
		$elDia=substr($result['fecha'],8,2);
		$elMes=substr($result['fecha'],5,2);
		$elYear=substr($result['fecha'],0,4);
		$fecha=$elDia."-".$elMes."-".$elYear;			
	?>
        <tr>        
        <td><?php echo $result['apellido1'];?> <?php echo $result['nombre1'];?></td>    
         <td><?php echo $result['nacionalidad'].'-'.$result['cedula'];?></td>      
          <td><?php echo $fecha;?></td>      
           <td><?php if($result['id_beneficiario']==0){ 
		   				echo "Mismo Titular";
						}else{
							$sMedicina->setidBeneficiario($result["id_beneficiario"]);
							$consulta_B=$sMedicina->consultar_beneficiario();
							$consulta_B=$sMedicina->sig_tupla($consulta_B);
							echo $consulta_B["apellido1"].' '.$consulta_B["nombre1"].' '.$consulta_B["nacionalidad"].'-'.$consulta_B["cedula"];	
			   }?></td>
           <td><?php if($result['id_solicitud']==0){echo "Reembolso";}else{echo $result['servicio'];}?></td>
           <td><a title="Ver planilla" href="javascript: void(0)" onclick="window.open('../../Controladores/controlador_solicitud_PDF.php?<?php if($result['id_solicitud']!='0'){echo "id=".$result['id_solicitud'];}else{echo "id_r=".$result['id_solicitud_reembolso'];} ?>','popup','width=770, height=800');return false;"><img src="../../Imagen_sistema/ver.png" alt="" width="16" height="16" align="center" /></a></td>      
            <td><a title="Aprobar" href="javascript: fn_aprobar('<?php echo $result['cod_hoja'];?>');"><img src="../../Imagen_sistema/aprobar.png" width="16" height="16" align="center" /></a></td> 
             <td><a title="Rechazar" href="javascript: fn_eliminar(<?php if($result['id_solicitud']!='0'){echo $result['id_solicitud'];}else{echo $result['id_solicitud_reembolso'];} ?>);"><img src="../../Imagen_sistema/delete.png" width="16" height="16" align="center" /></a></td>        
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