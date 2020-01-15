<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JudgmentJudge;

/**
 * JudgmentJudgeSearch represents the model behind the search form about `\backend\models\JudgmentJudge`.
 */
class JudgmentJudgeSearch extends JudgmentJudge
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'judgment_code'], 'integer'],
            [['judge_name'], 'safe'],
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
        $query = JudgmentJudge::find();

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
            'judgment_code' => $this->judgment_code,
        ]);

        $query->andFilterWhere(['like', 'judge_name', $this->judge_name]);

        return $dataProvider;
    }
}
