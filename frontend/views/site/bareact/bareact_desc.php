<?php 
$str = explode("-",$_GET['act_sub']);
$str1 = $str[0];
$str[1];
?>

<a href="/legal_mix/site/bareact-subcatg?act_code=<?php echo $str[1]?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp; Back</a><br><br>
<?php


use yii\widgets\LinkPager;
foreach ($bardesc as $barDescAll) { 
    $bareact_code = $barDescAll['bareact_code']; 
    $bareact_desc = $barDescAll['bareact_desc'];
	?>
	<ul>
	<li><a href="bareact-title?bar_code=<?php echo $bareact_code?>"><?php echo $bareact_desc; ?></a> </li>
    </ul>
<?php }
echo LinkPager::widget([
    'pagination' => $pages,

]);
?>

