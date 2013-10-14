<?php
include_once("clase_mysql.php");
//       Clase motivo hereda a clase CModeloDatos para conectar BD MYSql
class motivo extends conectaBDMy{
	private $idMotivo;	
	private $nom;
//       Metodo Constructor de la clase
    public function motivo(){
		parent::conectaBDMy();	    
		$this->idMotivo="";		
		$this->nom="";		
	}//cirre del constructor
//       Metodos Set para cada propiedad de la clase
 	public function setidMotivo($Valor){
        $this->idMotivo = trim($Valor);
    }  
	public function setNom($Valor){
        $this->nom = mb_strtoupper(trim($Valor), "utf-8");
    }

//       Metodo para listar motivo en los combos
	function lista_motivo()
	{ 
		$c=0;
		$sql="select * from tmotivo where estatus='1' order by nombre";		
		 $cursor=parent::ejecuta_sql($sql);
		 if($row= parent::proxima_tupla($cursor))
		 {
			 DO
			 {
				$fila[$c][1]=$row["id_motivo"];
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

}//cierra la clase
?>