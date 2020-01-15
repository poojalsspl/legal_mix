<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "case_mast".
 *
 * @property int $Id
 * @property int $userid
 * @property int $cust_id
 * @property int $case_type_id
 * @property string $case_desc
 * @property string $case_reg_date
 * @property string $case_over_date
 * @property string $appeal_number
 * @property string $court_code
 * @property string $appellant_name
 * @property string $respondant_name
 * @property string $case_summary
 * @property string $case_fees
 * @property string $case_status
 */
class CaseMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'case_mast';
    }

    /**
     * {@inheritdoc}
     */
    public $case_status_desc;
    public function rules()
    {
        return [
            [[ 'case_type_id', 'case_desc', 'case_reg_date', 'appeal_number', 'court', 'appellant_name', 'respondant_name', 'case_summary', 'case_fees', 'case_status'], 'required'],
            [['userid', 'custid', 'case_type_id'], 'integer'],
            [['case_reg_date', 'case_over_date','cust_id'], 'safe'],
            [['case_summary'], 'string'],
            [['case_fees'], 'number'],
            [['case_desc','custid'], 'string', 'max' => 200],
            [['appeal_number', 'appellant_name', 'respondant_name'], 'string', 'max' => 25],
            [['court'], 'string', 'max' => 10],
            [['case_status'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'userid' => 'Userid',
            'custid' => 'Customer',
            'case_type_id' => 'Case Type',
            'case_desc' => 'Case Title',
            'case_reg_date' => 'Case Reg Date',
            'case_over_date' => 'Case Over Date',
            'appeal_number' => 'Appeal Number',
            'court' => 'Court',
            'appellant_name' => 'Appellant Name',
            'respondant_name' => 'Respondant Name',
            'case_summary' => 'Case Summary',
            'case_fees' => 'Case Fees',
            'case_status' => 'Case Status',
           ];
    }

     public function getCustomer(){
        return $this->hasOne(CustMast::classname(),['custid'=>'custid']);
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


}

