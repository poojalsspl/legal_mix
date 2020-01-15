<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CourtMast;

/**
 * CourtMastSearch represents the model behind the search form about `\backend\models\CourtMast`.
 */
class CourtMastSearch extends CourtMast
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['court_code', 'city_code', 'state_code', 'country_code'], 'integer'],
            [['court_name', 'court_shrt_name', 'court_type', 'bench_status', 'court_status', 'city_name', 'state_name', 'country_name', 'court_remark', 'court_address'], 'safe'],
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
        $query = CourtMast::find();

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
            'court_code' => $this->court_code,
            'city_code' => $this->city_code,
            'state_code' => $this->state_code,
            'country_code' => $this->country_code,
        ]);

        $query->andFilterWhere(['like', 'court_name', $this->court_name])
            ->andFilterWhere(['like', 'court_shrt_name', $this->court_shrt_name])
            ->andFilterWhere(['like', 'court_type', $this->court_type])
            ->andFilterWhere(['like', 'bench_status', $this->bench_status])
            ->andFilterWhere(['like', 'court_status', $this->court_status])
            ->andFilterWhere(['like', 'city_name', $this->city_name])
            ->andFilterWhere(['like', 'state_name', $this->state_name])
            ->andFilterWhere(['like', 'country_name', $this->country_name])
            ->andFilterWhere(['like', 'court_remark', $this->court_remark])
            ->andFilterWhere(['like', 'court_address', $this->court_address]);

        return $dataProvider;
    }
}
