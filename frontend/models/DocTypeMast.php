<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doc_type_mast".
 *
 * @property int $doc_type_id
 * @property int $doc_catg_id
 * @property string $doc_type_name
 * @property string $doc_catg_name
 * @property string $short_name
 */
class DocTypeMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_type_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_catg_id'], 'required'],
            [['doc_catg_id'], 'integer'],
            [['doc_type_name', 'doc_catg_name'], 'string', 'max' => 30],
            [['short_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'doc_type_id' => 'Doc Type ID',
            'doc_catg_id' => 'Doc Catg ID',
            'doc_type_name' => 'Doc Type Name',
            'doc_catg_name' => 'Doc Catg Name',
            'short_name' => 'Short Name',
        ];
    }
}
