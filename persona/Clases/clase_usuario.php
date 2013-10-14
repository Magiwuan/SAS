<?php
include_once("clase_mysql.php");  // Llamado de la clase que conecta la BD
//--------------------------------------------------------------------
//       Clase Usuario hereda a clase CModeloDatos para conectar BD MYSql
//--------------------------------------------------------------------
class usuario extends conectaBDMy // clase conectada a la BD
{
	 private $nombre; // variable privada para el nombre  y apellido del usuario
	 private $cedula; // variable privada para la cedula del usuario, esta hace relación con la cedula de la tabla trabajador
     private $login; // variable privada para el nombre del usuario
     private $Clave; // variable privada para la contraseña del usurio
	 private $pregunta; // variable privada para la pregunta secreta del usuario
	 private $respuesta; // variable privada para la respuesta secreta del usuario
     private $email; // variable privada para el correo del usuario
	 private $fecha; // variable privada para la fecha del ultimo logeo
     private $hora; // variable privada para la hora del ultimo logeo
	 private $rol; // variable privada para el tipo del rol asociado al usuario
	 private $descripcion; // variable privada para la descripcion del rol

	 

//--------------------------------------------------------------------
//       Metodo Constructor de la clase
//--------------------------------------------------------------------
     public function usuario(){
		parent::conectaBDMy(); // llamado de la función  conectaBDMy de la clase mysql
       $this->nombre=" ";
	   $this->cedula=" ";
       $this->login=" ";
       $this->Clave=" ";
	   $this->pregunta=" ";
	   $this->respuesta=" ";
       $this->email=" ";
	   $this->fecha=" ";
       $this->hora=" ";
	   $this->rol=" ";
	   $this->descripcion=" ";

     }
//--------------------------------------------------------------------
//       Metodos Set para cada propiedad de la clase
//--------------------------------------------------------------------
 public function setNombre($Valor){
       $this->nombre = $Valor;
     }
	 public function setcedula($Valor){
       $this->cedula = $Valor;
     }
     public function setLogin($Valor){
       $this->login = $Valor;
     }
     public function setClave($Valor){
       $this->Clave = $Valor;
     }
	  public function setPregunta($Valor){
       $this->pregunta= $Valor;
     }
	  public function setRespuesta($Valor){
       $this->respuesta = $Valor;
     }
     public function setEmail($Valor){
       $this->email = $Valor;
     }
   	  public function setFecha($Valor){
       $this->fecha = $Valor;
     }
	  public function setHora($Valor){
       $this->hora = $Valor;
     }
	  public function setrol($Valor){
       $this->rol = $Valor;
     }
//--------------------------------------------------------------------
//       Metodo incluir usuario
//-------------------------------------------------------------------- 
     public function Registra(){
	   $sql="insert into usuario (cedula,nombre_usuario,clave_usuario,pregunta,respuesta,idrol,estatus) values ('$this->cedula','$this->login','$this->Clave','$this->pregunta','$this->respuesta','$this->rol','1')"; // Sentencia de inclusión de datos
	 $cursor = parent::ejecuta_sql( $sql ); // Proceso de enviar lo que traiga sql a la variable cursor
		parent::cerrar_bd(); // llama la función cerrar_bd de la clase mysql
		if ( $cursor>0 ) // Si la variable cursor es mayor a 0 Registra (-1), sino fallo (2) no registra
			return -1;// Exito
		else
			return 2;//fallo la operacion
     }

	
//--------------------------------------------------------------------
//       Metodo Buscar usuario para darle acceso
//--------------------------------------------------------------------
     public function buscaAcceso(){
		$sql="select * from usuario where nombre_usuario = '$this->login' and clave_usuario = '$this->Clave'";
	    return ( parent::ejecuta_sql($sql) );
     }
	public function busca_login() 
	{ 
		$c=0;
		 $sql="select * from tiempo where nombre_usuario ='$this->login'"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][1]=$row["nombre_usuario"];
				$c++;
		 }
			if ( $fila>0 ) // si la fila esta llena
			return $fila; // retorna la variable $fila
		else
			return -1; // fallo
			parent::cerrar_bd();
	}  
