<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\Order */
/* @var array $clients */

$this->title = 'Создать заказ';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <?= $this->render('_form', [
        'model' => $model,
        'clients' => $clients,
    ]) ?>

</div>
