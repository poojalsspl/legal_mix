<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\JudgmentComments;

/**
 * JudgmentCommentsSearch represents the model behind the search form of `frontend\models\JudgmentComments`.
 */
class JudgmentCommentsSearch extends JudgmentComments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'judgment_code'], 'integer'],
            [['doc_id', 'judgment_user_comment', 'status', 'username', 'crdt'], 'safe'],
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
        $username = \Yii::$app->user->identity->username;
        $query = JudgmentComments::find()->where(['username'=>$username]);

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
            'judgment_code' => $this->judgment_code,
            'crdt' => $this->crdt,
        ]);

        $query->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'judgment_user_comment', $this->judgment_user_comment])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }

    public function searchabstract($params, $jcode)
    {
        //$username = \Yii::$app->user->identity->username;
        $query = JudgmentComments::find()->where(['status'=>'1'])->andWhere(['judgment_code'=>$jcode]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
             }
         $query->andFilterWhere([
            'id' => $this->id,
            'judgment_code' => $this->judgment_code,
            'crdt' => $this->crdt,
            
          ]);
          $query->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'judgment_user_comment', $this->judgment_user_comment])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'username', $this->username]);
            return $dataProvider;     
    }
}
