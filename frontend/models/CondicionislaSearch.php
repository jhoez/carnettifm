<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Condicionisla;

/**
 * CondicionislaSearch represents the model behind the search form of `frontend\models\Condicionisla`.
 */
class CondicionislaSearch extends Condicionisla
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcond', 'persona_id'], 'integer'],
            [['status', 'f_registro', 'time_expulsion'], 'safe'],
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
        $query = Condicionisla::find();

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
            'idcond' => $this->idcond,
            'f_registro' => $this->f_registro,
            'persona_id' => $this->persona_id,
        ]);

        $query->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'time_expulsion', $this->time_expulsion]);

        return $dataProvider;
    }
}
