<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model src\entities\company\Company */

$this->title = 'Создать компанию';
$this->params['breadcrumbs'][] = ['label' => 'Компании', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
