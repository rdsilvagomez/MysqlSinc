<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "RegistroTransporteBdDetalle".
 *
 * @property integer $id
 * @property integer $idRegistroTransporte
 * @property string $fecha
 * @property integer $idTipoObjeto
 * @property string $bd
 * @property string $nombre
 * @property integer $servidorOrigenId
 * @property string $ServidorOrigenDescripcion
 * @property integer $servidorDestinoId
 * @property string $ServidorDestinoDescripcion
 * @property string $CodigoFuente
 * @property string $CodigoDestino
 *
 * @property TipoObjetoBd $idTipoObjeto0
 * @property ServidoresBd $servidorDestino
 * @property ServidoresBd $servidorOrigen
 */
class RegistroTransporteBdDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RegistroTransporteBdDetalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idRegistroTransporte', 'idTipoObjeto', 'servidorOrigenId', 'servidorDestinoId'], 'integer'],
            [['fecha'], 'safe'],
            [['bd', 'nombre', 'ServidorOrigenDescripcion', 'ServidorDestinoDescripcion', 'CodigoFuente', 'CodigoDestino'], 'string'],
            [['idTipoObjeto'], 'exist', 'skipOnError' => true, 'targetClass' => TipoObjetoBd::className(), 'targetAttribute' => ['idTipoObjeto' => 'id']],
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
            'idRegistroTransporte' => 'Id Registro Transporte',
            'fecha' => 'Fecha',
            'idTipoObjeto' => 'Id Tipo Objeto',
            'bd' => 'Bd',
            'nombre' => 'Nombre',
            'servidorOrigenId' => 'Servidor Origen ID',
            'ServidorOrigenDescripcion' => 'Servidor Origen Descripcion',
            'servidorDestinoId' => 'Servidor Destino ID',
            'ServidorDestinoDescripcion' => 'Servidor Destino Descripcion',
            'CodigoFuente' => 'Codigo Fuente',
            'CodigoDestino' => 'Codigo Destino',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoObjeto0()
    {
        return $this->hasOne(TipoObjetoBd::className(), ['id' => 'idTipoObjeto']);
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
