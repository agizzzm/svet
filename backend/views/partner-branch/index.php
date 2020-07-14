<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PartnerBranchSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $metros */

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
        'layout'       => '{items}{pager}',
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
            [
                'attribute' => 'metro',
                'value'     => function ($model) use ($metros) {
                    /* @var \common\models\repositories\PartnerBranchRepository $model */
                    $metroIds = $model->metro ? explode(',', $model->metro) : [];
                    $html = '';
                    foreach ($metroIds as $id) {
                        if (isset($metros[$id])) {
                            $html .= $metros[$id] . ' | ';
                        }
                    }

                    return $html;
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
