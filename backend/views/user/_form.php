<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var bool $isCreate */
/* @var array $partners */

$userPartners = [];
$selectedVals = '';
if (!empty($model->partners_ids)) {
    $userPartners = explode(',', $model->partners_ids);
    $selectedVals = '[' . $model->partners_ids . ']';
}

$items = [];
foreach ($partners as $id => $partner) {
    $item = new \StdClass;
    $item->id = $id;
    $item->text = $partner;
    $items[] = $item;
}

$js = json_encode($items, JSON_UNESCAPED_UNICODE);

$js = "var data = " . $js . ";

$('#partners').select2({
  data: data
});

$('#partners').val(" . $selectedVals . "); 
$('#partners').trigger('change'); 
";


$this->registerJs($js);

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

        <div class="form-group field-userrepository-email">
            <label class="control-label">Назначенные партнеры</label>
            <?= Html::dropDownList('partners[]', null, $partners,
                [
                    'class'    => 'form-control',
                    'multiple' => 'multiple',
                    'id'       => 'partners',
                ]) ?>
            &nbsp;</label>
        </div>


        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
