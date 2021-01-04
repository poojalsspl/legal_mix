<?php
    use yii\helpers\Html;
    use kartik\form\ActiveForm;
    use yii\helpers\Url;
?>
<script type="text/javascript">
        function successsearch() {
     if(document.getElementById("textbox").value==="") { 
            document.getElementById('srchbutton').disabled = true; 
        } else { 
            document.getElementById('srchbutton').disabled = false;
        }
    }
    </script>

<div class="col-md-12"></div>

  <form role="form" id="form" name="form" novalidate="novalidate" action="/legal_mix/site/search">
   <div class="box-body">
        <div class="form-group">
            <div class="col-md-10 col-md-offset-1">

              
              <input type="search" class="form-control" id="textbox" name="q" placeholder="" onkeyup="successsearch()">
              <input type="hidden" name="court_code" id="court_code" />
              <input type="hidden" name="advance_search" value="1" />
            </div>
       </div>
       <div class="form-group form-check">
           <div class="col-md-10 col-md-offset-1">
               <!--  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Search Title Only</label> -->
           </div>
           
       </div>
       <div class="form-group row">
           <div class="col-md-10 col-md-offset-1">
                <!-- <label for="inputPassword3" class="col-md-1 col-form-label">By: </label>
                <div class="col-md-11">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="">
                </div> -->
           </div>
           
       </div>
       <div class="form-group">
           <div class="col-md-10 col-md-offset-1">
               <div class="col-md-12">
                   <button class="btn theme-blue-button" type="submit" id="srchbutton" disabled><span class="search-icon"><i class="fa fa-search"></i></span> Search</button>
                   
                   
             

               </div>
           </div>
       </div>
   </div>
</form>