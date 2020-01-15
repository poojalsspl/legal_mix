<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invc_detl".
 *
 * @property int $Id
 * @property int $invc_numb
 * @property int $invc_qty
 * @property int $invc_rate
 * @property int $invc_amt
 * @property string $invc_desc
 * @property int $disc
 */
class InvcDetl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invc_detl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invc_numb', 'invc_qty', 'invc_rate', 'disc'], 'required'],
            [['invc_qty','gst'],'integer'],
            [['invc_numb', 'invc_rate', 'invc_amt', 'disc'], 'number'],
            [['invc_desc'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'invc_numb' => 'Invc Numb',
            'invc_qty' => 'Quantity',
            'invc_rate' => 'Rate',
            'invc_amt' => 'Amount',
            'invc_desc' => 'Description',
            'disc' => 'Discount %',
            'gst' => 'GST',
        ];
    }

    
}
