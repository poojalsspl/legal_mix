<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $catg_id
 * @property string $news_title
 * @property string $news_date
 * @property string $new_desc
 * @property string $status
 * @property string $posted_by
 *
 * @property NewsCatg $catg
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catg_id'], 'required'],
            [['catg_id'], 'integer'],
            [['news_date'], 'safe'],
            [['news_desc'], 'string'],
            [['news_title'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 1],
            [['posted_by'], 'string', 'max' => 50],
            [['catg_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewsCatg::className(), 'targetAttribute' => ['catg_id' => 'catg_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catg_id' => 'Catg ID',
            'news_title' => 'News Title',
            'news_date' => 'News Date',
            'news_desc' => 'New Desc',
            'status' => 'Status',
            'posted_by' => 'Posted By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatg()
    {
        return $this->hasOne(NewsCatg::className(), ['catg_id' => 'catg_id']);
    }
}
