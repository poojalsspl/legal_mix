<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JudgmentAdvocate;

/**
 * JudgmentAdvocateSearch represents the model behind the search form about `\backend\models\JudgmentAdvocate`.
 */
class JudgmentAdvocateSearch extends JudgmentAdvocate
{
    /**
     * @inheritdoc
     */
    public $name;
    public $title;

    public function rules()
    {
        return [
            [['id', 'judgment_code'], 'integer'],
            [['advocate_name', 'advocate_flag','name','title'], 'safe'],
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
        $query = JudgmentAdvocate::find()->groupBy('judgment_code');
                $query->joinWith(['judgmentCode']);
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

        $query->andFilterWhere(['like', 'advocate_name', $this->advocate_name])
            ->andFilterWhere(['like', 'advocate_flag', $this->advocate_flag])
            ->andFilterWhere(['like', 'judgment_mast.judgment_title', $this->title])
            ->andFilterWhere(['like', 'judgment_mast.court_name', $this->name]);

        return $dataProvider;
    }
}
