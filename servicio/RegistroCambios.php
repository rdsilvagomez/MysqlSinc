<?php
 include 'SqlServer.php';
class RegistroCambios  extends SqlServer {

	 
	public function RegistrarCambios($serverSourceId, $serverTargetId)
	{         
			$sql = "Insert into RegistroCambiosBd(servidorOrigenId, servidorDestinoId,autorizado) values(?,?,?); Select Scope_identity();";
			$params =array($serverSourceId,$serverTargetId,0);
		
	       return $this->IngresarRegistro($sql,$params); 
	}

	public function RegistrarDetalleCambios($data)
	{
		  foreach ($data['data'] as  $row)
		  {
		 	$RegistroCambiosId = $this->RegistrarCambios($row['serverTargetId'],$row['serverSourceId']);
		
			break; 
		  }
		 
		 foreach ($data['data'] as  $row)
		 {   
		 	 
			 $sql= "insert into  RegistroCambioBdDetalle(idRegistroCambioBd,idTipoObjeto,nombre,bd)values(?,(select id from TipoObjetoBd where descripcion = '".$row['type']."'),?,?);";
	        
	         $params= array ($RegistroCambiosId,$row['specific_name'] ,$row['db']);
	          
		     $this->IngresarRegistro($sql,$params); 
	    }
}

	public function ObtenerRegistroCambios()
	{
		$query = " select *  from RegistroCambiosBd";
		$objSqlServer = new SqlServer();
		return $objSqlServer->ObtenerDatosQuery($query); 
	}
	public function ObtenerDetalleRegistroCambios($idRegistroCambioBd)
	{
	 	$query = " Select * from RegistroCambioBdDetalle where idRegistroCambioBd=".$idRegistroCambioBd;
		$objSqlServer = new SqlServer();
		return $objSqlServer->ObtenerDatosQuery($query); 
	}

}



?>