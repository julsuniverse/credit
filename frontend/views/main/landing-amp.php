<?php
use yii\helpers\Html;
use yii\helpers\Url;

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
<div class="container landing">
    <div class="lan_title">
        <h1><?= $page->h1;?></h1>
        <amp-img width="300" height="40" src="/frontend/web/img/lend_title.png" alt="<?= $page->h1;?>"></amp-img>
    </div>
<?php if($page->offer_id) {?>
<div class="company_list"> 
    <?php if($comp_info) { 
        foreach($comp_info as $comp){ ?>
    <div class="company">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="company_bg">
                    <div class="company_block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <a href="<?=Url::toRoute(['main/company-amp', 'alias' =>$comp->alias]);?>"><p class="company_name"><?= $comp->name;?></p></a>
                                    <div class="company_stars">
                                        <?php echo '<b>рейтинг: </b>'.$comp->stars.' / 5'; ?>
                                    </div>
                                    <a href="<?=Url::toRoute(['main/company-amp', 'alias' =>$comp->alias]);?>"><amp-img width="200" height="80" class="company_logo" src="/frontend/web/img/<?= $comp->img;?>" alt="<?=$comp->name;?>"></amp-img></a>
                                </div>
                                
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="info_line">
                                        <p class="il_left">Сумма до</p>
                                        <div class="il_right">
                                            <p><?= $comp->max_sum;?> р.</p>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                    <div class="info_line">
                                        <p class="il_left">Срок до</p>
                                        <div class="il_right">
                                            <p><?= $comp->termin;?></p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="info_line">
                                        <p class="il_left">Рассмотрение</p>
                                        <div class="il_right">
                                            <p><?= $comp->watch;?></p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <?php if($comp->overpayments){?>
                                        <div class="info_line">
                                            <p class="il_left il_leftlast">Переплата за 10000</p>
                                            <div class="il_right">
                                                <p><?=$comp->overpayments;?><span> за 14 дней</span></p>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    <?php }?>
                                </div>
                                
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <a href="<?= $comp->href;?>" data-id="<?=$comp->id;?>" class="getcredit<?php if(!$comp->href) { echo " disabled";} ?>">
                                        <div class="button_bg">
                                            <div class="button">
                                                Оформить займ
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
    </div>
    <?php } } else {?>
    <div class="company">
        <div class="row">
            <h4 class="nocompanies">По таким условиям кредитных предложений нет, измените условия поиска.</h4>
        </div>
    </div> 
    <?php }?>
</div>
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

<?php if($page->marked) { ?>
<div class="landing_article">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <p class="marked"><?= $page->marked;?></p>
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
                        <div class="col-md-2">
                        <amp-img width="115" height="142" src="/frontend/web/img/expert.png"  alt="<?= $page->expert_title;?>"></amp-img>    
                        </div>
                        <div class="col-md-10">
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