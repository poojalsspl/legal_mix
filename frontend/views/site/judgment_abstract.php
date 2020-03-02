<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\JudgmentComments;
use frontend\models\JudgmentMast;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
$jcode = $_GET['jcode'];
$doc_id = $_GET['doc_id'];

$status = ['1'=>'Public','2'=>'Private'];

$judgment = ArrayHelper::map(JudgmentMast::find()
  ->where(['judgment_code'=>$jcode])
  ->all(),
    'judgment_code','judgment_title');
foreach ($judgment as $judgment_value) {

}

?>

<h2><?= $judgment_value; ?></h2>
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
              <h3 class="box-title">Add Comments</h3>
             
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
              <h3 class="box-title">Comments Section</h3>

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
              <?php Pjax::begin(); ?>    
           <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'crdt:date',//diaplay only date from datetime
            [
             'attribute'=>'username',
             'label'=>'Name',
             'value'=>'fullname.first_name',//show name in place of email 
            ],
            [
             'attribute'=>'judgment_user_comment',
             'value'=>'truncatedAbstract',//show limited characters
            ],
            
            

           ['class' => 'yii\grid\ActionColumn',
            'header'=>'Actions',
            'template' => '{View}', 
            'buttons' => [
                
               'View' => function ($url, $model, $key) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['abstract-view', 'id'=>$model->id]);
            },
             
                'format' => 'raw',

              ],
                 'contentOptions' => [ "class"=>'action-btns', 'width'=>''],
        ],


        ],
    ]); ?>
<?php Pjax::end(); ?>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
  
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