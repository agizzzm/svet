<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ClientSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <p>
        <?= Html::a('Добавить клиента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'layout'       => '{items}\n{pager}',
        'columns'      => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'lastname',
            'firstname',
            'middlename',
            'phone',
            'email:email',
            //'category_id',
            [
                'attribute' => 'category_id',
                'value'     => function ($model) {
                    /* @var \common\models\repositories\ClientRepository $model */
                    return $model->category ? $model->category->category : 'без категории';
                },
            ],
            'cost',
            'first_payment',

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
