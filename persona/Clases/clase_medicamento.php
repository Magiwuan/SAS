<?php
include_once("clase_mysql.php");
//       Clase medicamento hereda a clase CModeloDatos para conectar BD MYSql
class medicamento extends conectaBDMy{
	private $idMedicamento;	
	private $nom;
//       Metodo Constructor de la clase
    public function medicamento(){
		parent::conectaBDMy();	    
		$this->idMedicamento="";		
		$this->nom="";	
		$this->pres="";	
		$this->comp="";		
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidMedicamento($Valor){
        $this->idMedicamento = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setPres($Valor){
        $this->pres = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setComp($Valor){
        $this->comp = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Metodo registrar
 public function iMedicamento(){	  
       $sql="INSERT INTO tmedicamento(descripcion, estatus) values('$this->nom','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function eMedicamento(){
		$sql= "update tmedicamento set estatus='0' where id_medicamento='$this->idMedicamento'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();

}
//       Metodo para listar medicamento en los combos
	function lista_medicamento()
	{ 
		$c=0;
		$sql="select * from tmedicamento where estatus='1' order by descripcion";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_medicamento"];
				$fila[$c][2]=$row["descripcion"];
				$fila[$c][3]=$row["presentacion"];
				$fila[$c][4]=$row["componente"];			
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	} 
//busca el medicamento del complete
	 public function bMedicamento(){
		 $c=0;
        $sql="select * from tmedicamento where descripcion like'$this->nom%' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 DO{
			 	$fila[$c][1]=$row["id_medicamento"];
				$fila[$c][2]=$row["descripcion"];
				$fila[$c][3]=$row["presentacion"];
				$fila[$c][4]=$row["componente"];		
				$c++;
				}while($row= parent::proxima_tupla($cursor));
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }  
	 
     public function valida_medicamento() { 
		$sql="select * from tmedicamento where descripcion='$this->nom'"; 
		$cursor=parent::ejecuta_sql( $sql );
		return ( parent::getNRegistro($cursor) );
		//Si encuentra registro envia 1 para validar	
		//si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();							 		
	}   
//       Sentencia sql para listar
     public function sql_medicamento(){
        $sql="SELECT * FROM tmedicamento WHERE estatus='1' order by descripcion";
		/*if ($this->nom!=NULL)
		$sql .= " and nombre like '$this->nom%'";	*/
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		if(parent::getNRegistro($cursor)<0)
			return 1;//fallo la operacion
			else 
			return $sql;		
			
			parent::cerrar_bd();
     }	
}//cierra la clase
?>
