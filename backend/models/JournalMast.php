<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_mast".
 *
 * @property integer $journal_code
 * @property string $journal_name
 * @property string $shrt_name
 * @property string $pub_freq
 * @property string $remark
 *
 * @property JudgmentCitation[] $judgmentCitations
 */
class JournalMast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_mast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_name'], 'string', 'max' => 25],
            [['shrt_name'], 'string', 'max' => 10],
            [['pub_freq'], 'string', 'max' => 20],
            [['remark'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_code' => 'Journal Code',
            'journal_name' => 'Journal Name',
            'shrt_name' => 'Shrt Name',
            'pub_freq' => 'Pub Freq',
            'remark' => 'Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentCitations()
    {
        return $this->hasMany(JudgmentCitation::className(), ['journal_code' => 'journal_code']);
    }
}
