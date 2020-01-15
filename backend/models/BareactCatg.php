<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bareact_catg".
 *
 * @property integer $bareact_catgid
 * @property string $bareact_catg_name
 * @property integer $country_code
 * @property string $country_name
 *
 * @property CountryMast $countryCode
 * @property BareactMast[] $bareactMasts
 * @property JudgmentAct[] $judgmentActs
 */
class BareactCatg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bareact_catg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code'], 'integer'],
            [['bareact_catg_name'], 'string', 'max' => 255],
            [['country_name'], 'string', 'max' => 25],
            [['country_code'], 'exist', 'skipOnError' => true, 'targetClass' => CountryMast::className(), 'targetAttribute' => ['country_code' => 'country_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bareact_catgid' => 'Bareact Catgid',
            'bareact_catg_name' => 'Bareact Catg Name',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
        ];
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
    public function getBareactMasts()
    {
        return $this->hasMany(BareactMast::className(), ['bareact_catgid' => 'bareact_catgid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentActs()
    {
        return $this->hasMany(JudgmentAct::className(), ['bareact_catgid' => 'bareact_catgid']);
    }
}
