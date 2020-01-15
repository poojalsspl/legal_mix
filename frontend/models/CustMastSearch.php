<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CustMast;

/**
 * CustMastSearch represents the model behind the search form of `app\models\CustMast`.
 */
class CustMastSearch extends CustMast
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['custid', 'userid', 'mobile1', 'mobile2', 'city_code', 'state_code', 'country_code', 'cust_status_id', 'cust_type_id'], 'integer'],
            [['custname', 'username', 'custlogo', 'regsdate', 'dob', 'fax', 'tele', 'email', 'custaddr', 'city_name', 'state_name', 'country_name', 'panno', 'gstno', 'adharno', 'cust_status_name', 'cust_type_name'], 'safe'],
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
    public function search($params,$user_id)
    {
        $query = CustMast::find()
        ->where(['userid' => $user_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 10 ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

          $query->andFilterWhere(['like', 'custname', $this->custname])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'custlogo', $this->custlogo])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'tele', $this->tele])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'custaddr', $this->custaddr])
            ->andFilterWhere(['like', 'city_name', $this->city_name])
            ->andFilterWhere(['like', 'state_name', $this->state_name])
            ->andFilterWhere(['like', 'country_name', $this->country_name])
            ->andFilterWhere(['like', 'panno', $this->panno])
            ->andFilterWhere(['like', 'gstno', $this->gstno])
            ->andFilterWhere(['like', 'adharno', $this->adharno])
            ->andFilterWhere(['like', 'cust_status_name', $this->cust_status_name])
            ->andFilterWhere(['like', 'cust_type_name', $this->cust_type_name]);

        return $dataProvider;
    }
}
