<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JudgmentBenchType;

/**
 * JudgmentBenchTypeSearch represents the model behind the search form about `\backend\models\JudgmentBenchType`.
 */
class JudgmentBenchTypeSearch extends JudgmentBenchType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bench_type_id'], 'integer'],
            [['bench_type_text'], 'safe'],
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
        $query = JudgmentBenchType::find();

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
            'bench_type_id' => $this->bench_type_id,
        ]);

        $query->andFilterWhere(['like', 'bench_type_text', $this->bench_type_text]);

        return $dataProvider;
    }
}
