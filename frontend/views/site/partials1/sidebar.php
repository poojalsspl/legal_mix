  <?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use common\widgets\Alert;
use yii\helpers\Url;
use app\controllers\SiteController; 
use frontend\models\JudgmentMast;
?>
                              <div class="col-md-3 border-green side-menu">
                    <div class="row side-menu-content">
                        <div class="box box-v2"> 



                            <div class="box-body">
                                <?php  $items = [
                                        [
                                            'label' => 'Indian Courts (######)', 
                                            'icon' => 'plus',
                                            'items' => [
                                                ['label' => 'Supreme Court ( ###### )',  'url' => ['#'],],
                                                ['label' => 'Calcutta High Court ( ###### )', 'url' => ['#'],],
                                                ['label' => 'Patna High Court ( ####### )', 'url' => ['#'],],
                                                ['label' => 'Karnataka High Court ( ##### )', 'icon' => '', 'url' => ['#'],],
                                            ],
                                        ],
                                        [
                                            'label' => 'Year', 
                                            'icon' => 'folder-o',
                                            'items' => [
                                                ['label' => '2015', 'icon' => 'folder', 'url' => ['#'],],
                                                ['label' => '2016', 'icon' => 'folder', 'url' => ['#'],],
                                                ['label' => '2017', 'icon' => 'folder', 'url' => ['#'],],
                                            ],
                                        ],
                                        ['label' => 'Item 2', 'icon' => 'plus', 'url' => ['/#']],
                                        ['label' => 'Item 3', 'icon' => 'plus', 'url' => ['/#']],
                                        ['label' => 'Item 4', 'icon' => 'plus', 'url' => ['/#']],

                                    ];          
                                ?>
                                <?=$this->render('/site/partials1/side_menu.php', ['items' => $items, 'title' => false])?>
                            </div>
                        </div>
                    </div>
                </div>