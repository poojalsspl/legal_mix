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
        // return [
        //     [['judgment_code', 'bareact_catgid', 'bareact_id', 'catg_id', 'country_code'], 'integer'],
        //     [['act_name', 'catg_title'], 'required'],
        //     [['bareact_catg_name', 'act_name', 'catg_title'], 'string', 'max' => 255],
        //     [['country_name'], 'string', 'max' => 25],
        //     [['bareact_catgid'], 'exist', 'skipOnError' => true, 'targetClass' => BareactCatg::className(), 'targetAttribute' => ['bareact_catgid' => 'bareact_catgid']],
        //     [['bareact_id'], 'exist', 'skipOnError' => true, 'targetClass' => BareactMast::className(), 'targetAttribute' => ['bareact_id' => 'bareact_id']],
        //     [['catg_id'], 'exist', 'skipOnError' => true, 'targetClass' => BareactDetail::className(), 'targetAttribute' => ['catg_id' => 'catg_id']],
        //     [['country_code'], 'exist', 'skipOnError' => true, 'targetClass' => CountryMast::className(), 'targetAttribute' => ['country_code' => 'country_code']],
        //     [['judgment_code'], 'exist', 'skipOnError' => true, 'targetClass' => JudgmentMast::className(), 'targetAttribute' => ['judgment_code' => 'judgment_code']],
        // ];

         return [
            [['judgment_code', 'act_group_code', 'act_catg_code', 'act_sub_catg_code', 'country_code', 'court_code', 'bench_code'], 'integer'],
            [['crdt'], 'safe'],
            [['j_doc_id', 'doc_id'], 'string', 'max' => 40],
            [['judgment_title', 'act_title', 'bareact_desc'], 'string', 'max' => 255],
            [['act_group_desc'], 'string', 'max' => 25],
            [['act_catg_desc', 'act_sub_catg_desc', 'court_name', 'bench_name'], 'string', 'max' => 100],
            [['country_shrt_name', 'bareact_code'], 'string', 'max' => 10],
            [['court_shrt_name'], 'string', 'max' => 20],
            [['level'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        // return [
        //     'jact' => 'Jact',
        //     'judgment_code' => 'Judgment Code',
        //     'bareact_catgid' => 'Bareact Catgid',
        //     'bareact_catg_name' => 'Bareact Catg Name',
        //     'bareact_id' => 'Bareact ID',
        //     'act_name' => 'Act Name',
        //     'catg_id' => 'Catg ID',
        //     'catg_title' => 'Catg Title',
        //     'country_code' => 'Country Code',
        //     'country_name' => 'Country Name',
        // ];
        return [
            'j_doc_id' => 'J Doc ID',
            'judgment_code' => 'Judgment Code',
            'judgment_title' => 'Judgment Title',
            'id' => 'ID',
            'doc_id' => 'Doc ID',
            'act_group_code' => 'Act Group Code',
            'act_group_desc' => 'Act Group Desc',
            'act_catg_code' => 'Act Catg Code',
            'act_catg_desc' => 'Act Catg Desc',
            'act_sub_catg_code' => 'Act Sub Catg Code',
            'act_sub_catg_desc' => 'Act Sub Catg Desc',
            'act_title' => 'Act Title',
            'country_code' => 'Country Code',
            'country_shrt_name' => 'Country Shrt Name',
            'bareact_code' => 'Bareact Code',
            'bareact_desc' => 'Bareact Desc',
            'court_code' => 'Court Code',
            'court_name' => 'Court Name',
            'court_shrt_name' => 'Court Shrt Name',
            'bench_code' => 'Bench Code',
            'bench_name' => 'Bench Name',
            'level' => 'Level',
            'crdt' => 'Crdt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getBareactCatg() //old
    // {
    //     return $this->hasOne(BareactCatg::className(), ['bareact_catgid' => 'bareact_catgid']);
    // }

    public function getBareactCatg() 
    {
        return $this->hasOne(BareactCatgMast::className(), ['act_catg_code' => 'act_catg_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getBareact() //old
    // {
    //     return $this->hasOne(BareactMast::className(), ['bareact_id' => 'bareact_id']);
    // }

    public function getBareact() 
    {
        return $this->hasOne(BareactMast::className(), ['bareact_code' => 'bareact_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getCatg() //old
    // {
    //     return $this->hasOne(BareactDetail::className(), ['catg_id' => 'catg_id']);
    // }

    public function getCatg() 
    {
        return $this->hasOne(BareactDetl::className(), ['bareact_code' => 'bareact_code']);
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


    public static function getJudgmentCitied($RId) {
        $data = array('records' => null, 'total' => 0);
        $record = JudgmentMast::getCitedIn($RId);
        if(!empty($record)){
            foreach ($record as $value) {
                if($value['judgment_title_ref'] && $value['court_name']){
                    $result[] = $value['judgment_title_ref'];
                }
            }
            if(!empty($result)){
                return $data = array("records" => $result, 'total' => count($result));
            }
        }
        return $data;
    }

    /*==========Manticore Function End=========================*/

}