<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JudgmentAct;

/**
 * JudgmentActSearch represents the model behind the search form about `\backend\models\JudgmentAct`.
 */
class JudgmentActSearch extends JudgmentAct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jact', 'judgment_code', 'bareact_catgid', 'bareact_id', 'catg_id', 'country_code'], 'integer'],
            [['bareact_catg_name', 'act_name', 'catg_title', 'country_name'], 'safe'],
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
        $query = JudgmentAct::find();

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
            'jact' => $this->jact,
            'judgment_code' => $this->judgment_code,
            'bareact_catgid' => $this->bareact_catgid,
            'bareact_id' => $this->bareact_id,
            'catg_id' => $this->catg_id,
            'country_code' => $this->country_code,
        ]);

        $query->andFilterWhere(['like', 'bareact_catg_name', $this->bareact_catg_name])
            ->andFilterWhere(['like', 'act_name', $this->act_name])
            ->andFilterWhere(['like', 'catg_title', $this->catg_title])
            ->andFilterWhere(['like', 'country_name', $this->country_name]);

        return $dataProvider;
    }
}
