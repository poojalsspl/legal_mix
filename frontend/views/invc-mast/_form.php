<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\CustMast;
use yii\helpers\ArrayHelper;
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
    <div class="row">
      <div class="col-sm-6">
        <?php  echo Yii::$app->user->id;?>
           <?= $form->field($model, 'custid')->dropDownList(ArrayHelper::map(CustMast::find()->where(['userid'=>Yii::$app->user->id])->all(),'custid','custname'),['prompt'=>'Select customer'],['style'=>'width:300px']) ?>
      </div>
      <div class="col-sm-6">
            <?php // $form->field($model, 'invc_amt')->textInput(['maxlength' => true]) ?>
       </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsInvoice[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'invc_numb',
                    'invc_qty',
                    'invc_rate',
                    'invc_amt',
                    'invc_desc',
                    'disc',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsInvoice as $i => $modelInvoice): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Items</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelInvoice->isNewRecord) {
                                echo Html::activeHiddenInput($modelInvoice, "[{$i}]id");
                            }
                        ?>
                     
                        <div class="row">
                          
                            <div class="col-sm-2">
                                <?= $form->field($modelInvoice, "[{$i}]invc_qty")->textInput(['style'=>'width:150px']) ?>
                            </div>
                       
                      
                        <div class="col-sm-2">
                            <?= $form->field($modelInvoice, "[{$i}]invc_rate")->textInput(['style'=>'width:150px']) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $form->field($modelInvoice, "[{$i}]disc")->textInput(['style'=>'width:150px']) ?>
                        </div>
                        <div class="col-sm-2">
                             <?= $form->field($modelInvoice, "[{$i}]gst")->textInput(['style'=>'width:150px']) ?>
                        </div>
                        <div class="col-sm-2">
                                <?= $form->field($modelInvoice, "[{$i}]invc_desc")->textInput(['style'=>'width:250px']) ?>
                        </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($modelInvoice->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>