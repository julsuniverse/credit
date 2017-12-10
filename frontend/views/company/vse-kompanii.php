<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\Theme;
$this->title = $theme->seo_title_vse;
$this->registerMetaTag([ 
    'name'=>'description', 
    'content'=>$theme->seo_desc_vse
]); 
$this->registerMetaTag([ 
    'name'=>'keywords', 
    'content'=>$theme->seo_keys_vse
]);
?>
<div class="container landing page_begin">
    <div class="row">
        <div class="col-md-9">
            <div class="lan_title">
                <h1><?= Yii::t('app', 'Все компании')?></h1>
            </div>

            <?php Pjax::begin(['id'=>'pjax-second', 'enablePushState' => false, /*'scrollTo'=>100*/'timeout' => 3000]);?>
            <div class="sort_comp_main">
                <div class="landing">
                    <?php if($companies){?>
                        <div class="row filters_l1">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="sort">
                                    <div class="sort_center">
                                        <div class="sort_left">
                                            <p><?= Yii::t('app', 'Сортировать по:')?></p>
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
                    <div class="company_list" id="company_list">
                        <?php if($companies) { foreach($companies as $comp){?>
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

                </div>
            </div>
            <?php Pjax::end();?>

            <div class="row">
                <div class="col-md-12"><?=$theme->alldesc;?></div>
            </div>
        </div>
        <div class="col-md-3">
            <?= \frontend\widgets\SubscribeWidget::widget() ;?>
        </div>
    </div>

</div>