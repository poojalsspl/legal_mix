<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt_detail".
 *
 * @property int $id
 * @property int $receipt_id
 * @property int $invoc_num
 * @property string $invc_amt
 * @property string $paid_amt
 */
class ReceiptDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receipt_id', 'invoc_num', 'invc_amt', 'paid_amt'], 'required'],
            [['receipt_id', 'invoc_num'], 'integer'],
            [['invc_amt', 'paid_amt'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receipt_id' => 'Receipt ID',
            'invoc_num' => 'Invoc Num',
            'invc_amt' => 'Invc Amt',
            'paid_amt' => 'Paid Amt',
        ];
    }

     public function updateReceiptId($invc_numb,$id){
        \Yii::$app->db->createCommand("UPDATE receipt_detail SET receipt_id=:id WHERE invoc_num=:invc_numb")
        ->bindValue(':id', $id)
        ->bindValue(':invc_numb', $invc_numb)
        ->execute();

        return true;
    }
}
