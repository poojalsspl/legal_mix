<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="col-sm-3 well">
      <div class="well">

       <div class="container" style="margin-top:10px;">

    <div class="row">
        <div class="col-md-3">
        
            <ul id="tree1">
                         <li style="color:#e4353a;">  Bare act
   
                    
                        <li> Tax Laws </li>
                        <li>Environment Laws </li>
                        <li>Service and Labour Law </li>
                        <li>Human Rights Law </li>
                      </li>
                
            </ul>
        </div>

     </div>
     <div  style="float: left;"> <a href="#">Read more... </a> </div>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul id="tree2">
         <li style="color:#e4353a;"> Judgement Referred
   
                    
                        <li> Single judgments</li>
                        <li>Joint judgments </li>
                        <li>Dissenting judgments </li>
                        <li>Plural judgments </li>
                      </li>
                       
                    </ul>
               
        </div>
    
    </div>
      <div  style="float: left;"> <a href="#">Read more... </a></div>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul id="tree3">
        
                    <li style="color:#e4353a;"> Judges
   
                    
                        <li> Ranjan Gogoi</li>
                        <li>Madan Lokur </li>
                        <li>Kurian Joseph</li>
                        <li>N. V. Ramana </li>
                        <li>Arun Kumar Mishra </li>
                      </li>
                       
                    </ul>
               
        </div>
    
    </div>
    <div  style="float: left;"> <a href="#">Read more... </a></div>
</div> 
<hr>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul id="tree4">
          <li style="color:#e4353a;"> Advocate
   
                    
                        <li> Appellant</li>

                         <ul>
                                <li>Ashok Bhushan </li>
                                <li>Navin Sinha </li>
                                <li>Indu Malhotra </li>
                                  
                          </ul>
                        <li>Responded </li>
                        <ul>
                                <li> Deepak Gupta </li>
                                <li> Ajay Rastogi </li>
                                <li> Vineet Saran</li>
                          </ul>
                       
                      </li>
                       
  </ul>
               
   </div>
    
  </div>
      <div  style="float: left;"> <a href="#">Read more... </a></div>
</div>

   
 </div>
</div>
                

<div class="site-reset-password">
      <?php $form = ActiveForm::begin(); ?>
               <h1><?= Html::encode($this->title) ?></h1>
            <?= $this->render('judgedetails', [
              'model' => $model,
            ]) ?>
            <?php ActiveForm::end(); ?>
</div>
