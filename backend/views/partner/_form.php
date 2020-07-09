<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\db\Partner */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
$('#partnerrepository-contact_phone').mask('+0 (000) 000 00 00', {placeholder: "+_ (___) ___ __ __"});
JS;

$this->registerJs($js);
?>

<div class="partner-form">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->input('email',
            ['maxlength' => true, 'placeholder' => 'email@example.com']) ?>

        <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
