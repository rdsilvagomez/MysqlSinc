<?php 
  include 'SqlServer.php'; 
 $objectSQL = new SqlServer(); 

echo json_encode($objectSQL->ObtenerDatosQuery("Select srv.id,  tipoSrv.descripcion+'-'+ tipoAmbSrv.descripcion+'-'+ ip descripcion  from  ServidoresBd srv
		inner join TipoAmbienteServidor tipoAmbSrv
		on  srv.idTipoAmbiente= tipoAmbSrv.id
		inner join TipoServidor tipoSrv 
		on srv.idTipoServidor = tipoSrv.id"));
 
?>