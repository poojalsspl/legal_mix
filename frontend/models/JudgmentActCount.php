<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "judgment_act_count".
 *
 * @property string $id
 * @property int $judgment_code
 * @property string $doc_id
 * @property int $act_count
 */
class JudgmentActCount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judgment_act_count';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judgment_code', 'act_count'], 'integer'],
            [['id'], 'string', 'max' => 20],
            [['doc_id'], 'string', 'max' => 40],
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
            'act_count' => 'Act Count',
        ];
    }
    public static function getActsSectionsReferred($act){

        $result=array("data"=>'');
        $record=parent::find()
            ->asArray()
            ->select('act_count')
            ->where(array("doc_id" =>$act))
            ->all();
        if(!empty($record) && isset($record["0"])){
            $result["data"]=$record["0"];
        }

        return $result;

    }
    public static function getActCount($docId){
        $record=JudgmentActCount::find()
                 ->asArray()
            ->select(['act_count'])
            ->where(['doc_id' => $docId]);
        $row = $record->all();
         if(empty($row)){
             return 0;
         }else{
             return $row["act_count"];
         }



    }
}
