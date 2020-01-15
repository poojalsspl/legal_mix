<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_plan".
 *
 * @property int $Id
 * @property int $user_id
 * @property int $plan
 * @property string $start_date
 * @property string $expiry_date
 */
class UserPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'plan', 'start_date', 'expiry_date'], 'required'],
            [['plan'], 'integer'],
            [['username'], 'string'],
            [['start_date', 'expiry_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'user_id' => 'User ID',
            'plan' => 'Plan',
            'start_date' => 'Start Date',
            'expiry_date' => 'Expiry Date',
        ];
    }

    public function getPermissions($plan,$username){
        $time = new \DateTime('now');
        $today = $time->format('Y-m-d');

        $query1 = (new \yii\db\Query())
        ->select('expiry_date')
        ->from('user_plan')
        ->where('plan=:plan', [':plan' => 'Full access'])
        ->andWhere('username= :username', [':username' => $username])
        ->andWhere('expiry_date>= :today', [':today' => $today]);
        $command1 = $query1->createCommand();
        // Execute the command:
        $rows1 = $command1->queryAll();
      
        if($rows1){
            return $rows1[0];
        }
        
        $query = (new \yii\db\Query())
        ->select('expiry_date')
        ->from('user_plan')
        ->where('plan=:plan', [':plan' => $plan])
        ->andWhere('username= :username', [':username' => $username])
        ->andWhere('expiry_date>= :today', [':today' => $today]);
      
         $command = $query->createCommand();
        // Execute the command:
        $rows = $command->queryAll();
        //print_r($rows); exit;
        if($rows){
        return $rows[0];
    }
    }
}
