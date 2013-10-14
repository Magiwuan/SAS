<?php
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class detalle_rec extends conectaBDMy{
	private $idRecaudos;	
	private $idTitular;
	private $idSolicitud;
	private $idBeneficiario;
	private $id_titular_rec;
	private $id_beneficiario_rec;
	private $id_solicitud_rec;
	private $tipo;

//       Metodo Constructor de la clase
    public function detalle_rec(){
		parent::conectaBDMy();	    
		$this->idRecaudos="";		
		$this->idTitular="";	
		$this->idBeneficiario="";
		$this->id_titular_rec="";
		$this->id_beneficiario_rec="";
		$this->id_solicitud_rec="";
		$this->tipo="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
	public function setId_titular_rec($Valor){
        $this->id_titular_rec = trim($Valor);
    }
 	public function setidRecaudos($Valor){
        $this->idRecaudos = trim($Valor);
    }  
	public function setidTitular($Valor){
        $this->idTitular = trim($Valor);
    }
	public function setidBeneficiario($Valor){
        $this->idBeneficiario = trim($Valor);
    }
	public function setId_beneficiario_rec($Valor){
        $this->id_beneficiario_rec = trim($Valor);
    }
	public function setId_solicitud_rec($Valor){
        $this->id_solicitud_rec = trim($Valor);
    }
	public function setidSolicitud($Valor){
        $this->idSolicitud = trim($Valor);
    }
	public function setTipo($Valor){
        $this->tipo = trim($Valor);
    }
//       Metodo registrar
 public function iTitular_Recaudos(){	  
       $sql="INSERT INTO ttitular_recaudo(id_titular_recaudo,id_recaudo,id_titular,estatus) values('$this->id_titular_rec', '$this->idRecaudos', '$this->idTitular', '1')";
     $respuesta= parent::ejecuta_sql($sql);	
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
	parent::cerrar_bd();
    }
	
public function iBeneficiario_Recaudos(){	  
       $sql="INSERT INTO tbeneficiario_recaudo(id_beneficiario_recaudo,id_recaudo,id_beneficiario,tipo,estatus) values('$this->id_beneficiario_rec', '$this->idRecaudos', '$this->idBeneficiario','$this->tipo','1')";
     $respuesta= parent::ejecuta_sql($sql);	
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
	public function iSolicitud_Recaudos(){	  
       $sql="INSERT INTO tsolicitud_recaudo(id_solicitud_recaudo,id_recaudo,id_solicitud,estatus) values('$this->id_solicitud_rec', '$this->idRecaudos', '$this->idSolicitud', '2')";
     $respuesta= parent::ejecuta_sql($sql);	
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
	public function iSolicitud_reembolso_Recaudos(){	  
       $sql="INSERT INTO tsolicitud_recaudo(id_solicitud_recaudo,id_recaudo,id_solicitud_reembolso,estatus) values('$this->id_solicitud_rec', '$this->idRecaudos', '$this->idSolicitud', '2')";
     $respuesta= parent::ejecuta_sql($sql);	
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
 public function eTitular_Recaudos(){	  
       $sql="DELETE ttitular_recaudo.* FROM ttitular_recaudo where id_titular='$this->idTitular'";	  
     	$respuesta= parent::ejecuta_sql($sql);
		
		 if($respuesta>0)
			return -1;//Exito
	 	 else
	     	return 1;//Fallo Registro	
			
			parent::cerrar_bd();		
    }	
	
 public function eBeneficiario_Recaudos(){	  
       $sql="DELETE tbeneficiario_recaudo.* FROM tbeneficiario_recaudo where id_beneficiario='$this->idBeneficiario'";	  
     	$respuesta= parent::ejecuta_sql($sql);		
		 if($respuesta>0)
			return -1;//Exito
	 	 else
	     	return 1;//Fallo Registro	
			
			parent::cerrar_bd();		
    }	
//       Metodo para buscar las discapacidades por titular
	function buscar_recaudos()
	{ 
		$c=0; 
		$sql="SELECT * FROM ttitular_recaudo  where id_titular='$this->idTitular' and estatus='1' ";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_titular_recaudo"];					
				$fila[$c][2]=$row["id_titular"];	
				$fila[$c][3]=$row["id_recaudo"];						
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}	
	
	function buscar_recaudos_beneficiario()
	{ 
		$c=0; 
		$sql="SELECT * FROM tbeneficiario_recaudo  where id_beneficiario='$this->idBeneficiario' and estatus='1' ";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_beneficiario_recaudo"];					
				$fila[$c][2]=$row["id_beneficiario"];	
				$fila[$c][3]=$row["id_recaudo"];						
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
    public function tUltimoID_Rec(){
       $sql="SELECT * FROM ttitular_recaudo ORDER BY id_titular_recaudo DESC LIMIT 1";
	return ($cursor= parent::ejecuta_sql($sql));
    }
 public function bUltimoID_Rec(){
       $sql="SELECT * FROM tbeneficiario_recaudo ORDER BY id_beneficiario_recaudo DESC LIMIT 1";
	return ($cursor= parent::ejecuta_sql($sql));
    }
	 public function sUltimoID_Rec(){
       $sql="SELECT * FROM tsolicitud_recaudo ORDER BY id_solicitud_recaudo DESC LIMIT 1";
	return ($cursor= parent::ejecuta_sql($sql));
    }		
//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}//cierra la clase
?>