<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model common\models\Theme */
/* @var $form yii\widgets\ActiveForm */
$sum=[500, 1000, 1500, 2000, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 6500, 7000, 7500, 8000, 8500, 9000, 9500, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000, 23000, 24000, 25000, 26000, 27000, 28000, 29000, 30000, 35000, 40000, 45000, 50000, 60000, 70000, 80000, 90000, 100000];
$arr=[];
foreach($sum as $s)
{
    $arr[$s]=$s;
}
?>

<div class="theme-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'default_sum')->dropDownList($arr) ?>
    
    <?= $form->field($model, 'metrics')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'vk_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fb_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wall_update')->dropDownList(['60'=>'Online','86400'=>'Ежедневно','259200'=>'Раз в 3 дня','604800'=>'Раз в неделю', '1209600'=>'Раз в 2 недели']) ?>

    <?= $form->field($model, 'bott_col1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bott_col2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bott_col3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bott_col4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foot_col1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foot_col2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foot_col3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foot_col4')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'alldesc')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[]),
        ]);?>

    <?= $form->field($model, 'seo_title_main')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_desc_main')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_keys_main')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_title_vse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_desc_vse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_keys_vse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_title_blog')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_desc_blog')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_keys_blog')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
