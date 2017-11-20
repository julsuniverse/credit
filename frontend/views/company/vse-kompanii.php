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
<div class="container landing">
    <div class="lan_title">
        <h1>Все компании</h1>
        <img src="/frontend/web/img/lend_title.png" alt="<?= $page->h1;?>" />
    </div>
<?php Pjax::begin(['id'=>'pjax-landing','enablePushState' => false, 'scrollTo'=>300, 'timeout' => 5000]);?>
    <?php if($companies) { ?>
    <div class="row filters_l1">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="sort">
                <div class="sort_left">
                    <p><img src="/frontend/web/img/filters.png" alt=">" />Сортировать по:</p>
                </div>
                <noindex>
                <div class="sort_right">
                    <a href="#" rel="nofollow" <?php $ss='DESC'; if($sortby=='max_sum' && $sort=='DESC') {echo 'class="active"'; $ss='ASC';} else if($sortby=='max_sum' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['sortby'=>'max_sum', 'sort'=>$ss]);?>">Сумме кредита</a>
                    <a href="#" rel="nofollow" <?php $ts='DESC'; if($sortby=='max_termin' && $sort=='DESC') {echo 'class="active"'; $ts='ASC';} else if($sortby=='max_termin' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['sortby'=>'max_termin', 'sort'=>$ts]);?>">Сроку</a>
                    <a href="#" rel="nofollow" <?php $rs='DESC'; if($sortby=='raiting' && $sort=='DESC') {echo 'class="active"'; $rs='ASC';} else if($sortby=='raiting' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['sortby'=>'raiting', 'sort'=>$rs]);?>">Рейтингу</a>
                </div>
                </noindex>
                <div class="clearfix"></div>
            </div>        
        </div>
    </div>
    <?php }?>
<div class="company_list"> 
    <?php if($companies) {  foreach($companies as $comp){ ?>
    <div class="company">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="company_bg">
                    <div class="company_block">
                    <?php if($comp->checked) { ?>
                    <img class="proveren" src="/frontend/web/img/proveren.png" alt="Проверено" />
                    <?php } ?> 
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <a href="<?=Url::toRoute(['company/company', 'alias' =>$comp->alias]);?>"><p class="company_name"><?= $comp->name;?></p></a>
                                    <div class="company_stars">
                                        <?php for($i=0; $i<$comp->stars;$i++) { ?>
                                        <i class="fa fa-star star_full" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php for($i=0; $i<5 - $comp->stars;$i++) { ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php } ?>
                                    </div>
                                    <a href="<?=Url::toRoute(['company/company', 'alias' =>$comp->alias]);?>"><img class="company_logo" src="/frontend/web/img/<?= $comp->photo;?>" alt="<?=$comp->name;?>"/></a>
                                </div>
                                
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="info_line">
                                        <p class="il_left">Сумма до</p>
                                        <div class="il_right">
                                            <p><?= $comp->max_sum;?> р</p>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="info_line">
                                        <p class="il_left">Срок до</p>
                                        <div class="il_right">
                                            <p><?= $comp->termin;?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="info_line">
                                        <p class="il_left">Рассмотрение</p>
                                        <div class="il_right">
                                            <p><?= $comp->time_review;?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php /*<div class="info_line">
                                        <p class="il_left">Выплата на</p>
                                        <?php if(strpos($comp->pay, "2") !== false) {?>
                                            <img src="/frontend/web/img/pay_card.png" alt="Карта" />
                                        <?php } ?>
                                        <?php if(strpos($comp->pay, "1") !== false) {?>
                                            <img src="/frontend/web/img/pay_money.png" alt="Наличные" />
                                        <?php } ?>
                                        <?php if(strpos($comp->pay, "3") !== false) {?>
                                            <img src="/frontend/web/img/pay_home.png" alt="Дом" />
                                        <?php } ?>
                                        <?php if(strpos($comp->pay, "4") !== false) {?>
                                            <img src="/frontend/web/img/pay_wallet.png" alt="Яндекс.Деньги" />
                                        <?php } ?>
                                        <div class="clearfix"></div>
                                    </div>*/?>
                                    <?php if($comp->overpayments){?>
                                        <div class="info_line">
                                            <p class="il_left il_leftlast">Переплата за 10000</p>
                                            <div class="il_right">
                                                <p><?=$comp->overpayments;?><span> за 14 дней</span></p>
                                            </div>
                                            <div class="clearfix"></div>
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
<?php Pjax::end();?>
<?php
$urllink=Url::toRoute('main/link');
$script = <<< JS
    $(document).ready(function(){
        $(".getcredit").each( function ololo() {
              var d;
              var id=$(this).attr('data-id');
              var obj=$(this);
              $.get('$urllink', {id : id}, function(data){
                   obj.attr('href', data);
              });
        });
    });
JS;
$this->registerJs($script);
?> 
<div class="row">
    <div class="col-md-12"><?=$theme->alldesc;?></div>
</div>
</div>