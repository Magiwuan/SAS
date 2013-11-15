<?php
include_once("clase_mysql.php");
//       Clase Entrada hereda a clase CModeloDatos para conectar BD MYSql
class sOrden extends conectaBDMy{
	private $idSolicitud;
	private $idProveedor;
	private $tipoBeneficiario;	
	private $cedTitular;
	private $idTitular;	
	private $idBeneficiario;
	private $Patologia;
	private $observacion;
	private $idRecaudos;	
	private $idSolicitud_recaudos;
	private $idServicio;
	private $motivo;
	private $monto;
	private $idDetalle_cobertura;
	private $idCobertura;
	private $montoDisponible;
	private $idMedico;
	private $tipoServicio;
	private $codHoja;
	//       Metodo Constructor de la clase
    public function sOrden(){
		parent::conectaBDMy();	
		$this->idSolicitud="";    
		$this->idProveedor="";
		$this->tipoBeneficiario="";
		$this->cedTitular="";
		$this->idTitular="";
		$this->idBeneficiario="";
		$this->Patologia="";
		$this->observacion="";
		$this->idRecaudos="";
		$this->idSolicitud_recaudos="";
		$this->idServicio="";	
		$this->motivo="";	
		$this->monto="";
		$this->idDetalle_cobertura="";
		$this->idCobertura="";
		$this->montoDisponible="";	
		$this->idMedico="";
		$this->tipoServicio="";
		$this->codHoja="";
		
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
	public function setPatologia($Valor){
        $this->Patologia= trim($Valor);
    }
	public function setObservacion($Valor){
        $this->observacion = strtoupper(trim($Valor));
    }
	public function setidRecaudos($Valor){
        $this->idRecaudos = trim($Valor);
    }

	public function setidMedico($Valor){
        $this->idMedico = trim($Valor);
    }
	public function setidSolicitud_recaudos($Valor){
        $this->idSolicitud_recaudos = trim($Valor);
    }
	public function setidServicio($Valor){
        $this->idServicio = trim($Valor);
    }public function setMotivo($Valor){
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
	public function settipoServicio($Valor){
        $this->tipoServicio = trim($Valor);
    }
	public function setcodHoja($Valor){
        $this->codHoja = trim($Valor);
    }
	
	//       Metodo registrar
 public function iSolicitud_Orden(){
		$hora= time();
	   $fecha  = date('Y-m-d');
       $sql="INSERT INTO tsolicitud_servicio(id_solicitud,cod_hoja,tipo_beneficiario,id_titular,id_beneficiario,id_servicio,id_patologia,fecha,observacion,id_medico,id_proveedor,estatus,hora)VALUES(
	   '$this->idSolicitud', 
	   '$this->codHoja',
	   '$this->tipoBeneficiario', 
	   '$this->idTitular', 
	   '$this->idBeneficiario',
	   '$this->idServicio', 
	   '$this->Patologia',
	   '$fecha', 
	   '$this->observacion', 
	   '$this->idMedico',
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
	 public function consultar_beneficiario(){
       $sql="SELECT * FROM tbeneficiario WHERE id_beneficiario='$this->idBeneficiario'";
		return ($cursor= parent::ejecuta_sql($sql));
    }		
 public function validar_solicitud(){
       $sql="SELECT * FROM tsolicitud_servicio where id_titular='$this->idTitular' ORDER BY id_solicitud DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }
	 public function buscar_medico(){
       $sql="SELECT a.id_proveedor, a.id_medico, b.nombre, b.apellido, b.nacionalidad, b.cedula, c.nombre AS especialidad
FROM tproveedor_medico AS a, tmedico AS b, tespecialidad AS c WHERE a.id_medico =  '$this->idMedico' AND a.id_medico = b.id_medico
AND b.id_especialidad = c.id_especialidad";
		return ($cursor= parent::ejecuta_sql($sql));
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
	
	public function detalle_SM_1(){
		$c=0;
		if($this->tipoServicio!='5'){
       $sql="SELECT a. * , b.descripcion as examen FROM tdetalle_solicitud AS a, texamen AS b WHERE id_solicitud ='$this->idSolicitud' AND a.id_examen = b.id_examen";			 
		$cursor=parent::ejecuta_sql($sql);		 
			if($row= parent::proxima_tupla($cursor)){
				do{
					$fila[$c][1]=$row["descripcion"];	
					$fila[$c][2]=$row["cantidad"];		
					$fila[$c][3]=$row["id_examen"];	
					$fila[$c][4]=$row["examen"];
					$fila[$c][5]=$row["motivo_consulta"];
					$fila[$c][6]=$row["diagnostico"];
					$c++;
				}while($row= parent::proxima_tupla($cursor));
			 }			
		 }
		 if($this->tipoServicio=='5'){		 
			  $sql="SELECT a.* FROM tdetalle_solicitud AS a WHERE a.id_solicitud ='$this->idSolicitud'";			 
			$cursor=parent::ejecuta_sql($sql);		 
			if($row= parent::proxima_tupla($cursor)){
				do{
					$fila[$c][1]=$row["cantidad"];		
					$fila[$c][2]=$row["motivo_consulta"];
					$fila[$c][3]=$row["diagnostico"];
					$c++;
				}while($row= parent::proxima_tupla($cursor));
			 }				 
		 }
		return $fila;	
	
    }
	
	public function buscar_reacudos_solicitud(){
		$c=0;
       $sql="SELECT a.*,b.* FROM  tsolicitud_recaudo as a, trecaudo as b WHERE a.id_solicitud ='$this->idSolicitud' and a.id_recaudo=b.id_recaudo	";	
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
