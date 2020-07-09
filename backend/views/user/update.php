<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var array $partners */

$this->title = 'Обновить данные: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model'    => $model,
        'partners' => $partners,
        'isCreate' => false,
    ]) ?>

</div>
