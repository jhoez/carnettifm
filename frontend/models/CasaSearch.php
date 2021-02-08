<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Casa;

/**
 * CasaSearch represents the model behind the search form of `frontend\models\Casa`.
 */
class CasaSearch extends Casa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'inmuebles_id'], 'integer'],
            [['nombre', 'ncasa', 'tipcasa', 'tippiso', 'tipconstruccion', 'tiptecho'], 'safe'],
            [['alquilada', 'bano', 'cuarto', 'sala', 'comedor'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Casa::find();

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
            'alquilada' => $this->alquilada,
            'bano' => $this->bano,
            'cuarto' => $this->cuarto,
            'sala' => $this->sala,
            'comedor' => $this->comedor,
            'inmuebles_id' => $this->inmuebles_id,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'ncasa', $this->ncasa])
            ->andFilterWhere(['ilike', 'tipcasa', $this->tipcasa])
            ->andFilterWhere(['ilike', 'tippiso', $this->tippiso])
            ->andFilterWhere(['ilike', 'tipconstruccion', $this->tipconstruccion])
            ->andFilterWhere(['ilike', 'tiptecho', $this->tiptecho]);


        return $dataProvider;
    }
}
