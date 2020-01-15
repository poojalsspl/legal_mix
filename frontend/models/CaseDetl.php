<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "case_detl".
 *
 * @property int $tran_id
 * @property int $cust_id
 * @property int $case_id
 * @property int $userid
 * @property string $hearing_date
 * @property string $start_time
 * @property string $lawyers_name
 * @property string $judges_name
 * @property string $next_hearing_date
 * @property string $case_charged
 * @property string $case_notes
 */
class CaseDetl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'case_detl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cust_id', 'case_id', 'userid', 'hearing_date', 'start_time', 'lawyers_name', 'judges_name', 'next_hearing_date', 'case_charged', 'case_notes'], 'required'],
            [['cust_id', 'case_id', 'userid'], 'integer'],
            [['hearing_date', 'start_time', 'next_hearing_date'], 'safe'],
            [['case_charged'], 'number'],
            [['case_notes'], 'string'],
            [['lawyers_name', 'judges_name'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tran_id' => 'Tran ID',
            'cust_id' => 'Cust ID',
            'case_id' => 'Case ID',
            'userid' => 'Userid',
            'hearing_date' => 'Hearing Date',
            'start_time' => 'Start Time',
            'lawyers_name' => 'Lawyers Name',
            'judges_name' => 'Judges Name',
            'next_hearing_date' => 'Next Hearing Date',
            'case_charged' => 'Case Charged',
            'case_notes' => 'Case Notes',
        ];
    }

    public function getCustName($id){
       
        $query = (new \yii\db\Query())
        ->select('custname')
        ->from('cust_mast')
        ->where('custid=:cust_id', [':cust_id' => $id]);
        $command = $query->createCommand();
        // Execute the command:
        $rows = $command->queryAll();
         return $rows[0]['custname'];
     }

     public function getCaseId($id){
        $query = (new \yii\db\Query())
        ->select('case_id')
        ->from('case_detl')
        ->where('tran_id=:tran_id', [':tran_id' => $id]);
        $command = $query->createCommand();
        // Execute the command:
        $rows = $command->queryAll();
         return $rows[0]['case_id'];
     
     }
}
