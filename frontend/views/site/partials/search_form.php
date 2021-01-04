<?php
    use yii\helpers\Html;
    use kartik\form\ActiveForm;
?>
<div class="col-md-12"></div>
<form class="form-horizontal">
   <div class="box-body">
        <div class="form-group">
            <div class="col-md-10 col-md-offset-1">
              <input type="search" class="form-control" id="inputPassword3" placeholder="Search">
            </div>
       </div>
       <div class="form-group form-check">
           <div class="col-md-10 col-md-offset-1">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Search Title Only</label>
           </div>
           
       </div>
       <div class="form-group row">
           <div class="col-md-10 col-md-offset-1">
                <label for="inputPassword3" class="col-md-1 col-form-label">By: </label>
                <div class="col-md-11">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="">
                </div>
           </div>
           
       </div>
       <div class="form-group">
           <div class="col-md-10 col-md-offset-1">
               <div class="col-md-12">
                   <button class="btn theme-blue-button"><span class="search-icon"><i class="fa fa-search"></i></span> Search</button>
                   <button class="btn btn-warning">Advancedfhgfghfd Search</button>
               </div>
           </div>
       </div>
   </div>
</form>