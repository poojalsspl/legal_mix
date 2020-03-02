<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "faq".
 *
 * @property int $faq_id
 * @property int $faq_catg_id
 * @property string $faq_title
 * @property string $faq_date
 * @property string $faq_desc
 * @property string $status
 * @property string $posted_by
 *
 * @property FaqCatgMast $faqCatg
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faq_catg_id'], 'required'],
            [['faq_catg_id'], 'integer'],
            [['faq_date'], 'safe'],
            [['faq_desc'], 'string'],
            [['faq_title'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 1],
            [['posted_by'], 'string', 'max' => 50],
            [['faq_catg_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaqCatgMast::className(), 'targetAttribute' => ['faq_catg_id' => 'faq_catg_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'faq_id' => 'Faq ID',
            'faq_catg_id' => 'Faq Catg ID',
            'faq_title' => 'Faq Title',
            'faq_date' => 'Faq Date',
            'faq_desc' => 'Faq Desc',
            'status' => 'Status',
            'posted_by' => 'Posted By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqCatg()
    {
        return $this->hasOne(FaqCatgMast::className(), ['faq_catg_id' => 'faq_catg_id']);
    }

    public function getTruncatedFaqs()
    {
    if (strlen($this->faq_desc) <= 30)
        return $this->faq_desc;
    else
        return substr($this->faq_desc, 0, 30) . '...';
    }
}
