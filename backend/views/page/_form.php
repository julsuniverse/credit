<?php

use src\entities\page\Folderpage;
use src\entities\page\Offer;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\file\FileInput;

mihaildev\elfinder\Assets::noConflict($this);
/* @var $this yii\web\View */
/* @var $model src\entities\page\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'offer_id')->widget(Select2::className(), [
        'data' => Offer::find()->select(['name', 'id'])->indexBy('id')->column(),
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите оффер'],
        'pluginOptions' => [
            'allowClear' => true,
        ], 
    ])?>

    <?= $form->field($model, 'folder_id')->widget(Select2::className(), [
        'data' => Folderpage::find()->select(['name', 'id'])->indexBy('id')->column(),
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите папку'],
        'pluginOptions' => [
            'allowClear' => true,
        ], 
    ])?>

    <?= $form->field($model, 'short_desc')->textarea(['rows' => 6]) ?>

    <?=$form->field($model, 'text_1')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[]),
        ]);
?>

    <?= $form->field($model, 'expert_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expert_text')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[]),
        ]);?>

    <?= $form->field($model, 'text_2')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[]),
        ]);?>

    <?= $form->field($model, 'helpfull')->dropDownList(['0'=>'Не показывать','1'=>'Показывать']) ?>

    <?= $form->field($model, 'recommended')->dropDownList(['0'=>'Не показывать','1'=>'Показывать']) ?>

    <?php if($model->photo){echo "<img style='width:100px;' src='../../frontend/web/img/".$model->photo."'/>";}?>
    <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => ['previewFileType' => 'image','showUpload' => false]
    ]); ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seo_keys')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
    $(document).ready(function() {
        if($('#page-recommended').val() == true)
            $('.field-page-photo').css('display', 'block');
        else
            $('.field-page-photo').css('display', 'none');
    });
    $('#page-recommended').on('change', function(){
        if($('#page-recommended').val() == true)
            $('.field-page-photo').css('display', 'block');
        else
            $('.field-page-photo').css('display', 'none');
    });
JS;
$this->registerJs($script);
?>