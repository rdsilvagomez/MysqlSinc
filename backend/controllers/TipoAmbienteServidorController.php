<?php

namespace app\controllers;

use Yii;
use app\models\TipoAmbienteServidor;
use app\models\TipoAmbienteServidorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
/**
 * TipoAmbienteServidorController implements the CRUD actions for TipoAmbienteServidor model.
 */
class TipoAmbienteServidorController extends ActiveController
{
       public $modelClass = 'app\models\TipoAmbienteServidorSearch';
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
     
}
