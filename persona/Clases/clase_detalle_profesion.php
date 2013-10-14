<?php
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class detalle_pro extends conectaBDMy{
	private $idProfesion;	
	private $idTitular;
	private $id_titular_profesion;
//       Metodo Constructor de la clase
    public function detalle_pro(){
		parent::conectaBDMy();	    
		$this->idProfesion="";		
		$this->idTitular="";	
		$this->id_titular_profesion="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
	public function setId_titular_pro($Valor){
        $this->id_titular_profesion = trim($Valor);
    }
 	public function setidProfesion($Valor){
        $this->idProfesion = trim($Valor);
    }  
	public function setidTitular($Valor){
        $this->idTitular = trim($Valor);
    }
//       Metodo registrar
 public function iTitular_Profesion(){	  
       $sql="INSERT INTO ttitular_profesion(id_titular_profesion, id_profesion, id_titular, estatus) values('$this->id_titular_profesion','$this->idProfesion', '$this->idTitular', '1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();

    }
//       Metodo Modificar
 public function eTitular_Profesion(){	  
       $sql="DELETE ttitular_profesion.* FROM ttitular_profesion where id_titular='$this->idTitular'";	  
     	$respuesta= parent::ejecuta_sql($sql);
		
		 if($respuesta>0)
			return -1;//Exito
	 	 else
	     	return 2;//Fallo Registro
			
			parent::cerrar_bd();
    }	
//       Metodo para buscar las profesiones por titular
	function buscar_profesiones()
	{ 
		$c=0;
		$sql="select * from ttitular_profesion where id_titular='$this->idTitular' and estatus='1'";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_titular_profesion"];
				$fila[$c][2]=$row["id_profesion"];	
				$fila[$c][3]=$row["id_titular"];								
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	} 
	function buscar_profesion_pdf()
	{ 
		$c=0;
		$sql="SELECT a.*, b.* FROM ttitular_profesion as a, tprofesion as b WHERE a.id_profesion=b.id_profesion AND a.id_titular = '$this->idTitular'";		
			$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][1]=$row["id_titular"];
				$fila[$c][2]=$row["nombre"];									
				$c++;				 
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
//       Metodo Buscar ultmimo
    public function tUltimoID_Pro(){
       $sql="SELECT * FROM ttitular_profesion ORDER BY id_titular_profesion DESC LIMIT 1";
	return ($cursor= parent::ejecuta_sql($sql));
	
    }	
//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}//cierra la clase
?>