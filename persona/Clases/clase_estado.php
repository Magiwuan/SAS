<?php
/* Revisada 07-03-2013 5:29pm 
no hubo modificaciones
*/
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class estado extends conectaBDMy{
	private $idEstado;	
	private $nom;
	private $idPais;
//       Metodo Constructor de la clase
    public function estado(){
		parent::conectaBDMy();	    
		$this->idEstado="";		
		$this->nom="";	
		$this->idPais="";
		
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidEstado($Valor){
        $this->idEstado = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setidPais($Valor){
        $this->idPais = trim($Valor);
    }
//       Metodo registrar
 public function iEstado(){	  
       $sql="INSERT INTO testado(nombre,id_pais,estatus) values('$this->nom','$this->idPais','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function eEstado(){
		$sql= "update testado set estatus='0' where id_estado='$this->idEstado'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();

}	
public function valida_estado() { 
		$sql="select * from testado where nombre='$this->nom' and id_pais='$this->idPais'"; 
		$cursor=parent::ejecuta_sql( $sql );
		return ( parent::getNRegistro($cursor) );
		//Si encuentra registro envia 1 para validar	
		//si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();							 		
	} 
//       Metodo para consulta
	function buscar_estado()
	{ 
		$c=0;
		$sql="select * from testado where id_estado='$this->idEstado'";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			
				$fila[$c][1]=$row["id_estado"];
				$fila[$c][2]=$row["nombre"];			
				$c++;				 
			
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}   
function lista_estado()
	{ 
		$c=0;
		$sql="select * from testado where estatus='1' order by nombre asc";		
		 $cursor=parent::ejecuta_sql($sql);
			if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_estado"];
				$fila[$c][2]=$row["nombre"];
				$fila[$c][3]=$row["id_pais"];
				
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
     public function sql_estado(){
        $sql="SELECT a.id_estado, a.nombre, a.id_pais, b.id_pais, b.nombre as pais FROM testado as a, tpais as b WHERE a.estatus='1' and a.id_pais=b.id_pais order by pais";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		if(parent::getNRegistro($cursor)<0)
			return 1;//fallo la operacion
			else 
			return $sql;	
					
			parent::cerrar_bd();
     }	

//       Metodo Para Buscar idTitular
     public function buscar_id(){
		 $c=0;
        $sql="select * from ttitular where id_titular = '$this->id' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor)){					
		 		$fila[$c][3]=$row["cedula"];
				$fila[$c][4]=$row["nombre1"];
				$fila[$c][5]=$row["nombre2"];
				$fila[$c][6]=$row["apellido1"];
				$fila[$c][7]=$row["apellido2"];				
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
