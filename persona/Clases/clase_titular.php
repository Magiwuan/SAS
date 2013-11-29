<?php
include_once("clase_mysql.php");
//       Clase Entrada hereda a clase CModeloDatos para conectar BD MYSql
class titular extends conectaBDMy{
	private $idTitular;	
	private $tipoNomina;
	private $nac;	
	private $ced;
	private $nom1;
	private $nom2;
	private $ape1;
	private $ape2;
	private $sex;
	private $fec_nac;
	private $esta_civ;
	private $discapacidad;
	private $grupo;
	private $cel;
	private $tlf;
	private $idCiudad;
	private $idCiudadnac;
	private $email;
	private $correo;
	private $direccion;		
	private $fec_ingr;
	private $idProfesion;
	private $idCargo;
	private $idDepartamento;
	private $idUpsa;
	private $observ;
	private $ordenar_por;
//       Metodo Constructor de la clase
    public function titular(){
		parent::conectaBDMy();	    
		$this->idTitular="";
		$this->tipoNomina="";
		$this->nac="";
		$this->ced="";
		$this->nom1="";
		$this->nom2="";
		$this->ape1="";
		$this->ape2="";
		$this->sex="";
		$this->fec_nac="";
		$this->esta_civ="";
		$this->discapacidad="";
		$this->grupo="";
		$this->cel="";
		$this->tlf="";
		$this->idCiudad="";
		$this->idCiudadnac="";
		$this->email="";	
		$this->correo="";
		$this->direccion="";	
		$this->fec_ingr="";
		$this->idProfesion="";
		$this->idCargo="";
		$this->idDepartamento="";
		$this->idUpsa="";
		$this->observ="";
		$this->ordenar_por="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidTitular($Valor){
        $this->idTitular = trim($Valor);
    }
    public function setNac($Valor){
        $this->nac = mb_strtoupper(trim($Valor), "utf-8");
    }
	 public function setTipo($Valor){
        $this->tipoNomina = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setCed($Valor){
        $this->ced = trim($Valor);
    }
	public function setNom1($Valor){
        $this->nom1 = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setNom2($Valor){
        $this->nom2 = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setApe1($Valor){
        $this->ape1 = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setApe2($Valor){
        $this->ape2 = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setSex($Valor){
        $this->sex = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setFec_nac($Valor){
        $this->fec_nac = trim($Valor);
    }
	public function setEsta_civ($Valor){
        $this->esta_civ = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setDiscapacidad($Valor){
        $this->discapacidad = trim($Valor);
    }
	public function setGrupo($Valor){
        $this->grupo = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setCel($Valor){
        $this->cel = trim($Valor);
    }
	public function setTlf($Valor){
        $this->tlf = trim($Valor);
    }
	public function setidCiudad($Valor){
        $this->idCiudad = trim($Valor);
    }
	public function setidCiudadnac($Valor){
        $this->idCiudadnac = trim($Valor);
    }
	public function setEmail($Valor){
        $this->email = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setCorreo($Valor){
        $this->correo = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setDireccion($Valor){
        $this->direccion = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setFec_ingr($Valor){
        $this->fec_ingr = trim($Valor);
    }
	public function setidProfesion($Valor){
        $this->idProfesion = trim($Valor);
    }
	public function setidCargo($Valor){
        $this->idCargo = trim($Valor);
    }
	public function setDepartamento($Valor){
        $this->idDepartamento = trim($Valor);
    }
	public function setUpsa($Valor){
        $this->idUpsa = trim($Valor);
    }
	public function setObserv($Valor){
        $this->observ = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setOrden($Valor){
        $this->ordenar_por = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Metodo registrar
 public function iTitular(){
	   $this->fec_ingr = parent::fecha_bd($this->fec_ingr);
	   //$this->fec_nac  = parent::fecha_bd($this->fec_nac);
       $sql="INSERT INTO ttitular(id_titular,tipo_nomina, nacionalidad, cedula, nombre1, nombre2, apellido1, apellido2, sexo, fecha_nac, estado_civ, celular, telefono, correo_elect, correo_corp, fecha_ingr, id_profesion, id_cargo, id_ciudad, id_ciudad_nacimiento, id_departamento, direccion_hab, id_upsa, grupo, observacion, estatus)VALUES(
	   '$this->idTitular',
	   '$this->tipoNomina', 
	   '$this->nac', 
	   '$this->ced', 
	   '$this->nom1', 
	   '$this->nom2', 
	   '$this->ape1', 
	   '$this->ape2', 
	   '$this->sex', 
	   '$this->fec_nac', 
	   '$this->esta_civ', 
	   '$this->cel', 
	   '$this->tlf',
	   '$this->email',
	   '$this->correo',
	   '$this->fec_ingr', 
	   '$this->idProfesion',
	   '$this->idCargo', 
	   '$this->idCiudad',
	   '$this->idCiudadnac',
	   '$this->idDepartamento', 
	   '$this->direccion', 
	   '$this->idUpsa',
	   '$this->grupo', 
	   '$this->observ', 
	   '1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }

//       Metodo Modificar
	function mTitular() {
		$this->fec_ingr = parent::fecha_bd($this->fec_ingr);
	   	$this->fec_nac  = parent::fecha_bd($this->fec_nac);
		$sql= "UPDATE ttitular SET 
				tipo_nomina='$this->tipoNomina',
				nacionalidad='$this->nac',
				cedula 		='$this->ced',
				nombre1 	='$this->nom1',
				nombre2 	='$this->nom2',
				apellido1 	='$this->ape1',
				apellido2 	='$this->ape2',
				sexo 		='$this->sex',
				fecha_nac 	='$this->fec_nac',
				estado_civ 	='$this->esta_civ',
				celular 	='$this->cel',
				telefono 	='$this->tlf',
				correo_elect='$this->email',
				correo_corp='$this->correo',
				fecha_ingr 	='$this->fec_ingr',
				id_cargo	='$this->idCargo',
				id_ciudad 	='$this->idCiudad',
				id_ciudad_nacimiento 	='$this->idCiudadnac',
				id_departamento ='$this->idDepartamento',
				direccion_hab ='$this->direccion',
				id_upsa		='$this->idUpsa',
				grupo		='$this->grupo',
				observacion		='$this->observ',
				estatus 	='1' 
			   WHERE 
			   	id_titular =  '$this->idTitular'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();

	}
//       Metodo Eliminar
public function eTitular(){
		$sql= "update ttitular set estatus='0' where id_titular='$this->idTitular'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();
}
//       Metodo Buscar ultmimo
    public function buscaUltimoID(){
       $sql="SELECT * FROM ttitular ORDER BY id_titular DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }

//       Metodo Para Buscar idTitular
     public function buscar_id(){
		$c=0;
        $sql="select a.*, b.nombre as profesion from ttitular as a, tprofesion as b  where a.id_titular = '$this->idTitular' and a.id_profesion=b.id_profesion";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor)){
								
				$fila[$c][1]=$row["id_titular"];
				$fila[$c][2]=$row["nacionalidad"];
		 		$fila[$c][3]=$row["cedula"];
				$fila[$c][4]=$row["nombre1"];
				$fila[$c][5]=$row["nombre2"];
				$fila[$c][6]=$row["apellido1"];
				$fila[$c][7]=$row["apellido2"];
				$fila[$c][8]=$row["sexo"];
				$fila[$c][9]=$row["fecha_nac"];
				$fila[$c][10]=$row["estado_civ"];
				$fila[$c][11]=$row["celular"];	
				$fila[$c][12]=$row["telefono"];
				$fila[$c][13]=$row["correo_elect"];
				$fila[$c][14]=$row["fecha_ingr"];
				$fila[$c][15]=$row["direccion_hab"];	
				$fila[$c][16]=$row["id_cargo"];
				$fila[$c][17]=$row["id_ciudad"];
				$fila[$c][18]=$row["id_departamento"];
				$fila[$c][19]=$row["id_upsa"];
				$fila[$c][20]=$row["estatus"];
				$fila[$c][21]=$row["tipo_nomina"];
				$fila[$c][22]=$row["id_ciudad_nacimiento"];
				$fila[$c][23]=$row["correo_corp"];
				$fila[$c][24]=$row["observacion"];
				$fila[$c][25]=$row["grupo"];
				$fila[$c][26]=$row["profesion"];
				
				$c++;			
				
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
	  function edad() {
		 $fechaInicial=$this->fec_nac;
		 $patron = "/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/";
		 $fechaComparacion= date("Y-m-d");
    if(preg_match($patron, $fechaInicial, $partesI) &&
       preg_match($patron, $fechaComparacion, $partesC)){
 
        // Validamos que las fechas suministradas sean válidas
        if(!checkdate(intval($partesI[2]), intval($partesI[3]), $partesI[1]) ||
           !checkdate(intval($partesC[2]), intval($partesC[3]), $partesC[1]))
            return false;
 
        // Validamos que $fechaInicial sea menor a $fechaComparacion
        if(mktime(0, 0, 1, intval($partesI[2]), intval($partesI[3]), $partesI[1]) >
           mktime(0, 0, 1, intval($partesC[2]), intval($partesC[3]), $partesC[1]))
            return false;
 
        // Calculamos las diferencias entre las fechas 
        $annos = $partesC[1] - $partesI[1];
        $meses = $partesC[2] - $partesI[2];
        $dias = $partesC[3] - $partesI[3];
 
        // Corregimos dependiendo de los valores obtenidos
        if($meses < 0){
            $annos--;
        }
        elseif(($meses == 0) && ($dias < 0)){
            $annos--;
        }
 
        // Devolvemos la cantidad de años
        return $annos;
    } else {
        return false;
    } 
	}
	 //busca el trabajador para listarlo
	 public function bTitular(){
		 $c=0;
		 if($this->nom1!=NULL){
        	$sql="SELECT * FROM ttitular WHERE nombre1 like '$this->nom1%' and estatus='1' order by cedula DESC";
		 }
		 if($this->ape1!=NULL){
			$sql="SELECT * FROM ttitular WHERE apellido1 like '$this->ape1%' and estatus='1' order by cedula DESC";
		 }
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 DO{
				$fila[$c][1]=$row["id_titular"];	
				$fila[$c][2]=$row["nacionalidad"];	
				$fila[$c][3]=$row["cedula"];		
				$fila[$c][4]=$row["nombre1"];		
				$fila[$c][5]=$row["nombre2"];	
				$fila[$c][6]=$row["apellido1"];		
				$fila[$c][7]=$row["apellido2"];							
					
				$c++;
				}while($row= parent::proxima_tupla($cursor));
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			parent::cerrar_bd();
     }  
//       Metodo Para Buscar Cedula
     public function validar_titular(){ 
		 $sql="select * from ttitular where cedula = '$this->ced' ";
		$cursor=parent::ejecuta_sql( $sql );
		if(parent::getNRegistro($cursor)>0)
		return $cursor;
		else
		return -1; //si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();	
						 		
	}  
	 
	   public function verificar_titular(){ 
		$sql="select * from ttitular where cedula = '$this->ced' and nacionalidad='$this->nac'";
		$a=parent::ejecuta_sql( $sql );
		if(parent::getNRegistro($a)>0){
		return 1;
		}else{
			$sql="select * from tbeneficiario where cedula = '$this->ced' and nacionalidad='$this->nac'";
			$b=parent::ejecuta_sql( $sql );
			if(parent::getNRegistro($b)>0)
			return 2;
			else
			return -1; //si no encuentra registro procede a registrar	
		}
		
		parent::cerrar_bd();	
						 		
	} 
	 
	  public function verificar(){
		if($this->ced!=NULL){ 
        	$sql="select * from ttitular where cedula like '$this->ced%' ";
			return ($cursor= parent::ejecuta_sql($sql));
		}
		
     }	
	public function CajaNombre(){		
		if($this->ced!=NULL){
			$caja = array();
			$c=0;
			$sql="select nombre1,nombre2,apellido1,apellido2 from ttitular where cedula='$this->ced'";			
			$cursor = parent::ejecuta_sql($sql);
			if($fila=parent::proxima_tupla($cursor)) 
			{
				$caja[$c] .='<input size="45" name="box" id="box" type="text" value="'.$fila['apellido1'].' '.$fila['apellido2'].', '.$fila['nombre1'].' '.$fila['nombre2'].'" readonly="readonly" />';	
				$c++;
			}else{
				$caja[$c] .='<input size="45" name="box" id="box" type="text" value="No existen registros relacionados" readonly="readonly" />';	
				$c++;
			}
				return $caja;
		}
	}	
 
//       Sentencia sql para listar
     public function sql(){
        $sql="select id_titular,nacionalidad,cedula,nombre1,nombre2,apellido1,apellido2,telefono,celular from ttitular where estatus=1";
		if ($this->ced!=NULL)
		$sql .= " and cedula like '$this->ced%'";	
		if($this->ordenar_por=='0')						
		$sql .= " order by 1 desc";				
		if ($this->ordenar_por=='1')
			$sql .= " order by 6 asc";		
		if ($this->ordenar_por=='2')
			$sql .= " order by 3 desc";	
		if ($this->ordenar_por=='3')
			$sql .= " order by 6,3 desc";			
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		if(parent::getNRegistro($cursor)>0)
			return $sql;
			else 
			return -1;		
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
