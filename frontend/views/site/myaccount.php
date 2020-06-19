<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use backend\models\CourtMast;

$this->title = 'My Account';
?>
<h3>My Saved Judgments</h3>
<table class="table table-striped">
  <thead>
    <tr>
      
      <th>Judgment Title</th>
      <th>Court</th>
      <th>Date</th>
      <th>#</th>
      
    </tr>
  </thead>
  <tbody>
  <?php foreach ($models as $key => $model) { 
   $court_code = $model['court_code'];
   $court_name = CourtMast::find()->select('court_name')->where(['court_code'=>$court_code])->all();
   
   foreach($court_name as $cname){

    ?>
    <tr>
      
      <td><?= $model['judgment_title'] ?></td>
      <td><?= $cname['court_name'] ?></td>
      <td><?= $model['save_date'] ?></td>
      <td><a href="<?= $model['link'] ?>">view</a></td>

      
    </tr>

    <?php } } ?>
  </tbody>
</table>    
<!-- display pagination -->
    <?php 
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>

