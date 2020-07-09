<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var bool $isCreate */
?>

<div class="user-form">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->input('email') ?>

        <?php if ($isCreate) : ?>
            <?= $form->field($model, 'password_hash')->input('password') ?>
        <?php else : ?>
            <?= $form->field($model, 'password_new')->input('password') ?>
        <?php endif ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
