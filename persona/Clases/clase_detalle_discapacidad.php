<?php
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class detalle_disc extends conectaBDMy{
	private $idDiscapacidad;	
	private $idTitular;
	private $idBeneficiario;
	private $id_beneficiario_disc;
//       Metodo Constructor de la clase
    public function detalle_disc(){
		parent::conectaBDMy();	    
		$this->idDiscapacidad="";		
		$this->idTitular="";	
		$this->idBeneficiario="";
		$this->id_titular_disc="";
		$this->id_beneficiario_disc="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
	public function setId_titular_disc($Valor){
        $this->id_titular_disc = trim($Valor);
    }
 	public function setidDiscapacidad($Valor){
        $this->idDiscapacidad = trim($Valor);
    }  
	public function setidTitular($Valor){
        $this->idTitular = trim($Valor);
    }
	
	public function setId_beneficiario_disc($Valor){
        $this->id_beneficiario_disc = trim($Valor);
    }
	public function setidBeneficiario($Valor){
        $this->idBeneficiario = trim($Valor);
    }
//       Metodo registrar
 public function iTitular_Discapacidad(){	  
       $sql="INSERT INTO ttitular_discapacidad(id_titular_discapacidad,id_titular,id_discapacidad,estatus) values('$this->id_titular_disc', '$this->idTitular', '$this->idDiscapacidad', '1')";
     $respuesta= parent::ejecuta_sql($sql);	
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 2;//Fallo Registro
    }
public function iBeneficiario_Discapacidad(){	  
       $sql="INSERT INTO tbeneficiario_discapacidad(id_beneficiario_discapacidad,id_beneficiario,id_discapacidad,estatus) values('$this->id_beneficiario_disc', '$this->idBeneficiario', '$this->idDiscapacidad', '1')";
     $respuesta= parent::ejecuta_sql($sql);
	
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 2;//Fallo Registro
		  
    }
//       Metodo Modificar
 public function eTitular_Discapacidad(){	  
       $sql="DELETE ttitular_discapacidad.* FROM ttitular_discapacidad where id_titular='$this->idTitular'";	  
     	$respuesta= parent::ejecuta_sql($sql);
		
		 if($respuesta>0)
			return -1;//Exito
	 	 else
	     	return 2;//Fallo Registro
			
		
    }
	
 public function eBeneficiario_Discapacidad(){	  
       $sql="DELETE tbeneficiario_discapacidad.* FROM tbeneficiario_discapacidad where id_beneficiario='$this->idBeneficiario'";	  
     	$respuesta= parent::ejecuta_sql($sql);
		
		 if($respuesta>0)
			return -1;//Exito
	 	 else
	     	return 2;//Fallo Registro
			
    }
//       Metodo para buscar las discapacidades por titular
	function buscar_discapacidades()
	{ 
		$c=0;
		$sql="select * from ttitular_discapacidad where id_titular='$this->idTitular' and estatus='1'";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["	id_titular_discapacidad"];
				$fila[$c][2]=$row["id_titular"];	
				$fila[$c][3]=$row["id_discapacidad"];						
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}
	
	function buscar_discapacidades_beneficiario()
	{ 
		$c=0;
		$sql="select * from tbeneficiario_discapacidad where id_beneficiario='$this->idBeneficiario' and estatus='1'";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_beneficiario_discapacidad"];
				$fila[$c][2]=$row["id_beneficiario"];	
				$fila[$c][3]=$row["id_discapacidad"];						
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}

//       Metodo Buscar ultmimo
    public function tUltimoID_Disc(){
      $sql="SELECT * FROM ttitular_discapacidad ORDER BY id_titular_discapacidad DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }	
	 public function bUltimoID_Disc(){
      $sql="SELECT * FROM tbeneficiario_discapacidad ORDER BY id_beneficiario_discapacidad DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }	

//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}//cierra la clase
?>