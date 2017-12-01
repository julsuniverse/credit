<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use backend\models\Company;
/* @var $this yii\web\View */
/* @var $searchModel backend\search\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}{link}',
            ],
            //'id',
            //'user_id',
            [
                'attribute'=>'user_id',
                'filter'=> $searchModel::usersList(),
                'value'=>'user.name'
            ],
            //'company_id',
            [
                'attribute'=>'company_id',
                'filter'=> $searchModel::companyList(),
                'value'=>'company.name'
            ],
            'stars',
            'text:ntext',
            // 'date',
            // 'raiting',
            // 'likes',
            // 'user_ids_like:ntext',
            // 'user_ids_dislike:ntext',

            
        ],
    ]); ?>
</div>
