<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\repositories\PartnerBranchRepository */
/* @var $form yii\widgets\ActiveForm */
/* @var array $partners */
/* @var array $categories */
/* @var array $metros */

$branchMetros = [];
$selectedVals = '';
if (!empty($model->metro)) {
    $userPartners = explode(',', $model->metro);
    $selectedVals = '[' . $model->metro . ']';
}

$items = [];
foreach ($metros as $id => $metro) {
    $item = new \StdClass;
    $item->id = $id;
    $item->text = $metro;
    $items[] = $item;
}

$js = json_encode($items, JSON_UNESCAPED_UNICODE);

$js = "var data = " . $js . ";

$('#metros').select2({
  data: data
});

$('#metros').val(" . $selectedVals . "); 
$('#metros').trigger('change'); 
";

$this->registerJs($js);
?>

<div class="partner-branch-form">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'partner_id')->dropDownList($partners) ?>

        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

        <div class="form-group field-userrepository-email">
            <label class="control-label">Ближайшие метро</label>
            <?= Html::dropDownList('metros[]', null, $metros,
                [
                    'class'    => 'form-control',
                    'multiple' => 'multiple',
                    'id'       => 'metros',
                ]) ?>
            &nbsp;</label>
        </div>

        <?= $form->field($model, 'category_id')->dropDownList($categories) ?>

        <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
