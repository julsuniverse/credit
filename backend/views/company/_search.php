<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\search\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'h1') ?>

    <?= $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'vk_group') ?>

    <?php // echo $form->field($model, 'fb_group') ?>

    <?php // echo $form->field($model, 'max_sum') ?>

    <?php // echo $form->field($model, 'max_termin') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'time_rewiew') ?>

    <?php // echo $form->field($model, 'pay') ?>

    <?php // echo $form->field($model, 'stars') ?>

    <?php // echo $form->field($model, 'raiting') ?>

    <?php // echo $form->field($model, 'href') ?>

    <?php // echo $form->field($model, 'checked') ?>

    <?php // echo $form->field($model, 'overpayments') ?>

    <?php // echo $form->field($model, 'last_upd') ?>

    <?php // echo $form->field($model, 'on_main') ?>

    <?php // echo $form->field($model, 'recommended') ?>

    <?php // echo $form->field($model, 'seo_title') ?>

    <?php // echo $form->field($model, 'seo_desc') ?>

    <?php // echo $form->field($model, 'seo_keys') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
