<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvcMast;


/**
 * InvcMastSearch represents the model behind the search form of `app\models\InvcMast`.
 */
class InvcMastSearch extends InvcMast
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invc_numb', 'userid', 'invc_disc'], 'integer'],
            [['invc_date','custid'], 'safe'],
            [['invc_amt', 'GST'], 'number'],
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
        //$query = InvcMast::find();
        $query = InvcMast::find()->where(['invc_mast.userid' => Yii::$app->user->id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query->joinWith('customerName');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'invc_numb' => $this->invc_numb,
            'invc_date' => $this->invc_date,
             //'userid' => $this->userid,
            'invc_amt' => $this->invc_amt,
             ]);

        $query->andFilterWhere(['like', 'cust_mast.custname', $this->custid]);

        return $dataProvider;
    }
}
