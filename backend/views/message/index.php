<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Переводы';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.table-bordered>tbody>tr>td {
    max-width: 200px;
}
</style>
<div class="message-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
            [
                'attribute' => 'id',
                'filter' => $searchModel->findMessages(),
                'format'=>'row',
                'content' => function($model) {
                    return $model->id0->message;
                },
            ],
            //'language',
            'translation',

            
        ],
    ]); ?>
</div>
