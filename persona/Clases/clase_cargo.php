<?php
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class cargo extends conectaBDMy{
	private $idCargo;	
	private $nom;
//       Metodo Constructor de la clase
    public function cargo(){
		parent::conectaBDMy();	    
		$this->idCargo="";		
		$this->nom="";		
	}
//       Metodos Set para cada propiedad de la clase
 	public function setidCargo($Valor){
        $this->idCargo = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Metodo registrar
 public function iCargo(){	  
       $sql="INSERT INTO tcargo(nombre,estatus) values('$this->nom','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function eCargo(){
		$sql= "update tcargo set estatus='0' where id_cargo='$this->idCargo'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();
}
public function buscar_cargo() 
	{ 
		$c=0;
		$sql="select * from tcargo where id_cargo='$this->idCargo'"; 
		$cursor=parent::ejecuta_sql($sql);
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][2]=$row["nombre"];
				$c++;
			
		 }
		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
	} 	
//       Metodo para listar cargo en los combos
	function lista_cargo()
	{ 
		$c=0;
		$sql="select * from tcargo where estatus='1' order by nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_cargo"];
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
     public function sql_cargo(){
        $sql="SELECT * FROM tcargo WHERE estatus='1' order by nombre";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		$resulta=parent::getNRegistro($cursor); 		
		if($resulta<0)
			return 1;//fallo la operacion
			else 
			return $sql;		
			
			parent::cerrar_bd();
     }	
	 	public function valida_cargo() 
	{ 
		$c=0;
		$sql="select * from tcargo where nombre='$this->nom'"; 
		$cursor=parent::ejecuta_sql($sql);
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][2]=$row["nombre"];
				$c++;
			
		 }
		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
	} 
}//cierra la clase
?>