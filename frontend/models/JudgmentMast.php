<?php

namespace frontend\models;

use Yii;

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
            [['judgment_source_code'], 'string', 'max' => 40],
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
            'judgment_source_code'     => 'Judgment Source Code',
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
      return $this->hasOne(JudgmentBenchType::className(), ['id' => 'bench_type_id']);
    }
    public function getJudgmentDisposition()
    {
      return $this->hasOne(JudgmentDisposition::className(), ['id' => 'disposition_id']);
    }     
    public function getJudgmentJurisdiction()
    {
      return $this->hasOne(JudgmentJurisdiction::className(), ['id' => 'judgment_jurisdiction_id']);
    }
    public function getJlist($court){
     $query = (new \yii\db\Query())
        ->select('judgement_count ,court_name,court_code')
        ->from('judge_court_count')
        ->where('court_type=:court_type', [':court_type' => $court]);
      
         $command = $query->createCommand();
        // Execute the command:
        $rows = $command->queryAll();
       // print_r($rows); exit;
        if($rows){
        return $rows;
    }       
    }

     public function getJlistnew($court){
     $query = (new \yii\db\Query())
        ->select('judgement_count ,court_name,court_code')
        ->from('judge_court_count_new')
        ->where('court_type=:court_type', [':court_type' => $court]);
      
         $command = $query->createCommand();
        // Execute the command:
        $rows = $command->queryAll();
       // print_r($rows); exit;
        if($rows){
        return $rows;
    }       
    }

}
