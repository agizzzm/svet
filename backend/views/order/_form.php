<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\db\Order */
/* @var $form yii\widgets\ActiveForm */
/* @var array $clients */
?>

<div class="order-form">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model,
            'client_id')->dropDownList(\yii\helpers\ArrayHelper::merge([null => 'Выберите клиента'], $clients)) ?>

        <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сформировать заказ', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
