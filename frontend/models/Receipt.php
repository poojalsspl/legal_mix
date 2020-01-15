<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt".
 *
 * @property int $id
 * @property int $invoice_no
 * @property string $payment_date
 * @property string $payment_mode
 * @property string $instrument_no
 * @property string $instrument_mode
 * @property string $instrument_date
 * @property string $instrument_amt
 * @property string $bank_name
 * @property int $status
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice_no', 'payment_date','instrument_mode', 'instrument_date', 'paid_amt'], 'required'],
            [['invoice_no'], 'integer'],
            [['payment_date', 'instrument_date'], 'safe'],
            [['paid_amt'], 'number'],
            [['instrument_no', 'instrument_mode', 'bank_name','remarks'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_no' => 'Invoice No',
            'payment_date' => 'Payment Date',
            'instrument_no' => 'Instrument No',
            'instrument_mode' => 'Payment Mode',
            'instrument_date' => 'Instrument Date',
            'paid_amt' => 'Paid Amt',
            'bank_name' => 'Bank Name',
            'remarks' => 'Note',
        ];
    }

     public function getInvcDetl($id){
        $sql = (new \yii\db\Query());
        $sql->select(['invc_detl.Id','invc_detl.invc_numb','cust_mast.custname','invc_qty','invc_rate','invc_detl.invc_amt','invc_desc','disc','invc_detl.gst','invc_detl.paid_amt']) 
           ->from('invc_detl')
           ->join('Inner join',
                   'invc_mast',
                   'invc_mast.invc_numb = invc_detl.invc_numb'
               )
           ->join('Inner join',
                   'cust_mast',
                   'cust_mast.custid = invc_mast.custid'
               )
           
           ->where('invc_detl.invc_amt - invc_detl.paid_amt >0 and invc_mast.custid=:invc_numb', [':invc_numb' => $id]);
        
        $command1 = $sql->createCommand();
     
        $data1 = $command1->queryAll(); 

        return $data1;

    }
}
