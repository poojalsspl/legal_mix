<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dictionary".
 *
 * @property int $id
 * @property string|null $word
 * @property string|null $defination
 * @property string|null $synonym
 * @property int|null $dictionary_code
 * @property string|null $created_date
 */
class Dictionary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dictionary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['defination'], 'string'],
            [['dictionary_code'], 'integer'],
            [['created_date'], 'safe'],
            [['word'], 'string', 'max' => 45],
            [['synonym'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
            'defination' => 'Defination',
            'synonym' => 'Synonym',
            'dictionary_code' => 'Dictionary Code',
            'created_date' => 'Created Date',
        ];
    }
}
