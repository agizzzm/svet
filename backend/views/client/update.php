<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\repositories\ClientRepository */
/* @var array $categories */

$this->title = 'Обновить данные клиента: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="client-update">

    <?= $this->render('_form', [
        'model'      => $model,
        'categories' => $categories,
        'isCreate'   => false,
    ]) ?>

</div>
