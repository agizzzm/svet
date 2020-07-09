<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrderSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <p>
        <?= Html::a('Добавить заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'layout'       => '{items}\n{pager}',
        'columns'      => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'client_id',
            [
                'attribute' => 'client_id',
                'value'     => function ($model) {
                    /* @var \common\models\repositories\OrderRepository $model */
                    return $model->client ? $model->client->lastname . ' ' . $model->client->firstname . ' ' . $model->client->middlename . ' ' . $model->client->phone : 'клиент не определен';
                },
            ],
            'cost',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons'  => [
                    'update' => function ($url, $model) {
                        return Html::a(
                            '<span class="fa fa-pen"></span>',
                            $url);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<span class="fa fa-trash"></span>',
                            $url);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
