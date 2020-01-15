<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CaseMast;

/**
 * CaseMastSearch represents the model behind the search form of `app\models\CaseMast`.
 */
class CaseMastSearch extends CaseMast
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'userid',  'case_type_id'], 'integer'],
            [['case_desc', 'case_reg_date', 'case_over_date', 'appeal_number', 'court_code', 'appellant_name', 'respondant_name', 'case_summary', 'case_status','custid'], 'safe'],
            [['case_fees'], 'number'],
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
        $query = CaseMast::find();
        $query->joinWith(['customer']);
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

    

        $query->andFilterWhere(['like', 'case_desc', $this->case_desc])
            ->andFilterWhere(['like', 'appeal_number', $this->appeal_number])
            ->andFilterWhere(['like', 'court', $this->court])
            ->andFilterWhere(['like', 'appellant_name', $this->appellant_name])
            ->andFilterWhere(['like', 'respondant_name', $this->respondant_name])
            ->andFilterWhere(['like', 'case_summary', $this->case_summary])
            ->andFilterWhere(['like', 'case_status', $this->case_status])
            ->andFilterWhere(['like', 'cust_mast.custname', $this->custid]);
           

        return $dataProvider;
    }

   
}
