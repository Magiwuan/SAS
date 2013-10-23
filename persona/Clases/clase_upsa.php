<?php
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class upsa extends conectaBDMy{
	private $idUpsa;	
	private $nom;
	private $direccion;
	private $idCiudad;
	private $idEstado;
//       Metodo Constructor de la clase
    public function upsa(){
		parent::conectaBDMy();	    
		$this->idUpsa="";		
		$this->nom="";	
		$this->direccion="";	
		$this->idCiudad="";	
		$this->idEstado="";		
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidUpsa($Valor){
        $this->idUpsa = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setDireccion($Valor){
        $this->direccion = mb_strtoupper(trim($Valor), "utf-8");
    } 
	public function setidCiudad($Valor){
        $this->idCiudad = trim($Valor);
    } 
    public function setidEstado($Valor){
        $this->idEstado = trim($Valor);
    } 
//       Metodo registrar
//-------------------------------------------------------------------- 
 public function iUpsa(){	  
       $sql="INSERT INTO tupsa(nombre,direccion,id_ciudad,estatus) values('$this->nom','$this->direccion','$this->idCiudad','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
//-------------------------------------------------------------------- 	
public function eUpsa(){
		$sql= "update tupsa set estatus='0' where id_upsa='$this->idUpsa'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();

}
    public function valida_upsa(){ 
		$sql="select a.*, b.id_estado from tupsa as a, tciudad as b where a.nombre ='$this->nom' and a.id_ciudad='$this->idCiudad' and b.id_estado='$this->idEstado' and a.id_ciudad=b.id_ciudad";
		$cursor=parent::ejecuta_sql( $sql );
		return ( parent::getNRegistro($cursor) );
		//Si encuentra registro envia 1 para validar	
		//si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();	
						 		
	}  
//       Metodo para listar cargo en los combos
//-------------------------------------------------------------------- 
	function lista_upsa()
	{ 
		$c=0;
		$sql="select * from tupsa where estatus='1' order by nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_upsa"];
				$fila[$c][2]=$row["nombre"];
				$fila[$c][3]=$row["direccion"];			
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
     public function sql_upsa(){
        $sql="SELECT a.id_upsa, a.nombre, a.direccion, a.id_ciudad, b.id_ciudad, b.nombre as ciudad  FROM tupsa as a, tciudad as b WHERE a.id_ciudad=b.id_ciudad and a.estatus='1' order by a.nombre";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		if(parent::getNRegistro($cursor)<0)
			return 1;//fallo la operacion
			else 
			return $sql;		
			
			parent::cerrar_bd();
     }	
//	Metodo que Genera la Caja de Texto con la Direccion De Trabajo
	public function CajaDireccion(){		
		if($this->idUpsa!=NULL){
			$caja = array();
			$c=0;
			$sql="select direccion from tupsa where id_upsa='$this->idUpsa'";			
			$cursor = parent::ejecuta_sql($sql);
			while($fila=parent::proxima_tupla($cursor)) 
			{
				$caja[$c] .='<textarea cols="45" rows="2" name="direccion3" readonly >'.$fila['direccion'].'</textarea>';	
				$c++;
			}				
				return $caja;
				parent::cerrar_bd();
		}
	}
	 public function Buscar_upsa(){		
			$caja = array();
			$c=0;
			$sql="select a.direccion, a.nombre as upsa, b.nombre as ciudad, c.nombre as estado, d.nombre as pais from tupsa as a, tciudad as b, testado as c, tpais as d where a.id_ciudad=b.id_ciudad and b.id_estado=c.id_estado and c.id_pais=d.id_pais and id_upsa='$this->idUpsa'";			
			$cursor = parent::ejecuta_sql($sql);
			if($row= parent::proxima_tupla($cursor))
			 {
				 	$fila[$c][1]=$row["upsa"];
					$fila[$c][2]=$row["direccion"];
					$fila[$c][3]=$row["ciudad"];
					$fila[$c][4]=$row["estado"];
					$fila[$c][5]=$row["pais"];					
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
