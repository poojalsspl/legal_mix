<?php

namespace backend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "judgment_ref".
 *
 * @property int $id
 * @property int $judgment_code
 * @property string $doc_id
 * @property int $judgment_code_ref
 * @property string $doc_id_ref
 * @property string $judgment_title_ref
 * @property string $flag
 * @property int $court_code
 */
class JudgmentRef extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judgment_ref';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judgment_code', 'judgment_code_ref', 'court_code'], 'integer'],
            [['judgment_title_ref'], 'required'],
            [['doc_id', 'doc_id_ref'], 'string', 'max' => 40],
            [['judgment_title_ref'], 'string', 'max' => 255],
            [['flag'], 'string', 'max' => 50],
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
            'judgment_code_ref' => 'Judgment Code Ref',
            'doc_id_ref' => 'Doc Id Ref',
            'judgment_title_ref' => 'Judgment Title Ref',
            'flag' => 'Flag',
            'court_code' => 'Court Code',
        ];
    }

    /*==========Manticore Function Start=========================*/
    public static function getJudgmentCitiedBY($RIdBy){
        $data=array('records'=>null,'total'=>0);
        $record=JudgmentRef::find()
            ->asArray()
            ->select(array("judgment_title_ref","judgment_code"))
            ->where(['doc_id_ref' =>$RIdBy])
            ->groupBy("judgment_title_ref")
            ->all();
        $totalRecords= JudgmentRef::find()
            ->asArray()
            ->where(['doc_id_ref' =>$RIdBy])
            ->groupBy("judgment_title_ref")
            ->count();
        if(!empty($record) && isset($record["0"])) {
            foreach ($record as $value) {
                $result[] = $value["judgment_title_ref"];

            }
            return $data=array("records"=>$result,'total'=>$totalRecords);
        }
        return $data;
    }

    /*==========Manticore Function End=========================*/
}
