<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Themes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Theme', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'vk_link',
            'fb_link',
            'site_link',
            'wall_update',
            // 'bott_col1',
            // 'bott_col2',
            // 'bott_col3',
            // 'bott_col4',
            // 'foot_col1',
            // 'foot_col2',
            // 'foot_col3',
            // 'foot_col4',
            // 'seo_title_main',
            // 'seo_desc_main',
            // 'seo_keys_main',
            // 'seo_title_vse',
            // 'seo_desc_vse',
            // 'seo_keys_vse',
            // 'seo_title_blog',
            // 'seo_desc_blog',
            // 'seo_keys_blog',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
