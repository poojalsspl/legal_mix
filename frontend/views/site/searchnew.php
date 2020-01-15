<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use kartik\cmenu\ContextMenu;
use maxeko\devbridge\Autocomplete;
use yii\helpers\ArrayHelper;

$this->title = 'Search';
//$this->params['breadcrumbs'][] = $this->title;
//print_r($facets);exit;

?>
<script>
    function openInNewTab(url, index) {
        var win = window.open(url, 'win_' + index);
        //win.focus();
    }
</script>
<script type="text/javascript">
        function successsearch() {
     if(document.getElementById("search-input").value==="") { 
            document.getElementById('srchbutton').disabled = true; 
        } else { 
            document.getElementById('srchbutton').disabled = false;
        }
    }
    </script>



<div class="template">
    <div class ="body-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 col-sm-12 border-green"></div>
                
                <div class="col-md-9 col-sm-12 border-green">
                    <div class="row">
                        <form role="form">                            
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="search" class="form-control" name="q" id="search-input" placeholder="Search.." onkeyup="successsearch()" value="<?php echo \yii\helpers\Html::encode($term); ?>">
                                     <input type="hidden" class="form-control" name="p" style="display: none;"  value="<?php echo \yii\helpers\Html::encode($term); ?>">
                                            <input type="hidden" name="advance_search" value="<?php echo $advance_search; ?>">
                                  </div>
                            </div> 
                             <div class="col-md-4 col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <select class="form-control select2" style="width: 100%;">
                                      <option selected="selected">SORT SEARCH RESULT</option>
                                      <option>B Judgement Title</option>
                                      <option>C Judgement Date</option>
                                      <option>D Judgement Name</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="row"><button type="submit" id="srchbutton" class="btn theme-blue-button btn-block" disabled>SEARCH</button></div>                                
                            </div>
                        </form>

                        

                    </div>

                    <div class="row search-header">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="form-group">
                                <?php
                                            if ($term_again == 1):
                                                $searchagain = null;
                                                $searchawith = "checked=\"checked\"";
                                            else:
                                                $searchagain = "checked=\"checked\"";
                                                $searchawith = null;
                                            endif;
                                            ?>
                               
                                <input type="radio" name="again" value="0" <?php echo $searchagain; ?> >Search Again<span style="padding-left: 20px"></span>
                                <input type="radio" name="again" value="1" <?php echo $searchawith; ?>>Search Within These Results
                                <?php
                                            //check if we got suggested key word
                                            if (isset($suggest)):
                                                ?>
                                                <h4> Did you mean <a href="<?php echo Url::current(['q' => $suggest]); ?>"><?php echo $suggest; ?></a></h4>
                                                <?php
                                            endif;
                                            ?>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="query-timer row">
                                SEARCH RESULT COUNT : <span class="query-count"> <?php echo $total; ?> </span> results found ( <?php echo $querytime; ?> )
                            </div>
                        </div>
                        
                    </div>
                </div>
        </div>
         <div class="col-md-12">
            <div class="row">

                <!--sidebar code here-->
                         <!--SideBar Menu-->
               <div class="col-md-3 border-green side-menu">
                    <div class="row side-menu-content">
                        <div class="box box-v2">   
                            <div class="box-body">
                                 <?php 
                                    $items = [];
                                    
                                    //Generate Court Items <li> codes/
                                    if (!empty(( $court_data = $facets['court']))) {
                                        foreach ($facets['court'] as $i=> $court_type) {
                                            $items[($i.'courts')] = [
                                            'label' => ArrayHelper::getValue($court_type, 'name', 'not-set'),
                                            'icon' => 'plus',
                                            'items' => []
                                        ];
                                            if (is_array( ($courts = $court_type['items']))) {
                                                foreach ($courts as $court) {
                                                    //print_r($items[($i.'courts')]['items']);
                                                    $items[($i.'courts')]['items'][] = [
                                                        'label' => ArrayHelper::getValue($court, 'name', 'not-set') . ' (' . ArrayHelper::getValue($court, 'count', '#') . ' )',
                                                        'url' => Url::current(['court_code' => $court['code']]),
                                                         $court["name"] . " (" . $court["count"] . ")",
                                                    ];
                                                }
                                            }
                                        
                                        }
                                        
                                    }
                                    //Generate Year Items <li> codess.
                                    if (!empty(( $years_data = $facets['yearsdata']))) {
                                        if (is_array(($years = $years_data['years'])))
                                        {
                                            $items['years'] = [
                                                    'label' => 'Years',
                                                    'icon' => 'plus',
                                                    'items' => [],
                                                ];
                                            foreach ($years as $key => $year) {
                                                $items['years']['items'][$key] = [
                                                    'label' => $key,
                                                    'url' => Url::current(['j_year' => $key['value']]),$key,
                                                    'icon' => 'plus',
                                                    'items' => [],
                                                ];
                                                if (is_array($year)) {
                                                    foreach ($year as $code => $month) {
                                                        $items['years']['items'][$key]['items'][] = [
                                                            'label' => ArrayHelper::getValue($month, 'month', 'not-set') . ' (' . ArrayHelper::getValue($month, 'count', '#') . ' )',
                                                            'url' => Url::current(['j_year_month' => $key.$code]),
                                                            $month["month"] . " (" . $month["count"] . ")",

                                                            
                                                        ];
                                                    }
                                                }
                                            }
                                        }
                                        
                                    }
                                    
                                    if (!empty(( $categories = $facets['categories']))) {
                                        if (is_array($categories)) {
                                            foreach ($categories as $i => $category) {
                                                $items['categories'] = [
                                                    'label' => 'Categories',
                                                    'icon' => 'plus',
                                                    'items' => []
                                                ];
                                                
                                                if (is_array(($cat_items = ArrayHelper::getValue($category, 'items', 'not-set')))) {
                                                    foreach ($cat_items as $i => $cat_item) {
                                                        $items['categories']['items'][$i] = [
                                                            'label' => ArrayHelper::getValue($cat_item, 'name', 'not-set') . ' (' . ArrayHelper::getValue($cat_item, 'count', '#') . ' )',
                                                            'icon' => 'plus',
                                                            'items' => []
                                                        ];
                                                        if (is_array(($acts = ArrayHelper::getValue($cat_item, 'items', 'not-set')))) {
                                                            foreach ($acts as $act_id => $act) {
                                                                $items['categories']['items'][$i]['items'][$act_id] = [
                                                                    'label' => ArrayHelper::getValue($act, 'name', 'not-set') . ' (' . ArrayHelper::getValue($act, 'count', '#') . ' )',
                                                                    'icon' => 'plus',
                                                                    'url' => Url::current(['act_category' => $act_id]),
                                                                     $act["name"] . " (" . $act["count"] . ")",
                                                                    'items' => []
                                                                ];
                                                                if (is_array(($act_items = ArrayHelper::getValue($act, 'items', 'not-set')))) {
                                                                    foreach ($act_items as $act_item_id => $act_item) {
                                                                        $items['categories']['items'][$i]['items'][$act_id]['items'][] = [
                                                                            'label' => ArrayHelper::getValue($act_item, 'name', 'not-set') . ' (' . ArrayHelper::getValue($act_item, 'count', '#') . ' )',
                                                                            'url' => Url::current(['act_sub_category' => $act_item_id]),
                                                                            $act_item["name"] . " (" . $act_item["count"] . ")",
                                                                        ];
                                                                    }
                                                                }
                                                            }   
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                <?=$this->render('partials/side_menu.php', ['items' => $items, 'title' => false])?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 border-green">
                    <div class="row">
                        <!-- Search Results-->
                    
                         <?php
                            $linkopen = 0;
                            foreach ($data as $key => $row) :
                                if ($linkopen == 6):
                                    $linkopen = 0;
                                endif;
                                $linkopen++;
                                ?>
                        <div class="box box-v3">
                            <div class="box-header with-border box-header-custom">
                                <div class="row">
                                    <div class="col-md-8 align-left">
                                        <span class=" search-result-title" onclick="openInNewTab('<?php echo Url::to(['site/judgment/' . $row["judgment_code"]], true); ?>', '<?php echo $linkopen; ?>')">
                                           <a href="javascript:;" target="_blank"><?php echo $row["judgment_title"]; ?></a>
                                        </span>
                                    </div>
                                    <?php
                                            $showdate = 0;
                                            if (checkdate(date("m", strtotime($row["judgment_date"])), date("d", strtotime($row["judgment_date"])), date("Y", strtotime($row["judgment_date"])))) {
                                                $showdate = 1;
                                            }
                                             ?>
                                    <div class="col-md-4 align-right">
                                        <span class=" search-result-date">
                                            <?php if ($showdate == 1) { ?><a href="<?php echo Url::current(['judgment_date' => date("Ymd", strtotime($row["judgment_date"]))]); ?>"><?php echo date("Y-m-d", strtotime($row["judgment_date"]));
                                    } ?></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                             <!-- /.box-header -->
                            <div class="box-body search-results-body">
                                <div class="search-result-content">
                                    <p>
                                       <?php echo $row['snippet']; ?>
                                    <p>
                                </div>
                                <div class="col-md-12 magintop box-footer box-footer-custom">
                                    <div class="col-md-3">
                                        <span class="search-result-court-name align-left">
                                            <a href="<?php echo Url::current(['court_code' => $row["court_code"]]); ?>"><?php echo $row["court_name"]; ?></a>
                                            
                                        </span>                                        
                                    </div>
                                    <div class="col-md-3">
                                        <span class="search-result-acts">
                                            Acts / Section: <span class=""><a href="<?php echo Url::to(['site/actlist/' . $row["doc_id"]], true); ?>"><?php echo $row["act_count"]; ?></a></span>
                                        </span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="search-result-cited-by">
                                            Cited By: <span class=""><a href="<?php echo Url::to(['site/citedby/' . $row["doc_id"]], true); ?>"><?php echo $row["cited_count"]; ?></a></span>
                                        </span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="search-result-cited">
                                            Cited: <span class=""><a href="<?php echo Url::to(['site/citedin/' . $row["doc_id"]], true); ?>" ><?php echo $row["ref_count"]; ?></a></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                     <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-left">
                            <?php
                            echo LinkPager::widget([
                                'pagination' => $pagination,
                            ]);
                            ?>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
        
    </div>
</div>





















