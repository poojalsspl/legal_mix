<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_mast".
 *
 * @property integer $uid
 * @property integer $userid
 * @property string $username
 * @property string $user_pic
 * @property string $sign_date
 * @property string $bar_reg_no
 * @property string $dob
 * @property string $mobile_1
 * @property string $mobile_2
 * @property string $landline_1
 * @property string $landline_2
 * @property string $fax
 * @property string $email
 * @property string $alt_email
 * @property string $grad_yr
 * @property string $practice_since
 * @property integer $city_code
 * @property string $city_name
 * @property integer $state_code
 * @property string $state_name
 * @property integer $country_code
 * @property string $country_name
 * @property string $user_address
 * @property integer $pin_code
 * @property string $status
 *
 * @property CityMast $cityCode
 * @property StateMast $stateCode
 * @property CountryMast $countryCode
 */
class UserMast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_mast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'username', 'status'], 'required'],
            [['userid', 'city_code', 'state_code', 'country_code', 'pin_code'], 'integer'],
            [['sign_date', 'dob', 'grad_yr', 'practice_since','gender'], 'safe'],
            [['username', 'city_name'], 'string', 'max' => 50],
            [['user_pic', 'email', 'alt_email', 'user_address'], 'string', 'max' => 255],
            [['bar_reg_no'], 'string', 'max' => 100],
            [['mobile_1', 'mobile_2'], 'string', 'max' => 12],
            [['landline_1', 'landline_2', 'fax'], 'string', 'max' => 16],
            [['state_name', 'country_name'], 'string', 'max' => 25],
            [['status'], 'string', 'max' => 1],
            [['city_code'], 'exist', 'skipOnError' => true, 'targetClass' => CityMast::className(), 'targetAttribute' => ['city_code' => 'city_code']],
            [['state_code'], 'exist', 'skipOnError' => true, 'targetClass' => StateMast::className(), 'targetAttribute' => ['state_code' => 'state_code']],
            [['country_code'], 'exist', 'skipOnError' => true, 'targetClass' => CountryMast::className(), 'targetAttribute' => ['country_code' => 'country_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'userid' => 'Userid',
            'username' => 'Username',
            'user_pic' => 'User Pic',
            'sign_date' => 'Sign Date',
            'bar_reg_no' => 'Bar Reg No',
            'dob' => 'Dob',
            'mobile_1' => 'Mobile 1',
            'mobile_2' => 'Mobile 2',
            'landline_1' => 'Landline 1',
            'landline_2' => 'Landline 2',
            'fax' => 'Fax',
            'email' => 'Email',
            'alt_email' => 'Alt Email',
            'grad_yr' => 'Grad Yr',
            'practice_since' => 'Practice Since',
            'city_code' => 'City Code',
            'city_name' => 'City Name',
            'state_code' => 'State Code',
            'state_name' => 'State Name',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
            'user_address' => 'User Address',
            'pin_code' => 'Pin Code',
            'gender' => 'Gender',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCityCode()
    {
        return $this->hasOne(CityMast::className(), ['city_code' => 'city_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStateCode()
    {
        return $this->hasOne(StateMast::className(), ['state_code' => 'state_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryCode()
    {
        return $this->hasOne(CountryMast::className(), ['country_code' => 'country_code']);
    }
}
