<?php
//NOTA ESTA CLASE SERVIRA PARA CUANDO SE AGREGUEN LOS OTROS MODULOS
/*
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class servicio extends conectaBDMy{
	private $idServicio;	
	private $nom;
	private $desc;
//       Metodo Constructor de la clase
    public function servicio(){
		parent::conectaBDMy();	    
		$this->idServicio="";		
		$this->nom="";	
		$this->desc="";		
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidServicio($Valor){
        $this->idServicio = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setDescripcion($Valor){
        $this->desc = mb_strtoupper(trim($Valor), "utf-8");
    } 
//       Metodo registrar
 public function iServicio(){	  
       $sql="INSERT INTO tservicio_proveedor(nombre,descripcion,estatus) values('$this->nom','$this->desc','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function eServicio(){
		$sql= "update tservicio_proveedor set estatus='0' where id_servicio='$this->idServicio'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();

}
//       Metodo para listar cargo en los combos
	function lista_servicio()
	{ 
		$c=0;
		$sql="select * from tservicio_proveedor where estatus='1' order by nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_servicio"];
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
//       Sentencia sql para listar
     public function sql_servicio(){
        $sql="SELECT * FROM tservicio_proveedor WHERE estatus='1' order by nombre";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		$resulta=parent::getNRegistro($cursor); 		
		if($resulta<0)
			return 1;//fallo la operacion
			else 
			return $sql;		
			
			parent::cerrar_bd();
     }	
		
}//cierra la clase
* */
?>
