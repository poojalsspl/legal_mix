<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\JudgmentMast;
/* @var $this yii\web\View */
/* @var $model app\models\UserMast */
/* @var $form yii\widgets\ActiveForm */
?>
  <?php $form = ActiveForm::begin(); 
   $baseUrl =   \Yii::$app->request->BaseUrl;
    //exit;
  ?>

  
       
<div class="col-sm-9">
          <div class="well">
        
   
<p align="left" style="line-height:1px;"><span><br/>
</span><br/>

</p>
<p class="para2" align="center" style="font-size: 16px">
<span><b><?php echo $model->judgment_title; ?></b></span>
</p>
<p class="para2" align="left">
<span style="color:#e4353a;"> <b>Decided On:  </b> </span>
<span><?php echo  $model->judgment_date ?></span>

<span style="color:#e4353a;"><b> Subject: </b></span>
<span><?php echo  $model->jcatg_description ?></span>
<b><span style="color:#e4353a;">Case Status: </b></span>
<span>Appeal Dismissed</span>
<span style="color:#e4353a;"> <b>Appeal No: </b></span>
<span><?php echo  $model->appeal_numb ?></span>
</p>
<p class="para2" align="left">
<span style="color:#e4353a;"><b>Appellants: </b></span>
<span><?php echo  $model->appellant_name ?></span>
<span><br/></span>
<span><b>Vs.</b></span>
<span style="color:#e4353a;"><br/><b>Respondent:</b></span>
<span><?php echo  $model->respondant_name ?></span>
</p>
<p class="para2" align="justify" >
<span style="color:#e4353a;"> <b>Judges/Coram:</b></span>
<span><i><?php echo  $model->judges_name ?></span></i></span>
</p>

<p class="para2" align="justify">
<span style="color:#e4353a;"><b>Acts/Rules/Orders: </b></span>
<span>&middot; Group &quot;D&quot; Employees Service Rules, 2004 - Rule 28</span>
</p>

<p class="para2" align="justify">
<span style="color:#e4353a;"><b>Abstract:<br/></b></span>
<span> <b> <?php echo  $model->judgment_date ?></b></span>
</p>
<p class="para2" align="left" style="font-size: 16px">
<span style="color:#e4353a;"><b>JUDGMENT</b></span>
</p>


<p class="para2" align="justify">
<span><b>1.</b></span>
<span><?php echo  $model->judgment_text ?></span>
</p>







 </div>
        </div>



    <?php ActiveForm::end(); ?>
</div>
</div>
