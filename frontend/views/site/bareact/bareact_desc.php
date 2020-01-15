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

