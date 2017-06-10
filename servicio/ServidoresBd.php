<?php 
 
 
 
class ServidoresBd 
{
public function ObtenerServidorXId($id)
{

 include 'Conexion.php'; 
$query = " Select  
 * ,convert(varchar(max) , decryptByPassPhrase('20884344',pwd))pwd2  from RegistroCambiosBd..ServidoresBd
 where ID=".$id;

$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
 $resultado =    sqlsrv_query($conn, $query
		);

while( $ObjetoServidor = sqlsrv_fetch_object( $resultado)) 
{
  return $ObjetoServidor; 
}
 
}
else
	{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
	}

}


}
 




?>