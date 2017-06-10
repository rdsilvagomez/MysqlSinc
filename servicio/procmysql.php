<?php
include 'ServidoresBd.php';
if(isset($_GET["db"]))
{
mysqli_report(MYSQLI_REPORT_STRICT);
$ServidoresBd=new ServidoresBd(); 
$conexionServerMysql=  $ServidoresBd->ObtenerServidorXId($_GET["serverid"]);
 try 
 {
$Conexion=  new mysqli ($conexionServerMysql->ip, $conexionServerMysql->usuario, $conexionServerMysql->pwd2,'');
 }
 catch (Exception $e ) {
echo json_encode( array(
    "data" => [],
    "success" => false,
    "totalCount" =>0
));
	return ; 
 }

 
 $query ="select db, type , specific_name, definer , created , modified from mysql.proc where specific_name like '%".$_GET['nombre_proc']."%' and   db ='".$_GET["db"]."' limit ".$_GET["start"].",".$_GET["limit"];

$resultado = $Conexion->Query($query);

$arreglo_resultado = []; 
while ($row = mysqli_fetch_assoc($resultado))
{
$arreglo_resultado[]= $row; 

}

if($resultado=mysqli_query($Conexion,"select db, type , specific_name, definer , created , modified from mysql.proc where  specific_name like '%".$_GET['nombre_proc']."%' and db ='".$_GET["db"]."' "))
{
 $rowcount=mysqli_num_rows($resultado);
 mysqli_free_result($resultado);
}

echo json_encode( array(
    "data" => $arreglo_resultado,
    "success" => true,
    "totalCount" =>$rowcount
));
mysqli_close($Conexion);}
?>