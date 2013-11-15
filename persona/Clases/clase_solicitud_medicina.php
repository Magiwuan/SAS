<?php
include_once("clase_mysql.php");
date_default_timezone_set('America/Caracas');
//       Clase Entrada hereda a clase CModeloDatos para conectar BD MYSql
class sMedicina extends conectaBDMy{
	private $idSolicitud;
	private $idProveedor;
	private $tipoBeneficiario;	
	private $cedTitular;
	private $idTitular;	
	private $idBeneficiario;
	private $nombAutorizado;
	private $cedAutorizado;
	private $Tratamiento;
	private $fechaIni;
	private $fechaFin;
	private $Patologia;
	private $idMedicamento;
	private $cantMedicamento;
	private $observacion;
	private $idRecaudos;	
	private $idSolicitud_recaudos;
	private $idServicio;
	private $motivo;
	private $monto;
	private $idDetalle_cobertura;
	private $idCobertura;
	private $montoDisponible;
	private $ordenar_por;
	private $codHoja;
	private $nroControl;
	private $nroFactura;
//       Metodo Constructor de la clase
    public function sMedicina(){
		parent::conectaBDMy();	
		$this->idSolicitud="";    
		$this->idProveedor="";
		$this->tipoBeneficiario="";
		$this->cedTitular="";
		$this->idTitular="";
		$this->idBeneficiario="";
		$this->nombAutorizado="";
		$this->cedAutorizado="";
		$this->Tratamiento="";
		$this->fechaIni="";
		$this->fechaFin="";
		$this->Patologia="";
		$this->idMedicamento="";
		$this->cantMedicamento="";
		$this->observacion="";
		$this->idRecaudos="";
		$this->idSolicitud_recaudos="";
		$this->idServicio="";	
		$this->motivo="";	
		$this->monto="";
		$this->idDetalle_cobertura="";
		$this->idCobertura="";
		$this->montoDisponible="";
		$this->ordenar_por="";
		$this->codHoja="";
		$this->nroControl="";
		$this->nroFactura="";
			
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
	public function setidSolicitud($Valor){
        $this->idSolicitud = trim($Valor);
    }
    public function setidProveedor($Valor){
        $this->idProveedor = trim($Valor);
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
	public function setnombAutorizado($Valor){
        $this->nombAutorizado = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setcedAutorizado($Valor){
        $this->cedAutorizado= trim($Valor);
    }
	public function setTratamiento($Valor){
        $this->Tratamiento = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setfechaIni($Valor){
        $this->fechaIni = trim($Valor);
    }
	public function setfechaFin($Valor){
        $this->fechaFin= trim($Valor);
    }
	public function setPatologia($Valor){
        $this->Patologia= trim($Valor);
    }
	public function setidMedicamento($Valor){
        $this->idMedicamento = trim($Valor);
    }
	public function setcantMedicamento($Valor){
        $this->cantMedicamento = trim($Valor);
    }
	public function setObservacion($Valor){
        $this->observacion = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setidRecaudos($Valor){
        $this->idRecaudos = trim($Valor);
    }
	public function setidSolicitud_recaudos($Valor){
        $this->idSolicitud_recaudos = trim($Valor);
    }
	public function setidServicio($Valor){
        $this->idServicio = trim($Valor);
    }
	public function setOrden($Valor){
        $this->ordenar_por = trim($Valor);
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
	public function setmontoDisponible($Valor){
        $this->montoDisponible = trim($Valor);
    }
	public function setcodHoja($Valor){
        $this->codHoja = trim($Valor);
    }
	public function setnroControl($Valor){
        $this->nroControl = trim($Valor);
    }
	public function setnroFactura($Valor){
        $this->nroFactura = trim($Valor);
    }
//       Metodo registrar
 public function iSolicitud_Medicina(){
	 $hora= time();
	   $fecha  = date('Y-m-d');
       $sql="INSERT INTO tsolicitud_servicio(id_solicitud,cod_hoja,tipo_beneficiario,id_titular,id_beneficiario,autorizado,ced_autorizado,tratamiento,fecha_ini,fecha_fin,id_servicio,id_patologia,fecha,observacion,id_proveedor,estatus,hora)VALUES(
	   '$this->idSolicitud', 
	   '$this->codHoja', 
	   '$this->tipoBeneficiario', 
	   '$this->idTitular', 
	   '$this->idBeneficiario',
	   '$this->nombAutorizado', 
	   '$this->cedAutorizado', 
	   '$this->Tratamiento', 
	   '$this->fechaIni', 
	   '$this->fechaFin', 	     
	   '$this->idServicio', 
	   '$this->Patologia',
	   '$fecha', 
	   '$this->observacion', 
	   '$this->idProveedor',	    
	   '2',
	   '$hora')";
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
public function solicitudProcesada(){
		$sql= "update tsolicitud_servicio  set estatus='1' where id_solicitud='$this->idSolicitud'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();
}
public function solicitudAceptada(){
		$sql= "update tsolicitud_servicio set estatus='3' where cod_hoja='$this->codHoja'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();
}
	//       Metodo Eliminar
public function eSolicitud(){
		$sql= "update tsolicitud_servicio  set estatus='0',motivo_eliminacion='$this->motivo' where id_solicitud='$this->idSolicitud'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();
}
public function mDetalle_solcitud(){
		$sql= "update  tdetalle_solicitud  set nro_factura='$this->nroFactura', nro_control='$this->nroControl', 
		monto_unitario='$this->monto',estatus='1' where id_solicitud='$this->idSolicitud' and id_medicamento='$this->idMedicamento'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();			
}
	public function buscar_id_solicitud(){
		$sql="SELECT * from tsolicitud_servicio where cod_hoja='$this->idSolicitud' and estatus='3'";		
		$cursor=parent::ejecuta_sql($sql);	
		if($this->getNTupla($cursor)>0)
		return $cursor;
		else
		return -1;
		
    }
	 public function validar_solicitud(){
       $sql="SELECT * FROM tsolicitud_servicio where id_titular='$this->idTitular' ORDER BY id_solicitud DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }
	 public function buscar_idservicio(){
       $sql="SELECT * FROM tsolicitud_servicio where id_solicitud='$this->idSolicitud'";
		return ($cursor= parent::ejecuta_sql($sql));
    }
	public function buscar_cobertura(){
		  $sql="SELECT * FROM tcobertura WHERE descripcion='SERVICIOS PRIMARIOS'";
		return ($cursor= parent::ejecuta_sql($sql));
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
	  public function cabecera_SM(){
		   if($this->idTitular!=NULL){
       $sql="SELECT a.*, b.nombre1, b.nombre2, b.apellido1, b.apellido2, b.cedula,b.nacionalidad, c.descripcion, d.alias, d.telefono, d.direccion, e.nombre as upsa
			FROM tsolicitud_servicio AS a, ttitular AS b, tservicio_proveedor AS c, tproveedor AS d, tupsa as e
			WHERE a.id_titular =  '$this->idTitular'
			AND a.id_titular = b.id_titular
			AND a.id_servicio = c.id_servicio
			AND a.id_proveedor = d.id_proveedor and b.id_upsa=e.id_upsa ORDER BY a.id_solicitud DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
	  }
		 if($this->idSolicitud!=NULL){
       $sql="SELECT a.*, b.nombre1, b.nombre2, b.apellido1, b.apellido2, b.cedula,b.nacionalidad, c.descripcion, d.alias, d.telefono, d.direccion, e.nombre as upsa
			FROM tsolicitud_servicio AS a, ttitular AS b, tservicio_proveedor AS c, tproveedor AS d, tupsa as e
			WHERE a.id_solicitud =  '$this->idSolicitud'
			AND a.id_titular = b.id_titular
			AND a.id_servicio = c.id_servicio
			AND a.id_proveedor = d.id_proveedor
			and b.id_upsa=e.id_upsa";
		return ($cursor= parent::ejecuta_sql($sql));
		  }
    }
	  public function consultar_beneficiario(){
       $sql="SELECT * FROM tbeneficiario WHERE id_beneficiario='$this->idBeneficiario'";
		return ($cursor= parent::ejecuta_sql($sql));
    }	

	public function detalle_SM(){
		$c=0;
       $sql="SELECT a.*,b.descripcion 
			   FROM 
			   tdetalle_solicitud as a, tmedicamento as b 
			   WHERE 
			   id_solicitud='$this->idSolicitud' and a.id_medicamento=b.id_medicamento";			 
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor))
		 {
			 DO{
				$fila[$c][1]=$row["descripcion"];	
				$fila[$c][2]=$row["cantidad"];		
				$fila[$c][3]=$row["id_medicamento"];		
				$c++;
			}while($row= parent::proxima_tupla($cursor));
		 }			
		if($fila>0)		
		return $fila;	
		else
		return -1;			
    }
	public function sql(){
       $sql="SELECT a.*,b.nacionalidad,b.nombre1,b.nombre2,b.apellido1, b.apellido2,b.cedula,c.nombre,c.nombre as servicio
FROM tsolicitud_servicio as a, ttitular as b, tservicio_proveedor as c WHERE a.estatus='2' and a.id_servicio=c.id_servicio and";
		if($this->idTitular!=NULL)
		$sql.=" b.cedula like '$this->idTitular%' and";	
		if($this->ordenar_por=='0')						
		$sql .= " a.id_titular=b.id_titular AND a.id_servicio=c.id_servicio order by a.fecha asc";				
		if ($this->ordenar_por=='1')
			$sql .= " a.id_titular=b.id_titular AND a.id_servicio=c.id_servicio  order by b.apellido1 asc";		
		if ($this->ordenar_por=='2')
			$sql .= " a.id_titular=b.id_titular AND a.id_servicio=c.id_servicio order by b.cedula desc";	
		if ($this->ordenar_por=='3')
			$sql .= " a.id_titular=b.id_titular AND a.id_servicio=c.id_servicio  order by b.apellido1,b.cedula desc";			
		$cursor=parent::ejecuta_sql($sql);	
		$resulta=$this->getNTupla($cursor);
		if($resulta>0)
			return $sql;
		else 
			return -1;	
    }
	
	public function buscar_solicitud(){
		$sql="SELECT a. * , b.nombre1, b.nombre2, b.apellido1, b.apellido2, b.cedula, b.nacionalidad, c.descripcion,d.nombre as organizacion,d.rif, d.alias, d.telefono, d.direccion, e.nombre as patologia
			FROM tsolicitud_servicio AS a, ttitular AS b, tservicio_proveedor AS c, tproveedor AS d, tpatologia AS e
			WHERE a.cod_hoja =  '$this->codHoja'
			AND a.estatus =  '3'
			AND a.id_titular = b.id_titular
			AND a.id_servicio = c.id_servicio
			AND a.id_proveedor = d.id_proveedor
			AND a.id_patologia = e.id_patologia";
		$cursor=parent::ejecuta_sql($sql);	
		$resulta=$this->getNTupla($cursor);
		if($resulta>0)
			return $cursor;
		else 
			return -1;
    }
	public function buscar_reacudos_solicitud(){
		$c=0;
       $sql="SELECT a.*,b.* FROM  tsolicitud_recaudo as a, trecaudo as b WHERE a.id_solicitud ='$this->idSolicitud' and a.id_recaudo=b.id_recaudo";			 
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
	
		public function buscar_idSolicitud(){
       $sql="SELECT * FROM  tsolicitud_servicio WHERE id_solicitud =  '$this->idSolicitud'";			 
		return ($cursor= parent::ejecuta_sql($sql));		
    }
	
//       Metodo Buscar ultmimo
    public function UltimoID_dCobertura(){
       $sql="SELECT * FROM tdetalle_cobertura ORDER BY id_detalle_cobertura DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }
//       Metodo Buscar ultmimo
    public function buscaUltimoID(){
       $sql="SELECT * FROM tsolicitud_servicio ORDER BY id_solicitud DESC LIMIT 1";
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
}//cierra la clase

?>
