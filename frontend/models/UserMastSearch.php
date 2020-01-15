<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserMast;

/**
 * UserMastSearch represents the model behind the search form about `app\models\UserMast`.
 */
class UserMastSearch extends UserMast
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['uid', 'userid', 'city_code', 'state_code', 'country_code', 'pin_code'], 'integer'],
            [['username', 'gender', 'user_pic', 'sign_date', 'bar_reg_no', 'dob', 'mobile_1', 'mobile_2', 'landline_1', 'landline_2', 'fax', 'email', 'alt_email', 'grad_yr', 'practice_since', 'city_name', 'state_name', 'country_name', 'user_address', 'status'], 'safe'],
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
        $query = UserMast::find();
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
            'uid' => $this->uid,
            'userid' => $this->userid,
            'sign_date' => $this->sign_date,
            'dob' => $this->dob,
            'grad_yr' => $this->grad_yr,
            'practice_since' => $this->practice_since,
            'city_code' => $this->city_code,
            'state_code' => $this->state_code,
            'country_code' => $this->country_code,
            'pin_code' => $this->pin_code,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'user_pic', $this->user_pic])
            ->andFilterWhere(['like', 'bar_reg_no', $this->bar_reg_no])
            ->andFilterWhere(['like', 'mobile_1', $this->mobile_1])
            ->andFilterWhere(['like', 'mobile_2', $this->mobile_2])
            ->andFilterWhere(['like', 'landline_1', $this->landline_1])
            ->andFilterWhere(['like', 'landline_2', $this->landline_2])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'alt_email', $this->alt_email])
            ->andFilterWhere(['like', 'city_name', $this->city_name])
            ->andFilterWhere(['like', 'state_name', $this->state_name])
            ->andFilterWhere(['like', 'country_name', $this->country_name])
            ->andFilterWhere(['like', 'user_address', $this->user_address])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

}

