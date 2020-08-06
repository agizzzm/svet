<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\repositories\ClientRepository */
/* @var $form yii\widgets\ActiveForm */
/* @var array $categories */
/* @var array $partners */
/* @var bool $isCreate */

$js = <<<JS
$('#clientrepository-phone').mask('+0 (000) 000 00 00', {placeholder: "+_ (___) ___ __ __"});
JS;

$this->registerJs($js);

?>

<div class="client-form">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'middlename')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->input('email',
            ['maxlength' => true, 'placeholder' => 'email@example.com']) ?>

        <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::merge([null => 'Не выбрано'],
            $categories)) ?>

        <?= $form->field($model, 'partner_id')->dropDownList(\yii\helpers\ArrayHelper::merge([null => 'Не выбрано'],
            $partners)) ?>

        <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'first_payment')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?php if ($isCreate) : ?>
                <?= Html::submitButton('Сформировать заказ', ['class' => 'btn btn-success']) ?>
            <?php else: ?>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            <?php endif ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
