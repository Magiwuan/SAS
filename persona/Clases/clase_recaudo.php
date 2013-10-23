<?php
include_once("clase_mysql.php");

//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class recaudos extends conectaBDMy{
	private $idRecaudos;	
	private $tipoRecaudo;
	private $descripcion;
//       Metodo Constructor de la clase
    public function recaudos(){
		parent::conectaBDMy();	    
		$this->idRecaudos="";		
		$this->tipoRecaudo="";	
		$this->descripcion="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
	public function setidRecaudo($Valor){
        $this->idRecaudos = trim($Valor);
    }
 	public function setTiporecaudo($Valor){
        $this->tipoRecaudo = mb_strtoupper(trim($Valor), "utf-8");
    }  
	public function setDescripcion($Valor){
        $this->descripcion = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Metodo registrar
 public function iRecaudos(){	  
       $sql="INSERT INTO trecaudo(tipo,descripcion,estatus) values( '$this->tipoRecaudo', '$this->descripcion', '1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function eRecaudos(){
		$sql= "update trecaudo set estatus='0' where id_recaudo='$this->idRecaudos'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();
}
public function valida_recaudo(){ 
		$sql="select * from trecaudo where descripcion='$this->descripcion' and tipo='$this->tipoRecaudo'"; 
		$cursor=parent::ejecuta_sql( $sql );
		return (parent::getNRegistro($cursor));
		//Si encuentra registro envia 1 para validar
		//si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();	
						 		
	}   
//       Metodo para listar cargo en los combos
	function lista_recaudo()
	{ 
		$c=0; 
		$sql="SELECT * FROM trecaudo where estatus='1' and tipo='$this->tipoRecaudo' order by id_recaudo";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_recaudo"];			
				$fila[$c][2]=ucfirst(strtolower($row["descripcion"]));
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
	
//       Sentencia sql para listar
     public function sql_recaudos(){
        $sql="SELECT * FROM trecaudo WHERE estatus='1' order by descripcion";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		if(parent::getNRegistro($cursor)<0)
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
