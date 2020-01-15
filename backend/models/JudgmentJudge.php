<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "judgment_judge".
 *
 * @property integer $id
 * @property integer $judgment_code
 * @property string $judge_name
 *
 * @property JudgmentMast $judgmentCode
 */
class JudgmentJudge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'judgment_judge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judgment_code'], 'integer'],
            [['judge_name'], 'string', 'max' => 50],
            [['judgment_code'], 'exist', 'skipOnError' => true, 'targetClass' => JudgmentMast::className(), 'targetAttribute' => ['judgment_code' => 'judgment_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judgment_code' => 'Judgment Code',
            'judge_name' => 'Judge Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentCode()
    {
        return $this->hasOne(JudgmentMast::className(), ['judgment_code' => 'judgment_code']);
    }

    /*==========Manticore Function Start=========================*/
    public static function getJudges($JId){
        $data=array('records'=>null,'total'=>0);
        $record=JudgmentJudge::find()
            ->asArray()
            ->select(['judge_name'])
            ->where(['doc_id' => $JId])
            ->groupBy("judge_name")
            ->all();
        $totalRecords= JudgmentJudge::find()
            ->asArray()
            ->where(['doc_id' => $JId])
            ->groupBy("judge_name")
            ->count();
        if(!empty($record) && isset($record["0"])) {
            foreach ($record as $value) {
                $result[] = $value["judge_name"];
            }
            return $data=array("records"=>$result,'total'=>$totalRecords);
        }
        return $data;

    }
    /*==========Manticore Function End=========================*/
}
