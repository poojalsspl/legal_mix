<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JudgmentMast;
use backend\models\CourtMast;
use backend\models\JudgmentDisposition;
use yii\sphinx\Query;
use yii\data\Pagination;
use backend\models\BareactSubcatgMast;

/**

 * JudgmentMastSearch represents the model behind the search form about `\backend\models\JudgmentMast`.

 */

class JudgmentMastSphinxSearch extends JudgmentMast {

    public static function tableName() {
        return 'idx_court_decisions';

    }



    /**

     * @inheritdoc

     */

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();

    }

public function testquery(){
       // $sql="SELECT *,CONCAT(judgment_date,' 12:00:00') AS con,
//DATE_FORMAT(judgment_date,'%Y%m%d') AS judgment_date_year_month_day,
//UNIX_TIMESTAMP('2010-07-02 12:00:00') AS judgment_date2
//UNIX_TIMESTAMP(CONCAT(judgment_date,' 12:00:00')) AS judgment_date2
//UNIX_TIMESTAMP(judgment_dat) AS judgment_date2
//TIMESTAMP(judgment_dat) AS judgment2
//FROM judgment_mast WHERE judgment_code = 427377";

$sql="SELECT UNIX_TIMESTAMP(judgment_date) AS judgment_date2
FROM judgment_mast WHERE judgment_code = 427377";

            $connection = Yii::$app->getDb();

            $command = $connection->createCommand($sql);

            $courtrecords = $command->queryAll();
            echo "<pre>";
            print_r($courtrecords);
            echo "</pre>";
    }

    /**

     * Creates data provider instance with search query applied

     *

     * @param array $params

     *

     * @return ActiveDataProvider

     */

    public function searchJudgements($params) {

        $params['page']  = isset($params['page']) && intval($params['page']) > 0 ? intval($params['page']) : 1;

        $params['advance_search']  = isset($params['advance_search']) && intval($params['advance_search']) == 1 ? 1 : 0;

        //check if page value is greater than 10 so set it's value again 10

        if($params['page'] > 10):
            $params['page']=10;
        endif;

        $params['size']  = isset($params['size']) && intval($params['size']) > 0 ? intval($params['size']) : 20;
        $params['q']     = isset($params['q']) && strlen(trim($params['q'])) > 0 ? trim($params['q']) : '';
        $params['p']     = isset($params['p']) && strlen(trim($params['p'])) > 0 ? trim($params['p']) : '';
        $params['again'] = isset($params['again']) && intval($params['again']) > 0 ? intval($params['again']) : 0;
        $params['o']     = isset($params['o']) && strlen(trim($params['o'])) > 0 ? trim($params['o']) : '';

        //Check if current key word and previous key word are same

        if($params['again']==1):

            if($params['q']==$params['p']):

                $params['q'] = $params['q'];

            else:

                $params['q'] = $params['q'] . " " . $params['p'];

            endif;

        endif;

        

        $params['appeal_numb'] = isset($params['appeal_numb']) && strlen(trim($params['appeal_numb'])) > 0 ? trim($params['appeal_numb']) : '';

        $params['judgment_title'] = isset($params['judgment_title']) && strlen(trim($params['judgment_title'])) > 0 ? trim($params['judgment_title']) : '';

        

        $params['disposition_id'] = isset($params['disposition_id']) && intval($params['disposition_id']) > 0 ? intval($params['disposition_id']) : '';

        $params['judgment_date'] = isset($params['judgment_date']) && strlen(trim($params['judgment_date'])) > 0 ? trim($params['judgment_date']) : '';

        $params['j_year_month'] = isset($params['j_year_month']) && strlen(trim($params['j_year_month'])) > 0 ? trim($params['j_year_month']) : '';

        $params['j_year'] = isset($params['j_year']) && strlen(trim($params['j_year'])) > 0 ? trim($params['j_year']) : '';

        $params['j_year'] = isset($params['j_year']) && strlen(trim($params['j_year'])) > 0 ? trim($params['j_year']) : '';

        $params['act_category'] = isset($params['act_category']) && strlen(trim($params['act_category'])) > 0 ? trim($params['act_category']) : '';

        $params['act_sub_category'] = isset($params['act_sub_category']) && strlen(trim($params['act_sub_category'])) > 0 ? trim($params['act_sub_category']) : '';

        $params['actcount'] = isset($params['actcount']) && intval($params['actcount']) > 0 ? intval($params['actcount']) : '';

        $params['citedcount'] = isset($params['citedcount']) && intval($params['citedcount']) > 0 ? intval($params['citedcount']) : '';

        $params['refcount'] = isset($params['refcount']) && intval($params['refcount']) > 0 ? intval($params['refcount']) : '';


        if(isset($params['court_code']) && $params['court_code']):
            $params['court_code'] = explode(',', $params['court_code']);
        endif;

        

        if($params['advance_search'] == 1):
           $params['q'] = $this->parseAdvanceSearch($params['q']);
        else:
            $params['q'] = \Yii::$app->sphinx->escapeMatchValue($params['q']);
        endif;



//        print_r($params);die;

        $query = new \yii\sphinx\Query();
        $query->from(self::tableName())->showMeta(true);


        if ($params['q']):
            if(!empty($params['o']) && $params['again']==1):
            $exp = new \yii\db\Expression(':match', ['match' => '@(appeal_numb,judgment_title,judgment_abstract,judgment_text,disposition_text) (' . Yii::$app->sphinx->escapeMatchValue($params['swsQ']) . ')']);
            $query->match($exp);
        else:
            if (strpos($params['q'], '~') !== false) : 
              //  $params['q'] = $params['q'];
$exp = new \yii\db\Expression(':match', ['match' => '@(appeal_numb,judgment_title,judgment_abstract,judgment_text,disposition_text) (' . $params['q'] . ')']);
            else:
         //       $params['q'] = \Yii::$app->sphinx->escapeMatchValue($params['q']);
$exp = new \yii\db\Expression(':match', ['match' => '@(appeal_numb,judgment_title,judgment_abstract,judgment_text,disposition_text) (' . Yii::$app->sphinx->escapeMatchValue($params['q']) . ')']);
            endif;
           // $exp = new \yii\db\Expression(':match', ['match' => '@(appeal_numb,judgment_title,judgment_abstract,judgment_text,disposition_text) (' . Yii::$app->sphinx->escapeMatchValue($params['q']) . ')']);
            //$exp = new \yii\db\Expression(':match', ['match' => '@(appeal_numb,judgment_title,judgment_abstract,judgment_text,disposition_text) (' . $params['q'] . ')']);
            $query->match($exp);
//print_r($params['q']);die;
        endif;

            // $exp = new \yii\db\Expression(':match', ['match' => '@(appeal_numb,judgment_title,judgment_abstract,judgment_text,disposition_text) (' . $params['q'] . ')']);

            // $query->match($exp);

        // $query->andWhere($exp);

        endif;

        if (!empty($params["appeal_numb"])):
            $query->andWhere(['appeal_numb' => $params["appeal_numb"]]);
        endif;



        if (!empty($params["judgment_title"])):
            $query->andWhere(['judgment_title' => $params["judgment_title"]]);
        endif;



        if (!empty($params["court_code"])):
            $query->andWhere(['court_code' => $params["court_code"]]);
        endif;

        if (!empty($params["disposition_id"])):
            $query->andWhere(['disposition_id' => $params["disposition_id"]]);
        endif;

        if (!empty($params["judgment_date"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['judgment_date_year_month_day' => $params["judgment_date"]]);
        endif;

        if (!empty($params["j_year_month"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['judgment_date_year_month' => $params["j_year_month"]]);
        endif;

        if (!empty($params["j_year"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['jyear_new' => $params["j_year"]]);
        endif;

        if (!empty($params["act_category"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['act_catg_code' => $params["act_category"]]);
        endif;

        if (!empty($params["act_sub_category"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['act_sub_catg_code' => $params["act_sub_category"]]);
        endif;

        if (!empty($params["actcount"])):
            $query->andWhere(['act_count' => $params["actcount"]]);
        endif;

        if (!empty($params["citedcount"])):
            $query->andWhere(['cited_count' => $params["citedcount"]]);
        endif;

        

        if (!empty($params["refcount"])):
            $query->andWhere(['ref_count' => $params["refcount"]]);
        endif;

        

        if (!empty($params["startDate"])):
            $startDate = strtotime($params['startDate']);
            $query->andWhere("judgment_date >= ".$startDate."");
        endif;

        if (!empty($params["endDate"])):
            $endDate = strtotime($params['endDate']);
            $query->andWhere("judgment_date <= ".$endDate."");
        endif;

        if (!empty($params["o"])):
             $order = ($params["o"] == 'judgment_date')? $params["o"]." DESC": $params["o"]." ASC";
             $query->orderBy($order);
        endif;

        

        $facetarray = [
            'court_code' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,
            ],

            'disposition_id' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,
            ],

            'judgment_date_year_month' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 1000,
            ],

            'jyear_new' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,

            ],

            'act_catg_code' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,

            ],

            'act_sub_catg_code' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,

            ],

        ];

        $query->addFacets($facetarray);
        $offset = ($params['page'] - 1) * $params['size'];
        $query->options(['max_matches' => 1000000]);
        $query->limit($params['size'])->offset($offset);
        $rs = $query->search();

        //print_r($rs["meta"]);exit;

        //print_r($rs["facets"]);die;

        //proceed facets

        $facetsdata = $this->processFacets($rs["facets"]);

        //print_r($facetsdata);exit;

        // $totalItemCount = $rs['meta']['total_found'];
        // $totalItemCount = $facetsdata['court'][1]['count'];
        $totalItemCount = (isset($facetsdata['court'][1]['count']))?$facetsdata['court'][1]['count']:0;
        $queryTime=$rs["meta"]["time"];


        if (isset($rs['hits']) && count($rs['hits']) > 0):
            $rows = $rs['hits'];
            $ids = [];
            foreach ($rows as $key => $row) {
                $ids[$key] = $row["id"];

            }

            $ids = implode(',', $ids);



//        $conditions=['judgment_code IN '=> $ids];

            $records = JudgmentMast::find()

                    ->asArray()

                    ->select('judgment_mast.appeal_numb,judgment_mast.judgment_title,judgment_mast.judgment_date,judgment_mast.court_name,judgment_search_summary.act_count,judgment_search_summary.cited_count,judgment_search_summary.ref_count,judgment_mast.judgment_text,judgment_mast.judgment_abstract,judgment_mast.disposition_text,judgment_mast.court_code,judgment_mast.judgment_code,judgment_mast.doc_id')

                    ->leftJoin('judgment_search_summary', 'judgment_search_summary.doc_id=judgment_mast.doc_id')

                    ->where("judgment_mast.judgment_code IN (" . $ids . ")")

                    ->orderBy([new \yii\db\Expression('FIELD (judgment_mast.judgment_code, ' . $ids . ')')])

                    ->all();



//        print_r($records[0]);

            if(!empty($records)):

            foreach ($records as $row):
                $rowSnippetSources[] = strip_tags($row['judgment_title'] . ' ' . $row['judgment_text'] . ' ' . $row['judgment_abstract'] . ' ' . $row['disposition_text']);
            endforeach;


            if(!empty($params['o']) && $params['again']==1):

                $snippets = Yii::$app->sphinx->createCommand()->callSnippets(self::tableName() . '_0', $rowSnippetSources, $params['swsQ'], ['around' => 5, 'limit' => 300])->queryAll();    
            else:
                // removing number from snippet text if proximity search
                if (strpos($params['q'], '~') !== false) :
                preg_match('/"([^"]+)"/', $params['q'], $text);
                $params['q'] = $text[1];
                endif;

                $snippets = Yii::$app->sphinx->createCommand()->callSnippets(self::tableName() . '_0', $rowSnippetSources, $params['q'], ['around' => 5, 'limit' => 300])->queryAll();
            
            endif;

            // $snippets = Yii::$app->sphinx->createCommand()->callSnippets(self::tableName() . '_0', $rowSnippetSources, $params['q'], ['around' => 5, 'limit' => 300])->queryAll();

            endif;

            // free up space

            $rowSnippetSources = null;

            $count = 1;
            foreach ($records as $key => &$row):
                $row['snippet'] = $snippets[$key]['snippet'];
               $row['sno'] = $offset + $count;

                $count++;

                unset($row['disposition_text']);

                unset($row['judgment_abstract']);

                unset($row['judgment_text']);

            endforeach;

        else:

            $records = [];

            $snippets = [];

        endif;

        $countPagination=$totalItemCount;
        if($countPagination > 200):
         $countPagination=200;
        endif;

        $pagination = new Pagination(['totalCount' => $countPagination]);

//        print_r($facetsdata['yearsCount']['count']);die;

        if(empty($params['q']) && empty($params['court_code']) && empty($params['j_year_month']) && empty($params['act_sub_category']) && empty($params['startDate']) && empty($params['endDate'])){
            $records = array();
            $facetsdata = $facetsdata;
            $totalItemCount = 0;
            $pagination = false;
            $querytime = 0;
        }

        return [

            'data' => $records,
            'facets' => $facetsdata,
            'total' => $totalItemCount,
            'pagination' => $pagination,
            'querytime'=>$queryTime

        ];

//        

//        $query = JudgmentMast::find();

//

//        // add conditions that should always apply here

//

//        $dataProvider = new ActiveDataProvider([

//            'query' => $query,

//        ]);

//

//        $this->load($params);

//

//        if (!$this->validate()) {

//            // uncomment the following line if you do not want to return any records when validation fails

//            // $query->where('0=1');

//            return $dataProvider;

//        }

//

//        // grid filtering conditions

//        $query->andFilterWhere([

//            'judgment_code' => $this->judgment_code,

//            'court_code' => $this->court_code,

//            'judgment_date' => $this->judgment_date,

//            'appellant_adv_count' => $this->appellant_adv_count,

//            'respondant_adv_count' => $this->respondant_adv_count,

//            'citation_count' => $this->citation_count,

//            'judges_count' => $this->judges_count,

//            'hearing_date' => $this->hearing_date,

//            'jcatg_id' => $this->jcatg_id,

//            'jsub_catg_id' => $this->jsub_catg_id,

//            'jyear' => $this->jyear,            

//        ]);

//

//        

//        return $dataProvider;

    }
    /*new created for searchnew function*/
    public function searchJudgements1($params) {

        // print_r($params);die;
        $params['page']  = isset($params['page']) && intval($params['page']) > 0 ? intval($params['page']) : 1;

        $params['advance_search']  = isset($params['advance_search']) && intval($params['advance_search']) == 1 ? 1 : 0;
        //check if page value is greater than 10 so set it's value again 10
        if($params['page'] > 10):
            $params['page']=10;
        endif;
        $params['size']  = isset($params['size']) && intval($params['size']) > 0 ? intval($params['size']) : 20;
        $params['q']     = isset($params['q']) && strlen(trim($params['q'])) > 0 ? trim($params['q']) : '';
        $params['p']     = isset($params['p']) && strlen(trim($params['p'])) > 0 ? trim($params['p']) : '';
        $params['again'] = isset($params['again']) && intval($params['again']) > 0 ? intval($params['again']) : 0;
        //Check if current key word and previous key word are same
        if($params['again']==1):
            if($params['q']==$params['p']):
                $params['q'] = $params['q'];
            else:
                $params['q'] = $params['q'] . " " . $params['p'];
            endif;
        endif;
        
        $params['appeal_numb'] = isset($params['appeal_numb']) && strlen(trim($params['appeal_numb'])) > 0 ? trim($params['appeal_numb']) : '';
        $params['judgment_title'] = isset($params['judgment_title']) && strlen(trim($params['judgment_title'])) > 0 ? trim($params['judgment_title']) : '';
       
        $params['disposition_id'] = isset($params['disposition_id']) && intval($params['disposition_id']) > 0 ? intval($params['disposition_id']) : '';
        $params['judgment_date'] = isset($params['judgment_date']) && strlen(trim($params['judgment_date'])) > 0 ? trim($params['judgment_date']) : '';
        $params['j_year_month'] = isset($params['j_year_month']) && strlen(trim($params['j_year_month'])) > 0 ? trim($params['j_year_month']) : '';
        $params['j_year'] = isset($params['j_year']) && strlen(trim($params['j_year'])) > 0 ? trim($params['j_year']) : '';
        $params['j_year'] = isset($params['j_year']) && strlen(trim($params['j_year'])) > 0 ? trim($params['j_year']) : '';
        $params['act_category'] = isset($params['act_category']) && strlen(trim($params['act_category'])) > 0 ? trim($params['act_category']) : '';
        $params['act_sub_category'] = isset($params['act_sub_category']) && strlen(trim($params['act_sub_category'])) > 0 ? trim($params['act_sub_category']) : '';
        $params['actcount'] = isset($params['actcount']) && intval($params['actcount']) > 0 ? intval($params['actcount']) : '';
        $params['citedcount'] = isset($params['citedcount']) && intval($params['citedcount']) > 0 ? intval($params['citedcount']) : '';
        $params['refcount'] = isset($params['refcount']) && intval($params['refcount']) > 0 ? intval($params['refcount']) : '';
        
        if(isset($params['startDate']) && $params['startDate']):
            $datePart = explode('/', $params['startDate']);
            if(count($datePart) == 3):
                $params['startDate'] = mktime(0, 0, 0, $datePart[1], $datePart[0], $datePart[2]);
            else:
                $params['startDate'] = null;
            endif;
        endif;
        
        if(isset($params['endDate']) && $params['endDate']):
            $datePart = explode('/', $params['endDate']);
            if(count($datePart) == 3):
                $params['endDate'] = mktime(0, 0, 0, $datePart[1], $datePart[0], $datePart[2]);
            else:
                $params['endDate'] = null;
            endif;
        endif;

        if(isset($params['court_code']) && $params['court_code']):
            $params['court_code'] = explode(',', $params['court_code']);
        endif;
        
        if($params['advance_search'] == 1):
          
            $params['q'] = $this->parseAdvanceSearch1($params['q']);
        else:
            $params['q'] = \Yii::$app->sphinx->escapeMatchValue($params['q']);
        endif;

//        print_r($params);die;
        $query = new \yii\sphinx\Query();

        $query->from(self::tableName())->showMeta(true);
        //echo $query->createCommand()->getRawSql();die;

       

        if ($params['q']):
            $exp = new \yii\db\Expression(':match', ['match' => '@(appeal_numb,judgment_title,judgment_abstract,judgment_text,disposition_text) (' . $params['q'] . ')']);
            $query->match($exp);
        // $query->andWhere($exp);
           // print_r($exp);die;
        endif;
        if (!empty($params["appeal_numb"])):
            $query->andWhere(['appeal_numb' => $params["appeal_numb"]]);
        endif;

        if (!empty($params["judgment_title"])):
            $query->andWhere(['judgment_title' => $params["judgment_title"]]);
        endif;

        if (!empty($params["court_code"])):
            $query->andWhere(['court_code' => $params["court_code"]]);
        endif;
        if (!empty($params["disposition_id"])):
            $query->andWhere(['disposition_id' => $params["disposition_id"]]);
        endif;
        if (!empty($params["judgment_date"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['judgment_date_year_month_day' => $params["judgment_date"]]);
        endif;
        if (!empty($params["j_year_month"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['judgment_date_year_month' => $params["j_year_month"]]);
        endif;
        if (!empty($params["j_year"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['jyear' => $params["j_year"]]);
        endif;
        if (!empty($params["act_category"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['act_catg_code' => $params["act_category"]]);
        endif;
        if (!empty($params["act_sub_category"])):
            // echo strtotime($params["judgment_date"]);exit;
            $query->andWhere(['act_sub_catg_code' => $params["act_sub_category"]]);
        endif;
        if (!empty($params["actcount"])):
            $query->andWhere(['act_count' => $params["actcount"]]);
        endif;
        if (!empty($params["citedcount"])):
            $query->andWhere(['cited_count' => $params["citedcount"]]);
        endif;
        
        if (!empty($params["refcount"])):
            $query->andWhere(['ref_count' => $params["refcount"]]);
        endif;
        
        if (!empty($params["startDate"])):
            $query->andWhere('judgment_date >=:date',[':date'=>$params["startDate"]]);
        endif;
        
        if (!empty($params["endDate"])):
             $query->andWhere('judgment_date <=:date',[':date'=>$params["endDate"]]);
        endif;
        
        $facetarray = [
            'court_code' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,
            ],
            'disposition_id' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,
            ],
            'judgment_date_year_month' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 1000,
            ],
            'jyear' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,
            ],
            'act_catg_code' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,
            ],
            'act_sub_catg_code' => [
                'order' => ['COUNT(*)' => SORT_DESC],
                'limit' => 100,
            ],
        ];
        $query->addFacets($facetarray);
        $offset = ($params['page'] - 1) * $params['size'];
        $query->options(['max_matches' => 1000000]);
        $query->limit($params['size'])->offset($offset);

        $rs = $query->search();
        //print_r($rs);exit;
        //print_r($rs["facets"]);die;
        //proceed facets
        $facetsdata = $this->processFacets1($rs["facets"]);
        //print_r($facetsdata);exit;
        $totalItemCount = $rs['meta']['total_found'];
        $queryTime=$rs["meta"]["time"];

        if (isset($rs['hits']) && count($rs['hits']) > 0):
            $rows = $rs['hits'];

            $ids = [];
            foreach ($rows as $key => $row) {
                $ids[$key] = $row["id"];
            }
            $ids = implode(',', $ids);
            //print_r($ids);die;

//        $conditions=['judgment_code IN '=> $ids];
            $records = JudgmentMast::find()
                    ->asArray()
                    ->select('judgment_mast.appeal_numb,judgment_mast.judgment_title,judgment_mast.judgment_date,judgment_mast.court_name,judgment_search_summary.act_count,judgment_search_summary.cited_count,judgment_search_summary.ref_count,judgment_mast.judgment_text,judgment_mast.judgment_abstract,judgment_mast.disposition_text,judgment_mast.court_code,judgment_mast.judgment_code,judgment_mast.doc_id')
                    ->leftJoin('judgment_search_summary', 'judgment_search_summary.doc_id=judgment_mast.doc_id')
                    ->where("judgment_mast.judgment_code IN (" . $ids . ")")
                    ->orderBy([new \yii\db\Expression('FIELD (judgment_mast.judgment_code, ' . $ids . ')')])
                    ->all();
                    

//        print_r($records[0]);
            if(!empty($records)):
            foreach ($records as $row):
                $rowSnippetSources[] = strip_tags($row['judgment_title'] . ' ' . $row['judgment_text'] . ' ' . $row['judgment_abstract'] . ' ' . $row['disposition_text']);
            endforeach;

            $snippets = Yii::$app->sphinx->createCommand()->callSnippets(self::tableName() . '_0', $rowSnippetSources, $params['q'], ['around' => 5, 'limit' => 300])->queryAll();
            endif;
            // free up space
            $rowSnippetSources = null;
            $count = 1;
            foreach ($records as $key => &$row):
                $row['snippet'] = $snippets[$key]['snippet'];
                $row['sno'] = $offset + $count;
                $count++;
                unset($row['disposition_text']);
                unset($row['judgment_abstract']);
                unset($row['judgment_text']);
            endforeach;
        else:
            $records = [];
            $snippets = [];
        endif;
        $countPagination=$totalItemCount;
        if($countPagination > 200):
         $countPagination=200;
        endif;
        $pagination = new Pagination(['totalCount' => $countPagination]);
//        print_r($facetsdata['yearsCount']['count']);die;
        return [
            'data' => $records,
            'facets' => $facetsdata,
            'total' => $totalItemCount,
            'pagination' => $pagination,
            'querytime'=>$queryTime
        ];

    }




    

    private function parseAdvanceSearch($q){

        

        if(!strlen($q)):

            return null;

        endif;

        

        // $not = preg_split('/\snot\s/i',$q);

        // $q = '('.implode(') -(',$not).')';

        

        // $or = preg_split('/\sor\s/i',$q);

        // $q = '('.implode(') | (',$or).')';

        

        // $and = preg_split('/\sand\s/i',$q);

        // $q = ''.implode(' ',$and).'';

        if (strpos($q, 'NOT') !== false) :
            $not = preg_split('/\snot\s/i', $q);
            $q = '('.implode(') -(',$not).')';
        endif;


        if (strpos($q, 'OR') !== false) :
            $or = preg_split('/\sor\s/i', $q);
            $q = '(' . implode(') | (', $or) . ')';
        endif;


        if (strpos($q, 'AND') !== false) :
            $and = preg_split('/\sand\s/i', $q);
            $q = '' . implode(' ', $and) . '';
        endif;

     

        return $q;

    }

     /*new created for searchnew function*/
    private function parseAdvanceSearch1($q){

        if(!strlen($q)):

            return null;

        endif;

        if (strpos($q, 'NOT') !== false) :
            $not = preg_split('/\snot\s/i', $q);
            $q = '('.implode(') -(',$not).')';
        endif;


        if (strpos($q, 'OR') !== false) :
            $or = preg_split('/\sor\s/i', $q);
            $q = '(' . implode(') | (', $or) . ')';
        endif;


        if (strpos($q, 'AND') !== false) :
            $and = preg_split('/\sand\s/i', $q);
            $q = '' . implode(' ', $and) . '';
        endif;

     

        return $q;

    }

    

    /*

     * $data array of facets

     */



    private function processFacets($data) {

        $courtfacetsdata = [];

        $dispositionfacetsdata = [];

        $yearData= [];

        if(isset($data["act_sub_catg_code"]) && count($data["act_sub_catg_code"]) > 0):

        $categories=$this->processfacetsCategories($data["act_sub_catg_code"]);

        else:

        $categories=[];

        endif;



        //proceed with court_code facets

        if (isset($data["court_code"]) && count($data["court_code"]) > 0):



            //print_r($rs["facets"]["court_code"][0]["count(*)"]);exit;



            $courtcodes = implode(",", array_column($data["court_code"], "court_code"));

            //Primary key was not defined due to that direct query written

            $sql="select court_name,court_code,country_code,court_group_mast.court_group_name

                  FROM court_mast 

                  INNER JOIN

                  court_group_mast

                  ON 

                  court_group_mast.court_group_code = court_mast.court_group_code

                  WHERE  court_code IN (" . $courtcodes . ") ORDER BY court_type,court_name

                  ";

            $connection = Yii::$app->getDb();

            $command = $connection->createCommand($sql);

            $courtrecords = $command->queryAll();

            /*

            $courtrecords = CourtMast::find()

                    ->asArray()

                    ->select("court_name,court_code,country_code,court_group_mast.court_group_name")

                   ->innerJoin('court_group_mast', 'court_group_mast.court_group_code = court_mast.court_group_code')

                    ->where("court_code IN (" . $courtcodes . ")")

                    ->orderBy([new \yii\db\Expression('FIELD (court_code, ' . $courtcodes . ')')])

                    ->all();

             */



            //print_r($courtrecords);exit;



            foreach ($courtrecords as $key => $courtrecord):

                $courtKey = array_search($courtrecord['court_code'], array_column($data["court_code"], 'court_code'));

                $gid = $courtrecord['country_code'];

                if(!isset($courtfacetsdata[$gid])):

                    $courtfacetsdata[$gid] = ['name'=>$courtrecord['court_group_name'],'items'=>[],"count"=>0];

                endif;

                $courtfacetsdata[$gid]["items"][]= ["name"=>$courtrecord["court_name"],"code"=>$courtrecord["court_code"],"count"=>$data["court_code"][$courtKey]["count(*)"]];

                $courtfacetsdata[$gid]['count']+= $data["court_code"][$key]["count(*)"];

            endforeach;



        endif;

        //print_r($courtfacetsdata);exit;

        //proceed with disposition_id facets

        if (isset($data["disposition_id"]) && count($data["disposition_id"]) > 0):



            $dispositionids = implode(",", array_column($data["disposition_id"], "disposition_id"));

            $dispositionrecords = JudgmentDisposition::find()

                    ->asArray()

                    ->select("disposition_text,disposition_id")

                    ->where("disposition_id IN (" . $dispositionids . ")")

                    ->orderBy([new \yii\db\Expression('FIELD (disposition_id, ' . $dispositionids . ')')])

                    ->all();



            //print_r($records);exit;

            foreach ($dispositionrecords as $key => $dispositionrecord):

                $dispositionfacetsdata[$key]["text"] = $dispositionrecord["disposition_text"];

                $dispositionfacetsdata[$key]["id"] = $dispositionrecord["disposition_id"];

                $dispositionfacetsdata[$key]["count"] = isset($data["disposition_id"][$key]["count(*)"]);

            endforeach;



        endif;

        $years = array();

        //proceed with yearmonth facets

        if (isset($data["judgment_date_year_month"]) && count($data["judgment_date_year_month"]) > 0):

            $years = $this->proccesfacetsYears($data["jyear_new"]);

            $yearData = array();

            foreach ($data["judgment_date_year_month"] as $yearMonthValues):



                $year = substr($yearMonthValues["value"], 0, 4);

                // skip if year don't seem valid

                if ($year < 1000):

                    continue;

                endif;

                $month = substr($yearMonthValues["value"], -2);

                if (in_array($year, $years["year"])) {

                    $yearData["years"][$year][$month]["month"] = date("M", mktime(0, 0, 0, $month, 10));

                    $yearData["years"][$year][$month]["count"] = $yearMonthValues["count(*)"];

                }





            endforeach;

        endif;

        return array('court' => $courtfacetsdata, 'dispostion' => $dispositionfacetsdata, "yearsdata" => $yearData, 'yearsCount'=>$years,'categories'=>$categories);

    }
     /*new created for searchnew function*/
    private function processFacets1($data) {

        $courtfacetsdata = [];
        $dispositionfacetsdata = [];
        $yearData= [];
        if(isset($data["act_sub_catg_code"]) && count($data["act_sub_catg_code"]) > 0):
        $categories=$this->processfacetsCategories1($data["act_sub_catg_code"]);
        else:
        $categories=[];
        endif;

        //proceed with court_code facets

        if (isset($data["court_code"]) && count($data["court_code"]) > 0):
        //print_r($rs["facets"]["court_code"][0]["count(*)"]);exit;

        $courtcodes = implode(",", array_column($data["court_code"], "court_code"));
        //Primary key was not defined due to that direct query written
       $sql="select court_name,court_code,country_code,court_group_mast.court_group_name
                  FROM court_mast 
                  INNER JOIN
                  court_group_mast
                  ON 
                  court_group_mast.court_group_code = court_mast.court_group_code
                  WHERE  court_code IN (" . $courtcodes . ")
                  ";

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand($sql);
            $courtrecords = $command->queryAll();


            foreach ($courtrecords as $key => $courtrecord):
                $courtKey = array_search($courtrecord['court_code'], array_column($data["court_code"], 'court_code'));
                $gid = $courtrecord['country_code'];
                if(!isset($courtfacetsdata[$gid])):
                    $courtfacetsdata[$gid] = ['name'=>$courtrecord['court_group_name'],'items'=>[],"count"=>0];
                endif;

                $courtfacetsdata[$gid]["items"][]= ["name"=>$courtrecord["court_name"],"code"=>$courtrecord["court_code"],"count"=>$data["court_code"][$courtKey]["count(*)"]];
                $courtfacetsdata[$gid]['count']+= $data["court_code"][$key]["count(*)"];
            endforeach;

        endif;

        //print_r($courtfacetsdata);exit;

        //proceed with disposition_id facets

        if (isset($data["disposition_id"]) && count($data["disposition_id"]) > 0):
            $dispositionids = implode(",", array_column($data["disposition_id"], "disposition_id"));
            $dispositionrecords = JudgmentDisposition::find()
                    ->asArray()
                    ->select("disposition_text,disposition_id")
                    ->where("disposition_id IN (" . $dispositionids . ")")
                    ->orderBy([new \yii\db\Expression('FIELD (disposition_id, ' . $dispositionids . ')')])
                    ->all();

            //print_r($records);exit;

            foreach ($dispositionrecords as $key => $dispositionrecord):
                $dispositionfacetsdata[$key]["text"] = $dispositionrecord["disposition_text"];
                $dispositionfacetsdata[$key]["id"] = $dispositionrecord["disposition_id"];
                $dispositionfacetsdata[$key]["count"] = isset($data["disposition_id"][$key]["count(*)"]);
            endforeach;

        endif;

        $years = array();

        //proceed with yearmonth facets
        if (isset($data["judgment_date_year_month"]) && count($data["judgment_date_year_month"]) > 0):
            $years = $this->proccesfacetsYears1($data["jyear"]);
            $yearData = array();
            foreach ($data["judgment_date_year_month"] as $yearMonthValues):
                $year = substr($yearMonthValues["value"], 0, 4);
                // skip if year don't seem valid
                if ($year < 1000):
                    continue;
                endif;

                $month = substr($yearMonthValues["value"], -2);
                if (in_array($year, $years["year"])) {
                    $yearData["years"][$year][$month]["month"] = date("M", mktime(0, 0, 0, $month, 10));
                    $yearData["years"][$year][$month]["count"] = $yearMonthValues["count(*)"];
                }

            endforeach;
        endif;
        return array('court' => $courtfacetsdata, 'dispostion' => $dispositionfacetsdata, "yearsdata" => $yearData, 'yearsCount'=>$years,'categories'=>$categories);

    }



    private function proccesfacetsYears($years) {

        $result = array();

        if (empty($years)):

            return $result;

        endif;

        foreach ($years as $key => $year):

            $result["year"][$key] = $year["jyear_new"];

            $result["count"][$year["jyear_new"]] = $year["count(*)"];

        endforeach;

        return $result;

    }
      /*new created for searchnew function*/
    private function proccesfacetsYears1($years) {
        $result = array();
        if (empty($years)):
            return $result;
        endif;

        foreach ($years as $key => $year):
            $result["year"][$key] = $year["jyear"];
            $result["count"][$year["jyear"]] = $year["count(*)"];
        endforeach;
        return $result;
    }

    private  function processfacetsCategories($data){

        $ids=$this->makeCategoryArray($data);

        $counts=$this->makeCategoryArrayCount($data);

        $tree=array();

        if(!empty($counts) && !empty($ids)):

        $records = BareactSubcatgMast::find()

            ->asArray()

            ->where("act_sub_catg_code IN (" . $ids . ")")

            ->orderBy([new \yii\db\Expression('FIELD (act_sub_catg_code, ' . $ids . ')')])

            ->all();

//        print_r($records);exit;

        foreach ($records as $row):

            $countryId=$row['country_code'];

            if(!isset($tree[$countryId])):

                $tree[$countryId] = ['name'=>$row['country_name'],'items'=>[],"count"=>0];

            endif;

            $gid = $row['act_group_code'];

            if(!isset($tree[$countryId]["items"][$gid])):

                $tree[$countryId]["items"][$gid] = ['name'=>$row['act_group_desc'],'items'=>[],"count"=>0];

            endif;



            $cid = $row['act_catg_code'];

            if(!isset($tree[$countryId]["items"][$gid]['items'][$cid])):

                $tree[$countryId]["items"][$gid]['items'][$cid] = ['name'=>$row['act_catg_desc'],'items'=>[],'count'=>0];

            endif;



            $sid = $row['act_sub_catg_code'];

            if(!isset($tree[$countryId]["items"][$gid]['items'][$cid]['items'][$sid])):

                $tree[$countryId]["items"][$gid]['items'][$cid]['items'][$sid] = ['name'=>$row['act_sub_catg_desc'],'count'=>0];

            endif;



            $tree[$countryId]["items"][$gid]['items'][$cid]['items'][$sid]['count'] = $counts[$sid];

            $tree[$countryId]["items"][$gid]['items'][$cid]['count']+= $counts[$sid];

            $tree[$countryId]["items"][$gid]['count']+= $counts[$sid];

           $tree[$countryId]['count']+= $counts[$sid];

        endforeach;

        endif;

        return $tree;



    }
  /*new created for searchnew function*/
    private  function processfacetsCategories1($data){
        $ids=$this->makeCategoryArray($data);
        $counts=$this->makeCategoryArrayCount($data);
        $tree=array();
        if(!empty($counts) && !empty($ids)):
        $records = BareactSubcatgMast::find()
            ->asArray()
            ->where("act_sub_catg_code IN (" . $ids . ")")
            ->orderBy([new \yii\db\Expression('FIELD (act_sub_catg_code, ' . $ids . ')')])
            ->all();
//        print_r($records);exit;
        foreach ($records as $row):
            $countryId=$row['country_code'];
            if(!isset($tree[$countryId])):
                $tree[$countryId] = ['name'=>$row['country_name'],'items'=>[],"count"=>0];
            endif;
            $gid = $row['act_group_code'];
            if(!isset($tree[$countryId]["items"][$gid])):
                $tree[$countryId]["items"][$gid] = ['name'=>$row['act_group_desc'],'items'=>[],"count"=>0];
            endif;
            $cid = $row['act_catg_code'];
            if(!isset($tree[$countryId]["items"][$gid]['items'][$cid])):
                $tree[$countryId]["items"][$gid]['items'][$cid] = ['name'=>$row['act_catg_desc'],'items'=>[],'count'=>0];
            endif;
            $sid = $row['act_sub_catg_code'];
            if(!isset($tree[$countryId]["items"][$gid]['items'][$cid]['items'][$sid])):
                $tree[$countryId]["items"][$gid]['items'][$cid]['items'][$sid] = ['name'=>$row['act_sub_catg_desc'],'count'=>0];
            endif;

            $tree[$countryId]["items"][$gid]['items'][$cid]['items'][$sid]['count'] = $counts[$sid];
            $tree[$countryId]["items"][$gid]['items'][$cid]['count']+= $counts[$sid];
            $tree[$countryId]["items"][$gid]['count']+= $counts[$sid];
           $tree[$countryId]['count']+= $counts[$sid];
        endforeach;
        endif;
        return $tree;

    }




    /**

     * @param $id category id

     * @param $type main category 1 or subcategory 2

     * @return string category name

     */

    private  function makeCategoryArray($data){

        $result=array();

        if(!empty($data)){

           foreach ($data as $value){

               $result[]=$value["act_sub_catg_code"];

           }



        }

        return implode(",",$result);

    }
     /*new created for searchnew function*/
    private  function makeCategoryArray1($data){
        $result=array();
        if(!empty($data)){
           foreach ($data as $value){
               $result[]=$value["act_sub_catg_code"];
           }
        }
        return implode(",",$result);
    }

    private  function makeCategoryArrayCount($data){

        $result=array();

        if(!empty($data)){

            foreach ($data as $value){

                $result[$value["act_sub_catg_code"]]=$value["count"];

            }



        }

        return $result;

    }
    /*new created for searchnew function*/
    private  function makeCategoryArrayCount1($data){
        $result=array();
        if(!empty($data)){
            foreach ($data as $value){
                $result[$value["act_sub_catg_code"]]=$value["count"];
            }
        }
        return $result;
    }

    public  function keyWordSuggestion($keyword){

        $string=null;

        $conn = \Yii::$app->sphinx;

        $keywords=explode(" ",$keyword);

        if(!empty($keywords)):



        foreach ($keywords as $value):

           $response = $conn->createCommand("CALL QSUGGEST('".\Yii::$app->sphinx->escapeMatchValue(str_replace("'", "", $value))."','idx_court_decisions_0',1 as limit, 2 as max_edits,1 as result_stats,3 as delta_len,0 as result_line,25 as max_matches,4 as reject )")->queryAll();

           $data[]=$response;

        endforeach;

        //print_r($data);exit;

        if(isset($data) && !empty($data) && count($data[0]) > 0 ):

            foreach($data as $suggestedKeyWords):

                if(isset($suggestedKeyWords["0"]["suggest"])):
                    $result[]=$suggestedKeyWords["0"]["suggest"];
                endif;

            endforeach;

            return implode(" ",$result);

        endif;

        endif;

        return $string;







    }

     /*new created for searchnew function*/
    public  function keyWordSuggestion1($keyword){
        $string=null;
        $conn = \Yii::$app->sphinx;
        $keywords=explode(" ",$keyword);
        if(!empty($keywords)):
        foreach ($keywords as $value):
           $response = $conn->createCommand("CALL QSUGGEST('".\Yii::$app->sphinx->escapeMatchValue($value)."','idx_court_decisions_0',1 as limit, 2 as max_edits,1 as result_stats,3 as delta_len,0 as result_line,25 as max_matches,4 as reject )")->queryAll();

           $data[]=$response;
        endforeach;
        //print_r($data);exit;
        if(isset($data) && !empty($data) && count($data[0]) > 0 ):
            foreach($data as $suggestedKeyWords):
                $result[]=$suggestedKeyWords["0"]["suggest"];
            endforeach;
            return implode(" ",$result);
        endif;
        endif;
        return $string;

    }



    /**

     * @param $keyword this one function used for ajax search suggestion

     * @return string|null

     */

    public  function SearchSuggestion($keyword){

        $result=array();

        $response=array();

        $conn = \Yii::$app->sphinx;

        $keywords=explode(" ",$keyword);

        if(!empty($keywords)):



            foreach ($keywords as $value):

                $response = $conn->createCommand("CALL QSUGGEST('".\Yii::$app->sphinx->escapeMatchValue($value)."','idx_court_decisions_0',5 as limit, 4 as max_edits,1 as result_stats,3 as delta_len,0 as result_line,25 as max_matches,4 as reject )")->queryAll();

                //print_r($response);exit;

                $data[]=$response;

            endforeach;

            //print_r($response);exit;

            if(isset($response) && !empty($response) && count($response) > 0 ):



                foreach($response as $key => $suggestedKeyWords):

                    $result[]=$suggestedKeyWords["suggest"];

                endforeach;

                return $result;

                //print_r($result);

            endif;

        endif;

        return $result;







    }



}

