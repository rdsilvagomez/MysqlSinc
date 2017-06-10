<?php
public function ObtenerConexion($serverId)
{
switch ($serverId)
    {
                  case 1 : 
                    $conexion =  Yii::$app->dbMysqldesarrollo;
                     break ; 
                  case 2 : 
                     $conexion =  Yii::$app->dbMysqlCalidad;
                     break ; 
                  case 3 :
                  $conexion =  Yii::$app->dbMysqlProductivoTecnoglass;
                     break ;  
                  case 4 :
                    $conexion= Yii::$app->dbMysqlProductivoEnergia;
                     break ;  
                  case 5 :
                    $conexion= Yii::$app->dbmysqlProductivoFlanker;
                     break ;  
    }
    return $conexion; 
}