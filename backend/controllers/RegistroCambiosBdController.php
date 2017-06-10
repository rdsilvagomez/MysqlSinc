<?php

namespace app\controllers;

use Yii;
use app\models\RegistroCambiosBd;
use app\models\RegistroCambiosBdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
/**
 * RegistroCambiosBdController implements the CRUD actions for RegistroCambiosBd model.
 */
class RegistroCambiosBdController extends ActiveController
{
       public $modelClass = 'app\models\RegistroCambiosBdSearch';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'data',
    ];
   
 
     public function behaviors()
    
    {
        return [
            [
                 'class' => \yii\filters\ContentNegotiator::className(),
                
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];

}
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
public function subirCambiosProductivo($tipoObjeto , $db , $nombreProcedimiento, $serverSourceId,$serverTargetId)
{
     $codigoRutinaTransporte=$this->obtenerCodigoFuente($tipoObjeto, $db, $nombreProcedimiento, $serverSourceId);
     $conexion = $this->ObtenerConexion($serverTargetId);


     $sentencia = " DROP ".$tipoObjeto." IF EXISTS ".$db.".".$nombreProcedimiento;
     $conexion->createCommand(" USE ".$db)->execute(); 
     $conexion->createCommand($sentencia)->execute(); 
     $conexion->createCommand($codigoRutinaTransporte)->execute(); 
     
     
}


public function obtenerCodigoFuente($TipoObjeto,$db,$nombreProcedimiento,$serverid)
{


    $sentencia = "show create ".$TipoObjeto." ".$db.".".$nombreProcedimiento;
    $codigoFuente = ""; 
    
    $sentenciaListadoProc = "select * from mysql.proc where db='".$db."' and   specific_name = '".$nombreProcedimiento."' and type= '".$TipoObjeto."'";

    $conexion = $this->ObtenerConexion($serverid);

    $queryRegistros= $conexion->createCommand($sentenciaListadoProc)
                          ->queryAll();
if (count($queryRegistros)===0)
{
    return ""; 
}
     $query= $conexion->createCommand($sentencia)
                       ->queryAll();

    foreach ($query as $reg) 
    {
        if ($TipoObjeto==="PROCEDURE")
        { $codigoFuente = $reg['Create Procedure'];}
        else 
        { $codigoFuente = $reg['Create Function']; }
           

    }
return $codigoFuente; 

}
public function actionGentrans()
{    
     $RegistroCambiosBdId=  Yii::$app->request->bodyParams['data'][0]['id'];
     $transaction= \app\models\RegistroCambiosBd::getDb()->beginTransaction();

     try 
     {
        $RegistroCambiosBd    =\app\models\RegistroCambiosBd::findOne($RegistroCambiosBdId) ;
        $RegistroCambiosBd->autorizado = 1 ; 
        $RegistroCambiosBd->save(); 
        
        $RegistroTransporteBd = new \app\models\RegistroTransporteBd(); 

        $RegistroTransporteBd->servidorOrigenId  = $RegistroCambiosBd->servidorOrigenId;
        $RegistroTransporteBd->servidorDestinoId = $RegistroCambiosBd->servidorDestinoId; 
        $RegistroTransporteBd->idRegistroCambiosBd = $RegistroCambiosBdId;

        $RegistroTransporteBd->save(); 
        
        $listadoDetalle=\app\models\RegistroCambioBdDetalle::find()->where(['idRegistroCambioBd'=>$RegistroCambiosBdId])->all();
            

        foreach ($listadoDetalle as $reg) 
        {
                $RegistroTransporteBdDetalle  =new  \app\models\RegistroTransporteBdDetalle();

                $RegistroTransporteBdDetalle->idRegistroTransporte       =  $RegistroTransporteBd->id ; 
                $RegistroTransporteBdDetalle->idTipoObjeto               =  $reg->idTipoObjeto;
                $RegistroTransporteBdDetalle->bd                         =  $reg->bd; 
                $RegistroTransporteBdDetalle->nombre                     =  $reg->nombre; 
                $RegistroTransporteBdDetalle->servidorOrigenId           =  $RegistroCambiosBd->servidorOrigenId; 
            
               


                 $servidorOrigen =  \app\models\ServidoresBd::find()
                 ->select(['[ServidoresBd].ip +[tipoServidor].descripcion+[TipoAmbienteServidor].descripcion ip'])
                 ->where (['ServidoresBd.id'=> $RegistroCambiosBd->servidorOrigenId])
                 ->InnerJoinWith('tipoServidor')
                 ->InnerJoinWith('tipoAmbiente')->one();
                

                $RegistroTransporteBdDetalle->servidorOrigenId          =  $RegistroCambiosBd->servidorOrigenId; 
                $RegistroTransporteBdDetalle->ServidorOrigenDescripcion  = $servidorOrigen->ip;
                 

                 $servidorDestino =  \app\models\ServidoresBd::find()
                 ->select(['[ServidoresBd].ip +[tipoServidor].descripcion+[TipoAmbienteServidor].descripcion ip'])
                 ->where (['ServidoresBd.id'=> $RegistroCambiosBd->servidorDestinoId])
                 ->InnerJoinWith('tipoServidor')
                 ->InnerJoinWith('tipoAmbiente')->one();


                 $TipoObjeto=\app\models\TipoObjetoBd::find()->where(['id'=> $reg->idTipoObjeto])->one();


                $RegistroTransporteBdDetalle->servidorDestinoId          =  $RegistroCambiosBd->servidorDestinoId; 
                $RegistroTransporteBdDetalle->ServidorDestinoDescripcion =  $servidorDestino->ip;
                $RegistroTransporteBdDetalle->CodigoFuente=  $this->obtenerCodigoFuente( $TipoObjeto->descripcion,
                                                                                        $reg->bd,$reg->nombre,
                                                                                        $RegistroCambiosBd->servidorOrigenId);
                $RegistroTransporteBdDetalle->CodigoDestino=  $this->obtenerCodigoFuente($TipoObjeto->descripcion,
                                                                                         $reg->bd,$reg->nombre,
                                                                                         $RegistroCambiosBd->servidorDestinoId);
                
                $RegistroTransporteBdDetalle->save(); 
        }


        $transaction->commit();

        /*Ingresar rutina para pasar datos a productivo, elegir servidor de destino en la base de datos*/
        foreach ($listadoDetalle as $reg)
        {

            $TipoObjeto=\app\models\TipoObjetoBd::find()->where(['id'=> $reg->idTipoObjeto])->one();
            
             $this->subirCambiosProductivo($TipoObjeto->descripcion , 
                                            $reg->bd, 
                                            $reg->nombre, 
                                            $RegistroCambiosBd->servidorOrigenId,
                                            $RegistroCambiosBd->servidorDestinoId); 
        }




     }

    catch (\Exception $ex )
     {
        $transaction->rollBack();
        return ['success'=>false];

     }
  
        return ['success'=>true];
  

    }

   
}
