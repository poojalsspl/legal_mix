<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "judgment_citation".
 *
 * @property integer $id
 * @property integer $judgment_code
 * @property integer $journal_code
 * @property string $journal_name
 * @property string $shrt_name
 * @property string $judgment_date
 * @property string $citation
 * @property string $journal_year
 * @property string $journal_volume
 * @property integer $journal_pno
 *
 * @property JournalMast $journalCode
 * @property JudgmentMast $judgmentCode
 */
class JudgmentCitation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'judgment_citation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judgment_code', 'journal_code', 'journal_pno'], 'integer'],
            [['judgment_date'], 'safe'],
            [['journal_name'], 'string', 'max' => 25],
            [['shrt_name'], 'string', 'max' => 10],
            [['citation'], 'string', 'max' => 12],
            [['journal_year'], 'string', 'max' => 6],
            [['journal_volume'], 'string', 'max' => 2],
            [['journal_code'], 'exist', 'skipOnError' => true, 'targetClass' => JournalMast::className(), 'targetAttribute' => ['journal_code' => 'journal_code']],
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
            'journal_code' => 'Journal Code',
            'journal_name' => 'Journal Name',
            'shrt_name' => 'Shrt Name',
            'judgment_date' => 'Judgment Date',
            'citation' => 'Citation',
            'journal_year' => 'Journal Year',
            'journal_volume' => 'Journal Volume',
            'journal_pno' => 'Journal Pno',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournalCode()
    {
        return $this->hasOne(JournalMast::className(), ['journal_code' => 'journal_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentCode()
    {
        return $this->hasOne(JudgmentMast::className(), ['judgment_code' => 'judgment_code']);
    }
}
