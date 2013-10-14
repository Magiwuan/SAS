<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Acceso:.</title>
  	<link rel="stylesheet" type="text/css" href="persona/Css/estilo2.css" />       
   	<link rel="stylesheet" type="text/css" href="persona/Css/estilo.css" /> 
    <link href="persona/JavaScript/jquery.alerts.css" rel="stylesheet" type="text/css" />	 
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
	height: 325px;
	margin: auto;
	background: #fff;
	padding-top: 100px;
	}
	.fiefieldset{
		border-radius: 5px;
	}
</style>
</head>
<body>
<div id="capa3">
  <fieldset class="fiefieldset">
    <table width="209" height="110" cellpadding="4" cellspacing="1" align="center">
      <form action="persona/Controladores/control_acceso.php" method="post" name="registro" id="registro" onsubmit="if(!Enviar()) {return false;};">
        <tr valign="middle" align="left">
          <td style="font-size: 14px; vertical-align: middle; color: #500; font-family: Georgia, 'Times New Roman', Times, serif;" width="64" align="right" height="25">Usuario:</td>
          <td width="111" height="25" align="center"><input name="login" align="center" style="border: 1px solid; color:#006; width: 95px; font-family: tahoma; font-size: 11px;" type="text" /></td>
        </tr>
        <tr valign="middle" align="left">
          <td style="font-size: 14px; vertical-align: middle; color: #500; font-family: Georgia, 'Times New Roman', Times, serif;" width="64" align="right" height="25">Clave :</td>
          <td height="25" align="center"><input name="clave" align="middle" style="border: 1px solid; color:#006;; width: 95px; font-family: tahoma; font-size: 11px; " type="password" /></td>
        </tr>
        <tr valign="middle" align="left">
          <td width="64" align="right" height="25">&nbsp;</td>
          <td style="vertical-align: middle;" align="left" height="25"><input name="boton1" value=" Entrar " type="submit" id="boton1"/>
            <input name="operacion" type="hidden" value="1" /></td>
        </tr>
      </form>
    </table>
    </fieldset>
</div>
</body>
</html>