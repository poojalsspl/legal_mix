<?php
/*$str = explode("-",$_GET['bar_code']);
$str[0];
$str[1];*/
?>

<!-- <a href="/legal_mix/site/bareact-desc?bar_code=<?php //echo $str[1]?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp; Back</a><br><br> -->

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
