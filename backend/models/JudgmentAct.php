<?php

namespace backend\models;

use Yii;
use yii\db\Query;
use app\models\JudgmentActCount;
use app\models\JudgmentRefCount;

/**
 * This is the model class for table "judgment_act".
 *
 * @property integer $jact
 * @property integer $judgment_code
 * @property integer $bareact_catgid
 * @property string $bareact_catg_name
 * @property integer $bareact_id
 * @property string $act_name
 * @property integer $catg_id
 * @property string $catg_title
 * @property integer $country_code
 * @property string $country_name
 *
 * @property BareactCatg $bareactCatg
 * @property BareactMast $bareact
 * @property BareactDetail $catg
 * @property CountryMast $countryCode
 * @property JudgmentMast $judgmentCode
 */
class JudgmentAct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'judgment_act';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judgment_code', 'bareact_catgid', 'bareact_id', 'catg_id', 'country_code'], 'integer'],
            [['act_name', 'catg_title'], 'required'],
            [['bareact_catg_name', 'act_name', 'catg_title'], 'string', 'max' => 255],
            [['country_name'], 'string', 'max' => 25],
            [['bareact_catgid'], 'exist', 'skipOnError' => true, 'targetClass' => BareactCatg::className(), 'targetAttribute' => ['bareact_catgid' => 'bareact_catgid']],
            [['bareact_id'], 'exist', 'skipOnError' => true, 'targetClass' => BareactMast::className(), 'targetAttribute' => ['bareact_id' => 'bareact_id']],
            [['catg_id'], 'exist', 'skipOnError' => true, 'targetClass' => BareactDetail::className(), 'targetAttribute' => ['catg_id' => 'catg_id']],
            [['country_code'], 'exist', 'skipOnError' => true, 'targetClass' => CountryMast::className(), 'targetAttribute' => ['country_code' => 'country_code']],
            [['judgment_code'], 'exist', 'skipOnError' => true, 'targetClass' => JudgmentMast::className(), 'targetAttribute' => ['judgment_code' => 'judgment_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jact' => 'Jact',
            'judgment_code' => 'Judgment Code',
            'bareact_catgid' => 'Bareact Catgid',
            'bareact_catg_name' => 'Bareact Catg Name',
            'bareact_id' => 'Bareact ID',
            'act_name' => 'Act Name',
            'catg_id' => 'Catg ID',
            'catg_title' => 'Catg Title',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBareactCatg()
    {
        return $this->hasOne(BareactCatg::className(), ['bareact_catgid' => 'bareact_catgid']);
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
    public function getCatg()
    {
        return $this->hasOne(BareactDetail::className(), ['catg_id' => 'catg_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryCode()
    {
        return $this->hasOne(CountryMast::className(), ['country_code' => 'country_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentCode()
    {
        return $this->hasOne(JudgmentMast::className(), ['judgment_code' => 'judgment_code']);
    }


    /*==========Manticore Function Start=========================*/
    public static function getActSections($jDocId)
    {
   $data=array('records'=>null,'total'=>0);

        $record=JudgmentAct::find()
            ->asArray()
            ->select(array("act_title","doc_id"))
            ->where(['j_doc_id' =>$jDocId])
            ->groupBy("act_title")
            ->all();
        $totalRecords= JudgmentAct::find()
            ->asArray()
            ->where(['j_doc_id' =>$jDocId])
            ->groupBy("act_title")
            ->count();
        if(!empty($record) && isset($record["0"]) && $totalRecords > 0 ){

            foreach ($record as $value) {
                $result[]=$value["act_title"];
            }
         return $data=array("records"=>$result,'total'=>$totalRecords);
        }

        return $data;
    }


    public static function getJudgmentCitied($RId){
        $data=array('records'=>null,'total'=>0);
        $record=JudgmentAct::find()
            ->asArray()
            ->select(array("judgment_title","doc_id","judgment_code"))
            ->where(['j_doc_id' =>$RId])
            ->groupBy("judgment_title")
            ->all();
        $totalRecords= JudgmentAct::find()
            ->asArray()
            ->where(['j_doc_id' =>$RId])
            ->groupBy("judgment_title")
            ->count();
        if(!empty($record) && isset($record["0"])) {
            foreach ($record as $value) {
                $result[] = $value["judgment_title"];
            }
            return $data=array("records"=>$result,'total'=>$totalRecords);
        }
        return $data;
    }

    /*==========Manticore Function End=========================*/

}