<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "RegistroCambioBdDetalle".
 *
 * @property integer $id
 * @property integer $idRegistroCambioBd
 * @property string $fecha
 * @property integer $idTipoObjeto
 * @property string $nombre
 * @property string $bd
 *
 * @property RegistroCambiosBd $idRegistroCambioBd0
 * @property TipoObjetoBd $idTipoObjeto0
 */
class RegistroCambioBdDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RegistroCambioBdDetalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idRegistroCambioBd', 'idTipoObjeto'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre', 'bd'], 'string'],
            [['idRegistroCambioBd'], 'exist', 'skipOnError' => true, 'targetClass' => RegistroCambiosBd::className(), 'targetAttribute' => ['idRegistroCambioBd' => 'id']],
            [['idTipoObjeto'], 'exist', 'skipOnError' => true, 'targetClass' => TipoObjetoBd::className(), 'targetAttribute' => ['idTipoObjeto' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idRegistroCambioBd' => 'Id Registro Cambio Bd',
            'fecha' => 'Fecha',
            'idTipoObjeto' => 'Id Tipo Objeto',
            'nombre' => 'Nombre',
            'bd' => 'Bd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRegistroCambioBd0()
    {
        return $this->hasOne(RegistroCambiosBd::className(), ['id' => 'idRegistroCambioBd']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */



    public function getIdTipoObjeto0()
    {
        return $this->hasOne(TipoObjetoBd::className(), ['id' => 'idTipoObjeto']);
    }

    public function fields ()
    {
        return [
            'id' => 'id',
            'idRegistroCambioBd' => 'idRegistroCambioBd',
            'fecha' => 'fecha',
            /// 'idTipoObjeto' => 'idTipoObjeto',
            'TipoObjeto'=> function ($model){

                return TipoObjetoBd::find()->where(['id'=>$model->idTipoObjeto])->one()->descripcion ;
            },
            'nombre' => 'nombre',
            'bd' => 'bd',]

        ;


    }

}
