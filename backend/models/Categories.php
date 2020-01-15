<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $cat_id
 * @property string $cat_title
 * @property string $cat_meta_keywords
 * @property string $cat_meta_desc
 * @property integer $cat_root
 * @property string $cat_image
 * @property string $cat_desc
 * @property string $cat_nav
 *
 * @property Categories $catRoot
 * @property Categories[] $categories
 * @property Pages[] $pages
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_title', 'cat_meta_keywords', 'cat_meta_desc', 'cat_root', 'cat_desc'], 'required'],
            [['cat_root'], 'integer'],
            [['cat_desc', 'cat_nav'], 'string'],
            [['cat_title'], 'string', 'max' => 100],
            [['cat_meta_keywords', 'cat_meta_desc', 'cat_image'], 'string', 'max' => 255],
            /*[['cat_root'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['cat_root' => 'cat_id']],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_title' => 'Cat Title',
            'cat_meta_keywords' => 'Cat Meta Keywords',
            'cat_meta_desc' => 'Cat Meta Desc',
            'cat_root' => 'Cat Root',
            'cat_image' => 'Cat Image',
            'cat_desc' => 'Cat Desc',
            'cat_nav' => 'Cat Nav',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatRoot()
    {
        return $this->hasOne(Categories::className(), ['cat_id' => 'cat_root']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['cat_root' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['page_cat' => 'cat_id']);
    }
}
