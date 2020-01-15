<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\News;

/**
 * NewsSearch represents the model behind the search form of `frontend\models\News`.
 */
class NewsSearch extends News
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'catg_id'], 'integer'],
            [['news_title', 'news_date', 'news_desc', 'status', 'posted_by'], 'safe'],
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
        $query = News::find();

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
            'catg_id' => $this->catg_id,
            'news_date' => $this->news_date,
        ]);

        $query->andFilterWhere(['like', 'news_title', $this->news_title])
            ->andFilterWhere(['like', 'news_desc', $this->news_desc])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'posted_by', $this->posted_by]);

        return $dataProvider;
    }
}
