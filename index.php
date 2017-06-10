<?php
   include 'TransferirObjeto.php';
   include 'dbObjects.php';
 $transferenciaObjeto = new TransferirObjeto();
 $transferenciaObjeto->SourceDatabaseName="fussion";
 $transferenciaObjeto->TargetDatabaseName="fussion_test";

 $transferenciaObjeto->InicializarConexiones(new mysqli ('10.1.2.110', 'UsrSincroniza', 'gkdlYDfN992p', $transferenciaObjeto->SourceDatabaseName),
                                             new mysqli ('10.1.2.111', 'UsrSincroniza', 'gkdlYDfN992p', $transferenciaObjeto->TargetDatabaseName));
 
 

$queryObtenerListadoFunciones= "select name  from mysql.proc where db= '".$transferenciaObjeto->SourceDatabaseName."' and type = 'PROCEDURE'";

$conexion = new mysqli ('10.1.2.110', 'UsrSincroniza', 'gkdlYDfN992p',$transferenciaObjeto->SourceDatabaseName);
$result= $conexion->query($queryObtenerListadoFunciones);
/*while ($row = $result->fetch_assoc())
{
     $transferenciaObjeto->transferirProcedure($row['name']);
}*/

$transferenciaObjeto->CloseConection();

$dbObjects = new dbObjects(); 
$dbObjects->Conexion=  new mysqli ('10.1.2.110', 'UsrSincroniza', 'gkdlYDfN992p',$transferenciaObjeto->SourceDatabaseName);
echo json_encode($dbObjects->obtenerlistDb());  
echo json_encode($dbObjects->obtenerListadoProcedure('catalogo_test')); 
echo json_encode($dbObjects->obtenerListadoFunction('fussion')); 




?>
