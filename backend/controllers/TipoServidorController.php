<?php

namespace app\controllers;

use Yii;
use app\models\TipoServidor;
use app\models\TipoServidorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
/**
 * TipoServidorController implements the CRUD actions for TipoServidor model.
 */
class TipoServidorController extends ActiveController
{
   
       public $modelClass = 'app\models\TipoServidorSearch';
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
