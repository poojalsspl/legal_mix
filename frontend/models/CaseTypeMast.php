<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "case_type_mast".
 *
 * @property int $Id
 * @property string $case_type_desc
 */
class CaseTypeMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'case_type_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['case_type_desc'], 'required'],
            [['case_type_desc'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'case_type_desc' => 'Case Type Desc',
        ];
    }
}
