<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use kartik\cmenu\ContextMenu;
use maxeko\devbridge\Autocomplete;
use yii\helpers\ArrayHelper;

$this->title = 'Custom Search';
//$this->params['breadcrumbs'][] = $this->title;

// echo "<pre>";
// print_r($facets['categories']);
// echo "</pre>";die;

?>
<script>
    function openInNewTab(url, index) {
        var win = window.open(url, 'win_' + index);
        //win.focus();
    }
</script>



<div class="template">
<div class ="body-content">
<div class="col-md-12">

<div class="row">
<div class="col-md-9 col-sm-12 border-green">
<div class="row">
<form name="form" >                             
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<input type="search" class="form-control" name="csearch" id="search-input" placeholder="Search.." value="" >
</div>
</div> 
<div class="col-md-4 col-sm-8 col-xs-12">
<div class="form-group">
<select name="searchfilter" id="searchfilter" class="form-control" placeholder="">
<option disabled selected>Please select your option</option>
<option value="1">Judgment Title</option>
<option value="2">Judgment Citation</option>

</select>
</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
<div class="row"><a id="submit-button" class="btn btn-primary">Search</a></div>
</div>
</form>
<!-- </form> -->
</div>
<!-- row (col-md-9)-->
</div>
<!-- (col-md-9)-->
</div>
</div>

<div id="add">
    
</div>
<!-- Image loader -->
<div id="loader" style="display: none;">
 <img src="/legal_mix/frontend/web/images/loader.gif">
</div>
<!-- Image loader -->

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$('#submit-button').on("click",function(){
    alert('Please wait a moment, it will take some time to search');
var sargument = $('#search-input').val();
var sfilter = $('#searchfilter').val();

$.ajax({
        url      : '/legal_mix/site/custom-ajax-search?srch='+sargument+'&fltr='+sfilter,
        beforeSend: function(){
        $("#loader").show();
        },
        //dataType : 'json',
        success  : function(data) { 
           if(data=='[]'){
            alert('no data found');
           }
           //console.log(data);
          let jdata = JSON.parse(data);
          $("#add").each(function(){
             $('#add').empty();
          $.each(jdata,function () {
            var maxLength = 300;
            var judg_Code = this.judgment_code;
            var judg_Title = this.judgment_title;
            var jDate = new Date(this.judgment_date);
            var judg_Date  = jDate.getDate() + '-' + (jDate.getMonth() + 1) + '-' + jDate.getFullYear();
            var judg_Court = this.court_name;
            var jText = this.judgment_text;
            if(jText.length > maxLength){
            var judg_Text = jText.substring(0, maxLength) + ' ...................';
            }
            

            
            //console.log("Title: " + jud_title);

            $('#add').append('<div class="row"><div class="col-md-1"></div><div class="col-md-10 border-green"><div class="row"><div class="box box-v3"><div class="box-header with-border box-header-custom"><div class="row"><div class="col-md-8 align-left"><span class=" search-result-title"><a href="/legal_mix/site/judgment?id='+judg_Code+'">'+judg_Title+'</a></span></div><div class="col-md-4 align-right"><span class=" search-result-date">'+judg_Date+'</span></div></div></div><div class="box-body search-results-body"><div class="search-result-content">'+judg_Text+'</div><div class="col-md-12 magintop box-footer box-footer-custom "><div class="col-md-3 align-left"><span class="search-result-court-name">'+judg_Court+'</span></div></div></div></div></div>');
         });

       });
        
    },
    complete:function(data){
    $("#loader").hide();
   }
    });
});

</script>






















