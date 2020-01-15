<?php
    use yii\helpers\Html;
    use kartik\form\ActiveForm;
?>

<form class="form-horizontal">
   <div class="box-body">
        <div class="form-group">
            <div class="col-sm-12">
              <input type="search" class="form-control" id="inputPassword3" placeholder="Search">
            </div>
       </div>
       <div class="form-group form-check">
           <input type="checkbox" class="form-check-input" id="exampleCheck1">
           <label class="form-check-label" for="exampleCheck1">Search Title Only</label>
       </div>
       <div class="form-group row">
           <label for="inputPassword3" class="col-sm-2 col-form-label">By: </label>
           <div class="col-sm-10">
               <input type="text" class="form-control" id="inputPassword3" placeholder="">
           </div>
       </div>
       <div class="form-group">
           <button class="btn theme-blue-button"><span class="search-icon"><i class="fa fa-search"></i></span> Search</button>

           <button class="btn btn-warning">Advanced Search</button>
       </div>
   </div>
</form>