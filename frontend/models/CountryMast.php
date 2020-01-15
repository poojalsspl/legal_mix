<?php
namespace app\models;
use Yii;

/**
 * This is the model class for table "country_mast".
 *

 * @property integer $country_code
 * @property string $country_name
 * @property string $shrt_name
 *
 * @property BareactCatg[] $bareactCatgs
 * @property CityMast[] $cityMasts
 * @property CourtMast[] $courtMasts
 * @property JudgmentAct[] $judgmentActs
 * @property StateMast[] $stateMasts
 * @property UserMast[] $userMasts

 */

class CountryMast extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country_mast';
    }
    /**
     * @inheritdoc

     */
    public function rules()
    {
        return [
            [['country_name'], 'string', 'max' => 25],
            [['shrt_name'], 'string', 'max' => 10],
            [['country_name'], 'unique'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
            'shrt_name' => 'Shrt Name',
        ];
    }
    /**

     * @return \yii\db\ActiveQuery
     */
    public function getBareactCatgs()
    {
        return $this->hasMany(BareactCatg::className(), ['country_code' => 'country_code']);
    }

    /**

     * @return \yii\db\ActiveQuery

     */
    public function getCityMasts()
    {
        return $this->hasMany(CityMast::className(), ['country_code' => 'country_code']);
    }

    /**

     * @return \yii\db\ActiveQuery
     */
    public function getCourtMasts()
    {

        return $this->hasMany(CourtMast::className(), ['country_code' => 'country_code']);
    }



    /**

     * @return \yii\db\ActiveQuery

     */
    public function getJudgmentActs()
    {
        return $this->hasMany(JudgmentAct::className(), ['country_code' => 'country_code']);
    }

    /**

     * @return \yii\db\ActiveQuery
     */
    public function getStateMasts()
    {
        return $this->hasMany(StateMast::className(), ['country_code' => 'country_code']);
    }

    /**

     * @return \yii\db\ActiveQuery
     */
    public function getUserMasts()
    {
        return $this->hasMany(UserMast::className(), ['country_code' => 'country_code']);
    }

    public function getCountryName($id){
        $query = (new \yii\db\Query())
        ->select('country_name')
        ->from('country_mast')
        ->where('country_code=:country_code', [':country_code' => $id]);

        $command = $query->createCommand();

        // Execute the command:
        $rows = $command->queryAll();
         return $rows[0]['country_name'];
     }

}

