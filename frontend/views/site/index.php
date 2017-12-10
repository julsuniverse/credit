<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use frontend\widgets\SubscribeWidget;

$this->title = $theme->seo_title_main;
$this->registerMetaTag([ 
    'name'=>'description', 
    'content'=>$theme->seo_desc_main
]); 
$this->registerMetaTag([ 
    'name'=>'keywords', 
    'content'=>$theme->seo_keys_main
]);
?>
<div class="container page_begin">
    <div class="row">
        <div class="col-md-9">
            <?php Pjax::begin(['id'=>'pjax-first','timeout' => 5000]/*['scrollTo'=>1200]*/);?>
            <div class="kf_block">
                <div class="kform">
                    <div class="cont">
                        <p class="kf_title"><?= Yii::t('app', 'Мне нужно:');?>
                            <span class="center">
                            <span id="count"><?php if($sum==100100) echo "100 000+"; else {echo substr($sum,0, -3).' '.substr($sum, -3);}?></span><span class="rub"> <?= Yii::t('app', 'руб');?></span>
                        </span>
                        </p>
                        <div id="slider"></div>
                        <table>
                            <tr>
                                <td class="left">
                                    500<br />
                                </td>
                                <td class="center">
                                </td>
                                <td class="right">
                                    100 000+<br />
                                </td>
                            </tr>
                        </table>
                        <div class="container">
                            <?php $form = ActiveForm::begin(['id' => 'credit-form', 'options'=>['data-pjax'=>true]]); ?>
                            <?= $form->field($model, 'sum')->hiddenInput(['value'=>$sum, 'autofocus' => true])->label('') ?>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <span class="labels"><?= Yii::t('app', 'На срок до:');?></span>
                                    <?= $form->field($model, 'termin')->dropDownList([
                                        ''=> Yii::t('app', 'Не важно'),
                                        7=> Yii::t('app', 'Несколько дней'),
                                        14=> Yii::t('app', '2 недели'),
                                        30=> Yii::t('app', 'Месяц'),
                                        90=> Yii::t('app', '2-3 месяца'),
                                        180=> Yii::t('app', 'Пол года'),
                                        365=> Yii::t('app', 'Год'),
                                        400=> Yii::t('app', 'Несколько лет')
                                    ])->label('') ?>
                                </div>
                            </div>
                            <div class="findk">
                                <?= Html::submitButton(Yii::t('app', 'Найти подходящие кредиты'), ['name' => 'credit-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php Pjax::begin(['id'=>'pjax-second','enablePushState' => false, /*'scrollTo'=>100*/'timeout' => 3000]);?>
            <div class="sort_comp_main" id="companies">
                <div class="landing">
                    <?php if($companies){?>
                        <div class="row filters_l1">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="sort">
                                    <div class="sort_center">
                                        <div class="sort_left">
                                            <p><?= Yii::t('app', 'Сортировать по:');?></p>
                                        </div>
                                        <noindex>
                                            <div class="sort_right">
                                                <a rel="nofollow" href="#" <?php $ss='DESC'; if($sortby=='max_sum' && $sort=='DESC') {echo 'class="active"'; $ss='ASC';} else if($sortby=='max_sum' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['sum' =>$sum, 'termin' => $termin, 'sortby'=>'max_sum', 'sort'=>$ss]);?>"><?= Yii::t('app', 'Сумме кредита');?></a>
                                                <a rel="nofollow" href="#" <?php $ts='DESC'; if($sortby=='max_termin' && $sort=='DESC') {echo 'class="active"'; $ts='ASC';} else if($sortby=='max_termin' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['sum' =>$sum, 'termin' => $termin, 'sortby'=>'max_termin', 'sort'=>$ts]);?>"><?= Yii::t('app', 'Сроку');?></a>
                                                <a rel="nofollow" href="#" <?php $rs='DESC'; if($sortby=='raiting' && $sort=='DESC') {echo 'class="active"'; $rs='ASC';} else if($sortby=='raiting' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['sum' =>$sum, 'termin' => $termin, 'sortby'=>'raiting', 'sort'=>$rs]);?>"><?= Yii::t('app', 'Рейтингу');?></a>
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
            <?php
            $script = <<< JS
            var myData = [500, 1000, 1500, 2000, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 6500, 7000, 7500, 8000, 8500, 9000, 9500, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000, 23000, 24000, 25000, 26000, 27000, 28000, 29000, 30000, 35000, 40000, 45000, 50000, 60000, 70000, 80000, 90000, 100000, 100100];
            slider_config = {
                    range: "min",
                    min: 0,
                    max: myData.length - 1,
                    step: 1,
                    animate: true,
                    slide: function( event, ui ) {
                        var c=myData[ ui.value ];
                        if(c==100100)
                            $('#count').text( '100 000+' );
                        else
                        {
                            c=c+'';
                            $('#count').text( c.substr(0, c.length - 3)+' '+c.substr(c.length-3) );
                        } 
                        $('#creditform-sum').val( myData[ ui.value ] );
                    },
                    create: function() {
                        var zn=500;
                        for(var i=0; i<myData.length; i=i+1)
                        {
                            if(myData[i]==$sum)
                                zn=i;
                        }
                        $(this).slider('value',zn);
                    }
                };
            
            $(".container #slider").slider(slider_config);
JS;
                    $this->registerJs($script);
            ?>

            <?php Pjax::end();?>
        </div>
        <div class="col-md-3">
            <?= SubscribeWidget::widget();?>
        </div>
    </div>
</div>
<?= \frontend\widgets\BottomMenuWidget::widget(['theme' => $theme]) ;?>