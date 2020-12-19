<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "highcourt_detl".
 *
 * @property int $id
 * @property int|null $court_code
 * @property string|null $court_name
 * @property string|null $court_description
 * @property string $crdt
 */
class HighcourtDetl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'highcourt_detl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['court_code'], 'integer'],
            [['court_description'], 'string'],
            [['crdt'], 'safe'],
            [['court_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'court_code' => 'Court Code',
            'court_name' => 'Court Name',
            'court_description' => 'Court Description',
            'crdt' => 'Crdt',
        ];
    }
}
