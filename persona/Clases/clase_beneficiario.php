<?php
include_once("clase_mysql.php");
//       Clase Entrada hereda a clase CModeloDatos para conectar BD MYSql
class beneficiario extends conectaBDMy{
	private $idTitular;	
	private $idBeneficiario;
	private $nac;	
	private $ced;
	private $nom1;
	private $nom2;
	private $ape1;
	private $ape2;
	private $sex;
	private $fec_nac;
	private $parentesco;
	private $esta_civ;
	private $discapacidad;
	private $cel;
	private $tlf;
	private $particiapacion;
//       Metodo Constructor de la clase
    public function beneficiario(){
		parent::conectaBDMy();	    
		$this->idTitular="";
		$this->idBeneficiario="";
		$this->nac="";
		$this->ced="";
		$this->nom1="";
		$this->nom2="";
		$this->ape1="";
		$this->ape2="";
		$this->sex="";
		$this->fec_nac="";
		$this->parentesco="";
		$this->esta_civ="";
		$this->discapacidad="";
		$this->cel="";
		$this->tlf="";
		$this->participacion="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidTitular($Valor){
        $this->idTitular = trim($Valor);
    }
	public function setidBeneficiario($Valor){
        $this->idBeneficiario = trim($Valor);
    }
    public function setNac($Valor){
        $this->nac = trim($Valor);
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
	public function setParentesco($Valor){
        $this->parentesco = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setEsta_civ($Valor){
        $this->esta_civ = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setDiscapacidad($Valor){
        $this->discapacidad = trim($Valor);
    }
	public function setCel($Valor){
        $this->cel = trim($Valor);
    }
	public function setTlf($Valor){
        $this->tlf = trim($Valor);
    }
	public function setParticipacion($Valor){
        $this->particiapacion = trim($Valor);
    }	
//       Metodo registrar
 public function iBeneficiario(){	  
	   $this->fec_nac = parent::fecha_bd($this->fec_nac);
       $sql="INSERT INTO tbeneficiario(id_beneficiario,id_titular,nacionalidad, cedula, nombre1, nombre2, apellido1, apellido2, sexo, fecha_nac, parentesco, estado_civ, celular, telefono, participacion, estatus)VALUES(
	   '$this->idBeneficiario', 
	   '$this->idTitular', 
	   '$this->nac', 
	   '$this->ced', 
	   '$this->nom1', 
	   '$this->nom2', 
	   '$this->ape1', 
	   '$this->ape2', 
	   '$this->sex', 
	   '$this->fec_nac', 
	   '$this->parentesco', 
	   '$this->esta_civ', 
	   '$this->cel', 
	   '$this->tlf',
	   '$this->particiapacion',
	    '1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Modificar
	function mBeneficiario() {
	   	$this->fec_nac  = parent::fecha_bd($this->fec_nac);
		//id_titular,		='$this-';
		$sql= "UPDATE tbeneficiario SET								
				nacionalidad	='$this->nac', 
				cedula			='$this->ced',
				nombre1			='$this->nom1', 
				nombre2 		='$this->nom2',
				apellido1		='$this->ape1',
				apellido2		='$this->ape2', 
				sexo			='$this->sex',
				fecha_nac 		='$this->fec_nac',
				parentesco	 	='$this->parentesco',
				estado_civ	 	='$this->esta_civ',
				celular 		='$this->cel',
				telefono		='$this->tlf',
				participacion 	='$this->particiapacion',
				estatus			='1'
				WHERE 
				id_beneficiario ='$this->idBeneficiario'";
		$respuesta = parent::ejecuta_sql($sql);
			if ($respuesta>0)
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();

	}
//       Metodo Eliminar
public function eBeneficiario(){
		$sql= "update tbeneficiario set estatus='0' where id_beneficiario='$this->idBeneficiario'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();
}
public function excluir_Beneficiario(){
		$sql= "select * from tbeneficiario  where id_beneficiario='$this->idBeneficiario'";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor)){
								
				$fila[$c][1]=$row["id_beneficiario"];
				$fila[$c][2]=$row["id_titular"];	
				$fila[$c][3]=$row["nacionalidad"];
		 		$fila[$c][4]=$row["cedula"];
				$fila[$c][5]=$row["nombre1"];
				$fila[$c][6]=$row["nombre2"];
				$fila[$c][7]=$row["apellido1"];
				$fila[$c][8]=$row["apellido2"];
				$fila[$c][9]=$row["sexo"];
				$fila[$c][10]=$row["fecha_nac"];
				$fila[$c][11]=$row["celular"];	
				$fila[$c][12]=$row["telefono"];
				$fila[$c][13]=$row["parentesco"];
				$fila[$c][14]=$row["participacion"];
				$fila[$c][15]=$row["estado_civ"];				
				$fila[$c][16]=$row["estatus"];
				$c++;							
				
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;//fallo la operacion
			
			parent::cerrar_bd();
     }
public function valida_beneficiario(){ 
		$sql="select * from tbeneficiario where cedula = '$this->ced' and id_titular='$this->idTitular'";
		$cursor=parent::ejecuta_sql( $sql );
		return ( parent::getNRegistro($cursor) );
		//Si encuentra registro envia 1 para validar	
		//si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();							 		
	} 
//       Metodo Buscar ultmimo
    public function buscaUltimoID(){
       $sql="SELECT * FROM tbeneficiario ORDER BY id_beneficiario DESC LIMIT 1";
		return ( $cursor= parent::ejecuta_sql($sql) );
    }
//       Metodo Para Buscar idBeneficiario
     public function buscar_id(){
		$c=0;
        $sql="select * from tbeneficiario where id_beneficiario = '$this->idBeneficiario' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor)){
								
				$fila[$c][1]=$row["id_beneficiario"];
				$fila[$c][2]=$row["id_titular"];
				$fila[$c][3]=$row["nacionalidad"];
		 		$fila[$c][4]=$row["cedula"];
				$fila[$c][5]=$row["nombre1"];
				$fila[$c][6]=$row["nombre2"];
				$fila[$c][7]=$row["apellido1"];
				$fila[$c][8]=$row["apellido2"];
				$fila[$c][9]=$row["sexo"];
				$fila[$c][10]=$row["fecha_nac"];
				$fila[$c][11]=$row["celular"];	
				$fila[$c][12]=$row["telefono"];
				$fila[$c][13]=$row["parentesco"];
				$fila[$c][14]=$row["participacion"];
				$fila[$c][15]=$row["estado_civ"];				
				$fila[$c][16]=$row["estatus"];
				$c++;			
				
		 }
		if ( $fila<0 )
			return 1;//fallo la operacion
		else
			return $fila;
			
			parent::cerrar_bd();
     }
	 function lista_motivo()
	{ 
		$c=0;
		$sql="select * from tmotivo where estatus='1' order by descripcion asc";		
		 $cursor=parent::ejecuta_sql($sql);
			if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_motivo"];
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
	  public function buscar_Beneficiario(){
		$c=0;
        $sql="select * from tbeneficiario where id_titular = '$this->idTitular' and estatus='1'";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor)){
				do{			
				$fila[$c][1]=$row["id_beneficiario"];
				$fila[$c][2]=$row["id_titular"];
				$fila[$c][3]=$row["nacionalidad"];
		 		$fila[$c][4]=$row["cedula"];
				$fila[$c][5]=$row["nombre1"];
				$fila[$c][6]=$row["nombre2"];
				$fila[$c][7]=$row["apellido1"];
				$fila[$c][8]=$row["apellido2"];
				$fila[$c][9]=$row["sexo"];
				$fila[$c][10]=$row["fecha_nac"];
				$fila[$c][11]=$row["celular"];	
				$fila[$c][12]=$row["telefono"];
				$fila[$c][13]=$row["parentesco"];
				$fila[$c][14]=$row["participacion"];
				$fila[$c][15]=$row["estado_civ"];				
				$fila[$c][16]=$row["estatus"];
				$c++;			
				}while($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila<0 )
			return 1;//fallo la operacion
		else
			return $fila;
			
			parent::cerrar_bd();
     }
	 
	 
	public function combo_beneficiario(){		
			$combo = array();
			$c=0;
			$sql="select * from tbeneficiario where id_titular='$this->idTitular' and estatus='1'";		   
			$cursor = parent::ejecuta_sql($sql);
			$combo[$c] .= '<option value="0" selected="selected">Seleccionar</option>';
			$combo[$c] .= '<option value="-1">Mismo titular</option>';

			while($fila=parent::proxima_tupla($cursor)) 
			{
				$combo[$c] .='<option value="'.$fila['id_beneficiario'].'">'.$fila['parentesco'].' - '.$fila['apellido1'].' '.$fila['apellido2'].', '.$fila['nombre1'].' '.$fila['nombre2'].' '.$fila['nacionalidad'].'-'.$fila['cedula'].'</option>';	
				$c++;
			}
			return $combo;
		
	}
	public function combo_error(){		
			$combo = array();
			$c=0;			
			$combo[$c] .='<option value="0" selected="selected" disabled="disabled">Seleccionar</option>';	
			$combo[$c] .='<option value="-1">Mismo titular</option>';
			return $combo;		
	}

//       Metodo Para Buscar Cedula
     public function validar_combo(){
		 $c=0;
        $sql="select * from tbeneficiario where id_titular = '$this->idTitular' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if(parent::getNRegistro($cursor)>0)
		return 1;
		else
		return -1; //si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();	
     }		 
//       Sentencia sql para listar
     public function listar_beneficiario(){
        $sql="select id_beneficiario, id_titular,nacionalidad, cedula, nombre1, nombre2, apellido1, apellido2, sexo, parentesco, participacion from tbeneficiario where estatus=1 and id_titular='$this->idTitular'";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		$resulta=parent::getNRegistro($cursor); 		
		if($resulta<0)
			return 1;//fallo la operacion
			else 
			return $sql;		
			
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
	   parent::cerrar_bd(); //fin de transaccion cerrrando la bd
    }
//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}//cierra la clase

//       Metodo Constructor de la clase
?>
