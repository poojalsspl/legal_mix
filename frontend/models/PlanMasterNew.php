<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan_master_new".
 *
 * @property int $plan_code
 * @property int $court_code
 * @property string $court_name
 * @property string $plan_type
 * @property string $price
 * @property int $duration
 */
class PlanMasterNew extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_master_new';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['court_code', 'duration'], 'integer'],
            [['court_name', 'price', 'duration'], 'required'],
            [['price'], 'number'],
            [['court_name'], 'string', 'max' => 100],
            [['plan_type'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'plan_code' => 'Plan Code',
            'court_code' => 'Court Code',
            'court_name' => 'Court Name',
            'plan_type' => 'Plan Type',
            'price' => 'Price',
            'duration' => 'Duration',
        ];
    }
}
