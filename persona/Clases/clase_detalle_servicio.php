<?php
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class detalle_serv extends conectaBDMy{
	private $idDetalleServicio;	
	private $idServicio;
	private $idProveedor;
//       Metodo Constructor de la clase
    public function detalle_serv(){
		parent::conectaBDMy();	    
		$this->idDetalleServicio="";		
		$this->idServicio="";	
		$this->idProveedor="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
	public function setIdDetalleServicio($Valor){
        $this->idDetalleServicio = trim($Valor);
    }
 	public function setIdServicio($Valor){
        $this->idServicio = trim($Valor);
    }  
	public function setIdProveedor($Valor){
        $this->idProveedor = trim($Valor);
    }	
//       Metodo registrar
 public function iDetalle_Serv(){	  
       $sql="INSERT INTO tdetalle_servicio(id_detalle_servicio,id_servicio,id_proveedor,estatus) values('$this->idDetalleServicio','$this->idServicio','$this->idProveedor','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();

    }
//       Metodo Modificar
 public function eDetalle_Serv(){	  
       $sql="DELETE tdetalle_servicio.* FROM tdetalle_servicio where id_proveedor='$this->idProveedor'";	  
     	$respuesta= parent::ejecuta_sql($sql);
		
		 if($respuesta>0)
			return -1;//Exito
	 	 else
	     	return 2;//Fallo Registro	
			
			parent::cerrar_bd();		
    }	
//       Metodo para buscar los servicios
	function buscar_servicios()
	{ 
		$c=0;
		$sql="select * from tdetalle_servicio where id_proveedor='$this->idProveedor' and estatus='1'";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_detalle_servicio"];
				$fila[$c][2]=$row["id_servicio"];	
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
    public function UltimoID_serv(){
       $sql="SELECT * FROM tdetalle_servicio ORDER BY id_detalle_servicio DESC LIMIT 1";
	return ($cursor= parent::ejecuta_sql($sql));
	
    }	

//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}//cierra la clase
?>