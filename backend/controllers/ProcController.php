<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use app\models\Proc;
use app\models\ProcSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
 
class ProcController extends ActiveController
{
    public $modelClass = 'app\models\ProcMyqlDev';
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

public function actionListadodb()
{
    $consulta = 'select distinct db from mysql.proc ';
    switch ($_GET['serverid'])
    {
              case 1 : 
                 $conexion = Yii::$app->dbMysqldesarrollo;
                 break ; 
              case 2 : 
                $conexion = Yii::$app->dbMysqlCalidad;
                 break ; 
              case 3 :
                 $conexion = Yii::$app->dbMysqlProductivoTecnoglass;
                 break ;  
              case 4 :
                 $conexion = Yii::$app->dbMysqlProductivoEnergia;
                 break ;  
              case 5 :
                  $conexion= Yii::$app->dbmysqlProductivoFlanker;
              break ;  
    }
   $query=$conexion->createCommand($consulta)->queryAll();
    return ['data'=>$query]; 
}
 
public function actionList() {
switch ($_GET['serverid'])
{
          case 1 : 
             $query = \app\models\ProcMyqlDev::find();
            break ; 
          case 2 : 
            $query = \app\models\ProcMysqlQas::find();
            break ; 
          case 3 :
            $query = \app\models\ProcMysqlProdTecnoglass::find();
            break ;  
          case 4 :
               $query = \app\models\ProcMysqlProdEnergia::find();
            break ;  
}
      /*
      $dataProvider = new ActiveDataProvider([
            'query' => $query->andFilterWhere(['like', 'db', $_GET['db']])
                             ->andFilterWhere(['like', 'specific_name', $_GET['nombre_proc']])
            ,
        ]);

        */


        $dataProvider = new ActiveDataProvider([
            'query' => $query->andFilterWhere(['like', 'db', $_GET['db']])
                             ->andFilterWhere(['like', 'specific_name', $_GET['nombre_proc']])
            ,
        ]);
      return $dataProvider;
                                          
                                          }

public function actionGuardar()
{
try {
  $data =   Yii::$app->request->bodyParams['data'];

 foreach ($data as  $row)
 {

   $registroEncabezado= new \app\models\RegistroCambiosBd(); 
   $registroEncabezado->servidorOrigenId =$row['serverSourceId'];
   $registroEncabezado->servidorDestinoId=$row['serverTargetId'];
   $registroEncabezado->autorizado=0;
   $registroEncabezado->save();
    
    break ; 
 }
foreach ($data as $row)
{
  $registroDetalle = new \app\models\RegistroCambioBdDetalle();
  $registroDetalle->idRegistroCambioBd=$registroEncabezado->id ;
  $registroDetalle->idTipoObjeto =\app\models\TipoObjetoBd::find()->where(['descripcion'=>$row['type']])->one()->id;
  $registroDetalle->nombre=$row['specific_name'];
  $registroDetalle->bd=$row['db'];;
  $registroDetalle->save(); 
}

return ['success'=>true]; }

catch (Exception $e)
{
return ['success'=>false];

}

}



}