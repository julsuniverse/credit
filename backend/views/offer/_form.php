<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Company;
use backend\models\Folderoffer;
/* @var $this yii\web\View */
/* @var $model common\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'folder')->widget(Select2::className(), [
        'data' => Folderoffer::find()->select(['name', 'id'])->indexBy('id')->column(),
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите папку'],
        'pluginOptions' => [
            'allowClear' => true,
        ], 
    ])?>
    <?= $form->field($model, 'ids')->widget(Select2::className(), [
        'data' => Company::find()->select(['alias', 'id'])->where(['!=','alias', ''])->andWhere(['!=', 'href', ''])->indexBy('id')->column(),
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true,
        ], 
    ])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
