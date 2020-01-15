<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Categories;


/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_meta_desc')->textInput(['maxlength' => true]) ?>
    <?php
    	$cat[0] = '-root';
    	//$categories[0] = 'root';

        $categories = Categories::find()->all();
        foreach ($categories as $categ) {
          if($categ->cat_root == 0){
            $cat[$categ->cat_id] = ' --'.$categ->cat_title;
            $categChild = Categories::find()->select('cat_root,cat_id,cat_title')->where(['cat_root'=>$categ->cat_id])->all();            
            if(count($categChild)>0){
            foreach ($categChild as $child) {
                 $cat[$child->cat_id] = '  ---'.$child->cat_title;   
            }
        }

          }  

        }
        //print_r($categories)
         /*$categories[0]='root';*/
    ?>
    <?= $form->field($model, 'cat_root')->dropDownList($cat) ?>

    <?= $form->field($model, 'cat_image')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cat_nav')->dropDownList([ '0'=>'Active', '1'=>'Inactive', ], ['prompt' => 'Select']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
    $this->registerJs("CKEDITOR.replace('categories-cat_desc')");

?>

cate title
