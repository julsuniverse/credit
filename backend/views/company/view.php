<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model src\entities\company\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Компании', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

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
            'h1',
            'desc',
            'text',
            'photo',
            'message',
            'vk_group',
            'fb_group',
            'max_sum',
            'max_termin',
            'age',
            'time_review',
            'pay',
            'stars',
            'raiting',
            'href',
            'checked:boolean',
            'overpayments',
            //'last_upd',
            'on_main:boolean',
            'recommended:boolean',
            'seo_title',
            'seo_desc',
            'seo_keys',
        ],
    ]) ?>

</div>
