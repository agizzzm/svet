<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\PartnerBranch */
/* @var array $partners */
/* @var array $categories */

$this->title = 'Добавить филиал';
$this->params['breadcrumbs'][] = ['label' => 'Филиалы партернов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-branch-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'partners' => $partners,
    ]) ?>

</div>
