<?php

namespace app\models;

use Yii;
use app\models\JudgmentRefByCount;
/**
 * This is the model class for table "judgment_ref_by".
 *
 * @property int $judgment_code
 * @property string $doc_id_ref
 * @property string $judgment_title
 */
class JudgmentRefBy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judgment_ref_by';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judgment_code'], 'integer'],
            [['judgment_title'], 'required'],
            [['doc_id_ref'], 'string', 'max' => 40],
            [['judgment_title'], 'string', 'max' => 255],
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
            'judgment_title' => 'Judgment Title',
        ];
    }

    public static function getJudgmentCitiedBY($RIdBy){
        $data=array('records'=>null,'total'=>0);
        $record=JudgmentRefBy::find()
            ->asArray()
            ->select(array("judgment_title","judgment_code"))
            ->where(['doc_id_ref' =>$RIdBy])
            ->all();
        $totalRecords= JudgmentRefBy::find()
            ->asArray()
            ->where(['doc_id_ref' =>$RIdBy])
            ->count();
        if(!empty($record) && isset($record["0"])) {
            foreach ($record as $value) {
                $result[] = $value["judgment_title"];

            }
            return $data=array("records"=>$result,'total'=>$totalRecords);
        }
        return $data;
    }
}
