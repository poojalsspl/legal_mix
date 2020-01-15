<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UserMast;
/* @var $this yii\web\View */
/* @var $model app\models\UserMast */
/* @var $form yii\widgets\ActiveForm */
?>
  <?php $form = ActiveForm::begin(); 
  $baseUrl = Yii::$app->params['domainName'];

  ?>
<div class="container">
   <div class="row">
     <div class="col-sm-3"><!--left col-->
      <div class="text-center">
        <?php $image = $model->user_pic;
        if($image==""){
           $image = "default.jpg";
        }

        ?>
        <img src="<?php echo $imag = $baseUrl.'frontend/web/uploads/'.$image ; ?>" class="avatar img-circle img-thumbnail" alt="avatar" height="200" width="200">
        </div>
        </div><!--/col-3-->
        <div class="col-sm-7">
        <div>
       <div class="form-group">
          <div class="col-xs-6">
          <label for="first_name">First name : <span class="content"> <?php echo $model->first_name; ?> </span> </label>
          </div>
          </div>
        <div class="form-group">
           <div class="col-xs-6">
           <label for="last_name">Last name : <span class="content"> <?php echo $model->last_name; ?> </span></label>
           </div>
        </div>
        <div class="form-group">
           <div class="col-xs-6">
           <label for="phone">Gender : <span class="content">
           <?php if ($model->gender == 'M'){
                           echo "Male";
                        } else {
                        echo "Female";
                        }
              ?>
            </span></label>
            </div>
            </div>
         <div class="form-group">
            <div class="col-xs-6">
              <label for="mobile">DOB : <span class="content"> <?php echo date('d-m-Y',strtotime($model->dob)); ?> </span></label>
            </div>
          </div>
           <?php
              if($model->landline_1==""){
                $landline_1 = "-NA-";
              } else {
                $landline_1= $model->landline_1;
              }
          ?>  
          <div class="form-group">
          <div class="col-xs-6">
          <label for="phone">Phone1 : <span class="content"> <?php echo $landline_1; ?> </span></label>
          </div>
          </div>
          <?php
              if($model->landline_2==""){
                $landline_2 = "-NA-";
              } else {
                $landline_2= $model->landline_2;
              }
          ?>  
          <div class="form-group">
          <div class="col-xs-6">
          <label for="mobile">Phone2 : <span class="content">  <?php echo $landline_2 ; ?> </span></label>
          </div>
          </div>
          <div class="form-group">
           <?php
              if($model->mobile_1==""){
                $mobile_1 = "-NA-";
              } else {
                $mobile_1 = $model->mobile_1;
              }
          ?>  
          <div class="col-xs-6">
          <label for="phone">Mobile1 : <span class="content">  <?php echo $mobile_1; ?> </span></label>
          </div>
          </div>
           <?php
              if($model->mobile_2==""){
                $mobile_2 = "-NA-";
              } else {
                $mobile_2 = $model->mobile_2;
              }
          ?>  
          <div class="form-group">
             <div class="col-xs-6">
             <label for="mobile">Mobile2 : <span class="content">  <?php echo $mobile_2; ?> </span></label>
             </div>
          </div>
           <div class="form-group">
           <div class="col-xs-6">
          <label for="email">Email : <span class="content"> <?php echo $model->email; ?> </span></label>
           </div>
           </div>
           <div class="form-group">
           <div class="col-xs-6">
           <?php $address =  $model->user_address. ",".$model->city_name." ".$model->pin_code.",".$model->state_name.",".$model->country_name;
           ?>
           <label for="email">Address: <span class="content"> <?php echo $address; ?> </span></label>
           </div>
           </div>
           <div class="form-group">
           <div class="col-xs-6">
           <label for="email">Bar Council Registration : <span class="content"><?php echo $model->bar_reg_no; ?> </span></label>
            </div>
            </div>
            <div class="form-group">
            <div class="col-xs-6">
            <label for="email">Registration Date: <span class="content"> <?php echo date('d-m-Y',strtotime($model->sign_date));
             ?></span></label>
            </div>
            </div>
            <div class="form-group">
            <div class="col-xs-6">
            <label for="password">Graduation Year: <span class="content"> <?php echo $model->grad_yr; ?> </span></label>
             </div>
              </div>
            <div class="form-group">
            <div class="col-xs-6">
            <label for="password2">Practicing since:<span class="content"> <?php echo $model->practice_since; ?></span></label>
             </div>
             </div>
             <div class="form-group">
             <div class="col-xs-6">
              <?php
              if($model->company_name==""){
                $company = "-NA-";
              } else {
                $company = $model->company_name;
              }
               ?>
             
             <label for="password">Company Name: <span class="content"> <?php echo $company; ?> </span></label>
              </div>
              </div>
              <div class="form-group">
              <div class="col-xs-6">
              <?php
              if($model->no_of_laywers==""){
                $no_of_laywers = "-NA-";
              } else {
                $no_of_laywers = $model->no_of_laywers;
              }
               ?>
              <label for="password2">Number of employees:<span class="content"> <?php echo $no_of_laywers; ?></span></label>
              </div>
              </div>
              <div class="form-group">
              <div class="col-xs-6">
              <label for="password">GST No: <span class="content"><?php echo $model->gst_no; ?> </span></label>
              </div>
              </div>
              <div class="form-group">
              <div class="col-xs-6">
              <label for="password2">PAN No:<span class="content"><?php echo $model->pan_no; ?></span></label>
              </div>
              </div>
              <div class="form-group">
              <div class="col-xs-12">
              <br>
              <a href="<?= Yii::$app->params['domainName'] ?>site/step2update" class="btn btn-lg btn-success">Update Profile</a>
                    </div>
                   </div>
        </div><!--/col-9-->
    </div><!--/row-->

    <?php ActiveForm::end(); ?>
</div>
</div>