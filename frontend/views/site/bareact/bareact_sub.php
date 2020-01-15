<?php

foreach ($barsubCode as $barsubDesc) { 
    $act_sub_code = $barsubDesc['act_sub_catg_code']; 
    $act_sub_desc = $barsubDesc['act_sub_catg_desc'];
	?>
	<ul>
	<li><a href="bareact-desc?act_sub=<?php echo $act_sub_code?>"><?php echo $act_sub_desc; ?></a> </li>
    </ul>
<?php }
?>