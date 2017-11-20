<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\Theme;
$theme=Theme::find()->where(['id'=>1])->one();
$this->title = $theme->seo_title_blog;
$this->registerMetaTag([ 
    'name'=>'description', 
    'content'=>$theme->seo_desc_blog
]); 
$this->registerMetaTag([ 
    'name'=>'keywords', 
    'content'=>$theme->seo_keys_blog
]);
?>
<div class="container landing">
    <div class="lan_title">
        <h1>Все статьи</h1>
        <img src="/frontend/web/img/lend_title.png" alt="<?= $theme->seo_title_blog;?>" />
    </div>
<div class="company_list"> 
    <?php $i = 0; if($articles) {  foreach($articles as $article){ ?>
    <div class="company">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="company_bg">
                    <div class="company_block">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <img style="max-width: 142px; border-radius: 100%;" src="/frontend/web/img/<?= $img[$i] ?>" alt="<?= $article->h1;?>" />
                                </div>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <a href="<?=Url::toRoute(['main/landing', 'alias' =>$article->alias]);?>"><h2 class="company_name"><?= $article->h1;?></h2></a>
                                    <?php mb_internal_encoding("UTF-8"); 
                                    $text= mb_substr($article->text_1, 0, 400);
                                    echo $text.'...';
                                    ?>
                                    <div>
                                        <a href="<?=Url::toRoute(['main/landing', 'alias' =>$article->alias]);?>">Читать дальше <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                    
                                </div>      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
    <?php $i++; } } else {?>
    <div class="company">
        <div class="row">
            <h4 class="nocompanies">К сожалению, сатаей пока что нет.</h4>
        </div>
    </div> 
    <?php }?>
</div>
</div>