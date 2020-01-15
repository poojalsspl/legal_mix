<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "news_catg".
 *
 * @property int $catg_id
 * @property string $catg_desc
 *
 * @property News[] $news
 */
class NewsCatg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_catg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catg_desc'], 'required'],
            [['catg_desc'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'catg_id' => 'Catg ID',
            'catg_desc' => 'Catg Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['catg_id' => 'catg_id']);
    }
}
