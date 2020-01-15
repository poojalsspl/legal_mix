<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "state_mast".
 *
 * @property integer $state_code
 * @property string $state_name
 * @property string $shrt_name
 * @property string $zone
 * @property integer $country_code
 * @property string $country_name
 * @property string $country_shrt_name
 * @property string $cr_date
 * @property integer $status
 *
 * @property CityMast[] $cityMasts
 * @property CourtMast[] $courtMasts
 * @property CountryMast $countryCode
 * @property UserMast[] $userMasts
 */
class StateMast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state_mast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code', 'status'], 'integer'],
            [['cr_date'], 'safe'],
            [['state_name', 'country_name'], 'string', 'max' => 25],
            [['shrt_name', 'country_shrt_name'], 'string', 'max' => 10],
            [['zone'], 'string', 'max' => 3],
            [['country_code'], 'exist', 'skipOnError' => true, 'targetClass' => CountryMast::className(), 'targetAttribute' => ['country_code' => 'country_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'country_name' => 'Country Name',
            'country_shrt_name' => 'Country Shrt Name',
            'country_code' => 'Country Code',
            'state_code' => 'State Code',
            'state_name' => 'State Name',
            'shrt_name' => 'Shrt Name',
            'zone' => 'Zone',
            'cr_date' => 'Cr Date',
            'status' => 'Status',
        ];
    }

     public static function getSubCatList($id_cat) {
        $out = [];
         $models = StateMast::find()
        ->where('country_code = :country_code')
        ->addParams([':country_code' => $id_cat])
        ->all();
       foreach ($models as $i => $state) {
          //  print_r($state);
       $out[] = ['id' => $state['state_code'], 'name' => $state['state_name']];
        }
       return $out;
}


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCityMasts()
    {
        return $this->hasMany(CityMast::className(), ['state_code' => 'state_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourtMasts()
    {
        return $this->hasMany(CourtMast::className(), ['state_code' => 'state_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryCode()
    {
        return $this->hasOne(CountryMast::className(), ['country_code' => 'country_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserMasts()
    {
        return $this->hasMany(UserMast::className(), ['state_code' => 'state_code']);
    }

        public function getStateName($id){
        $query = (new \yii\db\Query())
        ->select('state_name')
        ->from('state_mast')
        ->where('state_code=:state_code', [':state_code' => $id]);

        $command = $query->createCommand();

        // Execute the command:
        $rows = $command->queryAll();
         return $rows[0]['state_name'];
     }
}
