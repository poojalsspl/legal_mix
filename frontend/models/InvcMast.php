<?php

namespace app\models;
use app\models\CustMast;

use Yii;

/**
 * This is the model class for table "invc_mast".
 *
 * @property int $invc_numb
 * @property string $invc_date
 * @property int $userid
 * @property int $custid
 * @property string $invc_amt
 * @property string $GST
 * @property int $invc_disc
 */
class InvcMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invc_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invc_date', 'userid'], 'required'],
            [['invc_date','custid'], 'safe'],
            [['userid', 'custid', 'invc_disc'], 'integer'],
            [['invc_disc'], 'number'],
            [['invc_amt', 'GST'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'invc_numb' => 'Invoice #',
            'invc_date' => 'Invoice Date',
            'userid' => 'Userid',
            'custid' => 'Customer',
            'invc_amt' => 'Invoice Amount',
            'GST' => 'GST %',
            'invc_disc' => 'Discount',
        ];
    }

    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

    public function getCustomerName(){
        return $this->hasOne(CustMast::className(),['custid' => 'custid']);
    }

    public function updateTotal($id,$amt){
        \Yii::$app->db->createCommand("UPDATE invc_mast SET invc_amt=:invc_amt WHERE invc_numb=:invc_numb")
        ->bindValue(':invc_numb', $id)
        ->bindValue(':invc_amt', $amt)
        ->execute();

        return true;
    }


}
