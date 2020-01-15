<div id="wrapper">
    <div id="sidebar-wrapper">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'side-menu', 'data-widget'=> 'tree'],
                'defaultIconHtml' => '',
                'submenuTemplate' => "\n<ul class='treeview-menu tree-view-menu-custom' {show}>\n{items}\n</ul>\n",
                'items' => $items
            ]
        ) ?>          
    </div>
</div>
