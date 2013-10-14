<?php

include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class examen extends conectaBDMy{
	private $idExamen;	
	private $tipoExamen;
	private $descripcion;
//       Metodo Constructor de la clase
    public function examen(){
		parent::conectaBDMy();	    
		$this->idExamen="";		
		$this->tipoExamen="";	
		$this->descripcion="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
	public function setidExamen($Valor){
        $this->idExamen = trim($Valor);
    }
 	public function setTipoexamen($Valor){
        $this->tipoExamen = mb_strtoupper(trim($Valor), "utf-8");
    }  
	public function setDescripcion($Valor){
        $this->descripcion = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Metodo registrar
 public function iExamen(){	  
       $sql="INSERT INTO texamen(tipo,descripcion,estatus) values( '$this->tipoExamen', '$this->descripcion', '1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function eExamen(){
		$sql= "update texamen set estatus='0' where id_examen='$this->idExamen'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();

}
//       Metodo para listar cargo en los combos
	function lista_examen()
	{ 
		$c=0; 
		$sql="SELECT * FROM texamen where estatus='1' and tipo='$this->tipoExamen' order by id_examen";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_examen"];			
				$fila[$c][2]=$row["descripcion"];
				$fila[$c][3]=$row["tipo"];		
				
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}
public function validar_examen(){
		 $c=0;
        $sql="select * from texamen where descripcion='$this->descripcion'";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 	$fila[$c][1]=$row["id_examen"];
				$fila[$c][2]=$row["descripcion"];
				$fila[$c][3]=$row["tipo"];
				$c++;
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }  
//busca el medicamento del complete
	 public function bExamen_e(){
		 $c=0;
        $sql="select * from texamen where descripcion like'$this->descripcion%' and tipo='ESPECIALES' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 DO{
			 	$fila[$c][1]=$row["id_examen"];
				$fila[$c][2]=$row["descripcion"];
				$fila[$c][3]=$row["tipo"];
				$c++;
				}while($row= parent::proxima_tupla($cursor));
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }  
	
//busca el medicamento del complete
	 public function bExamen_i(){
		 $c=0;
        $sql="select * from texamen where descripcion like'$this->descripcion%' and tipo='IMAGEN' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 DO{
			 	$fila[$c][1]=$row["id_examen"];
				$fila[$c][2]=$row["descripcion"];
				$fila[$c][3]=$row["tipo"];
				$c++;
				}while($row= parent::proxima_tupla($cursor));
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }  	
//busca el medicamento del complete
	 public function bExamen_l(){
		 $c=0;
        $sql="select * from texamen where descripcion like'$this->descripcion%' and tipo='LABORATORIO' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 DO{
			 	$fila[$c][1]=$row["id_examen"];
				$fila[$c][2]=$row["descripcion"];
				$fila[$c][3]=$row["tipo"];
				$c++;
				}while($row= parent::proxima_tupla($cursor));
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
	
//       Sentencia sql para listar
     public function sql_examen(){
        $sql="SELECT * FROM texamen WHERE estatus='1' order by descripcion";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		$resulta=parent::getNRegistro($cursor); 		
		if($resulta<0)
			return 1;//fallo la operacion
			else 
			return $sql;		
			
			parent::cerrar_bd();
     }	
//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}//cierra la clase
?>