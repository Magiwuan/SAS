<?php
include_once("clase_mysql.php");
//       Clase cobertura hereda a clase CModeloDatos para conectar BD MYSql
class cobertura extends conectaBDMy{
	private $idCobertura;	
	private $desc;
	private $tipo;
	private $monto;
	private $fecha_inicio;
	private $fecha_fin;
//       Metodo Constructor de la clase
    public function cobertura(){
		parent::conectaBDMy();	    
		$this->idCobertura="";		
		$this->desc="";
		$this->tipo="";	
		$this->monto="";	
		$this->fecha_inicio="";	
		$this->fecha_fin="";			
	}
//       Metodos Set para cada propiedad de la clase
 	public function setidCobertura($Valor){
        $this->idCobertura = trim($Valor);
    }  
	public function setDesc($Valor){
        $this->desc = trim($Valor);
    }
	public function setTipo($Valor){
        $this->tipo = trim($Valor);
    }
	public function setMonto($Valor){
        $this->monto = trim($Valor);
    }
	public function setFecha_ini($Valor){
        $this->fecha_inicio = trim($Valor);
    }
	public function setFecha_fin($Valor){
        $this->fecha_fin = trim($Valor);
    }
//       Metodo registrar
 public function iCobertura(){
	 	$this->fecha_inicio = parent::fecha_bd($this->fecha_inicio);
	   $this->fecha_fin  = parent::fecha_bd($this->fecha_fin);	  
       $sql="INSERT INTO tcobertura(descripcion,tipo,monto,fecha_inicio,fecha_fin,estatus) values('$this->desc','$this->tipo','$this->monto','$this->fecha_inicio','$this->fecha_fin','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function eCobertura(){
		$sql="update tcobertura set estatus='0' where id_cobertura='$this->idCobertura'";
		$respuesta = parent::ejecuta_sql($sql);
			if ($respuesta>0)
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();

}
//       Metodo para listar cobertura en los combos
	function lista_cobertura()
	{ 
		$c=0;
		$sql="select * from tcobertura where estatus='1' order by descripcion";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_cobertura"];
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
//       Sentencia sql para listar
     public function sql_cobertura(){
        $sql="SELECT * FROM tcobertura WHERE estatus='1' order by descripcion";
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
?>