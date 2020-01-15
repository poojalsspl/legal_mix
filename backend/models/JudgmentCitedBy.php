<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "judgment_cited_by".
 *
 * @property integer $id
 * @property integer $judgment_code
 * @property string $judgment_source_code
 * @property integer $judgment_code_ref
 * @property string $judgment_source_code_ref
 * @property string $judgment_title_ref
 *
 * @property JudgmentMast $judgmentCode
 */
class JudgmentCitedBy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'judgment_cited_by';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judgment_code', 'judgment_code_ref'], 'integer'],
            [['judgment_source_code', 'judgment_source_code_ref', 'judgment_title_ref'], 'required'],
            [['judgment_source_code', 'judgment_source_code_ref'], 'string', 'max' => 40],
            [['judgment_title_ref'], 'string', 'max' => 255],
            [['judgment_code'], 'exist', 'skipOnError' => true, 'targetClass' => JudgmentMast::className(), 'targetAttribute' => ['judgment_code' => 'judgment_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judgment_code' => 'Judgment Code',
            'judgment_source_code' => 'Source Code',
            'judgment_code_ref' => 'Cited Code',
            'judgment_source_code_ref' => 'Cited Source Code',
            'judgment_title_ref' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentCode()
    {
        return $this->hasOne(JudgmentMast::className(), ['judgment_code' => 'judgment_code']);
    }
}
