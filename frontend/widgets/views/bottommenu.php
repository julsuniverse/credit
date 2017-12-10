<?php 
use yii\helpers\Url;
?>
<div class="podborki">
    <div class="container">
        <div class="pod_title">
            <p><?= Yii::t('app', 'Смотрите также подборки кредитных предложений');?></p>
        </div>
        <div class="row">
            <?php

            foreach($bottommenu as $b)
            {
                if($b->column == 1)
                    $col1[] = $b;
                if($b->column == 2)
                    $col2[] = $b;
                if($b->column == 3)
                    $col3[] = $b;
                if($b->column == 4)
                    $col4[] = $b;
            }

            ?>
            <div class=" col-sm-6 col-md-3 col-lg-4 minusmarg">
                <p class="title foottitle" data-acp="1"><i class="fa fa-plus znak znak1" aria-hidden="true"></i><?=$theme->bott_col1;?></p>
                <div class="acdiv1">
                <?php  foreach($col1 as $c){ ?>
                    <a href="/<?= $c->alias;?>.html"><?= $c->name;?></a><br />
                <?php } ?>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-2">
                <p class="title foottitle" data-acp="2"><i class="fa fa-plus znak znak2" aria-hidden="true"></i> <?=$theme->bott_col2;?></p>
                <div class="acdiv2">
                <?php  foreach($col2 as $c){ ?>
                    <a href="/<?= $c->alias;?>.html"><?= $c->name;?></a><br />
                <?php } ?>
                </div>
            </div>
            <div class="cb"></div>
            <div class="col-sm-6 col-md-3 col-lg-2">
                <p class="title foottitle" data-acp="3"><i class="fa fa-plus znak znak3" aria-hidden="true"></i> <?=$theme->bott_col3;?></p>
                <div class="acdiv3">
                <?php  foreach($col3 as $c){ ?>
                    <a href="/<?= $c->alias;?>.html"><?= $c->name;?></a><br />
                <?php } ?>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-4">
                <div class="last">
                    <p class="title foottitle" data-acp="4"><i class="fa fa-plus znak znak4" aria-hidden="true"></i> <?=$theme->bott_col4;?></p>
                    <div class="acdiv4">
                    <?php  foreach($col4 as $c){ ?>
                        <a href="/<?= $c->alias;?>.html"><?= $c->name;?></a><br />
                    <?php } ?>
                    </div>
                </div>
            </div>
            <?php  ?>
        </div>
    </div>
</div>