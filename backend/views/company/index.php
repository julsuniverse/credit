<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\search\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'alias',
            'h1',
            'desc',
            // 'text',
            // 'photo',
            // 'message',
            // 'vk_group',
            // 'fb_group',
            // 'max_sum',
            // 'max_termin',
            // 'age',
            // 'time_rewiew',
            // 'pay',
            // 'stars',
            // 'raiting',
            // 'href',
            // 'checked',
            // 'overpayments',
            // 'last_upd',
            // 'on_main',
            // 'recommended',
            // 'seo_title',
            // 'seo_desc',
            // 'seo_keys',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
