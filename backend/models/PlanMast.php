<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plan_mast".
 *
 * @property integer $plan_code
 * @property string $plan_name
 * @property string $plan_expiry
 * @property string $plan_rate
 * @property string $coupon_allowed
 * @property string $plan_desc
 * @property string $search_limit
 * @property string $access_limit
 * @property string $access_rate_limit
 * @property string $concurrent_connection
 * @property string $plan_taxed
 * @property string $static_ip
 */
class PlanMast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_mast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_name', 'plan_expiry', 'plan_rate', 'coupon_allowed', 'plan_desc', 'plan_taxed', 'static_ip'], 'required'],
            [['plan_desc'], 'string'],
            [['plan_name'], 'string', 'max' => 255],
            [['plan_expiry', 'search_limit', 'access_limit'], 'string', 'max' => 4],
            [['plan_rate'], 'string', 'max' => 6],
            [['coupon_allowed', 'access_rate_limit', 'concurrent_connection', 'plan_taxed', 'static_ip'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'plan_code' => 'Plan Code',
            'plan_name' => 'Plan Name',
            'plan_expiry' => 'Plan Expiry',
            'plan_rate' => 'Plan Rate',
            'coupon_allowed' => 'Coupon Allowed',
            'plan_desc' => 'Plan Desc',
            'search_limit' => 'Search Limit',
            'access_limit' => 'Access Limit',
            'access_rate_limit' => 'Access Rate Limit',
            'concurrent_connection' => 'Concurrent Connection',
            'plan_taxed' => 'Plan Taxed',
            'static_ip' => 'Static Ip',
        ];
    }
}
