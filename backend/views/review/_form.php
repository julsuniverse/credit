<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model src\entities\company\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'stars')->textInput() ?>

    <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'raiting')->textInput() ?>

    <?= $form->field($model, 'likes')->textInput() ?>

    <?= $form->field($model, 'user_ids_like')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_ids_dislike')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ball')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
