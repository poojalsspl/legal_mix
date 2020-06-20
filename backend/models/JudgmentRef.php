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
    public static function getJudgmentCitiedBY($RIdBy) {
        $data = array('records' => null, 'total' => 0);
        $record = JudgmentMast::getCitedBy($RIdBy);
        if(!empty($record)){
            foreach ($record as $value) {
                    if($value['judgment_title'] || $value['court_name']){
                    $result[] = $value['judgment_title'];
                }
            }
            if(!empty($result)){
            return $data = array("records" => $result, 'total' => count($result));
            }
        }
        return $data;
        // $data = JudgmentMast::getCitedBy($params["id"]);
        // $data = array('records' => null, 'total' => 0);
        // $record = JudgmentRef::find()
        //     ->asArray()
        //     ->select(array("judgment_title", "judgment_code"))
        //     ->where(['doc_id_ref' => $RIdBy])
        //     ->groupBy("judgment_title")
        //     ->all();

        // $totalRecords = JudgmentMast::find()
        //     ->asArray()
        //     ->select("judgment_search_summary.cited_count")
        //     ->leftJoin('judgment_search_summary', 'judgment_search_summary.doc_id=judgment_mast.doc_id')
        //     ->where(['judgment_search_summary.doc_id' => $RIdBy])
        //     ->groupBy("judgment_search_summary.cited_count")
        //     ->all();
        // //$citedByCount = ($totalRecords) ? $totalRecords[0]['cited_count'] : 0;
        // $citedByCount = (isset($totalRecords[0]['cited_count']) && $totalRecords[0]['cited_count'] !== 0) ? $totalRecords[0]['cited_count'] : 0;

        // if (!empty($record) && isset($record["0"])) {
        //     foreach ($record as $value) {
        //         $result[] = $value["judgment_title"];
        //     }
        //     return $data = array("records" => $result, 'total' => $citedByCount);
        // }
        // return $data;
    }
     /*==========Manticore Function End=========================*/
}
