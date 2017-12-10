<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\search\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Создать компанию';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <p>
        <?= Html::a('Создать компанию', ['create'], ['class' => 'btn btn-success']) ?> <?= Html::a('Загрузить из файла', ['load'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="row">
        <div class="col-sm-3">
            <li class="list-group-item" style="<?php if(!$active){echo "background-color: #f2f2f2;";} ?>">
                <a style="<?php if(!$active){echo "text-decoration: underline;";} ?>" href="<?= Url::toRoute(["company/index"]);?>">Все</a>
            </li>
            <li class="list-group-item" style="<?php if($active){echo "background-color: #f2f2f2;";} ?>">
                <a style="<?php if($active){echo "text-decoration: underline;";} ?>" href="<?= Url::toRoute(["company/index", 'active'=>1]);?>">Активные</a>
            </li>
        </div>
    </div>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            'name',
            'alias',
            'h1',
            'seo_title',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
