<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "jcatg_mast".
 *
 * @property integer $jcatg_id
 * @property string $jcatg_description
 *
 * @property JsubCatgMast[] $jsubCatgMasts
 * @property JudgmentMast[] $judgmentMasts
 */
class JcatgMast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jcatg_mast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jcatg_description'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jcatg_id' => 'Jcatg ID',
            'jcatg_description' => 'Jcatg Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJsubCatgMasts()
    {
        return $this->hasMany(JsubCatgMast::className(), ['jcatg_id' => 'jcatg_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentMasts()
    {
        return $this->hasMany(JudgmentMast::className(), ['jcatg_id' => 'jcatg_id']);
    }
}
