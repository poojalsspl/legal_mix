<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CouponCode;

/**
 * CouponCodeSearch represents the model behind the search form about `\backend\models\CouponCode`.
 */
class CouponCodeSearch extends CouponCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_id', 'use_limit', 'used', 'discount_val'], 'integer'],
            [['rand_code', 'gen_date', 'exp_date', 'discount_type'], 'safe'],
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
        $query = CouponCode::find();

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
            'coupon_id' => $this->coupon_id,
            'gen_date' => $this->gen_date,
            'exp_date' => $this->exp_date,
            'use_limit' => $this->use_limit,
            'used' => $this->used,
            'discount_val' => $this->discount_val,
        ]);

        $query->andFilterWhere(['like', 'rand_code', $this->rand_code])
            ->andFilterWhere(['like', 'discount_type', $this->discount_type]);

        return $dataProvider;
    }
}
