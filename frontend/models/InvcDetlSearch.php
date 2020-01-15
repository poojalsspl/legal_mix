<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvcDetl;

/**
 * InvcDetlSearch represents the model behind the search form of `app\models\InvcDetl`.
 */
class InvcDetlSearch extends InvcDetl
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'invc_numb', 'invc_qty', 'invc_rate', 'invc_amt', 'disc'], 'integer'],
            [['invc_desc'], 'safe'],
            [['gst'], 'number'],
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
        $query = InvcDetl::find();

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
            'Id' => $this->Id,
            'invc_numb' => $this->invc_numb,
            'invc_qty' => $this->invc_qty,
            'invc_rate' => $this->invc_rate,
            'invc_amt' => $this->invc_amt,
            'disc' => $this->disc,
            'gst' => $this->gst,
        ]);

        $query->andFilterWhere(['like', 'invc_desc', $this->invc_desc]);

        return $dataProvider;
    }
}
