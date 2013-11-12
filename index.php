<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Acceso:.</title> 	 
		<link href="persona/Css/estilo2.css" rel="stylesheet" type="text/css" />   
        <link href="persona/Css/estilo.css" rel="stylesheet" type="text/css" />
    <link href="persona/JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	 
   <script language="javascript" type="text/javascript" src="persona/JavaScript/jquery-1.4.2.min.js"></script>     
   <script language="javascript" type="text/javascript" src="persona/JavaScript/jquery.alerts.js"></script> 
   <script language="JavaScript" type="text/javascript">
	function Enviar() {
		if(document.registro.login.value == '') {//8
			jAlert('El campo \"Usuario\" no puede estar vacio!');
			document.registro.login.focus();
			return false;	
		}
		if(document.forms.registro.clave.value == '') { //1
			jAlert('El campo \"Clave\" no puede estar vacio!');
			document.registro.clave.focus();
			return false;
		}	
		return true;
	}
</script>
</head>
<body>
<div id="cuerpo_acceso">
    <table width="600" height="408" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td height="120" style=" overflow: hidden;-webkit-border-radius: 3px 3px 0px 0px;-moz-border-radius: 3px 3px 0px 0px;"><img src="Imagenes/banner.jpg" width="601" height="120"></td>
    </tr>
      <tr>
        <td><table width="216"  border="0"  cellpadding="3" cellspacing="0" align="center">
          <form action="persona/Controladores/control_acceso.php" method="post" name="registro" id="registro" onSubmit="if(!Enviar()) {return false;};">
            <tr valign="middle" align="left">
              <td width="50" align="right" style="font-family: 'Lucida Sans Unicode';font-weight:bold;font-size:11px;color: #06C;">Usuario:</td>
              <td height="25" colspan="2" align="center"><input name="login" align="center"type="text" /></td>
            </tr>
            <tr valign="middle" align="left">
              <td width="50" align="right" style="font-family: 'Lucida Sans Unicode';font-weight:bold;font-size:11px;color: #06C;">Clave :</td>
              <td  colspan="2" align="center"><input name="clave" align="middle" type="password" /></td>
            </tr>
            <tr valign="middle" align="left">
              <td width="50" align="right">&nbsp;</td>
              <td width="115" align="center"><input name="boton1" class="btn btn-primary" value=" Entrar " type="submit" id="boton1"/>
                <input name="operacion" type="hidden" value="1" /></td>
              <td width="33" align="center">&nbsp;</td>
            </tr>
          </form>
        </table></td>
      </tr>
      <tr>
      <td height="60" align="center" valign="middle">&nbsp;</td>
      </tr>
       </tr>
      <tr>
      <td align="center" valign="bottom"><p style="font-family: 'Lucida Sans Unicode'; font-size:11px;color: #E17919;">Desarrollado por: Estudiantes de la Universidad Politecnica Territorial Portuguesa J.J Montilla.<br /> Yelix Monsalve. | Andrés Alvarado. Todos los derechos reservados.</p></td>
      </tr>
    </table>
</div>
</body>
</html>