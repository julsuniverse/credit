<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model src\entities\page\Page */

$this->title = $model->h1;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

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
            //'id',
            'h1',
            'alias',
            //'offer_id',
            [
                'attribute'=>'offer_id',
                'value'=> ArrayHelper::getValue($model, 'offer.name')
            ],
            'text_1:ntext',
            'expert_title',
            'expert_text:ntext',
            'text_2:ntext',
            'helpfull:boolean',
            'recommended:boolean',
            [
                'attribute'=>'photo',
                'value'=>'/frontend/web/img/'.$model->photo,
                'format' => ['image',['width'=>'100px']],
            ],
            'seo_title',
            'seo_desc:ntext',
            'seo_keys:ntext',
        ],
    ]) ?>

</div>
