<?php
include_once("clase_mysql.php");
//       Clase Entrada hereda a clase CModeloDatos para conectar BD MYSql
class reporte extends conectaBDMy{
	private $ced;
	private $ordenar_por;
	
	//       Metodo Constructor de la clase
    public function reporte(){
		parent::conectaBDMy();
		$this->ced="";
		$this->ordenar_por="";	    
	
	}
	public function setCed($Valor){
        $this->ced = trim($Valor);
    }
    	public function setOrden($Valor){
        $this->ordenar_por = mb_strtoupper(trim($Valor), "utf-8");
    }
//       Sentencia sql para listar
     public function sql(){
        $sql="select id_titular,nacionalidad,cedula,nombre1,nombre2,apellido1,apellido2,telefono from ttitular where estatus=1";
		if ($this->ced!=NULL)
		$sql .= " and cedula like '$this->ced%'";	
		if($this->ordenar_por=='0')						
		$sql .= " order by 5 asc";				
		if ($this->ordenar_por=='1')
			$sql .= " order by 5 asc";		
		if ($this->ordenar_por=='2')
			$sql .= " order by 2 desc";	
		if ($this->ordenar_por=='3')
			$sql .= " order by 5,2 desc";			
		$cursor=parent::ejecuta_sql($sql);	
// verifica que la consulta arroje al menos 1 fila para poder enviar la sentencia sql
		if(parent::getNRegistro($cursor)>0)
			return $sql;
			else 
			return -1;		
			
			parent::cerrar_bd();
     }	
}	 
?>
