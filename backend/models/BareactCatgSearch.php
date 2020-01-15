<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BareactCatg;

/**
 * BareactCatgSearch represents the model behind the search form about `\backend\models\BareactCatg`.
 */
class BareactCatgSearch extends BareactCatg
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bareact_catgid', 'country_code'], 'integer'],
            [['bareact_catg_name', 'country_name'], 'safe'],
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
        $query = BareactCatg::find();

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
            'bareact_catgid' => $this->bareact_catgid,
            'country_code' => $this->country_code,
        ]);

        $query->andFilterWhere(['like', 'bareact_catg_name', $this->bareact_catg_name])
            ->andFilterWhere(['like', 'country_name', $this->country_name]);

        return $dataProvider;
    }
}
