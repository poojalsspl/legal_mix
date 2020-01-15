<?php

namespace backend\models;


use app\models\JudgmentRefCount;
use Yii;
use yii\db\Query;
use backend\models\JudgmentAct;
use app\models\JudgmentActCount;
use app\models\JudgmentRefByCount;
use app\models\JudgmentRefBy;
use backend\models\JudgmentJudge;
use backend\models\JudgmentAdvocate;
use yii\data\SqlDataProvider;
use app\models\UserPlanNew;
/**
 * This is the model class for table "judgment_mast".
 *
 * @property integer $judgment_code
 * @property integer $court_code
 * @property string $court_name
 * @property string $appeal_numb
 * @property string $judgment_date
 * @property string $judgment_title
 * @property string $appellant_name
 * @property string $appellant_adv
 * @property integer $appellant_adv_count
 * @property string $respondant_name
 * @property string $respondant_adv
 * @property integer $respondant_adv_count
 * @property string $appeal_status
 * @property string $citation
 * @property integer $citation_count
 * @property string $judges_name
 * @property integer $judges_count
 * @property string $hearing_date
 * @property string $hearing_place
 * @property string $judgment_abstract
 * @property string $judgment_text
 * @property string $judgment_source_code
 * @property string $judgment_type
 * @property string $judgment_source_name
 * @property string $jcatg_description
 * @property integer $jcatg_id
 * @property string $jsub_catg_description
 * @property integer $jsub_catg_id
 * @property string $overrule_judgment
 * @property string $overruled_by_judgment
 * @property string $judgment_ext_remark_flag
 *
 * @property JudgmentAct[] $judgmentActs
 * @property JudgmentAdvocate[] $judgmentAdvocates
 * @property JudgmentCitation[] $judgmentCitations
 * @property JudgmentExtRemark $judgmentExtRemark
 * @property JudgmentJudge[] $judgmentJudges
 * @property JsubCatgMast $jsubCatg
 * @property CourtMast $courtCode
 * @property JcatgMast $jcatg
 * @property JudgmentParties[] $judgmentParties
 * @property JudgmentRef[] $judgmentRefs
 */
