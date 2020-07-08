<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\Order */
/* @var array $clients */

$this->title = 'Обновить заказ: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <?= $this->render('_form', [
        'model'   => $model,
        'clients' => $clients,
    ]) ?>

</div>
