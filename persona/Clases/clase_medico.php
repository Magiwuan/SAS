<?php
include_once("clase_mysql.php");
//       Clase Entrada hereda a clase CModeloDatos para conectar BD MYSql
class medico extends conectaBDMy{
	private $idMedico;
	private $nac;	
	private $nomb;
	private $apell;
	private $ced;
	private $espec;
	private $idProveedor;
	private $ordenar_por;

//       Metodo Constructor de la clase
    public function medico(){
		parent::conectaBDMy();	    
		$this->idMedico="";
		$this->nac="";
		$this->nomb="";
		$this->apell="";
		$this->ced="";
		$this->espec="";
		$this->idProveedor="";
		$this->ordenar_por="";
	
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidMedico($Valor){
        $this->idMedico = trim($Valor);
    }
	public function setNacionalidad($Valor){
        $this->nac = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setNombre($Valor){
        $this->nomb = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setApellido($Valor){
        $this->apell = mb_strtoupper(trim($Valor), "utf-8");
    }
	public function setCedula($Valor){
        $this->ced = trim($Valor);
    }
	public function setEspecialidad($Valor){
        $this->espec = trim($Valor);
    }
	public function setOrden($Valor){
        $this->ordenar_por = trim($Valor);
    }	
//       Metodo registrar
 public function iMedico(){
       $sql="INSERT INTO tmedico(id_medico,nacionalidad,cedula, nombre, apellido, id_especialidad,estatus)VALUES(
	   '$this->idMedico',
	   '$this->nac', 
	   '$this->nomb', 
	   '$this->apell', 
	   '$this->ced', 
	   '$this->espec',
	   '1')";
     $respuesta= parent::ejecuta_sql($sql);
	 if($respuesta>0)
		  return -1;//Exito
	   else
	      return 1;//Fallo Registro
		  
		  parent::cerrar_bd();
    }
//       Metodo Modificar
	function mMedico() {
		$sql= "UPDATE tmedico SET 
				nacionalidad		='$this->nac',
				nombre 				='$this->nomb',
				apellido		 	='$this->apell',
				cedula	 			='$this->ced',
				id_especialidad		='$this->espec',
				estatus 			='1' 
			   WHERE 
			   	id_medico =  '$this->idMedico'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();

	}
//       Metodo Eliminar
public function eMedico(){
		$sql= "update tmedico set estatus='0' where id_medico='$this->idMedico'";
		$respuesta = parent::ejecuta_sql( $sql );
			if ( $respuesta>0 )
				return -1;// Exito
			else
				return 1;//fallo la operacion
			
				parent::cerrar_bd();
}
//       Metodo Buscar ultmimo
    public function medico_UltimoID(){
       $sql="SELECT * FROM tmedico ORDER BY id_medico DESC LIMIT 1";
		return ($cursor= parent::ejecuta_sql($sql));
    }
//       Metodo Listar Medico
function lista_medico()
	{ 
		$c=0;
		$sql="select * from tmedico where estatus='1' order by apellido";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_medico"];
				$fila[$c][4]=$row["apellido"];			
				$c++;				 
			 }WHILE($row= parent::proxima_tupla($cursor));
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
		parent::cerrar_bd();
	}   
//       Metodo Para Buscar idMedico
     public function buscar_id(){
		$c=0;
        $sql="select * from tmedico where id_medico = '$this->idMedico' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor)){
								
				$fila[$c][1]=$row["id_medico"];
				$fila[$c][2]=$row["nacionalidad"];
		 		$fila[$c][3]=$row["nombre"];
				$fila[$c][4]=$row["apellido"];
				$fila[$c][5]=$row["cedula"];
				$fila[$c][6]=$row["id_especialidad"];
				$c++;			
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }
//       Metodo Para Buscar RIF
        public function validar_medico(){
		 $c=0;
        $sql="select * from tmedico where cedula = '$this->ced' ";
		$cursor=parent::ejecuta_sql($sql);		 
		if($row= parent::proxima_tupla($cursor)){				
		 		$fila[$c][5]=$row["cedula"];				
				$c++;			
		 }
		if ( $fila>0 )
			return $fila;
		else
			return -1;
			
			parent::cerrar_bd();
     }		 
//       Sentencia sql para Buscar el listar
      public function sql(){
        $sql="select a.id_medico, a.nombre, a.apellido, a.cedula, a.id_especialidad, b.nombre as especialidad from tmedico as a, tespecialidad as b where a.estatus=1 and a.id_especialidad=b.id_especialidad";
		if ($this->apell!=NULL)
		$sql .= " and apellido like '$this->apell%'";	
		if($this->ordenar_por=='0')						
		$sql .= " order by 3 asc";				
		if ($this->ordenar_por=='1')
			$sql .= " order by 3 asc";		
		if ($this->ordenar_por=='2')
			$sql .= " order by 4 desc";	
		if ($this->ordenar_por=='3')
			$sql .= " order by 3,4 desc";				
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		$resulta=parent::getNRegistro($cursor); 		
		if($resulta>0)
			return $sql;
			else 
			return -1;		
			
			parent::cerrar_bd();
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
}//cierra la clase

//       Metodo Constructor de la clase
?>
