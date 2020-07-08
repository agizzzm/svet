<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PartnerBranchSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Филиалы партернов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-branch-index">

    <p>
        <?= Html::a('Добавить филиал', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'partner_id',
                'value'     => function ($model) {
                    /* @var \common\models\repositories\PartnerBranchRepository $model */
                    return $model->partner ? $model->partner->name : 'не указан';
                },
            ],
            'address:ntext',
            [
                'attribute' => 'category_id',
                'value'     => function ($model) {
                    /* @var \common\models\repositories\PartnerBranchRepository $model */
                    return $model->category ? $model->category->category : 'без категории';
                },
            ],
            'cost',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons'  => [
                    'view'   => function ($url, $model) {
                        return Html::a(
                            '<span class="fa fa-eye"></span>',
                            $url);
                    },
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
