<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BareactDetail;

/**
 * BareactDetailSearch represents the model behind the search form about `\backend\models\BareactDetail`.
 */
class BareactDetailSearch extends BareactDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catg_id', 'bareact_id', 'source_catg_id', 'old_catg_id'], 'integer'],
            [['catg_type', 'catg_title', 'Enactment_date', 'catg_text'], 'safe'],
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
        $query = BareactDetail::find();

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
            'catg_id' => $this->catg_id,
            'bareact_id' => $this->bareact_id,
            'source_catg_id' => $this->source_catg_id,
            'old_catg_id' => $this->old_catg_id,
            'Enactment_date' => $this->Enactment_date,
        ]);

        $query->andFilterWhere(['like', 'catg_type', $this->catg_type])
            ->andFilterWhere(['like', 'catg_title', $this->catg_title])
            ->andFilterWhere(['like', 'catg_text', $this->catg_text]);

        return $dataProvider;
    }
}
