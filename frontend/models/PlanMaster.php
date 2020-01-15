<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan_master".
 *
 * @property string $plan
 * @property string $price
 * @property int $duration
 */
class PlanMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_master';
    }

    /**
     * {@inheritdoc}
      */
    public function rules()
    { 
        return [
            [['plan', 'price', 'duration'], 'required'],
            [['price'], 'number'],
            [['duration'], 'integer'],
            [['plan','description'], 'string', 'max' => 50],
            [['plan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'plan' => 'Plan',
            'price' => 'Price',
            'duration' => 'Duration',
            'description' => 'Description',
            'corporate_ip' => 'User IP',
        ];
    }

   
}
