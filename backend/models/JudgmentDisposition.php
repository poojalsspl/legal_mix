<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "judgment_disposition".
 *
 * @property integer $id
 * @property string $details
 */
class JudgmentDisposition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'judgment_disposition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['disposition_text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'disposition_id' => 'ID',
            'disposition_text' => 'Details',
        ];
    }
}
