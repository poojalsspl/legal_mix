<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pages;

/**
 * PagesSearch represents the model behind the search form about `\backend\models\Pages`.
 */
class PagesSearch extends Pages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'page_cat'], 'integer'],
            [['page_meta_keywords', 'page_meta_desc', 'page_title', 'page_image', 'page_abstract', 'page_body', 'page_tag', 'page_status', 'page_cr_date'], 'safe'],
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
        $query = Pages::find();

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
            'page_id' => $this->page_id,
            'page_cat' => $this->page_cat,
            'page_cr_date' => $this->page_cr_date,
        ]);

        $query->andFilterWhere(['like', 'page_meta_keywords', $this->page_meta_keywords])
            ->andFilterWhere(['like', 'page_meta_desc', $this->page_meta_desc])
            ->andFilterWhere(['like', 'page_title', $this->page_title])
            ->andFilterWhere(['like', 'page_image', $this->page_image])
            ->andFilterWhere(['like', 'page_abstract', $this->page_abstract])
            ->andFilterWhere(['like', 'page_body', $this->page_body])
            ->andFilterWhere(['like', 'page_tag', $this->page_tag])
            ->andFilterWhere(['like', 'page_status', $this->page_status]);

        return $dataProvider;
    }
}
