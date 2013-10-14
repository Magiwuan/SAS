<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script language="JavaScript" type="text/JavaScript">
	   $(document).ready(function(){

		$('#open').click(function(){
		$("#cap").load('popu_recaudos.php');	
        $('#popup').fadeIn('slow');
    });
    $('#close').click(function(){
        $('#popup').fadeOut('slow');	
    });
	});	
</script>
<body>
<?php 	include_once("../../Clases/clase_recaudo.php");
			$recaudo= new recaudos();			
			$recaudo->setTiporecaudo('Afiliación - Beneficiario');
			$consul=$recaudo->lista_recaudo();
			for($i=0;$i<count($consul);$i++)			
			{
				$idRecaudo = $consul[$i][1];	
				$Nombre		= $consul[$i][2];		
				$tipo		= $consul[$i][3];	
				if($tipo=='Afiliación - Beneficiario'){					
		?>
        <input type="checkbox" name="recaudos[]" id="checkbox" value="<?php echo $idRecaudo;?>" <?php if($t)?>>
        <?php echo $Nombre; ?>
        <?php		
		}else { echo "<div id='open' style='color:#F00'> Alerta: No se han asignado recaudos por Beneficiario. Por favor <a href='#'>click</a></div>";}			
		}?>
</body>
</html>