<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "RegistroTransporteBd".
 *
 * @property integer $id
 * @property string $fecha
 * @property integer $servidorOrigenId
 * @property integer $servidorDestinoId
 * @property integer $idRegistroCambiosBd
 *
 * @property RegistroCambiosBd $idRegistroCambiosBd0
 * @property ServidoresBd $servidorDestino
 * @property ServidoresBd $servidorOrigen
 */
class RegistroTransporteBd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RegistroTransporteBd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha'], 'safe'],
            [['servidorOrigenId', 'servidorDestinoId', 'idRegistroCambiosBd'], 'integer'],
            [['idRegistroCambiosBd'], 'exist', 'skipOnError' => true, 'targetClass' => RegistroCambiosBd::className(), 'targetAttribute' => ['idRegistroCambiosBd' => 'id']],
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
            'idRegistroCambiosBd' => 'Id Registro Cambios Bd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRegistroCambiosBd0()
    {
        return $this->hasOne(RegistroCambiosBd::className(), ['id' => 'idRegistroCambiosBd']);
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
}
