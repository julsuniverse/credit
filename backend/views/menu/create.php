<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model src\entities\Menu */

$this->title = 'Добавить пункт меню';
$this->params['breadcrumbs'][] = ['label' => 'Все меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
