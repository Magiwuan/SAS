<? 
//Metodo para destruir la sesión
session_start();
session_unset();
session_destroy();
header("Location: ../../index.php");
exit();
//----------------------- F i n --------------------------------------
?>