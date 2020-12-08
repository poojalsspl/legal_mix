
<a href="dashboard" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a><br><br>
<?php
$act_code;
foreach ($barsubCode as $barsubDesc) { 
    $act_sub_code = $barsubDesc['act_sub_catg_code']; 
    $act_sub_desc = $barsubDesc['act_sub_catg_desc'];
	?>
	<ul>
	<li><a href="bareact-desc?act_sub=<?php echo $act_sub_code?>-<?php echo $act_code?>"><?php echo $act_sub_desc; ?></a> </li>
    </ul>
<?php }
?>