<?php session_start(); //Funcion que permite trabajar con sesiones
if(empty($_SESSION["login"])) 
{
	header("Location: usuario/denied.php");
}

	include_once("../Clases/PHPPaging.lib.php");
	include_once("../Clases/clase_titular.php");
	$titular = new titular();
	$paging = new PHPPaging;
	$titular->setCed($_GET["buscar"]);
	$titular->setOrden($_GET["ordenar_por"]);
	$consulta=$titular->sql();
	$paging->agregarConsulta($consulta); 	
	$paging->porPagina($_GET["paginas"]);
	$paging->div('div_listar');
	$paging->verPost(true);
	$paging->ejecutar();	
?>
<table id="grilla" class="lista" width="624">
  <thead>
        <tr> 
        <th width="290"></th>
        <th width="108"></th>
        <th width="110"></th>
        <th width="27"></th>
        <th width="20"></th>
        <th width="20"></th>
        <th width="22"></th>
        <th width="0"></th>
        </tr>       
        <tr>
            <th>Apellido(s) y Nombre(s)</th>
            <th>Cedula</th>
            <th>Teléfono</th>
            <th>&nbsp;</th>
            <th></th>
            <th></th>
            <th><a href="javascript: fn_mostrar_frm_agregar();" title="Agregar Titular"><img src="Imagen_sistema/add.png" width="17" height="17" align="center" ></a></th>
        </tr>
    </thead>
    <tbody>
    <?php while ($result = $paging->fetchResultado()){?>
        <tr>        
            <td><?php echo $result['apellido1']; ?> <?php echo $result['apellido2']; ?>, <?php echo $result['nombre1']; ?> <?php echo $result['nombre2']; ?></td>
            <td> <?php echo  $result['nacionalidad'].'-'.$result['cedula']?></td>
            <td><?php 	echo $result['telefono']?></td>
            <td align="center" ><a href="javascript: fn_mostrar_agregar_grupo(<?php echo $result['id_titular'] ?>,'<?php echo $result['nombre1'] ?>','<?php echo $result['apellido1'] ?>');" title="Grupo Familiar"><img src="Imagen_sistema/grupo.png" width="22" height="22" align="center"/></a></td>
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
