<?php
include_once("clase_mysql.php");
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class ciudad extends conectaBDMy{
	private $idCiudad;	
	private $nom;
	private $idEstado;
//       Metodo Constructor de la clase
    public function ciudad(){
		parent::conectaBDMy();	    
		$this->idCiudad="";		
		$this->nom="";	
		$this->idEstado="";
		
	}
//       Metodos Set para cada propiedad de la clase
	public function setidCiudad($Valor){
        $this->idCiudad = trim($Valor);
    }
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }
 	public function setidEstado($Valor){
        $this->idEstado = trim($Valor);
    }  
//       Metodo registrar
 public function iCiudad(){	  
       $sql="INSERT INTO tciudad(nombre,id_estado,estatus) values('$this->nom','$this->idEstado','1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Eliminar
public function eCiudad(){
		$sql= "update tciudad set estatus='0' where id_ciudad='$this->idCiudad'";
		$respuesta = parent::ejecuta_sql($sql);
			if ($respuesta>0)
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();

}	
public function valida_ciudad() { 
		$sql="select * from tciudad where nombre='$this->nom'"; 
		$cursor=parent::ejecuta_sql( $sql );
		if(parent::getNRegistro($cursor)>0)
		return 1;//Si encuentra registro envia 1 para validar
		else
		return -1; //si no encuentra registro procede a registrar	
		
		parent::cerrar_bd();	
						 		
	} 
//       Metodo Para Listar  Ciudad por Estado
    public function combo(){		
			$combo = array();
			$c=0;
			$sql="select * from tciudad where id_estado = '$this->idEstado' ";		   
			$cursor = parent::ejecuta_sql($sql);
			$combo[$c] .= '<option value="0" disabled="disabled" selected="selected">Seleccionar</option>';
			while($fila=parent::proxima_tupla($cursor)) 
			{
				$combo[$c] .= '<option value="'.$fila['id_ciudad'].'">'.$fila['nombre'].'</option>';	
				$c++;
			}
			$combo[$c] .= '<option value="-1"><div id="open"><a href="#">Agregar ciudad</a></div></option>';
			return $combo;
			
			parent::cerrar_bd();
		
	}
//       Sentencia sql para listar
           public function sql_ciudad(){
        $sql="SELECT a.id_ciudad, a.nombre, a.id_estado, b.id_estado, b.nombre as estado FROM tciudad as a, testado as b WHERE a.estatus='1' and a.id_estado=b.id_estado order by estado";
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		$resulta=parent::getNRegistro($cursor); 		
		if($resulta<0)
			return 1;//fallo la operacion
			else 
			return $sql;		
			
			parent::cerrar_bd();
     }	
//	Lista todas las marcas Si no consigue relacion combo3();
public function combo_error(){		
			$combo = array();
			$c=0;			
			$combo[$c] .= '<option value="0" selected="selected" disabled="disabled">Seleccionar</option>';	
			$combo[$c] .= '<option value="-1"><div id="open"><a href="#">Agregar ciudad</a></div></option>';
		
			return $combo;		
	}
	
//       Metodo Para verificar el Estado
     public function Verificar_est(){
        $sql="select * from tciudad where id_estado = '$this->idEstado' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
				$fila[$c][3]=$row["id_estado"];		
				$c++;
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
//       Metodo Para el id estado por id ciudad
     public function buscar_ciudad(){
		 $c=0;
        $sql="select * from tciudad where id_ciudad = '$this->idCiudad' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 	$fila[$c][2]=$row["nombre"];
				$fila[$c][3]=$row["id_estado"];		
				$c++;
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
	  public function buscar_c_e_p(){
		 $c=0;
        $sql="SELECT a.id_ciudad,a.nombre as ciudad,b.id_estado, b.nombre as estado, b.id_pais, c.nombre as pais FROM tciudad as a, testado as b, tpais as c WHERE b.estatus='1' and b.id_pais=c.id_pais and a.id_estado=b.id_estado and id_ciudad = '$this->idCiudad' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 	$fila[$c][1]=$row["ciudad"];
				$fila[$c][2]=$row["estado"];
				$fila[$c][3]=$row["pais"];		
				$c++;
		 }		
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
//       Metodo Para Listar  Ciudad por Estado
    public function lista_ciudad(){		
			$combo = array();
			$c=0;
			$sql="select * from tciudad where id_estado = '$this->idEstado' ";		   
			$cursor = parent::ejecuta_sql($sql);
		if($row= parent::proxima_tupla($cursor))
		 {
			 do
			  {
				$fila[$c][1]=$row["id_ciudad"];
			 	$fila[$c][2]=$row["nombre"];
				$fila[$c][3]=$row["id_estado"];		
				$c++;
		 	  }while($row= parent::proxima_tupla($cursor));
		 }		 
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
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
