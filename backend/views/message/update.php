<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model src\entities\locale\Message */

$this->title = 'Редактировать перевод: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Переводы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="message-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
