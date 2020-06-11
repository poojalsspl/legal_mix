
<div class="row">
	<div class="col-md-9">
		<label>Plan Name</label>
		<?php foreach ($model as $value) { echo "<br>";?>
		<?= $value['plan_name']; ?>
		<?= $value['plan_price']; ?>
		<?php } ?>
	</div>
</div>
