<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = $page->seo_title;
$this->registerMetaTag([ 
    'name'=>'description', 
    'content'=>$page->seo_desc
]); 
$this->registerMetaTag([ 
    'name'=>'keywords', 
    'content'=>$page->seo_keys
]);
?>
<div class="container landing page_begin">
    <div class="row">
        <div class="col-md-9">
            <div class="lan_title">
                <h1><?= $page->h1;?></h1>
            </div>
            <?php if($page->offer_id) {?>
                <?php Pjax::begin(['id'=>'pjax-landing','enablePushState' => false, 'scrollTo'=>300, 'timeout' => 5000]);?>
                <?php if($comp_info) {?>
                    <div class="row filters_l1">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="sort">
                                <div class="sort_center">
                                    <div class="sort_left">
                                        <p><?= Yii::t('app', 'Сортировать по:');?></p>
                                    </div>
                                    <noindex>
                                        <div class="sort_right">
                                            <a rel="nofollow" href="#" <?php $ss='DESC'; if($sortby=='max_sum' && $sort=='DESC') {echo 'class="active"'; $ss='ASC';} else if($sortby=='max_sum' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['sortby'=>'max_sum', 'sort'=>$ss]);?>"><?= Yii::t('app', 'Сумме кредита');?></a>
                                            <a rel="nofollow" href="#" <?php $ts='DESC'; if($sortby=='max_termin' && $sort=='DESC') {echo 'class="active"'; $ts='ASC';} else if($sortby=='max_termin' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['sortby'=>'max_termin', 'sort'=>$ts]);?>"><?= Yii::t('app', 'Сроку');?></a>
                                            <a rel="nofollow" href="#" <?php $rs='DESC'; if($sortby=='raiting' && $sort=='DESC') {echo 'class="active"'; $rs='ASC';} else if($sortby=='raiting' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['sortby'=>'raiting', 'sort'=>$rs]);?>"><?= Yii::t('app', 'Рейтингу');?></a>
                                        </div>
                                    </noindex>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="company_list">
                    <?php if($comp_info) { foreach($comp_info as $comp){ ?>
                        <div class="company">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 companies">
                                    <div class="company_bg" <?php if($comp->checked==1) { ?> style="background-color: #f4fcfe;" <?php } ?>>
                                        <?php if($comp->checked==1) { ?><span class="checked_strip"><?= Yii::t('app', 'Проверено');?></span> <?php } ?>
                                        <div class="company_block">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-12 col-xs-12 one_company">
                                                    <a data-pjax="0" href="<?=Url::toRoute(['company/company', 'alias'=>$comp->alias]);?>"><img class="company_logo" src="/frontend/web/img/<?=$comp->photo;?>" alt="<?=$comp->name;?>"/></a>
                                                    <div class="company_stars">
                                                        <?php
                                                        $full=$comp->stars;
                                                        $pol=5-$full;
                                                        for($i=0;$i<$full;$i++){?>
                                                            <i class="fa fa-star star_full" aria-hidden="true"></i>
                                                        <?php }
                                                        for($i=0;$i<$pol;$i++){?>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        <?php }?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-md-3 info_table">
                                                            <p class="info_title"><?= Yii::t('app', 'Сумма до');?></p>
                                                            <p class="info_text"><?=$comp->max_sum;?> <?= Yii::t('app', 'руб');?>.</p>
                                                        </div>
                                                        <div class="col-md-3 info_table">
                                                            <p class="info_title"><?= Yii::t('app', 'Срок до');?></p>
                                                            <p class="info_text"><?=$comp->termin;?></p>
                                                        </div>
                                                        <div class="col-md-3 info_table">
                                                            <p class="info_title"><?= Yii::t('app', 'Рассмотрение');?></p>
                                                            <p class="info_text"><?=$comp->time_review;?></p>
                                                        </div>
                                                        <?php if($comp->overpayments){?>
                                                            <div class="col-md-3 info_table">
                                                                <p class="info_title"><?= Yii::t('app', 'Переплата');?></p>
                                                                <p class="info_text"><?=$comp->overpayments;?><span> <?= Yii::t('app', 'за 14 дней');?></span></p>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <a href="<?= $comp->href;?>" target="_blank" class="getcredit<?php if(!$comp->href) { echo " disabled";} ?>">
                                                        <div class="button_bg">
                                                            <div class="button">
                                                                <?= Yii::t('app', 'Оформить займ');?>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } } else {?>
                        <div class="company">
                            <div class="row">
                                <h4 class="nocompanies"><?= Yii::t('app', 'По таким условиям кредитных предложений нет, измените условия поиска.');?></h4>
                            </div>
                        </div>
                    <?php }?>
                </div>
                <?php Pjax::end();?>
            <?php } ?>

            <?php if($page->text_1) { ?>
                <div class="landing_article">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div><?= $page->text_1;?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if($page->expert_text) { ?>
                <div class="opinion">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="opin_inner">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img class="" src="/frontend/web/img/expert.png"  alt="<?= $page->expert_title;?>" />
                                    </div>
                                    <div class="col-md-9">
                                        <div class="expert_title"><?= $page->expert_title;?></div>
                                        <p><?= $page->expert_text;?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if($page->text_2) {?>
                <div class="landing_article">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div><?= $page->text_2;?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if($page->helpfull){ ?>
                <div class="usefull_art">
                    <div class="ua_title">
                        <div><?= Yii::t('app', 'Полезные статьи');?></div>
                        <img src="/frontend/web/img/lend_title.png"/>
                    </div>
                    <div class="row">
                        <?php $i=1;
                        foreach($articles as $a) {
                            $img = "img"."$i";
                            ?>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="ua_block">
                                    <img src="/frontend/web/img/<?= $a->photo ;?>" alt="<?= $a->h1 ;?>"/>
                                    <div class="ua_block_title"><a href="<?=Url::toRoute(['main/landing', 'alias' =>$a->alias]);?>"><?= $a->h1 ;?></a></div>
                                    <div class="dashed_line"></div>
                                    <?php
                                    mb_internal_encoding("UTF-8");
                                    $text = mb_substr($a->short_desc, 0, 100);
                                    ?>
                                    <p><?= $text;?>...</p>
                                </div>
                            </div>

                            <?php $i++; } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        <div class="col-md-3">
            <?= \frontend\widgets\SubscribeWidget::widget() ;?>
        </div>
    </div>
</div>

<div id="totop">
    <img src="/frontend/web/img/totop.png"/>
</div>