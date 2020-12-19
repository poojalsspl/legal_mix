<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "judgment_court_count".
 *
 * @property int $judgment_count
 * @property int|null $court_code
 * @property string|null $court_type
 * @property string|null $court_type_desc
 * @property string|null $court_name
 */
class JudgmentCourtCount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judgment_court_count';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judgment_count', 'court_code'], 'integer'],
            [['court_type'], 'string', 'max' => 2],
            [['court_type_desc'], 'string', 'max' => 50],
            [['court_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'judgment_count' => 'Judgment Count',
            'court_code' => 'Court Code',
            'court_type' => 'Court Type',
            'court_type_desc' => 'Court Type Desc',
            'court_name' => 'Court Name',
        ];
    }
}
