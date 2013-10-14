<?php
include_once("clase_mysql.php");
date_default_timezone_set('America/Caracas');
//       Clase cargo hereda a clase CModeloDatos para conectar BD MYSql
class detalle_solicitud extends conectaBDMy{
	private $idDetalleSolicitud;	
	private $idSolicitud;
	private $idMedicamento;
	private $idExamen;	
	private $cantidad;
	private $monto;
	private $descripcion;
	private $diagnostico;
	private $motivoConsulta;
	private $NroControl;
	private $nroFactura;
	private $montoFactura;
	private $montoAprobado;
//       Metodo Constructor de la clase
    public function detalle_solicitud(){
		parent::conectaBDMy();	    
		$this->idDetalleSolicitud="";		
		$this->idSolicitud="";	
		$this->idMedicamento="";
		$this->idExamen="";
		$this->cantidad="";
		$this->monto="";
		$this->descripcion="";
		$this->diagnostico="";
		$this->motivoConsulta="";
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
	public function setidDetalleSolicitud($Valor){
        $this->idDetalleSolicitud = trim($Valor);
    }
 	public function setidSolicitud($Valor){
        $this->idSolicitud = trim($Valor);
    }  
	public function setidMedicamento($Valor){
        $this->idMedicamento = trim($Valor);
    }
	public function setidExamen($Valor){
        $this->idExamen = trim($Valor);
    }
	public function setCantidad($Valor){
        $this->cantidad = trim($Valor);
    }
	public function setMonto($Valor){
        $this->monto = trim($Valor);
    }
	public function setDescripcion($Valor){
        $this->descripcion = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setDiagnostico($Valor){
        $this->diagnostico = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setmotivoConsulta($Valor){
        $this->motivoConsulta = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setnroFactura($Valor){
        $this->nroFactura = trim($Valor);
    }	
	public function setnroControl($Valor){
        $this->nroControl = trim($Valor);
    }	
	public function setmontoFactura($Valor){
        $this->montoFactura = trim($Valor);
    }
	public function setmontoAprobado($Valor){
        $this->montoAprobado = trim($Valor);
    }	
//       Metodo registrar
 public function iDetalle_solicitud(){	  
       $sql="INSERT INTO tdetalle_solicitud(id_detalle_solicitud,id_solicitud,id_medicamento,id_examen,motivo_consulta,diagnostico,descripcion,cantidad,monto_unitario,estatus) values('$this->idDetalleSolicitud','$this->idSolicitud','$this->idMedicamento','$this->idExamen','$this->motivoConsulta','$this->diagnostico','$this->descripcion','$this->cantidad','$this->monto','2')";
     $respuesta= parent::ejecuta_sql($sql);
	 parent::cerrar_bd();
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
	//       Metodo registrar
 public function iDetalle_reembolso(){	  
       $sql="INSERT INTO tdetalle_reembolso(id_detalle_reembolso,id_solicitud_reembolso,nro_factura,nro_control,descripcion,monto_factura,estatus) values('$this->idDetalleSolicitud','$this->idSolicitud','$this->nroFactura','$this->nroControl','$this->descripcion','$this->montoFactura','2')";
     $respuesta= parent::ejecuta_sql($sql);
	 parent::cerrar_bd();
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
public function mDetalle_solcitud_consulta(){
		$sql= "update  tdetalle_solicitud  set monto_unitario='$this->monto',estatus='1' where motivo_consulta='$this->motivoConsulta' and diagnostico='$this->diagnostico'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();			
}
public function mDetalle_solcitud_orden(){
		$sql= "update  tdetalle_solicitud  set monto_unitario='$this->monto',estatus='1' where id_examen='$this->idExamen' and descripcion='$this->descripcion'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
				
				parent::cerrar_bd();			
}
//       Metodo Modificar
 public function eDetalle_Serv(){	  
       $sql="DELETE tdetalle_servicio.* FROM tdetalle_servicio where id_proveedor='$this->idProveedor'";	  
     	$respuesta= parent::ejecuta_sql($sql);
		
		 if($respuesta>0)
			return -1;//Exito
	 	 else
	     	return 2;//Fallo Registro
			
			parent::cerrar_bd();
			
    }	
//       Metodo para buscar los servicios
	function buscar_servicios()
	{ 
		$c=0;
		$sql="select * from tdetalle_servicio where id_proveedor='$this->idProveedor' and estatus='1'";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_detalle_servicio"];
				$fila[$c][2]=$row["id_servicio"];	
				$fila[$c][3]=$row["id_proveedor"];								
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}   
//       Metodo Buscar ultmimo
    public function UltimoID_solicitud(){
       $sql="SELECT * FROM tdetalle_solicitud ORDER BY id_detalle_solicitud DESC LIMIT 1";
	return ($cursor= parent::ejecuta_sql($sql));
	
    }	
//       Metodo Buscar ultmimo
    public function UltimoID_detalle_Reembolso(){
       $sql="SELECT * FROM tdetalle_reembolso ORDER BY id_detalle_reembolso DESC LIMIT 1";
	return ($cursor= parent::ejecuta_sql($sql));
	
    }
//       Metodo transforma un recorset en una arreglo
    public function sig_tupla( $registro ) 
	{ 
		return( parent::proxima_tupla( $registro ) ); 
	}  
}//cierra la clase
?>