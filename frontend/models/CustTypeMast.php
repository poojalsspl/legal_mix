<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cust_type_mast".
 *
 * @property int $cust_type_id
 * @property string $cust_type_name
 * @property string $short_name
 *
 * @property CustMast[] $custMasts
 */
class CustTypeMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cust_type_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cust_type_name'], 'required'],
            [['cust_type_name'], 'string', 'max' => 30],
            [['short_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cust_type_id' => 'Cust Type ID',
            'cust_type_name' => 'Cust Type Name',
            'short_name' => 'Short Name',
        ];
    }

    public function getCustTypeName($id){
        $query = (new \yii\db\Query())
        ->select('cust_type_name')
        ->from('cust_type_mast')
        ->where('cust_type_id=:cust_type_id', [':cust_type_id' => $id]);

        $command = $query->createCommand();

        // Execute the command:
        $rows = $command->queryAll();
         return $rows[0];
     }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustMasts()
    {
        return $this->hasMany(CustMast::className(), ['cust_type_id' => 'cust_type_id']);
    }
}
