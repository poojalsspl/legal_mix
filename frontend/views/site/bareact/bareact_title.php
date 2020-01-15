<?php
use yii\widgets\LinkPager;
foreach ($barTitle as $barTitleAll) { 
    $doc_id = $barTitleAll['doc_id']; 
    $title = $barTitleAll['act_title'];
	?>
	<ul>
	<li><a href="complete-bareact?did=<?php echo $doc_id?>"><?php echo $title; ?> </a></li>
    </ul>
<?php }
echo LinkPager::widget([
    'pagination' => $pages,

]);
?>
