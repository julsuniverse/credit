<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model src\entities\company\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'time_rewiew',
            'pay',
            'stars',
            'raiting',
            'href',
            'checked',
            'overpayments',
            'last_upd',
            'on_main',
            'recommended',
            'seo_title',
            'seo_desc',
            'seo_keys',
        ],
    ]) ?>

</div>
