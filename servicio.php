<?php 
  include 'TransferirObjeto.php';
  include 'dbObjects.php';
  $dbObjects = new dbObjects(); 
  $dbObjects->Conexion=  new mysqli ('10.1.2.110', 'UsrSincroniza', 'gkdlYDfN992p','');

$arreglo_resultado= array(
    "data" => $dbObjects->obtenerlistDb(),
    "success" => true
);

echo json_encode($arreglo_resultado);  

?>