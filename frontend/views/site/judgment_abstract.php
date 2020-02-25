<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\JudgmentComments;
use yii\helpers\ArrayHelper;
$jcode = $_GET['jcode'];
$doc_id = $_GET['doc_id'];

$status = ['1'=>'Public','2'=>'Private'];

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-4">
         <!--  <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a> -->
          <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Add Suggestion</h3>
             
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
               <!--  <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">12</span></a></li> -->
                <li> <?= $form->field($model, 'judgment_user_comment')->textArea(['placeholder' => 'Enter Judgment Abstract','rows'=>8]) ?></li>
                <li><?= $form->field($model, 'status')->dropDownList($status,['prompt'=>'Select Status']); ?></li>
               
              </ul>
              <?= Html::submitButton('Submit', ['class' => 'btn-block btn theme-blue-button ']) ?>
            </div>
            <!-- /.box-body -->
          </div>
          <?php ActiveForm::end(); ?>

        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Comments Setion</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
               
               
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  	<?php
                  	$model_judg = new JudgmentComments();
                    $model_comm = $model_judg->find()->where(['status' => '1'])->andWhere(['judgment_code'=>$jcode])->all();
                    foreach ($model_comm as $valuecom) {
                    	$username = $valuecom['username'];
                    	$comment = $valuecom['judgment_user_comment'];
                    	$crdt = $valuecom['crdt'];
                    	$created_date = substr($crdt, 0,10); 
                    	
                   
                     ?>
                  <tr>
                   <td class="mailbox-name"><a href="read-mail.html"><?php echo $valuecom['username'] ?></a></td>
                    <td class="mailbox-subject"><?php if (strlen($comment) > 70) echo $comment = substr($comment, 0, 70) . "..."; ?>
                    </td>
                    <td class="mailbox-date"><?php echo $created_date; ?></td>
                  </tr>
              <?php } ?>
                  
                 </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
               
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->