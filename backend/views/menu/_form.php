<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model src\entities\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->widget(Select2::className(), [
        'data' => $model->findAliases(),
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => '',
        ],
    ]); ?>

    <?= $form->field($model, 'placement')->widget(Select2::className(), [
        'data' => [0 => 'Верхнее меню', 1 => 'Нижнее меню', 2 => 'Меню в подвале'],
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'column')->widget(Select2::className(), [
        'data' => [1 => 1, 2 => 2, 3 => 3, 4 => 4],
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
