<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Dictionary;

/**
 * DictionarySearch represents the model behind the search form of `frontend\models\Dictionary`.
 */
class DictionarySearch extends Dictionary
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dictionary_code'], 'integer'],
            [['word', 'defination', 'synonym', 'created_date'], 'safe'],
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
        $query = Dictionary::find();

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
            'dictionary_code' => $this->dictionary_code,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'word', $this->word])
            ->andFilterWhere(['like', 'defination', $this->defination])
            ->andFilterWhere(['like', 'synonym', $this->synonym]);

        return $dataProvider;
    }
}
