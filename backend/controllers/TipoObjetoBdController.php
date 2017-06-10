<?php

namespace app\controllers;

use Yii;
use app\models\TipoObjetoBd;
use app\models\TipoObjetoBdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
/**
 * TipoObjetoBdController implements the CRUD actions for TipoObjetoBd model.
 */
class TipoObjetoBdController extends ActiveController
{
   
       public $modelClass = 'app\models\TipoObjetoBdSearch';
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
