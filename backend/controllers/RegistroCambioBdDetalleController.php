<?php

namespace app\controllers;

use Yii;
use app\models\RegistroCambioBdDetalle;
use app\models\RegistroCambioBdDetalleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
/**
 * RegistroCambioBdDetalleController implements the CRUD actions for RegistroCambioBdDetalle model.
 */
class RegistroCambioBdDetalleController extends ActiveController
{
       public $modelClass = 'app\models\RegistroCambioBdDetalleSearch';
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
