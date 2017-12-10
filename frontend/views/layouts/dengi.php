<?php

use frontend\widgets\FooterMenuWidget;
use frontend\widgets\TopMenuWidget;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use src\entities\Theme;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <?php $theme = Theme::dataLayout(); ?>
        <title><?= Html::encode($this->title) ?></title>

        <?php if(Yii::$app->controller->action->id == 'company'){?>
        <link rel="amphtml" href="<?=Yii::$app->urlManager->createAbsoluteUrl(['main/company-amp', 'alias'=>$_GET['alias']]);?>">
        <?php }?>
            <?php if(Yii::$app->controller->action->id == 'landing'){?>
        <link rel="amphtml" href="<?=Yii::$app->urlManager->createAbsoluteUrl(['main/landing-amp', 'alias'=>$_GET['alias']]);?>">
        <?php }?>

        <?php//= $theme->metrics;?>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
            <?= TopMenuWidget::widget() ;?>
            <?= $content ?>
        <footer class="footer">
            <?= FooterMenuWidget::widget(['theme' => $theme]);?>
            <?= $theme->metrics;?>
        </footer>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
