<?php

use yii\helpers\Url;

foreach($footermenu as $f)
{
    if($f->column == 1)
        $col1[] = $f;
    if($f->column == 2)
        $col2[] = $f;
    if($f->column == 3)
        $col3[] = $f;
    if($f->column == 4)
        $col4[] = $f;
}
?>
<div class="container">
    <div class="row">
        <div class=" col-sm-6 col-md-2">
            <p class="title foottitle" data-acp="1"><i class="fa fa-plus znak znak1" aria-hidden="true"></i> <?=$theme->foot_col1;?></p>
            <div class="acdiv1">
                <?php foreach($col1 as $c) { ?>
                    <a href="/<?= $c->alias;?>.html"><?= $c->name;?></a><br />
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-6 col-md-2 bigcol">
            <p class="title foottitle" data-acp="2"><i class="fa fa-plus znak znak2" aria-hidden="true"></i> <?=$theme->foot_col2;?></p>
            <div class="acdiv2">
                <?php foreach($col2 as $c) { ?>
                    <a href="/<?= $c->alias;?>.html"><?= $c->name;?></a><br />
                <?php } ?>
            </div>
        </div>
        <div class="cb"></div>
        <div class="col-sm-6 col-md-2 bigcol">
            <p class="title foottitle" data-acp="3"><i class="fa fa-plus znak znak3" aria-hidden="true"></i> <?=$theme->foot_col3;?></p>
            <div class="acdiv3">
                <?php foreach($col3 as $c) { ?>
                    <a href="/<?= $c->alias;?>.html"><?= $c->name;?></a><br />
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-3 col-md-2">
            <p class="title foottitle" data-acp="4"><i class="fa fa-plus znak znak4" aria-hidden="true"></i> <?=$theme->foot_col4;?></p>
            <div class="acdiv4">
                <?php foreach($col4 as $c) { ?>
                    <a href="/<?= $c->alias;?>.html"><?= $c->name;?></a><br />
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-3 col-md-4 litcol">
            <div class="last">
                <a class="soca" target="__blank" href="<?=$theme->vk_link;?>"><i class="fa fa-vk" aria-hidden="true"></i></a><a class="soca" target="__blank" href="<?=$theme->fb_link;?>"> <i class="fa fa-facebook" aria-hidden="true"></i> </a><br />
                <a target="__blank" href="<?=$theme->site_link;?>"><img src="/frontend/web/img/foot_logo.png" alt="<?= Yii::t('app', 'Бистро Деньги');?>"/></a>
            </div>
            <div class="about_portal"><a href="<?= Url::toRoute(["page/landing", 'alias'=>'about']);?>"><?= Yii::t('app', 'О кредитном портале');?></a></div>
        </div>
    </div>
</div>