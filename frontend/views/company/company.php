<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;
use recaptcha\ReCaptcha;
use yii\widgets\Pjax;
$this->title = $company->seo_title;
$this->registerMetaTag([ 
    'name'=>'description', 
    'content'=>$company->seo_desc
]); 
$this->registerMetaTag([ 
    'name'=>'keywords', 
    'content'=>$company->seo_keys
]);


?>
<div class="container onecompany">
    <div class="row">
        <div class="col-md-9">
            <div class="combord">
                <div class="compinfo">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-7 col-xs-7">
                                <h1><?=$company->h1;?></h1>
                                <p class="stars">
                                <span>
                                    <?php
                                    $full=$company->stars;
                                    $pol=5-$full;
                                    for($i=0;$i<$full;$i++){?>
                                        <i class="fa fa-star star_full" aria-hidden="true"></i>
                                    <?php }
                                    for($i=0;$i<$pol;$i++){?>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php }?>
                                </span>
                                </p>
                            </div>
                            <div class="col-md-6 col-sm-5 col-xs-5">
                                <img class="logocomp" src="/frontend/web/img/<?=$company->photo;?>" alt="<?=$company->name;?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-7 col-xs-7">
                                <div class="left">
                                    <p><?= Yii::t('app', 'Максимальная сумма кредита');?></p>
                                    <p><?= Yii::t('app', 'Срок кредитования до');?></p>
                                    <?php if($company->overpayments){?>
                                        <p><?= Yii::t('app', 'Переплата за 10000, за 14 дней');?></p>
                                    <?php }?>
                                    <p><?= Yii::t('app', 'Возраст заемщика');?></p>
                                    <p><?= Yii::t('app', 'Способ выплаты');?></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-5 col-xs-5">
                                <div class="right">
                                    <p><span><?=$company->max_sum;?> <?= Yii::t('app', 'р.');?></span></p>
                                    <p><span><?=$company->termin;?></span></p>
                                    <?php if($company->overpayments){?>
                                        <p><span> <?=$company->overpayments;?> <?= Yii::t('app', 'p.');?></span></p>
                                    <?php }?>
                                    <p><span>от <?=$company->age;?></span></p>
                                    <p>
                                    <span>
                                        <?php if(strpos($company->pay, '2')!==false){?>
                                            <img src="/frontend/web/img/opl1.png" alt="<?= Yii::t('app', 'На карту');?>" title="<?= Yii::t('app', 'На карту');?>"/>
                                        <?php }?>
                                        <?php if(strpos($company->pay, '1')!==false){?>
                                            <img src="/frontend/web/img/opl2.png" alt="<?= Yii::t('app', 'Наличными');?>" title="<?= Yii::t('app', 'Наличными');?>"/>
                                        <?php }?>
                                        <?php if(strpos($company->pay, '3')!==false){?>
                                            <img src="/frontend/web/img/olp3.png" alt="<?= Yii::t('app', 'На дом');?>" title="<?= Yii::t('app', 'На дом');?>"/>
                                        <?php }?>
                                        <?php if(strpos($company->pay, '4')!==false){?>
                                            <img src="/frontend/web/img/opl4.png" alt="<?= Yii::t('app', 'Яндекс.Деньги');?>" title="<?= Yii::t('app', 'Яндекс.Деньги');?>"/>
                                        <?php }?>
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="desc">
                        <?=$company->desc;?>
                    </div>
                    <?php if($company->href){?>
                        <div class="findk">
                            <a data-id="<?=$company->id;?>" class="getcredit" href="#" target="_blank"><?= Yii::t('app', 'Получить кредит');?></a>
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

            </div>

            <div class=" recomend" id="recomend">
                <div class="pod_title">
                    <p class="ne_podhodit"><?= Yii::t('app', 'Не подходит данный вариант? Посмотрите популярные предложения');?></p>
                </div>
                <div class="row">
                    <?php foreach($rec as $r){ ?>
                        <div class="col-md-12 col-lg-4 col-sm-12 col-xs-12">
                            <div class="recblock">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <div class="recimg">
                                                <img class="logo_comp_rec" src="/frontend/web/img/<?= $r->photo;?>"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="name_stars">
                                            <a href="<?=Url::toRoute(['company/company', 'alias' =>$r->alias]);?>" class="title"><?= $r->name;?></a>
                                            <div>
                                                <?php for($i=0; $i<$r->stars;$i++) { ?>
                                                    <i class="fa fa-star star_full" aria-hidden="true"></i>
                                                <?php } ?>
                                                <?php for($i=0; $i<5 - $r->stars;$i++) { ?>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="sumsrok">
                                            <p><?= Yii::t('app', 'Сумма, (руб)');?></p>
                                            <p><?= Yii::t('app', 'Срок, (дн)');?></p>
                                        </td>
                                        <td class="sumsrokval">
                                            <p><?= Yii::t('app', 'до');?> <?= $r->max_sum;?> <?= Yii::t('app', 'руб');?></p>
                                            <p><?= $r->termin;?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="desc">
                                            <p><?= $r->message;?></p>
                                        </td>
                                    </tr>
                                </table>
                                <?php if($r->checked){ ?>
                                    <span class="checked_strip"><?= Yii::t('app', 'Проверено');?></span>
                                <?php } ?>
                                <div class="findk">
                                    <a target="_blank" data-id="<?=$r->id;?>" class="getcredit" href="#"><?= Yii::t('app', 'Получить кредит');?></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?= \frontend\widgets\SubscribeWidget::widget();?>
        </div>
    </div>

</div>

<div class="reviews_big">
    <?php Pjax::begin(['id' => 'company-pjax']); ?>
    <div class="container reviews">
        <div class="pod_title">
            <h2><?= Yii::t('app', 'ОТЗЫВЫ о');?> <?=$company->h1;?></h2>
        </div>
        <?php if(!$company->reviews){?>
            <div class="noreviews">
                <div class="alert alert-warning" role="alert"><?= Yii::t('app', 'Отзывов пока что нет.');?></div>
            </div>
        <?php } else { ?>
        <?php
        $comments=$company->reviews;
        foreach($comments as $com){?>
            <div class="container">
                <div class="review row">
                    <div class="col-md-2 col-sm-4">
                        <div class="bord_img">
                            <img src="<?=$com->user->photo;?>" alt="<?=$com->user->name;?>"/>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div class="name">
                            <a  target="_blank" href="<?=$com->user->user_href;?>"><?=$com->user->name;?></a>
                            <span>
                                <?php
                                $full=$com->stars;
                                $pol=5-$full;
                                for($i=0;$i<$full;$i++){?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                <?php }
                                for($i=0;$i<$pol;$i++){?>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php }?>
                            </span>
                        </div>
                        <p><?=$com->text;?></p>
                        <div class="likes">
                            <span class="title"><?= Yii::t('app', 'Отзыв полезен?');?></span>
                            <span class="count_likes count_likes<?=$com->id;?>"> <?=$com->likes;?> </span>
                            <span onclick="likecomm(<?=$com->id;?>)" class="like_plus" aria-hidden="true"><?= Yii::t('app', 'Да');?></span>
                            <span onclick="dislikecomm(<?=$com->id;?>)" class="like_minus"  aria-hidden="true"><?= Yii::t('app', 'Нет');?></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="date"><?=date("d:m:Y",$com->date);?></div>
                    </div>
                </div>
            </div>
        <?php } }?>
        <div class="add_comment" id="add-review">
            <?php if(Yii::$app->user->isGuest){?>
                <p class="add_title"><?= Yii::t('app', 'Довольны работой компании или разочарованы? Оставьте свой отзыв!');?><br /></p><p class="add_title"><?=Yii::t('app', 'Войти через:');?><br class="mobbr"/> <a href="<?=$fbhref;?>" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="<?=$vkhref?>" class="vk" data-pjax="0"><i class="fa fa-vk" aria-hidden="true"></i></a></p></p>
            <?php } else {?>
                <?=Html::a(Yii::t('app', 'Выйти'), Url::to(['auth/auth/logout'], true), ['data-pjax'=>0, 'class'=> 'add_comment_logout', 'data' => ['method' => 'post']]);?>
                <p class="add_review"><?= Yii::t('app', 'Добавить отзыв');?></p>
                <?php $f=ActiveForm::begin(['options'=>['data-pjax'=>true]]);?>
                <div class="row">
                    <div class="star_input row">
                        <div class="col-md-3 col-sm-3 col-xs-3 review_mark">
                            <span class="your_star"><?= Yii::t('app', 'Ваша оценка:')?></span>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">

                            <?php
                            echo StarRating::widget(['model' => $model, 'attribute' => 'star',
                                'pluginOptions' => [
                                    'size'=>'xs',
                                    'step'=>1,
                                    'showClear' => false,
                                    'showCaption' => false
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?=$f->field($model, 'text')->textArea(['placeholder' => Yii::t('app', 'Напишите здесь Ваше мнение о компании...'), 'class'=>'review_text'])->label('');?>
                        <?= $f->field($model, 'reCaptcha')->widget(ReCaptcha::className(), [
                            'id' => 'company-captcha',
                            'render' => ReCaptcha::RENDER_EXPLICIT,
                        ])->label(false) ?>
                    </div>
                    <div class="col-md-12">
                        <div class="rew_bott">
                            <div class="review_button">
                                <?= Html::submitButton(Yii::t('app', 'Добавить'), ['name' => 'add-button']) ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php ActiveForm::end();?>
            <?php }?>
        </div>
    </div>
    <?php Pjax::end();?>
    </div>



<?php
$script_wall = <<< JS
    var sochas=false;
    $(document).scroll(function() {
        var top = $("#wall").offset().top;
        var doctop=$("html").scrollTop();
        var id = $('#wall').data('id');
        if((doctop >= top - $(window).height()) && !sochas)
        {
            $.ajax({
                url: '/company/wall',
                type: 'GET',
                data: {id : id},
                success: function(data)
                {
                    $('#wall').html(data);
                }
            });
            sochas=true;
        }
    });
JS;
$this->registerJS($script_wall)
?>

<div id="wall" data-id="<?= $company->id; ?>"></div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabel" style="font-size: 18px;"><?= Yii::t('app', 'Ошибка');?></p>
      </div>
      <div class="modal-body">
        <p style="text-align: center;"><?= Yii::t('app', 'Что бы оценить отзыв, нужно авторизоваться');?></p>
      </div>
    </div>
  </div>
</div>
<div id="totop">
    <img src="/frontend/web/img/totop.png"/>
</div>
