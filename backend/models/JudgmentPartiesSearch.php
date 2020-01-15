<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JudgmentParties;

/**
 * JudgmentPartiesSearch represents the model behind the search form about `\backend\models\JudgmentParties`.
 */
class JudgmentPartiesSearch extends JudgmentParties
{
    /**
     * @inheritdoc
     */
    public $name;
    public $title;
    public function rules()
    {
        return [
            [['judgment_party_id', 'judgment_code'], 'integer'],
            [['party_name', 'party_flag','name','title'], 'safe'],
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
        $query = JudgmentParties::find()->groupBy('judgment_code'); 
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
            'judgment_party_id' => $this->judgment_party_id,
            'judgment_code' => $this->judgment_code,
        ]);

        $query->andFilterWhere(['like', 'party_name', $this->party_name])
            ->andFilterWhere(['like', 'party_flag', $this->party_flag])
            ->andFilterWhere(['like', 'judgment_mast.judgment_title', $this->title])
            ->andFilterWhere(['like', 'judgment_mast.court_name', $this->name]);

        return $dataProvider;
    }
}
