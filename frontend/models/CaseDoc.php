<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "case_doc".
 *
 * @property int $Id
 * @property int $userid
 * @property int $cust_id
 * @property int $case_id
 * @property int $doc_type_id
 * @property string $doc_url
 * @property string $case_doc_type
 */
class CaseDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'case_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'cust_id', 'case_id', 'doc_type_id', 'doc_url'], 'required'],
            [['userid', 'cust_id', 'case_id', 'doc_type_id'], 'integer'],
            [['doc_url'], 'string', 'max' => 250],
            [['case_doc_type'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'userid' => 'Userid',
            'cust_id' => 'Cust ID',
            'case_id' => 'Case ID',
            'doc_type_id' => 'Doc Type ID',
            'doc_url' => 'Doc Url',
            'case_doc_type' => 'Case Doc Type',
        ];
    }
}
