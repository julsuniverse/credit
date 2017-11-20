<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\Theme;

$seo=(new Theme())->dataIndexSeo();
$this->title = $seo->seo_title_main;
$this->registerMetaTag([ 
    'name'=>'description', 
    'content'=>$seo->seo_desc_main
]); 
$this->registerMetaTag([ 
    'name'=>'keywords', 
    'content'=>$seo->seo_keys_main
]);
?>

<?php Pjax::begin(['id'=>'pjax-first','timeout' => 5000]/*['scrollTo'=>1200]*/);?>
<div class="kf_block">
    <div class="dectop">
        <img src="/frontend/web/img/dectop.png"/>
    </div>
    <div class="monets">
        <img src="/frontend/web/img/monets.png"/>
    </div>
    <div class="fon">
        <img src="/frontend/web/img/fon.png"/>
    </div>
    <div class="kform">
        <div class="cont">
            <h3>Мне нужно</h3>
            <table>
                <tr>
                    <td class="left">
                        500<br />
                        <span>|</span>
                    </td>
                    <td class="center">
                        <span id="count"><?php if($sum==100100) echo "100 000+"; else {echo substr($sum,0, -3).' '.substr($sum, -3);}?></span><span class="rub"> руб</span>
                    </td>
                    <td class="right"> 
                        100 000+<br />
                        <span>|</span>
                    </td>
                </tr>
            </table>
            <div id="slider"></div>
            <div class="container">
            <?php $form = ActiveForm::begin(['id' => 'credit-form', 'options'=>['data-pjax'=>true]]); ?>
            <?= $form->field($model, 'sum')->hiddenInput(['value'=>$sum, 'autofocus' => true])->label('') ?>   
                <div class="row">
                    <div class="col-sm-6 col-xs-6">
                        <span class="labels">На срок до</span>
                        <?= $form->field($model, 'termin')->dropDownList([''=>'Не важно',7=>'Несколько дней',14=>'2 недели',30=>'Месяц',90=>'2-3 месяца',180=>'Пол года',365=>'Год',400=>'Несколько лет'])->label('') ?>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <span class="labels">Хочу получить деньги</span>
                        <?= $form->field($model, 'where')->dropDownList([''=>'Не важно',1=>'Наличными',2=>'На карту',3=>'На дом',4=>'Яндекс.Деньги'])->label('') ?>
                    </div>
                </div>
                <div class="findk">
                    <?= Html::submitButton('Найти подходящие кредиты', ['class' => '', 'name' => 'credit-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            </div>
                
        </div>
    </div>
</div>

<?php Pjax::begin(['id'=>'pjax-second','enablePushState' => false, /*'scrollTo'=>100*/'timeout' => 3000]);?>
<img id="companies" class="venzel" src="/frontend/web/img/venzel_top.png" alt="^"/>
<div class="sort_comp_main">
    <div class="container landing">
        <?php if($companies){?>
        <div class="row filters_l1">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="sort">
                    <div class="sort_left">
                        <p><img src="/frontend/web/img/filters.png" alt=">" />Сортировать по:</p>
                    </div>
                    <noindex>
                    <div class="sort_right">
                        <a rel="nofollow" href="#" <?php $ss='DESC'; if($sortby=='max_sum' && $sort=='DESC') {echo 'class="active"'; $ss='ASC';} else if($sortby=='max_sum' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['ids'=>$ids, 'sortby'=>'max_sum', 'sort'=>$ss]);?>">Сумме кредита</a>
                        <a rel="nofollow" href="#" <?php $ts='DESC'; if($sortby=='max_termin' && $sort=='DESC') {echo 'class="active"'; $ts='ASC';} else if($sortby=='max_termin' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['ids'=>$ids, 'sortby'=>'max_termin', 'sort'=>$ts]);?>">Сроку</a>
                        <a rel="nofollow" href="#" <?php $rs='DESC'; if($sortby=='raiting' && $sort=='DESC') {echo 'class="active"'; $rs='ASC';} else if($sortby=='raiting' && $sort=='ASC') echo 'class="active_rev"'; ?> data-h="<?=Url::current(['ids'=>$ids, 'sortby'=>'raiting', 'sort'=>$rs]);?>">Рейтингу</a>
                    </div>
                    </noindex> 
                    <div class="clearfix"></div>
                </div>        
            </div>
        </div>
        <?php }?>
    <div class="company_list" id="company_list">    
    <?php if($companies) { foreach($companies as $comp){?>
        <div class="company">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="company_bg">
                        <div class="company_block">
                        <?php if($comp->checked==1){?>
                        <img class="proveren" src="/frontend/web/img/proveren.png" alt="Проверено" />
                        <?php }?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <a data-pjax="0" href="<?=Url::toRoute(['main/company', 'alias'=>$comp->alias]);?>"><p class="company_name"><?=$comp->name;?></p></a>
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
                                        <a data-pjax="0" href="<?=Url::toRoute(['main/company', 'alias'=>$comp->alias]);?>"><img class="company_logo" src="/frontend/web/img/<?=$comp->img;?>" alt="<?=$comp->name;?>"/></a>
                                    </div>
                                    
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <div class="info_line">
                                            <p class="il_left">Сумма до</p>
                                            <div class="il_right">
                                                <p><?=$comp->max_sum;?> р</p>
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="info_line">
                                            <p class="il_left">Срок до</p>
                                            <div class="il_right">
                                                <p><?=$comp->termin;?></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="info_line">
                                            <p class="il_left">Рассмотрение</p>
                                            <div class="il_right">
                                                <p><?=$comp->watch;?></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <?php /*<div class="info_line">
                                            <p class="il_left">Выплата на</p>
                                            <?php if(strpos($comp->pay, '2')!==false){?>
                                            <img src="/frontend/web/img/pay_card.png" alt="Карта" />
                                            <?php }?>
                                            <?php if(strpos($comp->pay, '1')!==false){?>
                                            <img src="/frontend/web/img/pay_money.png" alt="Деньги" />
                                            <?php }?>
                                            <?php if(strpos($comp->pay, '3')!==false){?>
                                            <img src="/frontend/web/img/pay_home.png" alt="Дом" />
                                            <?php }?>
                                            <?php if(strpos($comp->pay, '4')!==false){?>
                                            <img src="/frontend/web/img/pay_wallet.png" alt="Кошелек" />
                                            <?php }?>
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
                                        <a href="#" data-id="<?=$comp->id;?>" target="_blank" class="getcredit<?php if(!$comp->href) { echo " disabled";} ?>">
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
        
    </div>
</div>
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
<?php // $this->registerJsFile('/js/cj.js',['depends' => 'yii\web\JqueryAsset']/*['position' =>  \yii\web\View::POS_END]*/); ?>
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
    
    $("#slider").slider(slider_config);
JS;
$this->registerJs($script);
?>
<?php Pjax::end();?>
<img class="venzel" src="/frontend/web/img/venzel_bottom.png"/>

<?php if ($this->beginCache("bott", ['duration' => 360])) { 
$theme=(new Theme())->dataIndex();    
?>
<div class="podborki">
    <div class="container">
        <div class="pod_title">
                <p>Смотрите также подборки кредитных предложений</p>
                <img src="/frontend/web/img/lend_title.png" alt="Кредиты без отказов">
        </div>
        <div class="row">
        <?php 
        
        foreach($bottommenu as $b)
        {
            if($b->position == 1)
                $col1[] = $b;  
            if($b->position == 2)
                $col2[] = $b; 
            if($b->position == 3)
                $col3[] = $b; 
            if($b->position == 4)
                $col4[] = $b; 
        }
        
        ?>
            <div class=" col-sm-6 col-md-3 col-lg-4 minusmarg">
                <p class="title"><img src="/frontend/web/img/mfl.png"/> <?=$theme->bott_col1;?></p>
                <?php  foreach($col1 as $c){ ?>
                <a href="<?= Url::toRoute(["main/landing", 'alias'=>$c->alias]);?>"><?= $c->name;?></a><br />
                <?php } ?>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-2">
                <p class="title"><img src="/frontend/web/img/mfl.png"/> <?=$theme->bott_col2;?></p>
                <?php  foreach($col2 as $c){ ?>
                <a href="<?= Url::toRoute(["main/landing", 'alias'=>$c->alias]);?>"><?= $c->name;?></a><br />
                <?php } ?>
            </div>
            <div class="cb"></div>
            <div class="col-sm-6 col-md-3 col-lg-2">
                <p class="title"><img src="/frontend/web/img/mfl.png"/> <?=$theme->bott_col3;?></p>
                <?php  foreach($col3 as $c){ ?>
                <a href="<?= Url::toRoute(["main/landing", 'alias'=>$c->alias]);?>"><?= $c->name;?></a><br />
                <?php } ?>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-4">
                <div class="last">
                    <p class="title"><img src="/frontend/web/img/mfl.png"/> <?=$theme->bott_col4;?></p>
                    <?php  foreach($col4 as $c){ ?>
                    <a href="<?= Url::toRoute(["main/landing", 'alias'=>$c->alias]);?>"><?= $c->name;?></a><br />
                    <?php } ?>
                </div>
            </div>
            <?php  ?>
        </div>
    </div>
</div>
<?php  $this->endCache();
}?>