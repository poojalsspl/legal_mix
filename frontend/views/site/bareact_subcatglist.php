<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\BareactSubcatgMast;
?>
                         <?php
                         echo $code;die;
						$model = new BareactSubcatgMast();
                        $catg_list = $model->getSubcatglist();
                         foreach($catg_list as $catgSingle){
                            echo $catgSingle['act_sub_catg_desc']?>
                        }
                        ?>
