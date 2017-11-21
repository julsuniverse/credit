<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Управление', 'options' => ['class' => 'header']],
                    ['label' => 'Компании', 'icon' => 'fa fa-list-alt', 'url' => ['/company'], 'active' => $this->context->id == 'company'],
                    ['label' => 'Верхнее меню', 'icon' => 'fa fa-list-alt', 'url' => ['/topmenu'], 'active' => $this->context->id == 'topmenu'],
                    ['label' => 'Нижнее меню', 'icon' => 'fa fa-list-alt', 'url' => ['/bottommenu'], 'active' => $this->context->id == 'order'],
                    ['label' => 'Меню в подвале', 'icon' => 'fa fa-list-alt', 'url' => ['/footermenu'], 'active' => $this->context->id == 'order'],
                    ['label' => 'Страницы', 'icon' => 'fa fa-list-alt', 'url' => ['/page'], 'active' => $this->context->id == 'page'],
                    ['label' => 'Офферы', 'icon' => 'fa fa-list-alt', 'url' => ['/offer'], 'active' => $this->context->id == 'offer'],
                    ['label' => 'Отзывы', 'icon' => 'fa fa-list-alt', 'url' => ['/review'], 'active' => $this->context->id == 'review'],
                    ['label' => 'Настройки + СЕО', 'icon' => 'fa fa-list-alt', 'url' => ['/theme/view?id=1'], 'active' => $this->context->id == 'order'],
                ],
            ]
        ) ?>

    </section>

</aside>
