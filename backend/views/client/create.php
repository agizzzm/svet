<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\repositories\ClientRepository */
/* @var array $categories */

$this->title = 'Добавить клиента';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-create">

    <?= $this->render('_form', [
        'model'      => $model,
        'categories' => $categories,
    ]) ?>

</div>