class JudgmentMast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'judgment_mast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['court_code', 'appellant_adv_count', 'respondant_adv_count', 'citation_count', 'judges_count', 'jcatg_id', 'jsub_catg_id'], 'integer'],
            [['judgment_date', 'disposition_id','disposition_text','judgment_jurisdiction_id','judgmnent_jurisdiction_text','bench_type_id','bench_type_text','hearing_date','jyear','jcount'], 'safe'],
            [['judgment_title', 'jcatg_id', 'jsub_catg_id'], 'required'],
            [['judgment_abstract', 'judgment_text'], 'string'],
            [['court_name'], 'string', 'max' => 100],
            //[['appeal_numb'], 'string', 'max' => 250],
            [['judgment_title'], 'string', 'max' => 255],
            /*[['appellant_name', 'appellant_adv', 'respondant_name', 'respondant_adv', 'judges_name'], 'string', 'max' => 500],*/
            [['appeal_status', 'hearing_place'], 'string', 'max' => 10],
            //[['citation'], 'string', 'max' => 2000],
            [['doc_id'], 'string', 'max' => 40],
            [['judgment_type', 'judgment_ext_remark_flag'], 'string', 'max' => 1],
            [['judgment_source_name'], 'string', 'max' => 50],
            [['jcatg_description', 'jsub_catg_description'], 'string', 'max' => 150],
            [['overrule_judgment', 'overruled_by_judgment'], 'string', 'max' => 20],
            [['jsub_catg_id'], 'exist', 'skipOnError' => true, 'targetClass' => JsubCatgMast::className(), 'targetAttribute' => ['jsub_catg_id' => 'jsub_catg_id']],
            [['court_code'], 'exist', 'skipOnError' => true, 'targetClass' => CourtMast::className(), 'targetAttribute' => ['court_code' => 'court_code']],
            [['jcatg_id'], 'exist', 'skipOnError' => true, 'targetClass' => JcatgMast::className(), 'targetAttribute' => ['jcatg_id' => 'jcatg_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'judgment_code'            => 'Judgment Code',
            'court_code'               => 'Court Code',
            'court_name'               => 'Court Name',
            'appeal_numb'              => 'Appeal Numb',
            'judgment_date'            => 'Judgment Date',
            'judgment_title'           => 'Judgment Title',
            'appellant_name'           => 'Appellant Name',
            'appellant_adv'            => 'Appellant Adv',
            'appellant_adv_count'      => 'Appellant Adv Count',
            'respondant_name'          => 'Respondant Name',
            'respondant_adv'           => 'Respondant Adv',
            'respondant_adv_count'     => 'Respondant Adv Count',
            'appeal_status'            => 'Status',
            'citation'                 => 'Citation',
            'citation_count'           => 'Citation Count',
            'judges_name'              => 'Judges Name',
            'judges_count'             => 'Judges Count',
            'hearing_date'             => 'Hearing Date',
            'hearing_place'            => 'Hearing Place',
            'judgment_abstract'        => 'Judgment Abstract',
            'judgment_text'            => 'Judgment Text',
            'doc_id'     => 'Judgment Source Code',
            'judgment_type'            => 'Judgment Type',
            'judgment_source_name'     => 'Judgment Source Name',
            'jcatg_description'        => 'Jcatg Description',
            'jcatg_id'                 => 'Jcatg ID',
            'jsub_catg_description'    => 'Jsub Catg Description',
            'jsub_catg_id'             => 'Jsub Catg ID',
            'overrule_judgment'        => 'Overrule Judgment',
            'overruled_by_judgment'    => 'Overruled By Judgment',
            'judgment_ext_remark_flag' => 'Judgment Ext Remark Flag',
            'bench_type_id'            => 'Bench Type',
            'disposition_id'           => 'Disposition',
            'judgment_jurisdiction_id' => 'Jurisdiction'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentActs()
    {
        return $this->hasMany(JudgmentAct::className(), ['judgment_code' => 'judgment_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentAdvocates()
    {
        return $this->hasMany(JudgmentAdvocate::className(), ['judgment_code' => 'judgment_code']);
    }
    public function getCourtNameCode()
    {
        return $this->hasOne(CourtMast::className(), ['court_name' => 'court_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentCitations()
    {
        return $this->hasMany(JudgmentCitation::className(), ['judgment_code' => 'judgment_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentExtRemark()
    {
        return $this->hasOne(JudgmentExtRemark::className(), ['judgment_code' => 'judgment_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentJudges()
    {
        return $this->hasMany(JudgmentJudge::className(), ['judgment_code' => 'judgment_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJsubCatg()
    {
        return $this->hasOne(JsubCatgMast::className(), ['jsub_catg_id' => 'jsub_catg_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourtCode()
    {
        return $this->hasOne(CourtMast::className(), ['court_code' => 'court_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJcatg()
    {
        return $this->hasOne(JcatgMast::className(), ['jcatg_id' => 'jcatg_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentParties()
    {
        return $this->hasMany(JudgmentParties::className(), ['judgment_code' => 'judgment_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgmentRefs()
    {
        return $this->hasMany(JudgmentRef::className(), ['judgment_code' => 'judgment_code']);
    }
    public function getJudgmentOverrules()
    {
        return $this->hasMany(JudgmentOverrules::className(), ['judgment_code' => 'judgment_code']);
    }
    public function getJudgmentOverruledby()
    {
      return $this->hasMany(JudgmentOverruledby::className(), ['judgment_code' => 'judgment_code']);
    }
    public function getJudgmentCitedby()
    {
      return $this->hasMany(JudgmentCitedBy::className(), ['judgment_code' => 'judgment_code']);
    }    
    public function getJudgmentBenchType()
    {
      return $this->hasOne(JudgmentBenchType::className(), ['bench_type_id' => 'bench_type_id']);
    }
    public function getJudgmentDisposition()
    {
      return $this->hasOne(JudgmentDisposition::className(), ['disposition_id' => 'disposition_id']);
    }     
    public function getJudgmentJurisdiction()
    {
      return $this->hasOne(JudgmentJurisdiction::className(), ['judgment_jurisdiction_id' => 'judgment_jurisdiction_id']);
    }

    public function getJudgmentByYear($court_code)
    {
    
    $count = Yii::$app->db->createCommand('
    SELECT COUNT(*) FROM judgment_mast WHERE court_code=:court_code
group by jyear', [':court_code' => $court_code] )->queryScalar();

   

$provider = new SqlDataProvider([
    'sql' => 'SELECT court_code,court_name , jyear,count(jyear) as cases FROM judgment_mast WHERE court_code=:court_code group by jyear',
    'params' => [':court_code' => $court_code],
    'totalCount' => $count,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => [
            'court_name',
            'jyear',
              ],
    ],
]);       

    return $provider;


    }

    public function getJudgmentList($court_code,$jyear)
    {
    
    $count = Yii::$app->db->createCommand('
    SELECT COUNT(*) FROM judgment_mast WHERE court_code=:court_code
and jyear=:jyear', [':court_code' => $court_code,':jyear'=>$jyear])->queryScalar();
  

    $provider = new SqlDataProvider([
    'sql' => 'SELECT judgment_code, appellant_name , judgment_title, judgment_date FROM judgment_mast WHERE court_code=:court_code  and jyear=:jyear' ,
    'params' => [':court_code' => $court_code,':jyear'=>$jyear],
    'totalCount' => $count,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => [
            'judgment_code',
            'appellant_name',
            'judgment_title',
            'judgment_date',
              ],
    ],
]);       

    return $provider;


    }
    

    /*==========Manticore Function Start=========================*/
     public static  function getSearchJudgment($code){
        $result=array("data"=>'');
        $record=parent::find()
        ->asArray()
        ->select('judgment_title,bench_name,appeal_numb,
                          judgment_date,appellant_name,respondant_name,appellant_adv,citation,
                          respondant_adv,judgment_abstract,disposition_text,
                          judgment_text,judges_name,judgment_code,doc_id,court_code,court_name')
       ->where(array("judgment_code" =>$code))
       ->all();
        //echo $record->createCommand()->getRawSql();die;
        $court_code = $record[0]['court_code'];
       $username = \Yii::$app->user->identity->username;
            $plans = UserPlanNew::find()->where([ 'username' => $username,'court_code' => $code ]);
            //print_r($plans);die;
           //echo $plans->createCommand()->getRawSql();die;
           

        if(!empty($record) && isset($record["0"])){
            //echo "hello".$record["0"]["doc_id"];exit;
            $actSectionRefered = JudgmentAct::getActSections($record["0"]["doc_id"]);
            $judgment_citied = JudgmentAct::getJudgmentCitied($record["0"]["doc_id"]);
            $judgment_citied_by = JudgmentRef::getJudgmentCitiedBY($record["0"]["doc_id"]);
            $judges = JudgmentJudge::getJudges($record["0"]["doc_id"]);
            $advocate_appellant = JudgmentAdvocate::getAppellant($record["0"]["doc_id"]);
            $adovcate_respondnat = JudgmentAdvocate::getRespondant($record["0"]["doc_id"]);
            $result["data"] = $record["0"];
            $result["act_count"] = $actSectionRefered["total"];
            $result["act_title"] = $actSectionRefered["records"];
            $result["judgment_citied"] = $judgment_citied["records"];
            $result["judgment_citied_count"] = $judgment_citied["total"];
            $result["judges"]=$judges["records"];
            $result["judges_count"]=$judges["total"];
            $result["judgment_citied_by"] = $judgment_citied_by["records"];
            $result["judgment_citied_by_count"] = $judgment_citied_by["total"];
            $result["advocate_appellant"] = $advocate_appellant["records"];
            $result["advocate_appellant_count"] = $advocate_appellant["total"];
            $result["adovcate_respondnat"] = $adovcate_respondnat["records"];
            $result["adovcate_respondnat_count"] = $adovcate_respondnat["total"];
        }

        return $result;
    }
   /* public static function getActsSectionsReferred($act){

        $result=array("data"=>'');
        $record=parent::find()
            ->asArray()
            ->select('act_count')
            ->where(array("doc_id" =>$act))
            ->all();
        if(!empty($record) && isset($record["0"])){
            $result["data"]=$record["0"];
        }

        return $result;

    }*/

   /* public static function getActCount($docId){

        $query = new Query();
        $query
            ->select(['act_title,doc_id'])
            ->from('judgment_act')
            ->where(['doc_id' => $docId]);
        $rows = $query->all();
        if (empty($rows)){

            return 0;

        }
        else{


            echo count($rows);
        }

        exit;
        // print_r($rows);exit;
        //print_r($query);exit;
        return $query;
    }*/
    /**
     * @param $docid
     */
    
    public static  function getCitedIn($docid){
      $sql="Select judgment_ref.court_code,judgment_ref.court_name,judgment_ref.judgment_title_ref,judgment_ref.judgment_title,judgment_ref.judgment_code 
            FROM judgment_ref
            where judgment_ref.doc_id = $docid";
        $command = Yii::$app->getDb()->createCommand($sql);
        return $records = $command->queryAll();
    }
    /**
     * @param $docid
     */
    public static  function getCitedBy($docid){
        $sql="Select court_name, judgment_title,judgment_title_ref,judgment_code  
              from judgment_ref 
                where doc_id_ref = $docid ";
        
        $command = Yii::$app->getDb()->createCommand($sql);
        //echo $command->getRawSql();exit;
        $records = $command->queryAll();
        return $records;
        //return array("records"=>$records,"title"=>$judgmentTitle);
    }
    public static  function getActList($docid){
        $sql="Select judgment_act.act_group_desc,judgment_act.act_catg_desc,judgment_act.act_sub_catg_desc, judgment_act.act_title,judgment_act.judgment_title,judgment_act.doc_id
        FROM judgment_act  
      where j_doc_id= $docid";
        $command = Yii::$app->getDb()->createCommand($sql);
        return $records = $command->queryAll();
    }
    public static function getBearAct($docid,$code=null){
        if(!empty($code)){
            $sqldocidfromcode="select doc_id from bareact_mast
             where bareact_code = $code";
             $command = Yii::$app->getDb()->createCommand($sqldocidfromcode);
             $docidcode = $command->queryOne();
             if(!empty($docidcode["doc_id"])){
                 $docid=$docidcode["doc_id"];
             }
        }
        $sql="Select  level, act_group_desc, act_catg_desc, act_sub_catg_desc, act_title,body, bareact_code
            from bareact_detl
            where doc_id= $docid ";
        $sqlCount="select count(*) as total from judgment_act
        where doc_id= $docid";
        $command = Yii::$app->getDb()->createCommand($sql);
        $record = $command->queryOne();
        $commandCount = Yii::$app->getDb()->createCommand($sqlCount);
        $recordCount =$commandCount->queryOne();
        return array("record"=>$record,"count"=>$recordCount);
    }

    /*==========Manticore Function End=========================*/
}
