<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "coupon_code".
 *
 * @property integer $coupon_id
 * @property string $rand_code
 * @property string $gen_date
 * @property string $exp_date
 * @property integer $use_limit
 * @property integer $used
 * @property string $discount_type
 * @property integer $discount_val
 */
class CouponCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rand_code', 'gen_date', 'exp_date', 'use_limit', 'discount_type', 'discount_val'], 'required'],
            [['gen_date', 'exp_date'], 'safe'],
            [['use_limit', 'used', 'discount_val'], 'integer'],
            [['rand_code'], 'string', 'max' => 6],
            [['discount_type'], 'string', 'max' => 1],
            [['rand_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupon_id' => 'Coupon ID',
            'rand_code' => 'Rand Code',
            'gen_date' => 'Gen Date',
            'exp_date' => 'Exp Date',
            'use_limit' => 'Use Limit',
            'used' => 'Used',
            'discount_type' => 'Discount Type',
            'discount_val' => 'Discount Val',
        ];
    }
}
