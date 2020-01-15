<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cust_mast".
 *
 * @property int $custid
 * @property string $custname
 * @property int $userid
 * @property string $username
 * @property string $custlogo
 * @property string $regsdate
 * @property string $dob
 * @property int $mobile1
 * @property int $mobile2
 * @property string $fax
 * @property string $tele
 * @property string $email
 * @property string $custaddr
 * @property int $city_code
 * @property string $city_name
 * @property int $state_code
 * @property string $state_name
 * @property int $country_code
 * @property string $country_name
 * @property string $panno
 * @property string $gstno
 * @property string $adharno
 * @property int $cust_status_id
 * @property string $cust_status_name
 * @property int $cust_type_id
 * @property string $cust_type_name
 *
 * @property CityMast $cityCode
 * @property CountryMast $countryCode
 * @property CustStatusMast $custStatus
 * @property CustTypeMast $custType
 * @property StateMast $stateCode
 */
class CustMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'cust_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['custname', 'userid', 'custaddr', 'dob','email'], 'required'],
            [['userid', 'mobile1', 'mobile2', 'city_code', 'state_code', 'country_code', 'cust_status_id', 'cust_type_id'], 'integer'],
            [['custid','regsdate', 'dob'], 'safe'],
            [['custname', 'email'], 'string', 'max' => 100],
            [['username', 'city_name'], 'string', 'max' => 50],
            [['custlogo'], 'string', 'max' => 200],
            [['fax'], 'string', 'max' => 10],
            [['tele', 'state_name', 'country_name'], 'string', 'max' => 25],
            [['custaddr'], 'string', 'max' => 1000],
            [['panno'], 'string', 'max' => 20],
            [['gstno', 'adharno', 'cust_status_name', 'cust_type_name'], 'string', 'max' => 30],
            [['city_code'], 'exist', 'skipOnError' => true, 'targetClass' => CityMast::className(), 'targetAttribute' => ['city_code' => 'city_code']],
            [['country_code'], 'exist', 'skipOnError' => true, 'targetClass' => CountryMast::className(), 'targetAttribute' => ['country_code' => 'country_code']],
            [['cust_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustStatusMast::className(), 'targetAttribute' => ['cust_status_id' => 'cust_status_id']],
            [['cust_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustTypeMast::className(), 'targetAttribute' => ['cust_type_id' => 'cust_type_id']],
            [['state_code'], 'exist', 'skipOnError' => true, 'targetClass' => StateMast::className(), 'targetAttribute' => ['state_code' => 'state_code']],
            [['file'], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'custid' => 'Custid',
            'custname' => 'Customer name',
            'userid' => 'Userid',
            'username' => 'Username',
            'custlogo' => 'Logo',
            'regsdate' => 'Regsdate',
            'dob' => 'Date of birth',
            'mobile1' => 'Mobile',
            'mobile2' => 'Mobile2',
            'fax' => 'Fax',
            'tele' => 'Telephone',
            'email' => 'Email',
            'custaddr' => 'Address',
            'city_code' => 'City Code',
            'city_name' => 'City Name',
            'state_code' => 'State Code',
            'state_name' => 'State Name',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
            'panno' => 'PAN no',
            'gstno' => 'GST no',
            'adharno' => 'Aadhar no',
            'cust_status_id' => 'Cust Status ID',
            'cust_status_name' => 'Cust Status Name',
            'cust_type_id' => 'Cust Type',
            'cust_type_name' => 'Cust Type Name',
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
    public function getCountryCode()
    {
        return $this->hasOne(CountryMast::className(), ['country_code' => 'country_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustStatus()
    {
        return $this->hasOne(CustStatusMast::className(), ['cust_status_id' => 'cust_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustType()
    {
        return $this->hasOne(CustTypeMast::className(), ['cust_type_id' => 'cust_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStateCode()
    {
        return $this->hasOne(StateMast::className(), ['state_code' => 'state_code']);
    }
}
