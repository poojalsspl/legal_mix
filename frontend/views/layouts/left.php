<aside class="main-sidebar theme-color-main">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?= yii\helpers\Html::img('@web/images/profile.png', ['class' => 'img-circle', 'alt' => 'User Image'])?>
            </div>
            <div class="pull-left info">
                <p>Firstname Lastname</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Courts Judgement CP', 'options' => ['class' => 'header cp-header']],
                    ['label' => 'Home', 'icon' => 'file-code-o', 'url' => ['site/index']],
                    ['label' => 'Menu Item 2', 'icon' => 'dashboard', 'url' => ['#']],
                    ['label' => 'Menu Item 3', 'url' => ['#']],
                    [
                        'label' => 'Sub Menu 1',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Sub Item 1', 'icon' => 'file-code-o', 'url' => ['#'],],
                            ['label' => 'Sub Item 2', 'icon' => 'dashboard', 'url' => ['#'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
