<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\Client */
/* @var $orderModel \common\models\repositories\OrderRepository */

$this->title = 'Сформировать заказ';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Добавить клиента', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    Ссылка на оплату https://svetoforgroup.ru/payment/order/<?= $orderModel->id ?>

</div>
