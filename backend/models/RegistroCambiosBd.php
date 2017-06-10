<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "RegistroCambiosBd".
 *
 * @property integer $id
 * @property string $fecha
 * @property integer $servidorOrigenId
 * @property integer $servidorDestinoId
 * @property integer $autorizado
 *
 * @property RegistroCambioBdDetalle[] $registroCambioBdDetalles
 * @property ServidoresBd $servidorDestino
 * @property ServidoresBd $servidorOrigen
 */
class RegistroCambiosBd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RegistroCambiosBd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha'], 'safe'],
            [['servidorOrigenId', 'servidorDestinoId', 'autorizado'], 'integer'],
            [['servidorDestinoId'], 'exist', 'skipOnError' => true, 'targetClass' => ServidoresBd::className(), 'targetAttribute' => ['servidorDestinoId' => 'id']],
            [['servidorOrigenId'], 'exist', 'skipOnError' => true, 'targetClass' => ServidoresBd::className(), 'targetAttribute' => ['servidorOrigenId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'servidorOrigenId' => 'Servidor Origen ID',
            'servidorDestinoId' => 'Servidor Destino ID',
            'autorizado' => 'Autorizado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistroCambioBdDetalles()
    {
        return $this->hasMany(RegistroCambioBdDetalle::className(), ['idRegistroCambioBd' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServidorDestino()
    {
        return $this->hasOne(ServidoresBd::className(), ['id' => 'servidorDestinoId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServidorOrigen()
    {
        return $this->hasOne(ServidoresBd::className(), ['id' => 'servidorOrigenId']);
    }


        public function extraFields () 
    {
        return ['servidorDestino','servidorOrigen','registroCambioBdDetalles'];
    }

}
