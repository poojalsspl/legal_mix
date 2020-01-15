<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Faq;

/**
 * FaqSearch represents the model behind the search form of `frontend\models\Faq`.
 */
class FaqSearch extends Faq
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faq_id', 'faq_catg_id'], 'integer'],
            [['faq_title', 'faq_date', 'faq_desc', 'status', 'posted_by'], 'safe'],
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
        $query = Faq::find();

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
            'faq_id' => $this->faq_id,
            'faq_catg_id' => $this->faq_catg_id,
            'faq_date' => $this->faq_date,
        ]);

        $query->andFilterWhere(['like', 'faq_title', $this->faq_title])
            ->andFilterWhere(['like', 'faq_desc', $this->faq_desc])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'posted_by', $this->posted_by]);

        return $dataProvider;
    }
}
