<?php
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use kartik\popover\PopoverX;


/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header theme-color-main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <nav class="navbar navbar-static-top theme-color-main custom-navbar" role="navigation">
                <div class="navbar-custom-menu">
                    <?php
                        NavBar::begin([
                            'brandLabel' => Html::img('@web/images/logo4.png', ['class' => 'logo-area',  'style' => "width: 100%;text-align: left;"]),
                            'brandUrl' => Yii::$app->homeUrl,
                            'renderInnerContainer' => false,
                            'options' => [
                                'class' => 'navbar-fixed-top nav-bar navbar-inverse theme-color-main custom-navbar',
                            ],
                            'containerOptions' => [
                                'class' =>'nav-container'
                            ]
                        ]);
                       $menuItems = [
                            [
                                'label' => 'Home',
                                'url' => ['site/index'],
                                'linkOptions' => [],
                            ],
                           
                           
                            [
                                'label' => 'FAQ',
                                'url' => ['/faq/view'],
                                'linkOptions' => [],
                                
                            ],
                           [
                                'label' => 'Contact Us',
                                'url' => ['site/contact'],
                                'linkOptions' => [],
                            ],
                            
                          ];
                        if (Yii::$app->user->isGuest) {
                            $menuItems[] = ['label' => 'Login', 'url' => ['site/login']];
                            $menuItems[] = ['label' => 'Sign Up', 'url' => ['site/signup']];
                        } else {
                           $menuItems[] = ['label' => 'Logout', 'url' => ['site/logout'], 'data-method' => 'post'];
                           $menuItems[] = 
                            [
                                'label' => 'User',
                                'url' => '',
                                'linkOptions' => [],
                                'items' => [
                                    [
                                        'label' => 'Profile',
                                        'url' => ['site/dashboard']
                                    ],

                                    [
                                        'label' => 'Change Password',
                                        'url' => ['site/change-password']
                                    ],
                                    
                                    [
                                        'label' => 'Subscription',
                                        'url' => ['site/planform']
                                    ],
                                    [
                                        'label' => 'SubscriptionNew',
                                        'url' => ['site/planformnew']
                                    ],

                                    [
                                        'label' => 'Advance Search',
                                        'url' => ['site/search-advancednew']
                                    ],

                                    [
                                        'label' => 'History',
                                        'url' => ['site/history']
                                    ],
                                  
                                    '<li class="divider"></li>',                                      
                                ]
                              ];  
                        }
                        $menuItems[] = '<li>'
                                . Html::button('<span class="search-icon"><i class="fa fa-search"></i></span> Search', [
                                    'value' => yii\helpers\Url::to(['site/search-form']),
                                    'class' => 'btn-link showModalButton search-button',
                                    'title' => 'Search',
                                ])
                                . '</li>';
                        echo Nav::widget([
                            'options' => ['class' => 'navbar-nav navbar-right theme-color-main nav-alt custom-navbar pdl-50 toggle-menu'],
                            'items' => $menuItems,
                        ]);
                        NavBar::end();
                        ?>

                </div>
            </nav>
        </div>
    </div>
</header>