//--------------------------------------------------------------------
//       Metodo Buscar si el nombre de un usuario ya existe
//--------------------------------------------------------------------
     public function buscaNombre(){
		 $sql="select * from usuario where nombre_usuario ='$this->login'"; 
		 return ($cursor=parent::ejecuta_sql($sql));		 
		
     }
	  public function validaNombre(){
	   $c=0;
		 $sql="select * from usuario where nombre_usuario ='$this->login'"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][1]=$row["nombre_usuario"];
				$c++;
		 }
		
			if ( $fila>0 ) // si la fila esta llena
			return $fila; // retorna la variable $fila
		else
			return -1; // fallo
			parent::cerrar_bd();
     }
	 
	  public function ValidaCedula(){
	   $c=0;
		 $sql="select * from usuario where cedula ='$this->cedula'"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][2]=$row["cedula"];
				$c++;
		 }
		
			if ( $fila>0 ) // si la fila esta llena
			return $fila; // retorna la variable $fila
		else
			return -1; // fallo
			parent::cerrar_bd();
     }
public function buscaRol(){
	   $c=0;
		 $sql="select * from trol where descripcion='$this->rol'"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][1]=$row["descripcion"];
				$c++;
		 }
		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
public function busca_rol_usuario(){
	   $c=0;
		 $sql="select * from usuario where idrol='$this->rol'"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][1]=$row["idrol"];
				$c++;
		 }
		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
	
 public function Modificar_rol_usuario(){
		$sql="update usuario set idrol='$this->rol' where nombre_usuario='$this->login'";
		$cursor = parent::ejecuta_sql( $sql );
		parent::cerrar_bd();
		if ( $cursor>0 )
			return -1;// Exito
		else
			return 2;//fallo la operacion
     }
	 
	  public function Modificar_todos_usuarios(){
		$sql="update usuario set idrol=0 where idrol='$this->rol'";
		$cursor = parent::ejecuta_sql( $sql );
		parent::cerrar_bd();
		if ( $cursor>0 )
			return -1;// Exito
		else
			return 2;//fallo la operacion
     }
	 
	  public function eliminaRolyPermisos(){
		$sql=" delete from trol where idrol='$this->rol'";
		$cursor = parent::ejecuta_sql( $sql );
		parent::cerrar_bd();
		if ( $cursor>0 )
			return -1;// Exito
		else
			return 2;//fallo la operacion
     }
	  public function ListaUsuarios(){ //Lista Usuarios para los permisos.
	   $c=0;
		 $sql="select * from usuario where idrol='0'"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {	
			 	$fila[$c][1]=$row["nombre"];
				$fila[$c][2]=$row["nombre_usuario"];
				$c++;
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
	  public function Usuario_recibe(){ //Lista Usuarios para los permisos.
	   $c=0;
		 $sql="select * from usuario where nombre_usuario ='$this->login'"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 
			 	$fila[$c][1]=$row["cedula"];
				$c++;
			
		 }
		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
 public function ListaPermisos(){//Listar los permisos para asignarselos a los usuarios.
	   $c=0;
		 $sql="select * from trol where descripcion!='WebMaster'"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["idrol"];
				$fila[$c][2]=$row["descripcion"];
				$c++;
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
			return $fila;			
			parent::cerrar_bd();
     }
	 
 public function valida_tipo(){//Listar los permisos para asignarselos a los usuarios.
	   $c=0;
		 $sql="SELECT * FROM usuario where idrol=2"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {			
				$fila[$c][1]=$row["idrol"];
				$fila[$c][2]=$row["descripcion"];
				$c++;			
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
//--------------------------------------------------------------------
//       Modificar contraseña
//--------------------------------------------------------------------
     public function Modificapw(){
		$sql= "update usuario set clave_usuario='$this->Clave' where nombre_usuario='$this->login'";
			$cursor = parent::ejecuta_sql( $sql );
		parent::cerrar_bd();
		if ( $cursor>0 )
			return -1;// Exito
		else
			return 2;//fallo la operacion     }
}
//--------------------------------------------------------------------
//        Modificar pw
//--------------------------------------------------------------------
     public function Modificar_rol(){
		$sql= "update usuario set idrol='$this->rol' where nombre='$this->nombre'";
		$cursor = parent::ejecuta_sql( $sql );
		parent::cerrar_bd();
		if ( $cursor>0 )
			return -1;// Exito
		else
			return 2;//fallo la operacion
     }
//--------------------------------------------------------------------
//       Metodo que transforma el record set en una arreglo
//--------------------------------------------------------------------
     public function sig_tupla($resulta){
        return ( parent::proxima_tupla($resulta)  );
     }
//--------------------------------------------------------------------
//       Metodo indica la cantidad de tuplas leidas
//--------------------------------------------------------------------
     public function getNTupla($resultado){
        return ( parent::getNRegistro($resultado)  );
     }


}
?>
