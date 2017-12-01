<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Offer */

$this->title = 'Редактировать оффер: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Оффера', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="offer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
