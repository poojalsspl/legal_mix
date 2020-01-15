<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "judgment_bench_type".
 *
 * @property integer $id
 * @property string $details
 */
class JudgmentBenchType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'judgment_bench_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bench_type_text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bench_type_id' => 'ID',
            'bench_type_text' => 'Details',
        ];
    }
}
