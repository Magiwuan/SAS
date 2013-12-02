<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: usuario/denied.php");
}
	include_once("../Clases/PHPPaging.lib.php");
	include_once("../Clases/clase_titular.php");
	$titular = new titular();
	$paging = new PHPPaging;
	if(isset($_GET["buscar"]))
	$titular->setCed($_GET["buscar"]);
	if(isset($_GET["ordenar_por"])){
		$titular->setOrden($_GET["ordenar_por"]);
	}else{
		$titular->setOrden(0);
	}
	$consulta=$titular->sql();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina($_GET["paginas"]);
	$paging->div('div_listar');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="680" title="Lista de Empleados">
  <thead>
        <tr> 
        <th width="285"></th>
        <th width="106"></th>
        <th width="110"></th>
        <th width="30"></th>
        <th width="20"></th>
        <th width="20"></th>
        <th width="21"></th>
        </tr>       
        <tr>
            <th>Apellido(s) y Nombre(s)</th>
            <th>C&eacute;dula</th>
            <th>Tel&eacute;fono Celular</th>
            <th>&nbsp;</th>
            <th></th>
            <th></th>
            <th>&nbsp;<a href="javascript: fn_mostrar_frm_agregar();" title="Agregar Titular"><img src="Imagen_sistema/add.png" width="16" height="16" align="right" ></a></th>
        </tr>
    </thead>
    <tbody>
    <?php while ($result = $paging->fetchResultado()){?>
        <tr>        
            <td ><?php echo $result['apellido1']; ?> <?php echo $result['apellido2']; ?>, <?php echo $result['nombre1']; ?> <?php echo $result['nombre2']; ?></td>
            <td> <?php echo  $result['nacionalidad'].'-'.$result['cedula']; ?></td>
            <td><?php 	echo $result['celular'];?></td>
            <td align="center" ><a href="javascript: fn_mostrar_agregar_grupo(<?php echo $result['id_titular'] ?>,'<?php echo $result['nombre1'] ?>','<?php echo $result['apellido1'] ?>');" title="Grupo Familiar"><img src="Imagen_sistema/grupo.png" width="18" height="18" align="center"/></a></td>
            <td align="center" valign="middle"><a href="javascript: void(0)" 
onclick="window.open('Controladores/controlador_afiliacion_titular_PDF.php?id=<?php echo $result['id_titular']?>','popup','width=770, height=800');return false;" title="Ver Planilla de Afiliación"><img src="Imagen_sistema/imp.png" width="16" height="16" align="center" /></a></td>
            <td align="center" valign="middle"><a href="javascript: fn_mostrar_frm_modificar(<? echo $result['id_titular']?>);" title="Editar"><img src="Imagen_sistema/page_edit.png" width="16" height="16"  align="center" /></a></td>
            <td align="center" valign="middle"><a href="javascript: fn_eliminar(<?php echo $result['id_titular']?>);" title="Excluir Titular"><img src="Imagen_sistema/delete.png" width="16" height="16" align="center" /></a></td>
        </tr>
        
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9">
					<?php echo $paging->fetchNavegacion()?>	<br />					
					Mostrando <?php echo $paging->numRegistrosMostrados()?> registros, 
					de un total de <?php echo $paging->numTotalRegistros()?>
            </td>
        </tr>
    </tfoot>
</table>
