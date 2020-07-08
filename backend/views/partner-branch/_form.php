<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\db\PartnerBranch */
/* @var $form yii\widgets\ActiveForm */
/* @var array $partners */
/* @var array $categories */
?>

<div class="partner-branch-form">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'partner_id')->dropDownList($partners) ?>

        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'category_id')->dropDownList($categories) ?>

        <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
