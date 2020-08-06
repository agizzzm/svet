<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\db\Partner */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
$('#partnerrepository-contact_phone').mask('+0 (000) 000 00 00', {placeholder: "+_ (___) ___ __ __"});

var url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party";
var token = "bc484b6f0f90f8c4a14ff0d576207895c6cd3dba";
var query = "7707083893";

$('#partnerrepository-inn').on('keyup', function(data) {
    var inn = $(this).val();
    
    async function postData(url = '', inn = '') {
        const response = await fetch(url, {
            method: 'POST',
            mode: 'cors',
            headers: {
               "Content-Type": "application/json",
                "Accept": "application/json",
                "Authorization": "Token " + token
            },
            body: JSON.stringify({query: inn})
        });
        
        return await response.json();
    }
    
    postData(url, inn)
      .then((data) => {
          if(data.suggestions) {
              $('#partnerrepository-ur_address').val(data.suggestions[0].data.address.value);
          }
      });
});

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

        <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ur_address')->textarea(['maxlength' => true, 'readonly' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
