<?php
use yii\helpers\Url;
$this->title = $company->title;
$this->registerMetaTag([ 
    'name'=>'description', 
    'content'=>$company->seo_desc
]); 
$this->registerMetaTag([ 
    'name'=>'keywords', 
    'content'=>$company->seo_keys
]);
?>
    <div class="onecompany">
        <div class="combord">
            <div class="compinfo">
                <div class="left">
                    <div class="divimg">
                        <amp-img width="200" height="80" class="logocomp" src="/frontend/web/img/<?=$company->img;?>" alt="<?=$company->name;?>"></amp-img><br />
                        <amp-img width="350" height="100" layout="responsive" class="locdec" src="/frontend/web/img/logodeccomp.png"></amp-img>
                        <h1><?=$company->h1;?></h1>
                    </div>
                </div>
                <div class="right">
                    <p><?= Yii::t('app', 'Максимальная сумма кредита');?><span><?=$company->max_sum;?> <?= Yii::t('app', 'p.');?></span></p>
                    <p><?= Yii::t('app', 'Срок кредитования до');?><span><?=$company->termin;?></span></p>
                    <?php if($company->overpayments){?>
                    <p><?= Yii::t('app', 'Переплата за 10000, за 14 дней');?><span> <?=$company->overpayments;?> <?= Yii::t('app', 'р.');?></span></p>
                    <?php }?>
                    <p><?= Yii::t('app', 'Способ выплаты');?><span>
                        <?php if(strpos($company->pay, '2')!==false){?>
                        <amp-img width="38" height="35" src="/frontend/web/img/opl1.png" alt="<?= Yii::t('app', 'На карту');?>" title="<?= Yii::t('app', 'На карту');?>"></amp-img>
                        <?php }?>
                        <?php if(strpos($company->pay, '1')!==false){?>
                        <amp-img width="38" height="35" src="/frontend/web/img/opl2.png" alt="<?= Yii::t('app', 'Наличными');?>" title="<?= Yii::t('app', 'Наличными');?>"></amp-img>
                        <?php }?>
                        <?php if(strpos($company->pay, '3')!==false){?>
                        <amp-img width="38" height="35" src="/frontend/web/img/olp3.png" alt="<?= Yii::t('app', 'На дом');?>" title="<?= Yii::t('app', 'На дом');?>"></amp-img>
                        <?php }?>
                        <?php if(strpos($company->pay, '4')!==false){?>
                        <amp-img width="38" height="35" src="/frontend/web/img/opl4.png" alt="<?= Yii::t('app', 'Яндекс.Деньги');?>" title="<?= Yii::t('app', 'Яндекс.Деньги');?>"></amp-img>
                        <?php }?>
                    </span></p>
                    <p><?= Yii::t('app', 'Возраст заемщика');?><span><?= Yii::t('app', 'от');?> <?=$company->age;?></span></p>
                    <p><?= Yii::t('app', 'Рейтинг');?><span>
                        <?php 
                        echo $company->stars.' / 5';
                        ?>
                    </span></p>
                </div>
                <div class="clear"></div>
                <div class="desc">
                    <?=$company->desc;?>
                </div>           
            </div>
        </div>
        <?php if($company->href){?>
        <div class="findk">
            <a data-id="<?=$company->id;?>" class="getcredit" href="<?=$company->href;?>" target="_blank"><span><?= Yii::t('app', 'Получить кредит');?></span></a>
        </div> 
        <?php } else {?>
        <div class="nofindk">
            <span>
            <?= Yii::t('app', 'К сожалению, на данный момент компания не выдает займы.');?><br />
            <?= Yii::t('app', 'Попробуйте');?> <a id="torecomend" href="#recomend"><?= Yii::t('app', 'похожие предложения');?></a>
            </span>
        </div>
        <?php }?>
    </div>
    <div class="container reviews">
        <div class="pod_title">
            <h2><?= Yii::t('app', 'ОТЗЫВЫ о');?> <?=$company->h1;?></h2>
        </div>
        <?php if(!$company->comments){?>
        <div class="noreviews">
            <div class="alert alert-warning" role="alert"><?= Yii::t('app', 'Отзывов пока что нет.');?></div>
        </div>
        <?php } else { ?>
        <?php 
        $comments=$company->comments;
        foreach($comments as $com){?>
        <div class="review_border container">
            <div class="review row">
                <div>
                    <div class="name"><a  target="_blank" href="<?=$com->user->user_href;?>"><?=$com->user->name;?></a>
                    <span>
                    <?php 
                    echo $com->stars.' / 5';
                    ?>
                    </span>
                    </div>
                    <p><?=$com->text;?></p>
                </div>
                <div>
                    <div>
                        <div class="date"><?=date("d:m:Y",$com->date);?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }?>
    </div>
    <div class="container recomend" id="recomend">
        <div class="pod_title">
            <p class="ne_podhodit"><?= Yii::t('app', 'Не подходит данный вариант? Посмотрите популярные предложения');?></p>
        </div>
        <div class="row">
            <amp-carousel height="495" layout="fixed-height" type="slides">
            <?php foreach($rec as $r){ ?>
            <div>
                <div class="recblock">
                    <amp-img width="364" height="455" layout="responsive" class="imgbl" src="/frontend/web/img/recblock.png"></amp-img>
                    <table>
                        <tr>
                            <td colspan="2">
                                <div class="recimg">
                                    <amp-img width="125" height="50" class="logo_comp_rec" src="/frontend/web/img/<?= $r->img;?>"></amp-img>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="name_stars">
                                <a href="<?=Url::toRoute(['main/company-amp', 'alias' =>$r->alias]);?>" class="title"><?= $r->name;?></a>
                                <div>
                                <?php echo '<b>'.Yii::t('app', 'рейтинг:') . '</b>'.$r->stars.' / 5'; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="sumsrok">
                                <p><?= Yii::t('app', 'Сумма, (р)');?></p>
                                <p><?= Yii::t('app', 'Срок, (дн)');?></p>
                            </td>
                            <td class="sumsrokval">
                                <p>до <?= $r->max_sum;?> <?= Yii::t('app', 'руб');?></p>
                                <p><?= $r->termin;?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="desc">
                                <p><?= strip_tags($r->lit_desc);?></p>
                            </td>
                        </tr>
                    </table>
                   
                    <div class="findkrec">
                        <a target="_blank" data-id="<?=$r->id;?>" class="getcredit" href="<?=$r->href;?>"><?= Yii::t('app', 'Получить кредит');?></a>
                    </div> 
                </div>
            </div>
            <?php } ?>
            </amp-carousel>
        </div>
    </div>