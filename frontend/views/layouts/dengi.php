<?php

use frontend\widgets\TopMenuWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php //$theme=(new Theme())->dataLayout(); ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <?php if(Yii::$app->controller->action->id == 'company'){?>
    <link rel="amphtml" href="<?=Yii::$app->urlManager->createAbsoluteUrl(['main/company-amp', 'alias'=>$_GET['alias']]);?>">
    <?php }?>
        <?php if(Yii::$app->controller->action->id == 'landing'){?>
    <link rel="amphtml" href="<?=Yii::$app->urlManager->createAbsoluteUrl(['main/landing-amp', 'alias'=>$_GET['alias']]);?>">
    <?php }?>
    
    <?php//= $theme->metrics;?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= TopMenuWidget::widget() ;?>

<?= $content ?>
        
<?php //if ($this->beginCache("foot", ['duration' => 360])) { ?>      
<footer class="footer">
<?php
$footermenu = Footermenu::find()->all();
foreach($footermenu as $f)
{
    if($f->position == 1)
        $col1[] = $f;  
    if($f->position == 2)
        $col2[] = $f; 
    if($f->position == 3)
        $col3[] = $f; 
    if($f->position == 4)
        $col4[] = $f;     
}
?>
    <div class="container">
        <div class="row">
            <div class=" col-sm-6 col-md-2">
                <p class="title foottitle" data-acp="1"><i class="fa fa-plus znak znak1" aria-hidden="true"></i> <?=$theme->foot_col1;?></p>
                <div class="acdiv1">
                    <?php foreach($col1 as $c) { ?>
                    <a href="<?= Url::toRoute(["main/landing", 'alias'=>$c->alias]);?>"><?= $c->name;?></a><br />
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-6 col-md-2 bigcol">
                <p class="title foottitle" data-acp="2"><i class="fa fa-plus znak znak2" aria-hidden="true"></i> <?php//=$theme->foot_col2;?></p>
                <div class="acdiv2">
                    <?php foreach($col2 as $c) { ?>
                    <a href="<?= Url::toRoute(["main/landing", 'alias'=>$c->alias]);?>"><?= $c->name;?></a><br />
                    <?php } ?>
                </div>
            </div>
            <div class="cb"></div>
            <div class="col-sm-6 col-md-2 bigcol">
                <p class="title foottitle" data-acp="3"><i class="fa fa-plus znak znak3" aria-hidden="true"></i> <?php//=$theme->foot_col3;?></p>
                <div class="acdiv3">
                    <?php foreach($col3 as $c) { ?>
                    <a href="<?= Url::toRoute(["main/landing", 'alias'=>$c->alias]);?>"><?= $c->name;?></a><br />
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-3 col-md-2">
                <p class="title foottitle" data-acp="4"><i class="fa fa-plus znak znak4" aria-hidden="true"></i> <?php//=$theme->foot_col4;?></p>
                <div class="acdiv4">
                    <?php foreach($col4 as $c) { ?>
                    <a href="<?= Url::toRoute(["main/landing", 'alias'=>$c->alias]);?>"><?= $c->name;?></a><br />
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-3 col-md-4 litcol">
                <div class="last">
                    <!--<a class="soca" target="__blank" href="<?=$theme->vk_link;?>"><i class="fa fa-vk" aria-hidden="true"></i></a><a class="soca" target="__blank" href="<?=$theme->fb_link;?>"> <i class="fa fa-facebook" aria-hidden="true"></i> </a><br />
                    <a target="__blank" href="<?=$theme->site_link;?>"><img src="/frontend/web/img/foot_logo.png" alt="Бистро Деньги"/></a>
                    -->
                </div>
                <div class="about_portal"><a href="<?= Url::toRoute(["main/landing", 'alias'=>'about']);?>">О кредитном портале</a></div>
            </div>
        </div>
    </div>
</footer>
<?php 
 //$this->endCache();
//}
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
