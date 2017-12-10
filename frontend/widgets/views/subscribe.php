<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>
<div class="subscribe">
    <p class="subscribe_title"><?= Yii::t('main', 'Свежие предложения');?></p>
    <div class="subscribe_body">
        <p class="subscribe_desc"><?= Yii::t('main', 'Подпишись и будь в курсе всех новых кредитных предложений');?></p>
        <?php Pjax::begin(['id' => 'subscribe_pjax']); ?>
        <?php $form = ActiveForm::begin([
            'id' => 'subscribe-form',
            'options' => ['data-pjax' => true]
            
        ]); ?>
    
            <?= $form->field($model, 'phone')->textInput(['placeholder' => Yii::t('app', 'Ваш телефон')])->label(false) ?>
        
            <?= $form->field($model, 'email')->input('email',['placeholder' => Yii::t('app', 'или e-mail')])->label(false) ?>
        
            <div class="form-group">
                <?= Html::submitButton(\Yii::t('main', 'Подписаться'), ['class' => 'subscribe_button', 'name' => 'contact-button']) ?>
            </div>
            <?php
            if ($success) {
            ?>
            <div class='alert alert-success' role='alert'>
                <?= Yii::t('main', 'Подписка успешно оформлена');?>
            </div>
            <?php }?>
            <?php
            if ($error) {
            ?>
            <div class='alert alert-danger' role='alert'><?= Yii::t('main', 'Хотябы одно поле обязательно к заполнению');?></div>
            <?php }?>
        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
    </div>
</div>