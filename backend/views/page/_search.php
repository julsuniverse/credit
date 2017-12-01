<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'h1') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'offer_id') ?>

    <?= $form->field($model, 'text_1') ?>

    <?php // echo $form->field($model, 'expert_text') ?>

    <?php // echo $form->field($model, 'text_2') ?>

    <?php // echo $form->field($model, 'helpfull') ?>

    <?php // echo $form->field($model, 'seo_title') ?>

    <?php // echo $form->field($model, 'seo_desc') ?>

    <?php // echo $form->field($model, 'seo_keys') ?>

    <?php // echo $form->field($model, 'expert_title') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
