<?php
namespace app\models;
use Yii;
/**
 * This is the model class for table "user_mast".
 *

 * @property integer $id
 * @property string $username
 * @property string $gender
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
 * @property CityMast $cityCode
 * @property StateMast $stateCode
 * @property CountryMast $countryCode

 */
class UserMast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
    */

 public $imageFile;
 public $permissions;
    public static function tableName()
    {
        return 'user_mast';
    }
    /**
     * @inheritdoc
**/

    public function rules()
    {
        return [
            [[ 'user_address', 'country_code', 'state_code','first_name', 'last_name', 'pan_no', 'city_code', 'pin_code', 'dob', 'grad_yr', 'practice_since', 'gender', 'bar_reg_no'], 'required'],
            [[ 'city_code', 'state_code', 'country_code'], 'integer'],
            [['sign_date', 'dob', 'grad_yr', 'practice_since', 'activation_date', 'exp_date'], 'safe'],
            [['city_name'], 'string', 'max' => 50],
            [['alt_email', 'user_address', 'practise_area'], 'string', 'max' => 255],
            [['mobile_1', 'mobile_2'], 'number','max' => 10000000000],
            [['pin_code'], 'number'],
             [['landline_1', 'landline_2', 'fax'], 'number','max' => 10000000000],
            [['state_name', 'country_name'], 'string', 'max' => 25],
            [['alt_email'], 'email'],
            [['first_name', 'last_name'], 'string', 'max' => 25],
            [['pan_no', 'pin_code'], 'string', 'max' => 10],
            [['gst_no'], 'string', 'max' => 15],
            [['bar_reg_no'], 'string', 'max' => 10],            
            [['user_type', 'company_name', 'profession', 'no_of_laywers',  'user_ip'], 'string', 'max' => 25],

            [['city_code'], 'exist', 'skipOnError' => true, 'targetClass' => CityMast::className(), 'targetAttribute' => ['city_code' => 'city_code']],
            [['state_code'], 'exist', 'skipOnError' => true, 'targetClass' => StateMast::className(), 'targetAttribute' => ['state_code' => 'state_code']],
            [['country_code'], 'exist', 'skipOnError' => true, 'targetClass' => CountryMast::className(), 'targetAttribute' => ['country_code' => 'country_code']],
          //  [['imageFile'], 'file', 'extensions' => 'png,jpg',
          //   'maxSize' => 512000, 'tooBig' => 'Limit is 500KB'],
             [['user_pic'], 'image','extensions'=>'jpg,jpeg,gif,png', 'maxSize' => 512000]];
    }
    /**
     * @inheritdoc

     */
    public function attributeLabels()
    {

        return [

            'id' => 'id',
            'first_name' => 'First Name',
            'last_name' => 'Last Name', 
            'pan_no' => 'Pan No',
            'gst_no' => 'Gst No',           
            'activation_date' => 'Activation Date',
            'exp_date' => 'Account Expiry Date',
            'user_type' => 'User Type',
            'company_name' => 'Company Name',
            'profession' => 'Profession',
            'no_of_laywers' => 'No of Laywers',
            'practise_area' => 'Practise Area',
            'user_ip' => 'user_ip',
            'gender' => 'Gender',
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

    public function getYearsList() {
        $currentYear = date('Y');
        $yearFrom = 1950;
        $yearsRange = range($yearFrom, $currentYear);
        return array_combine($yearsRange, $yearsRange);
    }

     public function getPracticeYears() {
        $currentYear = date('Y');
        $yearFrom = 1950;
        $yearsRange = range($yearFrom, $currentYear);
        return array_combine($yearsRange, $yearsRange);
    }


    

}

