<? session_start();
//--------------------------------------------------------------------
// Llamado a la clase a usarse
//--------------------------------------------------------------------
include_once("../Clases/clase_usuario.php");
//--------------------------------------------------------------------
// Recibe el valor de operacion para usarse en cada caso.
//--------------------------------------------------------------------
$operacion = $_POST['operacion'];
//Declaracion de variables que vienen del formulario
    $nombre 	= htmlspecialchars(trim($_POST['nombre']));
	$login 		= htmlspecialchars(trim($_POST['login']));
    $cedula 	= htmlspecialchars(trim($_POST['cedula']));
	$pregunta 	= htmlspecialchars(trim($_POST['pregunta']));
	$respuesta	= htmlspecialchars(trim($_POST['respuesta']));
	$correo     = htmlspecialchars(trim($_POST['correo']));
	$us = new usuario();
switch($operacion){
 case 1: 
//--------------------------------------------------------------------
// 	Caso 1:
// 	Acceso del us al sistema.
// 	Se encriptar la clave con la funcion sha1 y md5.
//	Se envian los datos por los metodos set.
//  Cantidad de tuplas encontradas.
//  Si encuentra tuplas,  Se crean variables de session.
// 	Variables de sesion para registrar la hora.
//	Se registra el tiempo.
// 	Se envia al index del sistema.
// 	Si no Se Envian mensajes de Error, de acuerdo a cada paso.
//--------------------------------------------------------------------		
		$clave = sha1(md5(trim($_POST['clave'])));
		$us->setLogin($login);
		$us->setClave($clave);							
	if ($registro = $us->buscaAcceso()) {
	
		$NTuplas = $us->getNTupla($registro);
		$Arreglo = $us->sig_tupla($registro);		
		if ($NTuplas==1) {	
			$_SESSION["login"]=$Arreglo['nombre_usuario'];	
				$_SESSION["nivel"]=$Arreglo['idrol'];	
				header("Location:../../menu.php");
			}
			else  
				echo 'error1';
		}
		else
			echo "error2";
//--------------------------------------------------------------------
//	Fin de Acceso.
//--------------------------------------------------------------------				
break;
case '2': 
//--------------------------------------------------------------------
//	Caso 2:
// 	Registra El usuario.
// 	Se encriptar la clave con la funcion sha1 y md5.
//	Se Envia el tipo de Usuario '0' para evitar Total Acceso.
//  Se envian los datos por los metodos set.
//	Se Verifica que no exista.
//  Se registra los datos.
//--------------------------------------------------------------------		
		$clave = sha1(md5(trim($_POST['clave1'])));
		$tipo = '0';
		
		$us->setcedula($cedula);
		$us->setLogin($login);
		$us->setEMail($correo);
		$us->setClave($clave);
		$us->setNombre($nombre);
		$us->setPregunta($pregunta);
		$us->setRespuesta($respuesta);		
		$us->setrol($tipo);
		
		$ValidaLogin=$us->validaNombre();	
		$ValidaCedula=$us->ValidaCedula();
		
	if($ValidaLogin>0 || $ValidaCedula>0)			
		header("Location: ../php/error.php?url=".$_POST["url"]."& codigo=10 & mensaje2=".$_POST["boton"]);		
	else
	{ 
		$registro =$us->Registra();
		if ( $registro<0 )				
		header("Location: ../php/exito.php?url=".$_POST["url"]."& mensaje=".$_POST["descripServ"]. "& mensaje2=".$_POST["boton"]);		
		else
		header("Location: ../php/error.php?url=".$_POST["url"]."& codigo=".$registro." & mensaje2=".$_POST["boton"]);
				
	}
//--------------------------------------------------------------------
// Fin de Registro.
//--------------------------------------------------------------------
break;
case '3':
//--------------------------------------------------------------------
//	Caso 3:
//	Recuperar Clave de usuario.
// 	Se recibe el Nombre de usuario.
//	Se Verifica que exista.
//	Se crean los Caso para Las preguntas.
//	Si las Respuestas han sido correcta se le pide ingresar
//	nueva clave y se modifica. 
//	Si se Modifica Correctamente Envia Mensaje de exito
//	Sino se Envia un mensajde de Error.
//--------------------------------------------------------------------
	$us->setLogin($login);
	$consulta=$us->buscaNombre();
	if ($consulta){
				
		$NTuplas = $us->getNTupla($consulta);
		$Arreglo = $us->sig_tupla($consulta);	
			
		if ($NTuplas==1) {
			
			$_SESSION["login"]=$Arreglo['nombre_usuario'];
			$_SESSION["pregunta"]=$Arreglo['pregunta'];
			
			switch($_POST['operacionR']) {
			case '1':										
				header("Location:../php/usuario/recuperar_clave.php");			
			break;	
			case '2':	
				if($respuestauno==$Arreglo['respuesta'])	{	
					
				$clave = sha1(md5(trim($_POST['campo1'])));	
				$us->setClave($clave);
				
				$registro=$us->Modificapw();
				
					if($registro<0)
						header("Location: ../php/exito.php?url=".$_POST["url"]."& mensaje=".$_POST["descripServ"]. "& mensaje2=".$_POST["boton"]);	
					else
						header("Location: ../php/error.php?url=".$_POST["url"]."& codigo=11 & mensaje2=".$_POST["boton"]);
							}
				else
				// Error respuesta 
				header("Location: ../php/error.php?url=".$_POST["url"]."& codigo=20 & mensaje2=".$_POST["boton"]);
			break;
			}
		}
		else
		//Error tupla
			header("Location: ../php/error.php?url=".$_POST["url"]."& codigo=19 & mensaje2=".$_POST["boton"]);			
	}
	else
	//Error Nombre
	header("Location: ../php/error.php?url=".$_POST["url"]."& codigo=19 & mensaje2=".$_POST["boton"]);
//--------------------------------------------------------------------
// Fin de Modificar Clave.
//--------------------------------------------------------------------	
break;
case '4':
//--------------------------------------------------------------------
//	Caso 4:
//	Valida us que no exista
//  Se busca ese nombre
//	Si Esta Registrado No Permitir
// 	Sino puede usarlo.
//--------------------------------------------------------------------
	$us->setLogin($login);		
	$consulta= $us->validaNombre();{
		
	if ($consulta>0)
		header("Location:../php/usuario/registrar_usuario.php?ced=".$_POST['cedula']."&& Permite=No");
	else 
		header("Location:../php/usuario/registrar_usuario.php?ced=".$_POST['cedula']."&& log=".$login."&& Permite=Si");
		}	
//--------------------------------------------------------------------
// Fin de Validar Usuario
//--------------------------------------------------------------------	
break;
case '5':
	$trabajador->setcedula( $_POST['cedula'] );			
	$consulta=$trabajador->trabajador_busqueda();
	
	if($consulta>0)
	header("Location: ../php/usuario/registrar_usuario.php? ced=".$_POST['cedula']."&& op=".$operacion."&& validar=positivo");
	else
	  header("Location:../php/usuario/registrar_usuario.php?validar=negativo");
break;
//--------------------------------------------------------------------
//------------------ Fin del Controlador Acceso ----------------------
//--------------------------------------------------------------------
}
?>