<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "judgment_ref_count_by".
 *
 * @property int $judgment_code
 * @property string $doc_id_ref
 * @property int $ref_by_count
 */
class JudgmentRefByCount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judgment_ref_count_by';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judgment_code', 'ref_by_count'], 'integer'],
            [['doc_id_ref'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'judgment_code' => 'Judgment Code',
            'doc_id_ref' => 'Doc Id Ref',
            'ref_by_count' => 'Ref By Count',
        ];
    }
    public static function getRefByCount($refCountBy){
        $record=JudgmentRefByCount::find()
            ->asArray()
            ->select(['ref_by_count'])
            ->where(['doc_id_ref' => $refCountBy]);
        $row = $record->all();
        if(empty($row)){
            return 0;
        }else{
            return $row["ref_by_count"];
        }

    }
}
