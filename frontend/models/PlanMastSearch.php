<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlanMast;

/**
 * PlanMastSearch represents the model behind the search form of `app\models\PlanMast`.
 */
class PlanMastSearch extends PlanMast
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_code'], 'integer'],
            [['plan_name', 'plan_expiry', 'plan_rate', 'coupon_allowed', 'plan_desc', 'search_limit', 'access_limit', 'access_rate_limit', 'concurrent_connection', 'plan_taxed', 'static_ip'], 'safe'],
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
        $query = PlanMast::find();

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
            'plan_code' => $this->plan_code,
        ]);

        $query->andFilterWhere(['like', 'plan_name', $this->plan_name])
            ->andFilterWhere(['like', 'plan_expiry', $this->plan_expiry])
            ->andFilterWhere(['like', 'plan_rate', $this->plan_rate])
            ->andFilterWhere(['like', 'coupon_allowed', $this->coupon_allowed])
            ->andFilterWhere(['like', 'plan_desc', $this->plan_desc])
            ->andFilterWhere(['like', 'search_limit', $this->search_limit])
            ->andFilterWhere(['like', 'access_limit', $this->access_limit])
            ->andFilterWhere(['like', 'access_rate_limit', $this->access_rate_limit])
            ->andFilterWhere(['like', 'concurrent_connection', $this->concurrent_connection])
            ->andFilterWhere(['like', 'plan_taxed', $this->plan_taxed])
            ->andFilterWhere(['like', 'static_ip', $this->static_ip]);

        return $dataProvider;
    }
}
