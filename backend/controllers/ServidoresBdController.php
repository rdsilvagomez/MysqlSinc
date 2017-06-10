<?php

namespace app\controllers;

use Yii;
use app\models\ServidoresBd;
use app\models\ServidoresBdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
/**
 * ServidoresBdController implements the CRUD actions for ServidoresBd model.
 */
class ServidoresBdController extends ActiveController
{
       public $modelClass = 'app\models\ServidoresBdSearch';
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
