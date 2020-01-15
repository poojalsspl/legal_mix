<?php
use yii\helpers\Html;
use yii\helpers\Url;

use backend\models\BareactCatgMast;
use backend\models\BareactSubcatgMast;
?>
<div class="template">
	<div class ="body-content">
		<div class="col-md-12">
			<div class="row">
				<?php foreach($models as $modelSingle){
					$code = $modelSingle['act_catg_code']
					?>
					<ul>
						<?php echo $modelSingle['act_catg_desc']?>
						
						
						
					</ul>
					<?php
				}?>
			</div>
		</div>
	</div>
</div>
