<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use kartik\rating\StarRating;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model src\entities\company\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overpayments')->textInput() ?>

    <?= $form->field($model->meta, 'seo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->meta, 'seo_desc')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model->meta, 'seo_keys')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[]),
    ]); ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[]),
    ]); ?>

    <?php if($model->photo){echo "<img style='width:100px;' src='/frontend/web/img/$model->photo' alt='photo' />";}?>
    <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => ['previewFileType' => 'image','showUpload' => false]
    ]); ?>

    <?= $form->field($model, 'message')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'basic',
            'inline' => false,
        ],
    ]);?>

    <?= $form->field($model, 'vk_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fb_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_sum')->textInput() ?>

    <?= $form->field($model, 'max_termin')->textInput() ?>

    <?= $form->field($model, 'age')->widget(Select2::className(), [
        'data' => [1=>'18-19 лет', 2=>'20 лет',3=>'21 год и более'],
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])
    ?>

    <?= $form->field($model, 'time_review')->widget(Select2::className(), [
        'data' => ['5 минут'=>'5 минут','15 минут'=>'15 минут','1 час'=>'1 час','1 день'=>'1 день','несколько дней'=>'несколько дней','от недели'=>'от недели',],
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'pay')->widget(Select2::className(), [
        'data' => [1=>'Наличными', 2=>'На карту',3=>'На дом', 4=>'Яндекс.Деньги'],
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите способы', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])
    ?>

    <?= $form->field($model, 'stars')->widget(StarRating::classname(), [
        'pluginOptions' => ['step' => 1]
    ]);?>

    <?= $form->field($model, 'raiting')->textInput() ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checked')->checkbox() ?>

    <?= $form->field($model, 'on_main')->checkbox() ?>

    <?= $form->field($model, 'recommended')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
