<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form about `\backend\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'cat_root'], 'integer'],
            [['cat_title', 'cat_meta_keywords', 'cat_meta_desc', 'cat_image', 'cat_desc', 'cat_nav'], 'safe'],
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
        $query = Categories::find();

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
            'cat_id' => $this->cat_id,
            'cat_root' => $this->cat_root,
        ]);

        $query->andFilterWhere(['like', 'cat_title', $this->cat_title])
            ->andFilterWhere(['like', 'cat_meta_keywords', $this->cat_meta_keywords])
            ->andFilterWhere(['like', 'cat_meta_desc', $this->cat_meta_desc])
            ->andFilterWhere(['like', 'cat_image', $this->cat_image])
            ->andFilterWhere(['like', 'cat_desc', $this->cat_desc])
            ->andFilterWhere(['like', 'cat_nav', $this->cat_nav]);

        return $dataProvider;
    }
}
