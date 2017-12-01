<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'text:ntext',
            //'user_id',
            [
                'attribute'=>'user_id',
                'value'=> ArrayHelper::getValue($model, 'user.name')
            ],
            //'company_id',
            [
                'attribute'=>'company_id',
                'value'=> ArrayHelper::getValue($model, 'company.name')
            ],
            'stars',
            //'date',
            [
                'attribute'=>'date',
                'value'=> date('d.m.Y', $model->date)
            ],
            'raiting',
            'likes',
            //'user_ids_like:ntext',
            //'user_ids_dislike:ntext',
            'ball'
        ],
    ]) ?>

</div>
