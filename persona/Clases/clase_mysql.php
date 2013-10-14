<?PHP
class conectaBDMy
//       Accesa a BD en MYSql
{
	private $servidor; 
	private $usuario; 
	private $password; 
	private $basedatos;
	private $conexion;
//       Metodo Constructor de la clase
	function conectaBDMy() 
	{ 
		$this->servidor="localhost"; 
		$this->usuario="root"; 
		$this->password="iutep"; 
		$this->basedatos="bdsas"; 
	} 
//       Metodo Abrir conexión 
	function abrir_BD()
	{
		if ( !($enlace= @mysql_connect( $this->servidor, $this->usuario, $this->password ) ) )
		{
		header("Location: ../html/Error_bd.html");		
		}
		if ( !@mysql_select_db( $this->basedatos, $enlace ) )
		{
		header("Location: ../html/Error_bd.html");			
		}
		@mysql_query("SET NAMES 'utf8'");
		$this->conexion=$enlace;
		return true;
	}
//       Metodo ejecutar SQL 
	function ejecuta_sql( $query )
	{
		if ( $this->abrir_BD() )
	     return ( mysql_query($query,$this->conexion ) );
	else
	     return null;
	}

//       Proxima Tupla en Arreglo
  function proxima_tupla($cursor) 
  {
	return mysql_fetch_array($cursor);
  }
//       Cantidad de Tuplas 
  function getNRegistro($resulta) 
  {
	return mysql_num_rows($resulta);
  }
//       Metodo cerrar conexión 
	function cerrar_bd()
	{
		mysql_close( $this->conexion );
	}

// Transforma la fecha del formato actual 
// al formato de mysql Año-mes-dia
  function fecha_bd($Fecha)
  {
	$unaFecha="now()";
	if (strlen($Fecha)==10)
	{
  	 	$elDia=substr($Fecha,0,2);
  	 	$elMes=substr($Fecha,3,2);
  	 	$elYear=substr($Fecha,6,4);
  	 	$FechaBD=$elYear."-".$elMes."-".$elDia;
	}
	return $FechaBD;
  }
}
//  Fin de la clase conectaBDMy
?>
