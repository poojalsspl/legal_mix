<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $doc_id
 * @property int|null $judgment_code
 * @property string|null $judgment_title
 * @property int|null $court_code
 * @property string|null $save_date
 * @property string|null $link
 */
class UserLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judgment_code', 'court_code'], 'integer'],
            [['save_date'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['doc_id'], 'string', 'max' => 40],
            [['judgment_title'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'doc_id' => 'Doc ID',
            'judgment_code' => 'Judgment Code',
            'judgment_title' => 'Judgment Title',
            'court_code' => 'Court Code',
            'save_date' => 'Save Date',
            'link' => 'Link',
        ];
    }
}
