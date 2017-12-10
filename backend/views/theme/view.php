<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Theme */

$this->title = "Настройки + СЕО";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'default_sum',
            'metrics',
            'vk_link',
            'fb_link',
            'site_link',
            'wall_update',
            'bott_col1',
            'bott_col2',
            'bott_col3',
            'bott_col4',
            'foot_col1',
            'foot_col2',
            'foot_col3',
            'foot_col4',
            'seo_title_main',
            'seo_desc_main',
            'seo_keys_main',
            'seo_title_vse',
            'seo_desc_vse',
            'seo_keys_vse',
            'seo_title_blog',
            'seo_desc_blog',
            'seo_keys_blog',
        ],
    ]) ?>

</div>
