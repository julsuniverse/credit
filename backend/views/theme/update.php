<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Theme */

$this->title = 'Редактировать настройки';
$this->params['breadcrumbs'][] = ['label' => "Настройки", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="theme-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
