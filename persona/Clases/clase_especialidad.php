<?php
include_once("clase_mysql.php");
//       Clase especialidad hereda a clase CModeloDatos para conectar BD MYSql
class especialidad extends conectaBDMy{
	private $idespecialidad;	
	private $nom;
//       Metodo Constructor de la clase
    public function especialidad(){
		parent::conectaBDMy();	    
		$this->idespecialidad="";		
		$this->nom="";		
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidespecialidad($Valor){
        $this->idespecialidad = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Metodo registrar
 public function iespecialidad(){	  
       $sql="INSERT INTO tespecialidad(nombre,estatus) values('$this->nom','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function eespecialidad(){
		$sql= "update tespecialidad set estatus='0' where id_especialidad='$this->idespecialidad'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();
}
public function valida_especialidad() { 
		$sql="select * from tespecialidad where nombre='$this->nom'"; 
		$cursor=parent::ejecuta_sql( $sql );
		return (parent::getNRegistro($cursor));
		//Si encuentra registro envia 1 para validar
		//si no encuentra registro procede a registrar		
		parent::cerrar_bd();							 		
	} 	
//       Metodo para listar especialidad en los combos
	function lista_especialidad()
	{ 
		$c=0;
		$sql="select * from tespecialidad where estatus='1' order by nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_especialidad"];
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
     public function sql_especialidad(){
        $sql="SELECT * FROM tespecialidad WHERE estatus='1' order by nombre";
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
