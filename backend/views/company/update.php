<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model src\entities\company\Company */

$this->title = 'Редактировать компанию: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Компании', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $company->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="company-update">

    <?= $this->render('_form', [
        'model' => $model,
        'company' => $company
    ]) ?>

</div>