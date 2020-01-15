<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cust_status_mast".
 *
 * @property int $cust_status_id
 * @property string $cust_status_name
 * @property string $short_name
 *
 * @property CustMast[] $custMasts
 */
class CustStatusMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cust_status_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cust_status_name'], 'required'],
            [['cust_status_name'], 'string', 'max' => 30],
            [['short_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cust_status_id' => 'Cust Status ID',
            'cust_status_name' => 'Cust Status Name',
            'short_name' => 'Short Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustMasts()
    {
        return $this->hasMany(CustMast::className(), ['cust_status_id' => 'cust_status_id']);
    }
}
