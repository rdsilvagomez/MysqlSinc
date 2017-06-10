<?php
class TransferirObjeto
{
    public $ConexionOrigen; 
    public $ConexionDestino; 
    public $SourceDatabaseName;
    public $TargetDatabaseName;

    public function InicializarConexiones($Origen,$destino)
    {
            $this->ConexionOrigen = $Origen;
            $this->ConexionDestino= $destino;
    }

    public function transferirFuncion($nombreFuncion)
    {   
        $queryCreateFunction= "SHOW CREATE FUNCTION ".$this->SourceDatabaseName.".".$nombreFuncion ;  
        $resultado = $this->ConexionOrigen->Query($queryCreateFunction);
        while ($row = $resultado->fetch_assoc()) 
        {
            $CreateFunctionStatement=   $row['Create Function'];
        }
        if (!$this->ConexionDestino->query("DROP function IF EXISTS ".$this->TargetDatabaseName.".".$nombreFuncion) ||
            !$this->ConexionDestino->query(  $CreateFunctionStatement))
        {
           
        }
     }

    public function transferirProcedure($nameProcedure)
    {
        $queryCreateProcedure = "SHOW CREATE PROCEDURE ".$this->SourceDatabaseName.".".$nameProcedure ;  
        $resultado=$this->ConexionOrigen->Query($queryCreateProcedure);
         while ($row = $resultado->fetch_assoc()) 
        {
            $CreateProcedureStatement=   $row['Create Procedure'];
        }
    if (!$this->ConexionDestino->query("DROP PROCEDURE IF EXISTS ".$this->TargetDatabaseName.".".$nameProcedure) ||
            !$this->ConexionDestino->query(  $CreateProcedureStatement))
        {
           
        }
    }

public function CloseConection()
{
    $this->ConexionOrigen->close();
    $this->ConexionDestino->close();
}

}?>
