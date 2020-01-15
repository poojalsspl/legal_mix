<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "case_status_mast".
 *
 * @property int $Id
 * @property string $case_status_desc
 */
class CaseStatusMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'case_status_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['case_status_desc'], 'required'],
            [['case_status_desc'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'case_status_desc' => 'Case Status Desc',
        ];
    }

    public function getStatus($id){
        $model = CaseStatusMast::find('case_status_desc')
        ->where('id = :id', [':id' => $id])
        ->one();

        return $model['case_status_desc'];
        

    }
}
