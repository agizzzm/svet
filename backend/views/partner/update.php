<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\Partner */

$this->title = 'Обновить данные: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="partner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
