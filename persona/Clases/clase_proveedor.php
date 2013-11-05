<?php
include_once("clase_mysql.php");
//       Clase Entrada hereda a clase CModeloDatos para conectar BD MYSql
class proveedor extends conectaBDMy{
	private $idProveedor;	
	private $rif;	
	private $alias;	
	private $nomb;
	private $personaContacto;
	private $celular;
	private $telefono;
	private $fax;
	private $correo;
	private $idCiudad;
	private $direccion;
	private $fechaInicio;
	private $fechaFin;
	private $ordenar_por;

//       Metodo Constructor de la clase
    public function proveedor(){
		parent::conectaBDMy();	    
		$this->idProveedor="";
		$this->rif="";
		$this->alias="";
		$this->nomb="";
		$this->personaContacto="";
		$this->celular="";
		$this->telefono="";
		$this->fax="";
		$this->correo="";
		$this->idCiudad="";
		$this->direccion="";
		$this->fechaInicio="";
		$this->fechaFin="";
		$this->ordenar_por="";
	
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidProveedor($Valor){
        $this->idProveedor = trim($Valor);
    }
    public function setRif($Valor){
        $this->rif = trim($Valor);
    }
	  public function setAlias($Valor){
        $this->alias = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setNombre($Valor){
        $this->nomb = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setPersonaContacto($Valor){
        $this->personaContacto = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setCel($Valor){
        $this->celular = trim($Valor);
    }
	public function setTlf($Valor){
        $this->telefono = trim($Valor);
    }
	public function setFax($Valor){
        $this->fax = trim($Valor);
    }		
	public function setCorreo($Valor){
        $this->correo = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setidCiudad($Valor){
        $this->idCiudad = trim($Valor);
    }
	public function setDireccion($Valor){
        $this->direccion = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setFechaInicio($Valor){
        $this->fechaInicio = trim($Valor);
    }
	public function setFechaFin($Valor){
        $this->fechaFin = trim($Valor);
    }
	public function setOrden($Valor){
        $this->ordenar_por = trim($Valor);
    }
	
//       Metodo registrar
 public function iProveedor(){
	   $this->fechaInicio = parent::fecha_bd($this->fechaInicio);
	   $this->fechaFin  = parent::fecha_bd($this->fechaFin);
       $sql="INSERT INTO tproveedor(id_proveedor,rif,alias, nombre, persona_contacto, celular, telefono, fax, correo, id_ciudad, direccion, fecha_inicio, fecha_fin,estatus)VALUES(
	   '$this->idProveedor', 
	   '$this->rif', 
	   '$this->alias', 
	   '$this->nomb', 
	   '$this->personaContacto', 
	   '$this->celular', 
	   '$this->telefono', 
	   '$this->fax', 
	   '$this->correo', 
	   '$this->idCiudad', 
	   '$this->direccion', 
	   '$this->fechaInicio', 
	   '$this->fechaFin', 
	   '1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }

//       Metodo Modificar
	function mProveedor() {
	   $this->fechaInicio = parent::fecha_bd($this->fechaInicio);
	   $this->fechaFin  = parent::fecha_bd($this->fechaFin);
		$sql= "UPDATE tproveedor SET 
				rif					='$this->rif',
				alias				='$this->alias',
				nombre 				='$this->nomb',
				persona_contacto 	='$this->personaContacto',
				celular 			='$this->celular',
				telefono 			='$this->telefono',
				fax 				='$this->fax',
				correo 				='$this->correo',
				id_ciudad 			='$this->idCiudad',
				direccion 			='$this->direccion',
				fecha_inicio 		='$this->fechaInicio',
				fecha_fin 			='$this->fechaFin',
				estatus 			='1' 
			   WHERE 
			   	id_proveedor =  '$this->idProveedor'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();

	}
//       Metodo Eliminar
public function eProveedor(){
		$sql= "update tproveedor set estatus='0' where id_proveedor='$this->idProveedor'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();
}
public function valida_proveedor() { 
		$sql="select * from tproveedor where rif='$this->rif'"; 
		$cursor=parent::ejecuta_sql( $sql );
		return ( parent::getNRegistro($cursor) );
		//Si encuentra registro envia 1 para validar	
		//si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();							 		
	}   
//       Metodo Buscar ultmimo
    public function proveedor_UltimoID(){
       $sql="SELECT * FROM tproveedor ORDER BY id_proveedor DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }
//       Metodo Listar Proveedor
function lista_proveedor()
	{ 
		$c=0;
		$sql="select * from tproveedor where estatus='1' order by nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_proveedor"];
				$fila[$c][2]=$row["nombre"];			
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}  
//       Metodo Listar Proveedor
function lista_proveedor_medicinas()
	{ 
		$c=0;
		$sql="select a.id_proveedor,a.nombre, b.id_servicio
			from tproveedor as a, tdetalle_servicio as b
			where a.id_proveedor=b.id_proveedor and a.estatus='1' and b.id_servicio='1'
			order by a.nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_proveedor"];
				$fila[$c][2]=$row["nombre"];			
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}
//       Metodo Para verificar el Estado
     public function Verificar_combo(){
        $sql="SELECT a. * , b. * , c. * FROM tproveedor_medico AS a, tmedico AS b, tespecialidad AS c WHERE id_proveedor ='$this->idProveedor'
AND a.id_medico = b.id_medico AND b.id_especialidad = c.id_especialidad";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][3]=$row["id_proveedor"];		
				$c++;
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }   
//       Metodo Combo
    public function combo(){		
			$combo = array();
			$c=0;
			$sql="SELECT a. * ,b.id_medico, b.nombre, b.apellido, c.nombre AS especialidad
FROM tproveedor_medico AS a, tmedico AS b, tespecialidad AS c
WHERE id_proveedor ='$this->idProveedor'
AND a.id_medico = b.id_medico
AND b.id_especialidad = c.id_especialidad";		   
			$cursor = parent::ejecuta_sql($sql);
			$combo[$c] .= '<option value="0" disabled="disabled" selected="selected">Seleccionar</option>';
			while($fila=parent::proxima_tupla($cursor)) 
			{
				$combo[$c] .= '<option value="'.$fila['id_medico'].'">'.$fila['nombre'].' '.$fila['apellido'].'  -  '.$fila['especialidad'].'</option>';	
				$c++;
			}
			
			return $combo;		
			
			parent::cerrar_bd();
		
	}
	public function combo_error(){		
			$combo = array();
			$c=0;	
					
			$combo[$c] .= '<option value="-1" selected="selected" disabled="disabled">No hay Registros</option>';	
		
			return $combo;		
	}
//       Metodo Listar Proveedor
function lista_proveedor_ordenes()
	{ 
		$c=0;
		$sql="select a.id_proveedor,a.nombre, b.id_servicio
			from tproveedor as a, tdetalle_servicio as b
			where a.id_proveedor=b.id_proveedor and a.estatus='1' and b.id_servicio!='1'
			order by a.nombre limit 1";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_proveedor"];
				$fila[$c][2]=$row["nombre"];			
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}   
	//       Metodo Combo
    public function l_servicios_proveedor(){		
			$combo = array();
			$c=0;
			$sql="SELECT a.id_proveedor, a.nombre, b.id_servicio as id, c.nombre as servicio
				FROM tproveedor AS a, tdetalle_servicio AS b, tservicio_proveedor AS c
				WHERE b.id_servicio = c.id_servicio
				AND a.id_proveedor = b.id_proveedor
				AND a.estatus =  '1'
				AND b.id_servicio !=  '1'
				AND b.id_proveedor =  '$this->idProveedor'";
			$cursor = parent::ejecuta_sql($sql);
			$combo[$c] .= '<option value="0" disabled="disabled" selected="selected">Seleccionar</option>';
			while($fila=parent::proxima_tupla($cursor)) 
			{
				$combo[$c] .= '<option value="'.$fila['id'].'">'.$fila['servicio'].'</option>';	
				$c++;
			}
			return $combo;		
			
			parent::cerrar_bd();
		
	}

//       Metodo Para Buscar idProveedor
     public function buscar_id(){
		$c=0;
        $sql="select * from tproveedor where id_proveedor = '$this->idProveedor' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor)){
								
				$fila[$c][1]=$row["id_proveedor"];
				$fila[$c][2]=$row["rif"];
		 		$fila[$c][3]=$row["nombre"];
				$fila[$c][4]=$row["persona_contacto"];
				$fila[$c][5]=$row["celular"];
				$fila[$c][6]=$row["telefono"];
				$fila[$c][7]=$row["fax"];
				$fila[$c][8]=$row["correo"];
				$fila[$c][9]=$row["id_ciudad"];
				$fila[$c][10]=$row["direccion"];
				$fila[$c][11]=$row["fecha_inicio"];	
				$fila[$c][12]=$row["fecha_fin"];
			    $fila[$c][13]=$row["estatus"];
				$fila[$c][14]=$row["alias"];
				$c++;			
				
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
//	Metodo que Genera Text area con la Direccion Del Proveedor
	public function CajaDireccion(){		
		if($this->idProveedor!=NULL){
			$caja = array();
			$c=0;
			$sql="select direccion from tproveedor where id_proveedor='$this->idProveedor'";			
			$cursor = parent::ejecuta_sql($sql);
			while($fila=parent::proxima_tupla($cursor)) 
			{
				$caja[$c] .='<textarea cols="45" rows="2" name="direccion" readonly >'.$fila['direccion'].'</textarea>';	
				$c++;
			}				
				return $caja;
		}
	}
//       Metodo Para Buscar RIF
     public function validar_proveedor(){
		 $c=0;
        $sql="select * from tproveedor where rif = '$this->rif' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor)){				
		 		$fila[$c][2]=$row["rif"];				
				$c++;			
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }		 
//       Sentencia sql para Buscar el listar
     public function sql(){
        $sql="select a.id_proveedor, a.alias, a.nombre, a.rif, a.id_ciudad, b.id_ciudad, b.nombre as ciudad from tproveedor as a, tciudad as b where a.estatus='1' and a.id_ciudad=b.id_ciudad";
		if ($this->nomb!=NULL)
		$sql .= " and a.nombre like '$this->nomb%'";	
		if($this->ordenar_por=='0')						
		$sql .= " order by 3 asc";				
		if ($this->ordenar_por=='1')
			$sql .= " order by 3 asc";		
		if ($this->ordenar_por=='2')
			$sql .= " order by 2 desc";	
		if ($this->ordenar_por=='3')
			$sql .= " order by 2,3 desc";		
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		if(parent::getNRegistro($cursor)>0)
			return $sql;
			else 
			return -1;		
			
			parent::cerrar_bd();
     }		 
//       Metodo le indica al SMBD que inicie una transaccion
    public function IniciaTransaccion(){
	   $sql="BEGIN";
	   parent::ejecuta_sql($sql);
	  
    }
//       Metodo le indica al SMBD que deshaga una transaccion
    public function RompeTransaccion(){
	   $sql="ROLLBACK";
	   parent::ejecuta_sql($sql);
	  
    }
//       Metodo le indica al SMBD que finalizo bien una transaccion
    public function FinTransaccion(){
	   $sql="BEGIN";
	   parent::ejecuta_sql($sql);
	   parent::cerrar_bd();
    }
//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}//cierra la clase

//       Metodo Constructor de la clase
?>
