<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\PartnerBranch */
/* @var array $partners */
/* @var array $categories */

$this->title = 'Обновить данные: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Филиалы партнеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="partner-branch-update">

    <?= $this->render('_form', [
        'model'      => $model,
        'categories' => $categories,
        'partners'   => $partners,
    ]) ?>

</div>
