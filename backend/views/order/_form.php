<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\db\Order */
/* @var $form yii\widgets\ActiveForm */
/* @var array $clients */

$items = [];
foreach ($clients as $id => $client) {
    $item = new \StdClass;
    $item->id = $id;
    $item->text = $client;
    $items[] = $item;
}

$js = json_encode($items, JSON_UNESCAPED_UNICODE);


$js = 'var data = ' . $js . ';

$("#orderrepository-client_id").select2({
  data: data
})
';

$this->registerJs($js);

?>

<div class="order-form">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'client_id')->dropDownList([]) ?>

        <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
