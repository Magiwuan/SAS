<?php
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class discapacidad extends conectaBDMy{
	private $idDiscapacidad;	
	private $nom;
//       Metodo Constructor de la clase
    public function discapacidad(){
		parent::conectaBDMy();	    
		$this->idDiscapacidad="";		
		$this->nom="";	
		
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidDiscapacidad($Valor){
        $this->idDiscapacidad = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Metodo registrar
 public function iDiscapacidad(){	  
       $sql="INSERT INTO tdiscapacidad(nombre,estatus) values('$this->nom','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }

//       Metodo Eliminar
public function eDiscapacidad(){
		$sql= "update tdiscapacidad set estatus='0' where id_discapacidad='$this->idDiscapacidad'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();

}
public function valida_discapacidad() { 
		$sql="select * from tdiscapacidad where nombre='$this->nom'"; 
		$cursor=parent::ejecuta_sql( $sql );
		if(parent::getNRegistro($cursor)>0)
		return 1;//Si encuentra registro envia 1 para validar
		else
		return -1; //si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();	
						 		
	}
//       Metodo para listar cargo en los combos
	function lista_discapacidad()
	{ 
		$c=0;
		$sql="select * from tdiscapacidad where estatus='1' order by nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 do{
				$fila[$c][1]=$row["id_discapacidad"];
				$fila[$c][2]=$row["nombre"];			
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
     public function sql_discapacidad(){
        $sql="SELECT * FROM tdiscapacidad WHERE estatus='1' order by nombre";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		if(parent::getNRegistro($cursor)<0)
			return 1;//fallo la operacion
			else 
			return $sql;		
			
			parent::cerrar_bd();
     }	
//--------------------------------------------------------------------
//       Metodo indica la cantidad de tuplas leidas
//--------------------------------------------------------------------
     public function getNTupla($resultado){
        return ( parent::getNRegistro($resultado)  );
     }
}//cierra la clase
?>
