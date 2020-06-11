<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dictionary_mast".
 *
 * @property int $dictionary_code
 * @property string|null $dictionary_name
 * @property string|null $short_name
 * @property int|null $dictionary_type
 */
class DictionaryMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dictionary_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dictionary_code'], 'required'],
            [['dictionary_code', 'dictionary_type'], 'integer'],
            [['dictionary_name'], 'string', 'max' => 50],
            [['short_name'], 'string', 'max' => 10],
            [['dictionary_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dictionary_code' => 'Dictionary Code',
            'dictionary_name' => 'Dictionary Name',
            'short_name' => 'Short Name',
            'dictionary_type' => 'Dictionary Type',
        ];
    }
}
