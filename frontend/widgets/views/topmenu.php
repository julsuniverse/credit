<?php
    use yii\helpers\Url;
?>

<?php
if ($this->beginCache("topmenu", ['duration' => 360])) { ?>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed mob_menu" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo_big" href="<?=Url::toRoute(['site/index']);?>"><img src="/frontend/web/img/logo.png"/></a>
                <a class="navbar-brand logo_small" href="<?=Url::toRoute(['site/index']);?>"><img src="/frontend/web/img/logo.png"/></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav ultop">
                    <?php foreach($menu as $m) {?>
                        <li><a href="/<?= $m->alias;?>.html"><?= $m->name;?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php  $this->endCache();
}
?>
