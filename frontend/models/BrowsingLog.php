<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "browsing_log".
 *
 * @property string $username
 * @property string $browse_time
 * @property string $broowse_url
 */
class BrowsingLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'browsing_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['browse_time'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['browse_url'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'browse_time' => 'Browse Time',
            'browse_url' => 'Browse Url',
        ];
    }
}
