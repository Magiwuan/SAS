<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Acceso:.</title>
  	 
    <link href="persona/JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	 
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <script language="javascript" type="text/javascript" src="persona/JavaScript/jquery-1.4.2.min.js"></script>     
   <script language="javascript" type="text/javascript" src="persona/JavaScript/jquery.alerts.js"></script> 
   <script language="JavaScript" type="text/javascript" src="persona/JavaScript/jquery.asmselect.js"></script>	
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
<style>
#capa3{
	position: relative;	
	width: 305px;
	height: 150px;
	margin: auto;
	margin-top:40px;
	background: #fff;
	}
	.fiefieldset{
		border-radius: 5px;
	}
</style>
</head>
<body>
<div id="capa3">

    <table width="209" height="110" cellpadding="4" cellspacing="1" align="center">
      <form action="persona/Controladores/control_acceso.php" method="post" name="registro" id="registro" onsubmit="if(!Enviar()) {return false;};">
        <tr valign="middle" align="left">
          <td width="64" align="right" height="25">Usuario:</td>
          <td width="111" height="25" align="center"><input name="login" align="center"type="text" /></td>
          <td width="111" align="center">&nbsp;</td>
        </tr>
        <tr valign="middle" align="left">
          <td width="64" align="right" height="25">Clave :</td>
          <td height="25" align="center"><input name="clave" align="middle" type="password" /></td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr valign="middle" align="left">
          <td width="64" align="right" height="25">&nbsp;</td>
          <td style="vertical-align: middle;" align="left" height="25"><input name="boton1" class="btn-primary " value=" Entrar " type="submit" id="boton1"/>
            <input name="operacion" type="hidden" value="1" /></td>
          <td style="vertical-align: middle;" align="left">&nbsp;</td>
        </tr>
      </form>
    </table>
    </div>
</body>
</html>