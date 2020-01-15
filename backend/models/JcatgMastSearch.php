<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JcatgMast;

/**
 * JcatgMastSearch represents the model behind the search form about `\backend\models\JcatgMast`.
 */
class JcatgMastSearch extends JcatgMast
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jcatg_id'], 'integer'],
            [['jcatg_description'], 'safe'],
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
        $query = JcatgMast::find();

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
            'jcatg_id' => $this->jcatg_id,
        ]);

        $query->andFilterWhere(['like', 'jcatg_description', $this->jcatg_description]);

        return $dataProvider;
    }
}
