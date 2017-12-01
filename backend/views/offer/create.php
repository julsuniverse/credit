<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Offer */

$this->title = 'Создать оффер';
$this->params['breadcrumbs'][] = ['label' => 'Офферы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
