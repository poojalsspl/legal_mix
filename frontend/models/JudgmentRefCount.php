<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "judgment_ref_count".
 *
 * @property int $judgment_code
 * @property string $doc_id
 * @property int $ref_count
 */
class JudgmentRefCount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judgment_ref_count';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judgment_code', 'ref_count'], 'integer'],
            [['doc_id'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'judgment_code' => 'Judgment Code',
            'doc_id' => 'Doc ID',
            'ref_count' => 'Ref Count',
        ];
    }

    public  static function getRefCount($RCountId){

        $record=JudgmentRefCount::find()
            ->asArray()
            ->select(['ref_count'])
            ->where(['doc_id' => $RCountId]);
        $row = $record->all();
        if(empty($row)){
            return 0;
        }else{
            return $row["ref_count"];
        }






    }
}
