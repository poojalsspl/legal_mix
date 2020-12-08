<style type="text/css">
	h3{
		text-align: center;
		background-color: #edf6fd !important;
	}
	p{
		text-align: justify;
	}
	
</style>
<a href="/legal_mix/site/dashboard" class="btn btn-primary"><i class= "fa fa-arrow-left">  Back to Dashboard</i></a>
<?php
use yii\helpers\ArrayHelper;
use backend\models\BareactDetl;
$doc_id = $_GET['did'];

//<!-- section display start-->
$bareact = ArrayHelper::map(BareactDetl::find()->where(['doc_id'=>$doc_id])->all(),
    'doc_id','act_title');

foreach ($bareact as $value) { ?>
	<h3><?php echo $value; ?></h3>
<?php } ?>
<br><hr>
<!-- section display end-->
<div class="container">
	<div class="row">
		<p><input type="hidden" id="br-code" value="<?php echo $barBody['bareact_code'];?>"></p>
		<p><?php echo $barBody['body'];?></p>
		<?php 
        $level = $barBody['level'];
		if ($level!=0) {?>
		<div class="act_row" style="font-size: 16px;text-align: justify;"></div>
		<button id="completebar-body">Complete Act</button>
		<?php } ?>
	</div>
</div>


<?php $customScript = <<< SCRIPT

$('#completebar-body').on('click', function(){
	$('#completebar-body').hide();
    var bareact_code = $('#br-code').val();
    $.ajax({
    	url        : '/legal_mix/site/bareact-final?id='+bareact_code,
        dataType   : 'json',
        success    : function(data){
        	
           $('.act_row').append(data.body);

        }
    	});
    	
    }); 

SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);?>


