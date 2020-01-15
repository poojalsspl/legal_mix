<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "judge_court_count".
 *
 * @property int $court_code
 * @property string $court_name
 * @property string $judgement_type
 * @property string $judgement_type_name
 * @property int $judgement_count
 */
class JudgeCourtCountNew extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judge_court_count_new';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['court_code', 'court_name', 'judgement_type', 'judgement_type_name', 'judgement_count'], 'required'],
            [['court_code', 'judgement_count'], 'integer'],
            [['court_name'], 'string', 'max' => 100],
            [['judgement_type', 'judgement_type_name'], 'string', 'max' => 50],
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
            'judgement_type' => 'Judgement Type',
            'judgement_type_name' => 'Judgement Type Name',
            'judgement_count' => 'Judgement Count',
        ];
    }

    public function getCourtCode($court_name){
        //$court_code = JudgeCourtCount::find();
        $model = JudgeCourtCountNew::find()
           ->select('court_code')
           ->where(['court_code' => $court_name])
           ->one();
           

           return $model->court_code;
    }
}
