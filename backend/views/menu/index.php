<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <p>
        <?= Html::a('Создать пункт меню', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            [
                'attribute' => 'name',
                'filter' => $searchModel::menuList()
            ],
            'alias',
            [
                'attribute' => 'placement',
                'filter' => ['0' => 'Верхнее меню', '1' => 'Нижнее меню', '2' => 'Меню в подвале'],
                'value' => function($data) {
                    $arr = ['0' => 'Верхнее меню', '1' => 'Нижнее меню', '2' => 'Меню в подвале'];
                    return $arr[$data->placement];
                }
            ]
            //'column',

        ],
    ]); ?>
<?php Pjax::end(); ?></div>
