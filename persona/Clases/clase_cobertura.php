<?php
include_once("clase_mysql.php");
//       Clase cobertura hereda a clase CModeloDatos para conectar BD MYSql
class cobertura extends conectaBDMy{
	private $idCobertura;	
	private $idTitular;
	private $desc;
	private $tipo;
	private $monto;
	private $fecha_inicio;
	private $fecha_fin;
	private $montoDisponible;
	private $idDetalle_cobertura;
	private $tipoBeneficiario;	
	private $idBeneficiario;
//  Metodo Constructor de la clase
    public function cobertura(){
		parent::conectaBDMy();	    
		$this->idCobertura="";		
		$this->idTitular="";
		$this->desc="";
		$this->tipo="";	
		$this->monto="";	
		$this->idDetalle_cobertura="";
		$this->montoDisponible="";	
		$this->fecha_inicio="";	
		$this->fecha_fin="";
		$this->tipoBeneficiario="";
		$this->idBeneficiario="";			
	}
//       Metodos Set para cada propiedad de la clase
 	public function setidCobertura($Valor){
        $this->idCobertura = trim($Valor);
    }  
    public function setidTitular($Valor){
        $this->idTitular = trim($Valor);
    }  
	public function setDesc($Valor){
        $this->desc = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setTipo($Valor){
        $this->tipo = mb_strtoupper(trim($Valor), "utf-8");
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
    public function setidDetalle_cobertura($Valor){
        $this->idDetalle_cobertura = trim($Valor);
    }
    public function setmontoDisponible($Valor){
        $this->montoDisponible = trim($Valor);
    }
    public function setidBeneficiario($Valor){
        $this->idBeneficiario = trim($Valor);
    }
    	public function settipoBeneficiario($Valor){
        $this->tipoBeneficiario = trim($Valor);
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
 	public function iDetalle_cobertura(){
		$fecha  = date('Y-m-d');
		$sql= "insert into tdetalle_cobertura(id_detalle_cobertura,id_cobertura,id_titular,id_beneficiario,tipo_beneficiario,id_solicitud,monto_disponible,fecha,estatus)  values('$this->idDetalle_cobertura',
		'$this->idCobertura',
		'$this->idTitular',
		'$this->idBeneficiario',
		'$this->tipoBeneficiario',
		'$this->idSolicitud',
		'$this->montoDisponible',
		'$fecha',
		'1')";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
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
public function bDetalle_cobertura(){
			  $sql="SELECT * FROM tdetalle_cobertura WHERE id_titular='$this->idTitular' order by fecha DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
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
	public function buscar_cobertura(){
		  $sql="SELECT * FROM tcobertura WHERE descripcion='SERVICIOS PRIMARIOS'";
		return ($cursor= parent::ejecuta_sql($sql));
	}	
//       Metodo Buscar ultmimo
    public function UltimoID_dCobertura(){
       $sql="SELECT * FROM tdetalle_cobertura ORDER BY id_detalle_cobertura DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }
//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	} 
 //--------------------------------------------------------------------
//       Metodo indica la cantidad de tuplas leidas
//--------------------------------------------------------------------
     public function getNTupla($resultado){
        return ( parent::getNRegistro($resultado)  );
     }	
}//cierra la clase
?>
