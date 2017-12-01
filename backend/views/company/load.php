<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Загрузить с exel файла: ';
$this->params['breadcrumbs'][] = ['label' => 'Компании', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php print_r($arr); $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'file')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>