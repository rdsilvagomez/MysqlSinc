<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoServidor".
 *
 * @property integer $id
 * @property string $descripcion
 *
 * @property ServidoresBd[] $servidoresBds
 */
class TipoServidor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TipoServidor';
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
    public function getServidoresBds()
    {
        return $this->hasMany(ServidoresBd::className(), ['idTipoServidor' => 'id']);
    }
}
