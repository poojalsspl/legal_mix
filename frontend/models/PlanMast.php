<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "plan_mast".
 *
 * @property int $plan_code
 * @property string|null $plan_name
 * @property int|null $plan_price
 * @property int|null $duration in months
 */
class PlanMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_code'], 'required'],
            [['plan_code', 'plan_price', 'duration'], 'integer'],
            [['plan_name'], 'string', 'max' => 50],
            [['plan_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'plan_code' => 'Plan Code',
            'plan_name' => 'Plan Name',
            'plan_price' => 'Plan Price',
            'duration' => 'Duration',
        ];
    }
}
