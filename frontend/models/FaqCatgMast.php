<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "faq_catg_mast".
 *
 * @property int $faq_catg_id
 * @property string $faq_catg_desc
 *
 * @property Faq[] $faqs
 */
class FaqCatgMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq_catg_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faq_catg_desc'], 'required'],
            [['faq_catg_desc'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'faq_catg_id' => 'Faq Catg ID',
            'faq_catg_desc' => 'Faq Catg Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqs()
    {
        return $this->hasMany(Faq::className(), ['faq_catg_id' => 'faq_catg_id']);
    }
}
