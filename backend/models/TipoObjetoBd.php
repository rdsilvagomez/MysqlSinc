<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoObjetoBd".
 *
 * @property integer $id
 * @property string $descripcion
 *
 * @property RegistroCambioBdDetalle[] $registroCambioBdDetalles
 */
class TipoObjetoBd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TipoObjetoBd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistroCambioBdDetalles()
    {
        return $this->hasMany(RegistroCambioBdDetalle::className(), ['idTipoObjeto' => 'id']);
    }
}
