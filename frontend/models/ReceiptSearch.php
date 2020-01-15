<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\receipt;

/**
 * ReceiptSearch represents the model behind the search form of `app\models\receipt`.
 */
class ReceiptSearch extends receipt
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'invoice_no'], 'integer'],
            [['payment_date', 'instrument_no', '    instrument_mode', 'instrument_date', 'bank_name'], 'safe'],
            [['paid_amt'], 'number'],
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
        $query = receipt::find();

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
            'invoice_no' => $this->invoice_no,
            'payment_date' => $this->payment_date,
            'instrument_date' => $this->instrument_date,
            'instrument_amt' => $this->paid_amt,
        ]);

        $query->andFilterWhere(['like', 'instrument_no', $this->instrument_no])
            ->andFilterWhere(['like', 'instrument_mode', $this->instrument_mode])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name]);

        return $dataProvider;
    }
}
