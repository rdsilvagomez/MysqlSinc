<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ServidoresBd".
 *
 * @property integer $id
 * @property integer $idTipoServidor
 * @property integer $idTipoAmbiente
 * @property string $ip
 * @property string $puerto
 * @property string $usuario
 * @property resource $pwd
 *
 * @property RegistroCambiosBd[] $registroCambiosBds
 * @property RegistroCambiosBd[] $registroCambiosBds0
 * @property TipoAmbienteServidor $idTipoAmbiente0
 * @property TipoServidor $idTipoServidor0
 */
class ServidoresBd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ServidoresBd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTipoServidor', 'idTipoAmbiente'], 'integer'],
            [['ip', 'puerto', 'usuario', 'pwd'], 'string'],
            [['idTipoAmbiente'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAmbienteServidor::className(), 'targetAttribute' => ['idTipoAmbiente' => 'id']],
            [['idTipoServidor'], 'exist', 'skipOnError' => true, 'targetClass' => TipoServidor::className(), 'targetAttribute' => ['idTipoServidor' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idTipoServidor' => 'Id Tipo Servidor',
            'idTipoAmbiente' => 'Id Tipo Ambiente',
            'ip' => 'Ip',
            'puerto' => 'Puerto',
            'usuario' => 'Usuario',
            'pwd' => 'Pwd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistroCambiosBds()
    {
        return $this->hasMany(RegistroCambiosBd::className(), ['servidorDestinoId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistroCambiosBds0()
    {
        return $this->hasMany(RegistroCambiosBd::className(), ['servidorOrigenId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAmbiente()
    {
        return $this->hasOne(TipoAmbienteServidor::className(), ['id' => 'idTipoAmbiente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoServidor()
    {
        return $this->hasOne(TipoServidor::className(), ['id' => 'idTipoServidor']);
    }
public function descripcionGeneral()
{
          $TipoServidor =  TipoServidor::find()
                        ->where(['id' => $this->idTipoServidor])
                         ->one();

            $TipoAmbienteServidor= TipoAmbienteServidor::find()
            ->where(['id'=>$this->idTipoAmbiente])->one(); 
            Return  $this->ip."-".$TipoServidor->descripcion."-".$TipoAmbienteServidor->descripcion; 

}

public function Fields ()
{
 return [ 
        
            'id'=>'id',
            'descripcion'=> function ($model)
            { $TipoServidor =  TipoServidor::find()
                        ->where(['id' => $model->idTipoServidor])
                         ->one();

            $TipoAmbienteServidor= TipoAmbienteServidor::find()
            ->where(['id'=>$model->idTipoAmbiente])->one(); 
            Return  $model->ip."-".$TipoServidor->descripcion."-".$TipoAmbienteServidor->descripcion; 
                }
        ];
}

    public function extraFields () 
    {
        return ['tipoServidor','tipoAmbiente'];
    }
}
