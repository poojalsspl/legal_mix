<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "judgment_count".
 *
 * @property int|null $sc_judgment
 * @property int|null $hc_judgment
 * @property int|null $fc_judgment
 * @property int|null $tr_judgment
 * @property string $crdt
 * @property int $ba
 * @property int|null $totind_judgment
 */
class JudgmentCount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judgment_count';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sc_judgment', 'hc_judgment', 'fc_judgment', 'tr_judgment', 'ba', 'totind_judgment'], 'integer'],
            [['crdt'], 'safe'],
            [['ba'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sc_judgment' => 'Sc Judgment',
            'hc_judgment' => 'Hc Judgment',
            'fc_judgment' => 'Fc Judgment',
            'tr_judgment' => 'Tr Judgment',
            'crdt' => 'Crdt',
            'ba' => 'Ba',
            'totind_judgment' => 'Totind Judgment',
        ];
    }
}
