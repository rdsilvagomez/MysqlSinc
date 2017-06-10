<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RegistroCambioBdDetalle;

/**
 * RegistroCambioBdDetalleSearch represents the model behind the search form about `app\models\RegistroCambioBdDetalle`.
 */
class RegistroCambioBdDetalleSearch extends RegistroCambioBdDetalle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idRegistroCambioBd', 'idTipoObjeto'], 'integer'],
            [['fecha', 'nombre', 'bd'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RegistroCambioBdDetalle::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idRegistroCambioBd' => $this->idRegistroCambioBd,
            'fecha' => $this->fecha,
            'idTipoObjeto' => $this->idTipoObjeto,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'bd', $this->bd]);

        return $dataProvider;
    }
}
