<?php

include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class detalle_pro extends conectaBDMy{
	private $idProveedor;	
	private $idMedico;
	private $id_Proveedor_Medico;
//       Metodo Constructor de la clase
    public function detalle_pro(){
		parent::conectaBDMy();	    
		$this->idProveedor="";		
		$this->idMedico="";	
		$this->id_Proveedor_Medico="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
	public function setId_proveedor_medico($Valor){
        $this->id_Proveedor_Medico = trim($Valor);
    }
 	public function setIdProveedor($Valor){
        $this->idProveedor = trim($Valor);
    }  
	public function setIdMedico($Valor){
        $this->idMedico = trim($Valor);
    }
//       Metodo registrar
 public function iProveedor_Medico(){	  
       $sql="INSERT INTO tproveedor_medico (id_proveedor_medico, id_proveedor, id_medico, estatus) values('$this->id_Proveedor_Medico','$this->idProveedor', '$this->idMedico', '1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
	parent::cerrar_bd();

    }
//       Metodo Modificar
 public function mProveedor_Medico(){	  
       $sql="DELETE tproveedor_medico.* FROM tproveedor_medico where id_proveedor='$this->idProveedor'";	  
     	$respuesta= parent::ejecuta_sql($sql);
		
		 if($respuesta>0)
			return -1;//Exito
	 	 else
	     	return 2;//Fallo Registro
			
			parent::cerrar_bd();
    }	
//       Metodo para buscar las profesiones por titular
	function buscar_proveedores()
	{ 
		$c=0;
		$sql="select * from tproveedor_medico where id_medico='$this->idMedico' and estatus='1'";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_proveedor_medico"];
				$fila[$c][2]=$row["id_medico"];
				$fila[$c][3]=$row["id_proveedor"];	
												
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
    public function UltimoID_Pro(){
       $sql="SELECT * FROM tproveedor_medico ORDER BY id_proveedor_medico DESC LIMIT 1";
	return ($cursor= parent::ejecuta_sql($sql));
	
    }	
//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}//cierra la clase
?>