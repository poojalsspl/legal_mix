<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_plan_new".
 *
 * @property int $plan_code
 * @property int $court_code
 * @property string $court_name
 * @property string $username
 * @property int $tenure
 * @property string $payment_amount
 * @property string $apply_date
 * @property string $corporate_ip
 * @property string $activattion_date
 * @property int $search_limit
 * @property string $access_limit
 * @property string $account_status
 * @property string $concurrent_connection
 */
class UserPlanNew extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_plan_new';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['court_code', 'tenure', 'search_limit'], 'integer'],
            [['apply_date', 'activattion_date'], 'safe'],
            [['court_name'], 'string', 'max' => 100],
            [['username'], 'string', 'max' => 50],
            [['payment_amount', 'account_status'], 'string', 'max' => 10],
            [['corporate_ip'], 'string', 'max' => 25],
            [['access_limit'], 'string', 'max' => 4],
            [['concurrent_connection'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
           
            'court_code' => 'Court Code',
            'court_name' => 'Court Name',
            'username' => 'Username',
            'tenure' => 'Tenure',
            'payment_amount' => 'Payment Amount',
            'apply_date' => 'Apply Date',
            'corporate_ip' => 'Corporate Ip',
            'activattion_date' => 'Activattion Date',
            'search_limit' => 'Search Limit',
            'access_limit' => 'Access Limit',
            'account_status' => 'Account Status',
            'concurrent_connection' => 'Concurrent Connection',
        ];
    }


    public function getPermissions($plan,$username){
        $time = new \DateTime('now');
        $today = $time->format('Y-m-d');

        $query1 = (new \yii\db\Query())
        ->select('expiry_date')
        ->from('user_plan_new')
        ->where('court_code=:court_name', [':court_name' => 'Full access'])
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
        ->from('user_plan_new')
        ->where('court_code=:court_code', [':court_code' => $plan])
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
