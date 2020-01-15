<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bareact_detail".
 *
 * @property integer $catg_id
 * @property integer $bareact_id
 * @property integer $source_catg_id
 * @property integer $old_catg_id
 * @property string $catg_type
 * @property string $catg_title
 * @property string $Enactment_date
 * @property string $catg_text
 *
 * @property BareactMast $bareact
 * @property JudgmentAct[] $judgmentActs
 */
class BareactDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bareact_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bareact_id', 'source_catg_id', 'old_catg_id'], 'integer'],
            [['catg_title'], 'required'],
            [['Enactment_date'], 'safe'],
            [['catg_text'], 'string'],
            [['catg_type'], 'string', 'max' => 1],
            [['catg_title'], 'string', 'max' => 255],
            [['bareact_id'], 'exist', 'skipOnError' => true, 'targetClass' => BareactMast::className(), 'targetAttribute' => ['bareact_id' => 'bareact_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'catg_id' => 'Catg ID',
            'bareact_id' => 'Bareact ID',
            'source_catg_id' => 'Source Catg ID',
            'old_catg_id' => 'Old Catg ID',
            'catg_type' => 'Catg Type',
            'catg_title' => 'Catg Title',
            'Enactment_date' => 'Enactment Date',
            'catg_text' => 'Catg Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBareact()
    {
        return $this->hasOne(BareactMast::className(), ['bareact_id' => 'bareact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentActs()
    {
        return $this->hasMany(JudgmentAct::className(), ['catg_id' => 'catg_id']);
    }
}
