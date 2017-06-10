
<?php 
class SqlServer
{


    	public function IngresarRegistro ($query , $params)
    	{
          include 'Conexion.php';
          $conn=sqlsrv_connect ($serverName,$connectionInfo);
          if ($conn===false)
		  {return 0; }
		   $result = sqlsrv_query($conn,$query,$params  ); 
	       sqlsrv_next_result($result); 
	       sqlsrv_fetch($result ); 
          return sqlsrv_get_field($result, 0); 

    	}

		public function ObtenerDatosQuery($query)
		{

			include 'Conexion.php';
			$conn = sqlsrv_connect( $serverName, $connectionInfo);

			if( $conn ) {
		 		$resultado =    sqlsrv_query($conn, $query	);
				$arreglo_resultado = []; 
			
			while ($row = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC) )
			{
				$arreglo_resultado[]= $row; 
			}
			return  array(
		    			"data" => $arreglo_resultado,
		    	 		"success" => true 
						);
					 }
			else
			{

				return  array(
		    					"data" => [],
		    					"success" => false
							);		
		   
			}

		}
}?>