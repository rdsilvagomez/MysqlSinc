<?php 
class dbObjects
{
    public $Conexion; 
	
	public function obtenerlistDb()
	{
		$queryDb= "select  distinct db   from mysql.proc ";
		$result = $this->Conexion->Query($queryDb);
		 
		$emparray = array();
    	while($row =mysqli_fetch_assoc($result))
    	{
        	$emparray[] = $row;
    	}
    	return $emparray;
	}
	public function obtenerListadoProcedure($databaseName)
	{
		$queryDB="select * from mysql.proc where type= 'PROCEDURE'  and db= '".$databaseName."' limit 1 ";
		$result= $this->Conexion->Query($queryDB);
		$emparray = array();
    	while($row =mysqli_fetch_assoc($result))
    	{
        $emparray[] = $row;
    	}
    	return $emparray;
		
	}
	public function obtenerListadoFunction($databaseName)
	{
		$queryDB= "select * from mysql.proc where type= 'FUNCTION'  and db= '".$databaseName."' limit 1";
		$result= $this->Conexion->Query($queryDB);
		
		$emparray = array();
    	while($row =mysqli_fetch_assoc($result))
    	{
        $emparray[] = $row;
    	}
    	return $emparray;
	}
}

?>