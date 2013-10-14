<?php
include_once("clase_mysql.php");
//       Clase pais hereda a clase CModeloDatos para conectar BD MYSql
class pais extends conectaBDMy{
	private $idPais;	
	private $nom;
//       Metodo Constructor de la clase
    public function pais(){
		parent::conectaBDMy();	    
		$this->idPais="";		
		$this->nom="";		
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidPais($Valor){
        $this->idPais = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Metodo registrar
 public function iPais(){	  
       $sql="INSERT INTO tpais(nombre,estatus) values('$this->nom','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function ePais(){
		$sql= "update tpais set estatus='0' where id_pais='$this->idPais'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();

}
//       Metodo para listar pais en los combos
	function lista_pais()
	{ 
		$c=0;
		$sql="select * from tpais where estatus='1' order by nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_pais"];
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
     public function sql_pais(){
        $sql="SELECT * FROM tpais WHERE estatus='1' order by nombre";
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