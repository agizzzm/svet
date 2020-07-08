<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Вы уверены что хотите удалить запись?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    Ссылка на оплату https://svetoforgroup.ru/payment/order/<?= $model->id ?>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'client_id',
            'cost',
        ],
    ]) ?>

</div>
