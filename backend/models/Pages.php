<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $page_id
 * @property integer $page_cat
 * @property string $page_meta_keywords
 * @property string $page_meta_desc
 * @property string $page_title
 * @property string $page_image
 * @property string $page_abstract
 * @property string $page_body
 * @property string $page_tag
 * @property string $page_status
 * @property string $page_cr_date
 *
 * @property Categories $pageCat
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_cat', 'page_title', 'page_abstract', 'page_body', 'page_cr_date'], 'required'],
            [['page_cat'], 'integer'],
            [['page_abstract', 'page_body', 'page_tag', 'page_status'], 'string'],
            [['page_cr_date', 'page_meta_keywords', 'page_meta_desc'], 'safe'],
            [['page_meta_keywords', 'page_meta_desc', 'page_image'], 'string', 'max' => 255],
            [['page_title'], 'string', 'max' => 100],
            [['page_cat'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['page_cat' => 'cat_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => 'Page ID',
            'page_cat' => 'Page Cat',
            'page_meta_keywords' => 'Page Meta Keywords',
            'page_meta_desc' => 'Page Meta Desc',
            'page_title' => 'Page Title',
            'page_image' => 'Page Image',
            'page_abstract' => 'Page Abstract',
            'page_body' => 'Page Body',
            'page_tag' => 'Page Tag',
            'page_status' => 'Page Status',
            'page_cr_date' => 'Page Cr Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageCat()
    {
        return $this->hasOne(Categories::className(), ['cat_id' => 'page_cat']);
    }
}
