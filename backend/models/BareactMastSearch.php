<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BareactMast;

/**
 * BareactMastSearch represents the model behind the search form about `\backend\models\BareactMast`.
 */
class BareactMastSearch extends BareactMast
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bareact_id', 'old_bareact_id', 'source_act_id', 'bareact_catgid', 'tot_section', 'tot_chap'], 'integer'],
            [['act_name', 'bareact_catg_name', 'Enactment_date', 'bareact_text'], 'safe'],
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
        $query = BareactMast::find();

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
            'bareact_id' => $this->bareact_id,
            'old_bareact_id' => $this->old_bareact_id,
            'source_act_id' => $this->source_act_id,
            'bareact_catgid' => $this->bareact_catgid,
            'tot_section' => $this->tot_section,
            'tot_chap' => $this->tot_chap,
            'Enactment_date' => $this->Enactment_date,
        ]);

        $query->andFilterWhere(['like', 'act_name', $this->act_name])
            ->andFilterWhere(['like', 'bareact_catg_name', $this->bareact_catg_name])
            ->andFilterWhere(['like', 'bareact_text', $this->bareact_text]);

        return $dataProvider;
    }
}
