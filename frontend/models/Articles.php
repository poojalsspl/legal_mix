<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $status
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'status' => 'Status',
        ];
    }
}
