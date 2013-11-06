<?
include_once( "clase_mysql.php" );// Llamado de la clase que conecta la BD
//--------------------------------------------------------------------
//       Clase vistas hereda a clase conectaBDMy para conectar BD MYSql
//--------------------------------------------------------------------
class vistas extends conectaBDMy  // clase conectada a la BD
{
// Se crean las Variables en privadas
	private $idvista;   // variable privada para el código correlativo de la BD para las consultas 
	private $nombrevistas; // variable privada para el nombre del vistas
	private $url; // variable privada para la direccion donde se encuntra ubicado el vistas
	private $idmodulo;   // variable privada para el código correlativo de la BD para las consultas 
	private $login; // variable privada para capturar el usuario que esta logiando
	private $seccion; // variable privada para el nombre de la sección donde se encuentra los vistass
	private $vistas; // variable privada para el nombre de los vistass
	private $rol; // variable privada para el nombre del rol 
//Variables para la asiganar permisos
		private $incluir; 
		private $modificar; 
		private $consultar; 
		private $eliminar; 	
//--------------------------------------------------------------------
//       Metodo Constructor de la clase
//--------------------------------------------------------------------
	function vistas() {
		parent::conectaBDMy();
		$this->idvista="";
		$this->nombrevistas="";
		$this->url="";
		$this->idmodulo="";
		$this->login="";
		$this->seccion="";
		$this->vistas="";
		$this->rol="";			
		$this->incluir="";
		$this->modificar="";
		$this->consultar="";
		$this->eliminar="";
	}
//--------------------------------------------------------------------
//       Metodos Set para cada propiedad de la clase
//--------------------------------------------------------------------
	function setnombvistas($nombrevistas) {
		$this->nombrevistas = $nombrevistas;
	}
	function setcodigo($idvista){
		$this->idvista = $idvista;
	}
	function setvista($idvista){
		$this->vistas = $idvista;
	}
	function seturl($url){
		$this->url = $url;
	}
	function setidmodulo($idmodulo){
		$this->idmodulo = $idmodulo;
	}
	function setlogin($login){
		$this->login = $login;
	}
	function setseccion($seccion){
		$this->seccion = $seccion;
	}
	function setrol($rol){
		$this->rol = $rol;
	}
	function setincluir($rol){
		$this->incluir = $rol;
	}
	function setmodificar($rol){
		$this->modificar = $rol;
	}
	function seteliminar($rol){
		$this->eliminar = $rol;
	}
	function setconsultar($rol){
		$this->consultar = $rol;
	}
//--------------------------------------------------------------------
//       Metodo incluir el nombre del rol
//--------------------------------------------------------------------
	function incluir_nombre_rol() {
		$sql= "insert into trol(descripcion,estatus) values ('$this->rol','1')";  // Sentencia de inclusión de datos
		$cursor = parent::ejecuta_sql( $sql );  // Proceso de enviar lo que traiga sql a la variable cursor
		parent::cerrar_bd();  // llama la función cerrar_bd de la clase mysql
		if ( $cursor>0 ) // Si la variable cursor es mayor a 0 Registra (-1), sino fallo (2) no registra
			return -1;// Exito
		else
			return 2;//fallo la operacion
	}
//--------------------------------------------------------------------
//       Metodo incluir permisos
//--------------------------------------------------------------------
	function incluir_permisos() {
		$sql= "insert into tpermisos(idvista,idrol,incluir,consultar,modificar,eliminar) values ('$this->idvista','$this->rol','$this->incluir','$this->consultar','$this->modificar','$this->eliminar')"; 
		$cursor = parent::ejecuta_sql( $sql );
		parent::cerrar_bd();
		if ( $cursor>0 )
			return -1;// Exito
		else
			return 2;//fallo la operacion
	}
//--------------------------------------------------------------------
//       Metodo Buscar ultmimo
//--------------------------------------------------------------------
    public function buscaUltimoRol(){
       $sql="SELECT * FROM trol order by idrol DESC LIMIT 1";
	return ($cursor= parent::ejecuta_sql($sql));
    }
//--------------------------------------------------------------------
//       Metodo Que valida que el nombre del rol no se repita
//--------------------------------------------------------------------	
	public function validar_rol() 
	{ 
		$c=0;		
		 $sql="select * from trol where descripcion ='$this->rol'"; 
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
//--------------------------------------------------------------------
//	 listar los vistass para dar permisos
//--------------------------------------------------------------------    
	function lista()
	{ 
		$c=0;
			$sql="SELECT * FROM tvista where estatus=1 order by descripcion d";
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["idvista"];
				$fila[$c][2]=$row["descripcion"];
				$c++;	 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			parent::cerrar_bd();
	}
//--------------------------------------------------------------------
//       Metodo de modificar el estatus del vistas en 0
//--------------------------------------------------------------------
	function eliminarvistas() {
		$sql= "update tvista set estatusvistas='0' where idvista='$this->codigo'";
		$cursor = parent::ejecuta_sql( $sql );
		parent::cerrar_bd();
		if ( $cursor>0 )
			return -1;// Exito
		else
			return 2;//fallo la operacion
	}
//--------------------------------------------------------------------
//       Metodo Listar Modulo (Menu dinámico)
//--------------------------------------------------------------------
	function listamodulo()
	{ 
		$c=0;
			$sql="
				SELECT DISTINCT (tmodulo.idmodulo) as modulo,tmodulo.url, tmodulo.icono as ico, tmodulo.descripcion as descrip
				FROM usuario, tmodulo, tvista, tseccion, trol, tpermisos
				WHERE usuario.nombre_usuario = '$this->login'
				AND usuario.idrol = trol.idrol
				AND trol.idrol = tpermisos.idrol
				AND tpermisos.idvista = tvista.idvista
				AND tvista.idseccion = tseccion.idseccion
				AND tseccion.idmodulo = tmodulo.idmodulo";
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["modulo"];
				$fila[$c][2]=$row["ico"];
				$fila[$c][3]=$row["descrip"];
				$fila[$c][4]=$row["url"];
				$c++;		 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
	}  
//--------------------------------------------------------------------
//       Metodo Listar secciones (Menu dinámico)
//--------------------------------------------------------------------
	function listasecciones()
	{ 
		$c=0;
			$sql="
				SELECT  DISTINCT (tseccion.idseccion) as secc, tseccion.descripcion as descrip
				FROM usuario, tmodulo, tvista, tseccion, trol, tpermisos
				WHERE usuario.nombre_usuario = '$this->login'
				AND usuario.idrol = trol.idrol
				AND trol.idrol = tpermisos.idrol
				AND tpermisos.idvista = tvista.idvista
				AND tvista.idseccion = tseccion.idseccion
				AND tseccion.idmodulo = tmodulo.idmodulo
				AND tmodulo.idmodulo='$this->idmodulo'";	
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["secc"];
				$fila[$c][2]=$row["descrip"];
				$c++;
				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		 parent::cerrar_bd();
		if ( $fila>0 ) // si la fila esta llena 
			return $fila; // retorna la variable $fila
		else
			return -1; // Fallo
	}
//--------------------------------------------------------------------
//       Metodo Listar vistass (Menu dinámico)
//--------------------------------------------------------------------    
	function listavistas()
	{ 
		$c=0;
			$sql="
				SELECT  DISTINCT (tvista.idvista) as serv, tvista.descripcion as descrip, tvista.url as link, tvista.estatus
				FROM usuario, tmodulo, tvista, tseccion, trol, tpermisos
				WHERE  tvista.estatus='1' and usuario.nombre_usuario = '$this->login'
				AND usuario.idrol = trol.idrol
				AND trol.idrol = tpermisos.idrol
				AND tpermisos.idvista = tvista.idvista
				AND tvista.idseccion = tseccion.idseccion
				AND tseccion.idmodulo = tmodulo.idmodulo
				AND tseccion.idseccion='$this->seccion' order by descrip";
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["serv"];
				$fila[$c][2]=$row["descrip"];
				$fila[$c][3]=$row["link"];
				$c++;	 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			parent::cerrar_bd();
	}
	public function buscaRol(){
	   $c=0;
		 $sql="select * from trol where descripcion!='WebMaster' and descripcion!='nulo' order by descripcion asc"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 do{
				$fila[$c][1]=$row["idrol"];
				$fila[$c][2]=$row["descripcion"];
			
				
				$c++;
			 }while($row= parent::proxima_tupla($cursor));
		 }
		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
	
	
	
	public function LinkBeneficiario(){
	   $c=0;
		 $sql="SELECT * FROM tvista WHERE descripcion='$this->nombrevistas'"; 
		 $cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {			
				$fila[$c][1]=$row["url"];					
			
		 }
		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
	
	
	function buscarpermisos()
	{ 
		$c=0;
			$sql="select tpermisos .*,tvista.descripcion from tpermisos,tvista where idrol='$this->rol' and tpermisos.idvista=tvista.idvista";
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["descripcion"];
				$fila[$c][2]=$row["idrol"];
				$fila[$c][3]=$row["incluir"];
				$fila[$c][4]=$row["consultar"];
				$fila[$c][5]=$row["modificar"];
				$fila[$c][6]=$row["eliminar"];
				$c++;	 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			parent::cerrar_bd();
	}
//--------------------------------------------------------------------
//       Metodo de seleccionar el vistas de acuerdo a la permisologia tenga rol
//-------------------------------------------------------------------- 
	function botonera()
	{ 
		$c=0;
			$sql="SELECT  * FROM tpermisos WHERE idvista='$this->vistas' AND idrol='$this->rol'";
		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
				$fila[1]=$row["incluir"];
				$fila[2]=$row["consultar"];
				$fila[3]=$row["modificar"];
				$fila[4]=$row["eliminar"];
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			parent::cerrar_bd();
	}  
//--------------------------------------------------------------------
//       Metodo le indica al SMBD que inicie una transaccion
//--------------------------------------------------------------------
    public function IniciaTransaccion(){
	   $sql="BEGIN";
	   parent::ejecuta_sql($sql);
    }
//--------------------------------------------------------------------
//       Metodo le indica al SMBD que deshaga una transaccion
//--------------------------------------------------------------------
    public function RompeTransaccion(){
	   $sql="ROLLBACK";
	   parent::ejecuta_sql($sql);
    }
//--------------------------------------------------------------------
//       Metodo le indica al SMBD que finalizo bien una transaccion
//--------------------------------------------------------------------
    public function FinTransaccion(){
	   $sql="BEGIN";
	   parent::ejecuta_sql($sql);
	   parent::cerrar_bd();
    }        
//--------------------------------------------------------------------
//       Metodo Proxima tupla
//--------------------------------------------------------------------
	public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}
//  Fin de la clase vistas
?>
