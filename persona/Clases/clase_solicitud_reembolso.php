<?php
include_once("clase_mysql.php");
//       Clase Entrada hereda a clase CModeloDatos para conectar BD MYSql
class sReembolso extends conectaBDMy{
	private $idSolicitud_reembolso;	
	private $tipoBeneficiario;	
	private $cedTitular;
	private $idTitular;		
	private $idBeneficiario;
	private $observacion;
	private $diagnostico;
	private $idDetalle_cobertura;
	private $idCobertura;
	private $idRecaudos;	
	private $idSolicitud_recaudos;	
	private $motivo;
	private $monto;
	private $montoDisponible;
	private $idServicio;
	private $codHoja;
	//       Metodo Constructor de la clase
    public function sOrden(){
		parent::conectaBDMy();	
		$this->idSolicitud_reembolso="";    
		$this->tipoBeneficiario="";
		$this->cedTitular="";
		$this->idTitular="";
		$this->idBeneficiario="";
		$this->observacion="";
		$this->diagnostico="";
		$this->idDetalle_cobertura="";
		$this->idCobertura="";
		$this->idRecaudos="";
		$this->idSolicitud_recaudos="";
		$this->motivo="";	
		$this->monto="";	
		$this->montoDisponible="";	
		$this->idServicio="";
		$this->codHoja="";
		}//cirre del constructor
	public function setidSolicitud_reembolso($Valor){
        $this->idSolicitud_reembolso = trim($Valor);
    }	
	public function settipoBeneficiario($Valor){
        $this->tipoBeneficiario = trim($Valor);
    }
    public function setcedTitular($Valor){
        $this->cedTitular = trim($Valor);
    }
	public function setidTitular($Valor){
        $this->idTitular = trim($Valor);
    }
	public function setidBeneficiario($Valor){
        $this->idBeneficiario = trim($Valor);
    }
	public function setObservacion($Valor){
        $this->observacion = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setDiagnostico($Valor){
        $this->diagnostico = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setMotivo($Valor){
        $this->motivo = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setMonto($Valor){
        $this->monto = trim($Valor);
    }	
	public function setidDetalle_cobertura($Valor){
        $this->idDetalle_cobertura = trim($Valor);
    }
	public function setidCobertura($Valor){
        $this->idCobertura = trim($Valor);
    }
	public function setidRecaudos($Valor){
        $this->idRecaudos = trim($Valor);
    }
	public function setmontoDisponible($Valor){
        $this->montoDisponible = trim($Valor);
    }
	public function setidSolicitud_recaudos($Valor){
        $this->idSolicitud_recaudos = trim($Valor);
    }
	public function setidServicio($Valor){
        $this->idServicio = trim($Valor);
    }
	public function setcodHoja($Valor){
        $this->codHoja = trim($Valor);
    }
	//       Metodo registrar
 public function iSolicitud_Reembolso(){
		$hora= time();
	   $fecha  = date('Y-m-d');    
       $sql="INSERT INTO tsolicitud_servicio(id_solicitud_reembolso, cod_hoja, id_titular, id_beneficiario, tipo_beneficiario, id_servicio, fecha, diagnostico, observacion, hora, estatus)VALUES(
	   '$this->idSolicitud_reembolso', 
	   '$this->codHoja', 
	   '$this->idTitular',
	   '$this->idBeneficiario',
	   '$this->tipoBeneficiario',
	   '$this->idServicio', 
	   '$fecha', 
	   '$this->diagnostico', 
	   '$this->observacion',
	   '$hora', 	     
	   '2')";
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
public function mDetalle_reembolso(){
		$sql= "update tdetalle_reembolso  set monto_aprobado='$this->monto',estatus='1' where id_solicitud_reembolso='$this->idSolicitud_reembolso'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();
}
public function solicitudProcesada(){
		$sql= "update tsolicitud_servicio  set estatus='1' where id_solicitud_reembolso='$this->idSolicitud_reembolso'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();
}
 public function validar_solicitud_reembolso(){
       $sql="SELECT * FROM tsolicitud_servicio where id_titular='$this->idTitular' ORDER BY id_solicitud_reembolso DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }
	 public function cabecera_Reembolso(){
		   if($this->idTitular!=NULL){
       $sql="SELECT a. * , b.nombre1, b.nombre2, b.apellido1, b.apellido2, b.tipo_nomina AS nomina, b.telefono, b.celular, b.cedula, b.nacionalidad, c.nombre as servicio, d.nombre AS upsa
FROM tsolicitud_servicio AS a, ttitular AS b, tservicio_proveedor AS c, tupsa AS d
WHERE a.id_titular =   '$this->idTitular'
AND a.id_titular = b.id_titular
AND a.id_servicio = c.id_servicio
AND b.id_upsa = d.id_upsa order by a.id_solicitud_reembolso DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
	  }
		 if($this->idSolicitud_reembolso!=NULL){
       $sql="SELECT a. * , b.nombre1, b.nombre2, b.apellido1, b.apellido2, b.tipo_nomina AS nomina, b.telefono, b.celular, b.cedula, b.nacionalidad, c.nombre as servicio, d.nombre AS upsa
FROM tsolicitud_servicio AS a, ttitular AS b, tservicio_proveedor AS c, tupsa AS d
WHERE a.id_solicitud_reembolso =   '$this->idSolicitud_reembolso'
AND a.id_titular = b.id_titular
AND a.id_servicio = c.id_servicio
AND b.id_upsa = d.id_upsa";		
		return ($cursor= parent::ejecuta_sql($sql));
		  }
		   if($this->codHoja!=NULL){
       $sql="SELECT a. * , b.nombre1, b.nombre2, b.apellido1, b.apellido2, b.tipo_nomina AS nomina, b.telefono, b.celular, b.cedula, b.nacionalidad, c.nombre as servicio, d.nombre AS upsa
FROM tsolicitud_servicio AS a, ttitular AS b, tservicio_proveedor AS c, tupsa AS d
WHERE a.cod_hoja =   '$this->codHoja'
AND a.id_titular = b.id_titular
AND a.id_servicio = c.id_servicio
AND b.id_upsa = d.id_upsa";		
		return ($cursor= parent::ejecuta_sql($sql));
		  }
    }
	public function Detalle_reembolso(){
		$c=0;
       $sql="SELECT * FROM tdetalle_reembolso WHERE id_solicitud_reembolso='$this->idSolicitud_reembolso'";	
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 do{				 				
				$fila[$c][1]=$row["nro_factura"];	
				$fila[$c][2]=$row["nro_control"];	
				$fila[$c][3]=$row["descripcion"];	
				$fila[$c][4]=$row["monto_factura"];
				$fila[$c][5]=$row["monto_aprobado"];	
				$c++;
			}while($row= parent::proxima_tupla($cursor));
		 }			
		return $fila;		
    }
	public function buscar_reacudos_solicitud(){
		$c=0;
       $sql="SELECT a.*,b.* FROM  tsolicitud_recaudo as a, trecaudo as b WHERE a.id_solicitud_reembolso ='$this->idSolicitud_reembolso' and a.id_recaudo=b.id_recaudo	";	
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 DO{
				$fila[$c][1]=$row["id_recaudo"];	
				$fila[$c][2]=$row["descripcion"];	
				$c++;
			}while($row= parent::proxima_tupla($cursor));
		 }			
		return $fila;		
    }
	public function montoDisponible(){
		if($this->idBeneficiario!=NULL){
		  $sql="SELECT * FROM tdetalle_cobertura WHERE id_beneficiario='$this->idBeneficiario' ORDER BY id_detalle_cobertura  DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
		}
		if($this->idTitular!=NULL){
		  $sql="SELECT * FROM tdetalle_cobertura WHERE id_titular='$this->idTitular' ORDER BY id_detalle_cobertura  DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
		}
	}
	public function buscar_cobertura(){
		  $sql="SELECT * FROM tcobertura WHERE descripcion='SERVICIOS PRIMARIOS'";
		return ($cursor= parent::ejecuta_sql($sql));
	}
	 public function consultar_beneficiario(){
       $sql="SELECT * FROM tbeneficiario WHERE id_beneficiario='$this->idBeneficiario'";
		return ($cursor= parent::ejecuta_sql($sql));
    }	
//	   Metodo Buscar ultmimo
    public function UltimoID_dCobertura(){
       $sql="SELECT * FROM tdetalle_cobertura ORDER BY id_detalle_cobertura DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }	
		
//       Metodo Buscar ultmimo
    public function buscaUltimoID(){
       $sql="SELECT * FROM tsolicitud_servicio ORDER BY id_solicitud_reembolso DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }	
//       Metodo le indica al SMBD que inicie una transaccion
    public function IniciaTransaccion(){
	   $sql="BEGIN";
	   parent::ejecuta_sql($sql);
	  
    }
//       Metodo le indica al SMBD que deshaga una transaccion
    public function RompeTransaccion(){
	   $sql="ROLLBACK";
	   parent::ejecuta_sql($sql);
	  
    }
//       Metodo le indica al SMBD que finalizo bien una transaccion
    public function FinTransaccion(){
	   $sql="BEGIN";
	   parent::ejecuta_sql($sql);
	   parent::cerrar_bd();
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
	
}

?>