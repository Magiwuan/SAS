<?php
/* Revisada 07-03-2013 5:29pm 
no hubo modificaciones
*/
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class departamento extends conectaBDMy{
	private $idDepartamento;	
	private $nom;
//       Metodo Constructor de la clase
    public function departamento(){
		parent::conectaBDMy();	    
		$this->idDepartamento="";		
		$this->nom="";			
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidDepartamento($Valor){
        $this->idDepartamento = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Metodo registrar
 public function iDepartamento(){	  
       $sql="INSERT INTO tdepartamento(nombre,estatus) values('$this->nom','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
	
    }
//       Metodo Eliminar
public function eDepartamento(){
		$sql= "update tdepartamento set estatus='0' where id_departamento='$this->idDepartamento'";
		$respuesta = parent::ejecuta_sql($sql);
			if ($respuesta>0)
				return -1;// Exito
			else
				return 1;//fallo la operacion
}
//       Metodo para listar cargo en los combos
	function lista_departamento()
	{ 
		$c=0;
		$sql="select * from tdepartamento where estatus='1' order by nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_departamento"];
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
	//       Metodo para listar cargo en los combos
//       Sentencia sql para listar
     public function sql_departamento(){
        $sql="SELECT * FROM tdepartamento WHERE estatus='1' order by nombre";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		$resulta=parent::getNRegistro($cursor); 		
		if($resulta<0)
			return 1;//fallo la operacion
			else 
			return $sql;		
			
			parent::cerrar_bd();
     }	  
	public function valida_departamento() 
	{ 
		$c=0;
		$sql="select * from tdepartamento where nombre='$this->nom'"; 
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
	public function buscar() 
	{ 
		$c=0;
		$sql="select * from tdepartamento where id_departamento='$this->idDepartamento'"; 
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
