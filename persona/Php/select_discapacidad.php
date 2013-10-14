<html>
<body>
 <div id="disc_capa"> 
<select name="discapacidad[]" multiple="multiple"  id="discapacidad" title="Seleccionar">
  <?php include_once("../Clases/clase_discapacidad.php");
			$discapacidad=new discapacidad();
			$lista_discapacidad=$discapacidad->lista_discapacidad();
			for($i=0;$i<count($lista_discapacidad);$i++)
			{			
			?>
  <option value="<?php echo $$lista_discapacidad[$i][1];?>" 
		  	<?php if($lista_discapacidad[$i][2]=='N/A')
				{
					echo "Selected=\"Selected\"";
				}
				?>> <?php echo $lista_discapacidad[$i][2];?></option>
  <?php }?>
</select>
</div>
</body>
</html>