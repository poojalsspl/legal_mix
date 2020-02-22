<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "judgment_abstract_suggest".
 *
 * @property int $id
 * @property int|null $judgment_code
 * @property string|null $doc_id
 * @property string|null $judgment_title
 * @property string|null $judgment_abstract
 * @property string|null $abstract_status
 * @property string|null $username
 * @property string|null $created_date
 */
class JudgmentAbstractSuggest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judgment_abstract_suggest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judgment_code'], 'integer'],
            [['judgment_abstract'], 'string'],
            [['created_date'], 'safe'],
            [['doc_id'], 'string', 'max' => 40],
            [['judgment_title'], 'string', 'max' => 255],
            [['abstract_status'], 'string', 'max' => 7],
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
            'judgment_title' => 'Judgment Title',
            'judgment_abstract' => 'Judgment Abstract',
            'abstract_status' => 'Abstract Status',
            'username' => 'Username',
            'created_date' => 'Created Date',
        ];
    }
}
