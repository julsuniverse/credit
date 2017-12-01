<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model src\entities\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'alias',
            [
                'attribute' => 'placement',
                'filter' => ['0' => 'Верхнее меню', '1' => 'Нижнее меню', '2' => 'Меню в подвале'],
                'value' => function($model) {
                    $arr = ['0' => 'Верхнее меню', '1' => 'Нижнее меню', '2' => 'Меню в подвале'];
                    return $arr[$model->placement];
                }
            ],
            'column',
        ],
    ]) ?>

</div>
