<?php 
  include 'TransferirObjeto.php';
  include 'dbObjects.php';
  include 'ServidoresBd.php';
  session_start();
  mysqli_report(MYSQLI_REPORT_STRICT);
if (isset($_GET['serverid']))
{

    $_SESSION["serverid"]=$_GET['serverid'];
	$ServidoresBd = new ServidoresBd(); 

 	$conexionServerMysql = $ServidoresBd->ObtenerServidorXId($_GET['serverid']);

 
  $dbObjects = new dbObjects(); 

  try {
  $dbObjects->Conexion=  new mysqli ($conexionServerMysql->ip, $conexionServerMysql->usuario, $conexionServerMysql->pwd2,'');
}
catch(Exception $ex )
{

  echo json_encode( array(
    "data" => [],
    "success" => true )); 
    

 return ;  
}

 $arreglo_resultado= array(
    "data" => $dbObjects->obtenerlistDb(),
    "success" => true);



echo json_encode($arreglo_resultado);  
}
?>