<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "judgment_comments".
 *
 * @property int $id
 * @property int|null $judgment_code
 * @property string|null $doc_id
 * @property string|null $judgment_user_comment
 * @property string|null $status
 * @property string|null $username
 * @property string|null $crdt
 */
class JudgmentComments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judgment_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judgment_code'], 'integer'],
            [['judgment_user_comment'], 'string'],
            [['crdt'], 'safe'],
            [['doc_id'], 'string', 'max' => 40],
            [['status'], 'string', 'max' => 1],
            [['username'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judgment_code' => 'Judgment Code',
            'doc_id' => 'Doc ID',
            'judgment_user_comment' => 'Judgment User Comment',
            'status' => 'Status',
            'username' => 'Username',
            'crdt' => 'Crdt',
        ];
    }
}
